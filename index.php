<?php

$ui = $_POST['Body'];//Getting the body via a post request, so it's ssl based
$from = $_POST['From'];//phone number its coming from let's add this to the database

//Let's add our postgre crap here!
$dsn = "pgsql:"
    . "ec2-23-23-177-33.compute-1.amazonaws.com;"
    . "dbname=ddq8so2n6f4vo0;"
    . "user=iqahmldhghxjpr;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=vmSGrlSxzVFWgbNoZ_XgWolwuP";//I hate postgre, unfortunately the guys over at heroku seem to prefer it FML
 


// Get the PHP helper library from twilio.com/docs/php/install
require_once('./Services/Twilio.php'); // Loads the library, so Twilio guy told us to do this, wondering why but if it doesn't work we'll try this.... :D if theres an error, at least we know what the fuck it is
 
// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "AC7a14830568ec769f5f68d7d3d2ac7287"; //tokens
$token = "3a0cd8283b0788e463e43f6fcab93f46"; //Remind me again why I'm posting this on github..... :) 
$client = new Services_Twilio($sid, $token);//random unnecesary things
 
// Get an object from its sid. If you do not have a sid,
// check out the list resource examples on this page
$sms = $client->account->sms_messages->get("AC7a14830568ec769f5f68d7d3d2ac7287");//looks like this should contain ths SID not quite sure tho....
//echo $sms->body;//Why are you here...?
//he said to block this out, but the problem is its not being used anywhere ^
$message = explode($ui,  "  ");// exploding into location place and body by paramater of 2 spaces, I really hope they don't use 2 spaces anywhere else, than again doesn't matter cuz we only reference 1 and 2 (i know 0 an 1) :D
$place = $message[0];
$body =  $message[1];


//Let's define the function for actually sending out messages
function sendlet ($number, $ournum, $sms, $client, $body, $row){//add some params for god's sake
 $row = pg_fetch_array($row, $x);//fetches the row
            for($x=0; $x<count($row); $x++){//gets all numbers within location
            $number = $row[$x]["number"];
            $ournum = 9088180650;//phone number (ours)
            $sms = $client->account->sms_messages->create($ournum,$number,$body,array());//Creates a new message to there umber
}// that function was fun to write :D, just kidding, twillios a pain in the ass, that dude made it look so god damn easy
//$con=mysql_connect("sql4.freesqldatabase.com:3306","sql434134","bY2%tL9%","sql434134");//heroku is shit, but we're using postgresql

    if (mysqli_connect_errno())//TODO convert all mysql back to mysqli
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();//for some reason heroku doesn't believe i should know when there's an error
    }
    

//TODO ability to associate with multiple arrays
 $x = mysqli_query($link, "SELECT * FROM Chats WHERE number = '$number'");//if your number is already there why add it again 
    $row2 = mysql_fetch_array($x);
    if(count($row2)==0){
        $result = mysqli_query($con,"INSERT INTO Chats (Numbers, Location) VALUES ('$number', '$place')");
            $y = mysqli_query($con, "SELECT * FROM Chats WHERE location = '$place'");
           sendlet ($number, $ournum, $sms, $client, $body, $row);
}}
//this is for when the # doesnt exist in the chat
    else{
 $y = mysql_query("SELECT * FROM Chats WHERE location = '$place'");
           sendlet ($number, $ournum, $sms, $client, $body, $row);//this function shortens it a bit
            }
            }
   ?>
