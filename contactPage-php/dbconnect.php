<?php

include ( ".env" );

$db_connect = mysqli_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_NAME)or die();

//Check the connection 
if (mysqli_connect_errno())
{
	echo " Failed to connect to Server. Try Again!".mysqli_connect_error();
}

print "Successfully connected to MySQL.<br><br><br>";
mysqli_select_db( $db_connect, $DB_NAME ); 

//echo "Connection Successful";
//this is a test Christy

?>