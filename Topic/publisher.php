<?php

require_once __DIR__ . '\..\vendor\autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AmqpMessage;
use PhpAmqpLib\Exchange\AMQPExchangeType;

$strHost     = '127.0.0.1';
$strPort     = '5672';
$strUsername = 'guest';
$strPassword = 'guest';
$strVhost    = '/';

$strData       = 'Hey you!';
$strQueue      = 'topic.queue';
$strExchange   = 'topic.exchange';
$strBindingKey = '#.in';

try {

	$objConnection = new AMQPStreamConnection( $strHost, $strPort, $strUsername, $strPassword, $strVhost );
	$objChannel    = $objConnection->channel();

	$objChannel->exchange_declare( $strExchange, AMQPExchangeType::TOPIC, false, false, false );
	$objChannel->queue_declare( $strQueue );
	$objChannel->queue_bind( $strQueue, $strExchange, $strBindingKey );

	$objMessage = new AmqpMessage( $strData );

	// @NOTE: We are publishing two messages here, first one will end up in Q as the
	// binding key (#.in) will match the routing key topic.in
	$objChannel->basic_publish( $objMessage, $strExchange, 'topic.in' );

	// This message will eventually be discarded as no binding key (#.in) will match the routing key topic.us
	$objChannel->basic_publish( $objMessage, $strExchange, 'topic.us' );

	print_r( '[x] sent ' . $strData . PHP_EOL );

	$objChannel->close();
	$objConnection->close();

} catch( Exception $objException ) {
	print_r( $objException->getMessage() );
}

