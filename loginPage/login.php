<?php
require "C:\Users\Michael\PhpstormProjects\Plan-to-Part-Week-1/vendor\autoload.php";

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;

//This file is used to check if the user's email is marked as verified
$email = $_POST ['email'];
$pass = $_POST['password'];

$factory = (new Factory)->withServiceAccount('C:\Users\Michael\PhpstormProjects\Plan-to-Part-Week-1\secret\plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
//$u = $factory->createAuth()->getUserByEmail($email)->uid;
$verified = $factory->createAuth()->getUserByEmail($email)->emailVerified;

if ($verified == true) {
    header("Location: ../Dashboard_SideBar/Membership_Section/membership.html");
}elseif ($verified==false){
    header("Location: login.html");
}