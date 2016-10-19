<?php
// This our simple data source. Usually we should query database, or some other data stream.
// Here we have one multidimensional array with very simple structure - ticked -> price.
// Server sends those data one by one until the end waiting some random time (seconds) in between.
// In real life scenario you need real data source, but for example purpose it is OK.
// Array contains 70 elements which should be enough to run demo for 1-3 minutes.
$tickets = array(array("0"=> 'a',"1" =>  47.59 ), array("0"=>  162.99 , "1"=> 114.12 ),array( "0"=>  47.29 , "1"=> 533.95 ), array("0"=> 163.78 , "1"=> 533.55 ), array("0"=> 113.67 , "1"=> 533.91 ), array("0"=>  48.12 , "1"=>  162.37 ));

$ticketsLength = count($tickets);


// Set necessary headers
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
header("Connection: keep-alive");

// If connection is closed and then reopened then browser sends last event id that it received.
// So server can continue sending data from that even and not to send all events again.
// Note that it is incremented by one, because we have to send next value (after last id).
// HTTP header value is Last-Event-ID and should be accessible by HTTP_LAST_EVENT_ID field.
$lastId = $_SERVER["HTTP_LAST_EVENT_ID"];
if (isset($lastId) && !empty($lastId) && is_numeric($lastId)) {
	$lastId = intval($lastId);
	$lastId++;
} else {
	$lastId = 0;
}

// Check that lastId is not larger than the size of array - if it is larger star from zero.
if ($lastId >= $ticketsLength) {
	$lastId = 0;
}

// Using while server keeps connection open and thus we have only one request.
// If connection is closed browser will reconnect and will send last event Id.
while (true) {

	sendMessage($lastId, $tickets[$lastId][0], $tickets[$lastId][1]);
	$lastId++;

	// Check that lastId is not larger than the size of array - if it is larger close connection.
	if ($lastId >= $ticketsLength) {
		die();
	}

	// This code tests that last event id really wokrs.
	// Connection is closed on 10, 20 30, etc. ids and then should continue to next id.
	// Uncomment it if you want to test it.
	//if ($lastId % 10 == 0) {
	//	die();
	//}

	// Sleep some random seconds
	sleep(rand(1, 3));
}


// Function to send data in format "ticket:price".
function sendMessage($id, $ticket, $price) {
	
	$url=base_url().$this->user->root."/orders/details/";
	//echo "id: <div  class='tab_wrper'>\n";
	echo "data: $ticket:$price\n\n";
	
	echo "id:<tr id='row_'><td href='' style='cursor:pointer;' class='tdlink'></td><td href='' style='cursor:pointer;' class='tdlink'></td><td href='' style='cursor:pointer;' class='tdlink'></td><td href='' style='cursor:pointer;' class='tdlink'></td><td><input type='button' class='btn btn-info accept' data-attr='' value='ACCEPT'></td><td><input type='button' class='btn btn_gray cancel' data-attr='' value='CANCEL'></td><td><a href='' style='color:#03F;' >Order Details</a></td></tr>";
	ob_flush();
	flush();
}

?>



