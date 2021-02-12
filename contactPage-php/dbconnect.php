<?php
$db_host = "localhost";
$db_username ="root";
$db_password = "";
$db_name = "plantopart";

$db_connect = mysqli_connect($db_host,$db_username,$db_password,$db_name)or die();

//Check the connection 
if (mysqli_connect_error())
{
echo " Failed to connect to Server. Try Again!".mysqli_connect_error();
	}

//echo "Connection Successful";

	
?>