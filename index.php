<?php

$body = $_POST['Body'];
$number = $_POST['From'];

// Get the PHP helper library from twilio.com/docs/php/install
/*require_once('/twilio-php/Services/Twilio.php'); // Loads the library
 
// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "AC3b392bc11cfc9762ed23e1488b56c4d2"; 
$token = "1d510d501597d6eec2568ed7be8fa9e5"; 
$client = new Services_Twilio($sid, $token);
 
// Get an object from its sid. If you do not have a sid,
// check out the list resource examples on this page
$sms = $client->account->sms_messages->get("SM800f449d0399ed014aae2bcc0cc2f2ec");
echo $sms->body;
function breakup($data){
    $x = explode($data,  "  ");
    return $x;// $x 
}*/

$con=mysqli_connect("sql4.freesqldatabase.com","sql434134","bY2%tL9%","sql434134");
if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
function message($Number, $Name){
$result = mysqli_query($con,"INSERT INTO Chats (Numbers, Name) VALUES ('$Numbers', '$Name')")
if (mysqli_num_rows($result) != 0 && ){
    $row = mysqli_fetch_array($result);}


    $x = mysqli_query("SELECT * FROM Chats WHERE Name = '$place'")
    $row = mysqli_fetch_array($x);
?>