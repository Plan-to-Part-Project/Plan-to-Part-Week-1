<?php
require "/Users/christy/PhpstormProjects/PTPLink/Plan-to-Part-Week-1/vendor/autoload.php";

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\FirebaseException;

//This file is used to check if the user's email is marked as verified
$email = $_POST ['email'];
$pass = $_POST['password'];

$factory = (new Factory)->withServiceAccount('/Users/christy/PhpstormProjects/PTPLink/Plan-to-Part-Week-1/secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');

try{
    $verified = $factory->createAuth()->getUserByEmail($email)->emailVerified;

    if ($verified == true) {
        try{
            $factory->createAuth()->signInWithEmailAndPassword($email, $pass);
            header("Location: ../Dashboard_SideBar/Membership_Section/membership.html");
        }catch(Exception $e){
            $err = $e->getMessage();
            echo "<script>alert('$err'); window.location.href='login.html';</script>";
        }
    }else{
        echo "<script>alert('Please verify your email.'); window.location.href='login.html';</script>";
    }

}catch(Exception $e){
    $NoUserError = $e->getMessage();
    // this error cannot be displayed in an alert using js
    echo $NoUserError;
}


