<?php 
include("dbconnect.php");

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$msg = $_REQUEST['message'];

 
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "Please Enter Valid Email"; 
    return false;
  }
  else if ((!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)) || (strlen($phone) != 10)){
    echo "Please Enter Valid Phone Number"; 
    return false;
  }
   else{
       $query = mysqli_query($db_connect,
       "INSERT INTO user(name,email,phone,message)
        VALUES ('$name','$email','$phone','$msg')") 
       or die(mysqli_error($db_connect));
  }

mysqli_close($db_connect);

header("location: contactUs.php?note=success");



?>
