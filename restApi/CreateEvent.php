<?php
require_once'Event.php';

$json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);

$event = new Event('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');
//$jsonData = $obj["type"];
if(in_array("Give me Your Locations", $obj)) {
$MSG = "YES";
$MSG = $obj["type"];
$jsonData = json_encode($event->displayAllLocationMobile($obj["type"]));
}
else {
$MSG = "NO";
}






// Converting the message into JSON format.
$json = json_encode($jsonData);

// Echo the message.
 echo $json;

?>