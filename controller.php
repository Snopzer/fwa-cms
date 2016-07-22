<?php
include_once ('admin/includes/config.php');
if(isset($_GET['action'])&&($_GET['action']==subscription)){
$email=mysql_real_escape_string($_POST['email']);
$query=mysql_query("INSERT INTO r_subscribe (email)values('".$email."')")or die(mysql_error());
if($query){
    header('location:index.php?subscription=success');
}
 else {
    header('location:index.php?subscription=fail');
}}
if(isset($_GET['action'])&&($_GET['action']==contact)){
    
$subject=mysql_real_escape_string($_POST['subject']);
$name=mysql_real_escape_string($_POST['name']);
$email=mysql_real_escape_string($_POST['email']);
$message=mysql_real_escape_string($_POST['message']);
$contacts = array(
"fareed543@gmail.com",
" Mohammadwaheed567@gmail.com",
" abidali70722@gmail.com"
//....as many email address as you need
);
	foreach($contacts as $contact) {
$to = $contact;
$subject2 = $subject;
$txt = $message;
$headers = 'From:$email' . "\r\n" .
$mail=mail($to,$subject2,$txt,$headers);
	}
$query=mysql_query("INSERT INTO r_message (subject,name,email,message)values('".$subject."','".$name."','".$email."','".$message."')")or die(mysql_error());
if($mail){
    header('location:index.php?contact=success');
}
 else {
    header('location:index.php?contact=fail');
}}
?>