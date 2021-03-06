<?php

require_once __DIR__ . '\..\vendor\autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;

$strHost     = '127.0.0.1';
$strPort     = '5672';
$strUsername = 'guest';
$strPassword = 'guest';
$strVhost    = '/';

$strQueue      = 'direct.queue';
$strExchange   = 'direct.exchange';
$strBindingKey = 'direct.binding';

try {

	$objConnection = new AMQPStreamConnection( $strHost, $strPort, $strUsername, $strPassword, $strVhost );
	$objChannel    = $objConnection->channel();

	$objChannel->exchange_declare( $strExchange, AMQPExchangeType::DIRECT, false, false, false );
	$objChannel->queue_declare( $strQueue );

	$callback = function ( $objMessage ) {
		print_r( '[x] ' . $objMessage->body . PHP_EOL );
		$objMessage->delivery_info['channel']->basic_ack( $objMessage->delivery_info['delivery_tag'] );
	};

	$objChannel->basic_consume( $strQueue, '', false, false, false, false, $callback );

	while ( $objChannel->is_consuming() ) {
		$objChannel->wait();
	}

	$objChannel->close();
	$objConnection->close();

} catch( Exception $objException ) {
	print_r( $objException->getMessage() );
}