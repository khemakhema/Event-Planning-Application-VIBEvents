<?php
require_once'AddServicesCompany.php';

$json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);


$create = new AddServices('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents', $obj["owner"], $obj["eventType"], $obj["serviceoffered"]);
    
$MSG = 'Your Service Could Not Be Inserted';
//echo $obj["username"];
//echo $obj["password"];
if($create->insertService('')) {
$MSG = 'Your Service Has Been Inserted';
}



// Converting the message into JSON format.
$json = json_encode($MSG);

// Echo the message.
 echo $json;

?>