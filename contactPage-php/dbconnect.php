<?php

$db_connect = mysqli_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_NAME)or die();

//Check the connection 
if (mysqli_connect_error())
{
echo " Failed to connect to Server. Try Again!".mysqli_connect_error();
	}

//echo "Connection Successful";
//this is a test




?>