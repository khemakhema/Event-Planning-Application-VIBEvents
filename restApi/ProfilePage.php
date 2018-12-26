<?php
require_once'Profile.php';

$json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);


$profile = new Profile('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');
    
$MSG = $profile->getProfileInformation($obj["username"]);




// Converting the message into JSON format.
$json = json_encode($MSG);

// Echo the message.
 echo $json;

?>