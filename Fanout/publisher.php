<?php

require_once __DIR__ . '\..\vendor\autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AmqpMessage;

$strHost     = '127.0.0.1';
$strPort     = '5672';
$strUsername = 'guest';
$strPassword = 'guest';
$strVhost    = '/';

$strData       = 'Hey you!';
$strQueue      = 'fanout.queue';
$strExchange   = 'fanout.exchange';
$strBindingKey = 'fanout.binding';

try {

	$objConnection = new AMQPStreamConnection( $strHost, $strPort, $strUsername, $strPassword, $strVhost );
	$objChannel    = $objConnection->channel();

	$objChannel->exchange_declare( $strExchange, 'fanout', false, false, false );
	$objChannel->queue_declare( $strQueue );
	$objChannel->queue_bind( $strQueue, $strExchange, $strBindingKey );

	$objMessage = new AmqpMessage( $strData );

	$objChannel->basic_publish( $objMessage, $strExchange, $strBindingKey );

	print_r( '[x] sent ' . $strData . PHP_EOL );

	$objChannel->close();
	$objConnection->close();

} catch( Exception $objException ) {
	print_r( $objException->getMessage() );
}

