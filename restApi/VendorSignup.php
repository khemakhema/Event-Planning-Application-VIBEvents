<?php
require_once'VendorCreate.php';
require_once'Mail.php';
$json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);


$vendor = new VendorCreate('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents', $obj["companyName"], $obj["email"], $obj["password"], $obj["description"]);
$MSG = 'You Have Been Successfully Registered' ;
$mail = new Mail('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');
if(!$vendor->insertVendorMobile()) {
$MSG = 'Something Went Wrong Try Again Later';
}
else {
$mail->accountCreated($obj["email"]);
$vendor->insertResetTable();
}





// Converting the message into JSON format.
$json = json_encode($MSG);

// Echo the message.
 echo $json ;

?>