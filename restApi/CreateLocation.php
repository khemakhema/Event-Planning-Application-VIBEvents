<?php
require_once'CreateLocationClass.php';

$json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);


$create = new CreateLocation('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents', $obj["locationName"], $obj["address"], $obj["email"], $obj["owner"], $obj["maxAttendess"], $obj["description"], $obj["items"]);
    
$MSG = 'Your Event Could Not Be Inserted';
//echo $obj["username"];
//echo $obj["password"];
if($create->insertLocations()) {
$MSG = 'Your Event Has Been Inserted';
}



// Converting the message into JSON format.
$json = json_encode($MSG);

// Echo the message.
 echo $json;

?>