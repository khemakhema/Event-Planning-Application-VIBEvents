<?php
require_once'User.php';
require_once'Mail.php';
$json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);


$user = new User('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents', $obj["username"], $obj["email"], $obj["firstName"], $obj["password"], $obj["lastName"], $obj["phoneNumber"], $obj["address"]);
$mail = new Mail('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');

$MSG = 'You Have Been Successfully Registered' ;

if($user->checkEmailExists($obj["email"])) {
$MSG = "email already exists";

}
else {
if($user->checkUserNameExists($obj["username"])) {
$MSG = "username already exists";
}
else {
if($user->insertDataMobile()) {
$user->insertResetTable();
$mail->accountCreated($obj["email"]);
}
else {
$MSG = "Something went wrong";
}
}

}




// Converting the message into JSON format.
$json = json_encode($MSG);

// Echo the message.
 echo $json ;

?>