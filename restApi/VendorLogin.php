<?php
require_once'LoginVendor.php';

$json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);


$login = new LoginVendor('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');
    
$MSG = "You Have Logged In";

if(!$login->loginMobile($obj["username"], $obj["password"])) {
$MSG = "Invalid Company Name or Password";
}



// Converting the message into JSON format.
$json = json_encode($MSG);

// Echo the message.
 echo $json;

?>