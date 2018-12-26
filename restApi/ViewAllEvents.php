<?php
require_once'Event.php';


$json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);
$MSG = "";
if(!empty($_GET["username"])) {
$MSG = "y";
}
$event = new Event('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');


// Converting the message into JSON format.
$json = json_encode($MSG);

// Echo the message.
 echo $json;


?>