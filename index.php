<?php

$ui = $_POST['Body'];//Getting the body
$from = $_POST['From'];//phone number its coming from 

// Get the PHP helper library from twilio.com/docs/php/install
require_once('./Services/Twilio.php'); // Loads the library
 
// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "AC3b392bc11cfc9762ed23e1488b56c4d2"; //tokens
$token = "1d510d501597d6eec2568ed7be8fa9e5"; 
$client = new Services_Twilio($sid, $token);//random unnecesary things
/* 
// Get an object from its sid. If you do not have a sid,
// check out the list resource examples on this page
$sms = $client->account->sms_messages->get("SM800f449d0399ed014aae2bcc0cc2f2ec");
echo $sms->body;
*/
$message = explode($ui,  "  ");// exploding into location place and body 
$place = $message[0];
$body =  $message[1];

$con=mysql_connect("sql4.freesqldatabase.com:3306","sql434134","bY2%tL9%","sql434134");//used a free sql service because heroku is retarted, use digital ocean in the future
/*if (mysql_connect_errno())//TODO convert all mysql back to mysqli
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }//blanked out error cuz it was screwin us up, didn't help...
    */
else{
    
}
//TODO ability to associate with multiple arrays
 $x = mysql_query("SELECT * FROM Chats WHERE number = '$number'");//if your number is already there why add it again 
    $row2 = mysql_fetch_array($x);
    if(count($row2)==0){
        $result = mysql_query($con,"INSERT INTO Chats (Numbers, Location) VALUES ('$number', '$place')");
            $y = mysql_query("SELECT * FROM Chats WHERE location = '$place'");
            $row = mysql_fetch_array($x);//fetches the row
            for($x=0; $x<count($row); $x++){//gets all numbers within location
            $number = $row[$x]["number"];
            $ournum = 9088180650;//phone number (ours)
            $sms = $client->account->sms_messages->create($ournum,$number,$body,array());
}}
    else{
 $y = mysql_query("SELECT * FROM Chats WHERE location = '$place'");
            $row = mysql_fetch_array($x);//ALL COMMENTS FROM ABOVE
                
            for($x=0; $x<count($row); $x++){
            $number = $row[$x]["number"];
            $ournum = +19088180650;
            $sms = $client->account->sms_messages->create($ournum,$number,$body,array());
            }
            }
   ?>