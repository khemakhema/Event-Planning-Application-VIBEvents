<?php
require_once'Mail.php';

$json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);


$mail = new Mail('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');
    
$MSG = $mail->resetPassword($obj["username"], $obj["type"]);



// Converting the message into JSON format.
$json = json_encode($MSG);

// Echo the message.
 echo $json;

?>