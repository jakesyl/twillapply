<?php

$ui = $_POST['Body'];//Getting the body via a post request, so it's ssl based
$from = $_POST['From'];//phone number its coming from let's add this to the database

// Get the PHP helper library from twilio.com/docs/php/install
require_once('./Services/Twilio.php'); // Loads the library, so Twilio guy told us to do this, wondering why but if it doesn't work we'll try this.... :D
 
// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "AC3b392bc11cfc9762ed23e1488b56c4d2"; //tokens
$token = "1d510d501597d6eec2568ed7be8fa9e5"; 
$client = new Services_Twilio($sid, $token);//random unnecesary things
 
// Get an object from its sid. If you do not have a sid,
// check out the list resource examples on this page
$sms = $client->account->sms_messages->get("SM800f449d0399ed014aae2bcc0cc2f2ec");
echo $sms->body;
//he said to block this out, but the problem is its not being used anywhere ^
$message = explode($ui,  "  ");// exploding into location place and body 
$place = $message[0];
$body =  $message[1];


//Let's define the function for actually sending out messages
function sendlet ($number, $ournum, $sms, $client, $body, $row){//add some params for god's sake
 $row = mysql_fetch_array($x);//fetches the row
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
