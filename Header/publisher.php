<?php

require_once __DIR__ . '\..\vendor\autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AmqpMessage;
use PhpAmqpLib\Wire\AMQPTable;
use PhpAmqpLib\Exchange\AMQPExchangeType;

$strHost     = '127.0.0.1';
$strPort     = '5672';
$strUsername = 'guest';
$strPassword = 'guest';
$strVhost    = '/';

$strData     = 'Hey you!';
$strQueue    = 'headers.queue';
$strExchange = 'headers.exchange';
$strHeaders  = '{"format": "pdf", "type": "report"}';

try {

	$objConnection = new AMQPStreamConnection( $strHost, $strPort, $strUsername, $strPassword, $strVhost );
	$objChannel    = $objConnection->channel();

	$objChannel->exchange_declare( $strExchange, AMQPExchangeType::HEADERS, false, false, false );
	$objChannel->queue_declare( $strQueue );
	$objChannel->queue_bind( $strQueue, $strExchange );

	$objMessage = new AmqpMessage( $strData );
	$objHeaders = new AMQPTable( [ 'format' => 'pdf', 'type' => 'report' ] );
	$objMessage->set( 'application_headers', $objHeaders );

	$objChannel->basic_publish( $objMessage, $strExchange );

	print_r( '[x] sent ' . $strData . PHP_EOL );

	$objChannel->close();
	$objConnection->close();

} catch( Exception $objException ) {
	print_r( $objException->getMessage() );
}

