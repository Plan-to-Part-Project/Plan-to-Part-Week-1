<?php
require 'C:\Users\Michael\PhpstormProjects\Plan-to-Part-Week-1/vendor\autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;

//Collect email address from the form
$email = $_POST['email'];

//Send the password reset link
(new Factory)->withServiceAccount('../secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json')-> createAuth()->sendPasswordResetLink($email);

header("Location: login.html");