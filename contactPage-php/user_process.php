<?php 
include("dbconnect.php");

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$msg = $_REQUEST['message'];


//Insert date to table 

$query = mysqli_query($db_connect,
"INSERT INTO user(name,email,phone,message)
 VALUES ('$name','$email','$phone','$msg')") 
 or die(mysqli_error($db_connect));

mysqli_close($db_connect);

header("location: contactUs.php?note=success");



?>
