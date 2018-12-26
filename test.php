<?php
require_once'User.php';

$json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);


$user = new User('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents', $obj["username"], $obj["email"], $obj["firstName"], $obj["password"], $obj["lastName"], $obj["phoneNumber"], $obj["address"]);

$user->insertDataMobile();

$MSG = 'Data Inserted Successfully into MySQL Database' ;

// Converting the message into JSON format.
$json = json_encode($MSG);

// Echo the message.
 echo $json ;

?>