<?php

$ui = $_POST['Body'];//Getting the body
$from = $_POST['From'];//phone number its coming from 

// Get the PHP helper library from twilio.com/docs/php/install
require_once('http://mysterious-meadow-7659.herokuapp.com/Services/Twilio.php'); // Loads the library
 
// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "AC3b392bc11cfc9762ed23e1488b56c4d2"; //tokens
$token = "1d510d501597d6eec2568ed7be8fa9e5"; 
$client = new Services_Twilio($sid, $token);//random unnecesary things
 
// Get an object from its sid. If you do not have a sid,
// check out the list resource examples on this page
$sms = $client->account->sms_messages->get("SM800f449d0399ed014aae2bcc0cc2f2ec");
echo $sms->body;
$message = explode($ui,  "  ");// exploding into location place and body 
$place = $message[0];
$body =  $message[1];

$con=mysqli_connect("sql4.freesqldatabase.com:3306","sql434134","bY2%tL9%","sql434134");
if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
else{
    
}

 $x = mysqli_query("SELECT * FROM Chats WHERE number = '$number'");
    $row2 = mysqli_fetch_array($x);
    if(count($row2)==0){
        $result = mysqli_query($con,"INSERT INTO Chats (Numbers, Location) VALUES ('$number', '$place')");
            $y = mysqli_query("SELECT * FROM Chats WHERE location = '$place'");
            $row3 = mysqli_fetch_array($x);
            for($x=0; $x<count(row3); $x++){
            $number = $row3[$x]["number"];
            $ournum = +19088180650;
            $sms = $client->account->sms_messages->create($ournum,$number,$body,array());
}}
    else{
 $y = mysqli_query("SELECT * FROM Chats WHERE location = '$place'");
            $row3 = mysqli_fetch_array($x);    
            for($x=0; $x<count(row3); $x++){
            $number = $row3[$x]["number"];
            $ournum = +19088180650;
            $sms = $client->account->sms_messages->create($ournum,$number,$body,array());
            }
            }
   ?>