<?php
require_once'UserLogin.php';

$json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);


$login = new UserLogin('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');
    
$MSG = 'Invalid Username and Password Combination' ;
//echo $obj["username"];
//echo $obj["password"];
if($login->loginMobile($obj["username"], $obj["password"])) {
$MSG = 'You Have Logged In';
}



// Converting the message into JSON format.
$json = json_encode($MSG);

// Echo the message.
 echo $json;

?>