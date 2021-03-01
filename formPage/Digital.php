<?php

require "C:\Users\henil\Desktop\P2P\Plan-to-Part-Week-1/vendor/autoload.php";

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;



if(isset($_POST['sub'])){
    if(isset($_POST['Option1']))
        $option1 = "yes";
    else
        $option1 = "no";
    if(isset($_POST['email']))
        $email = $_POST['email'];
    else
        $email = "no";
    if(isset($_POST['Option2']))
        $option2 = "yes";
    else
        $option2 = "no";
    if(isset($_POST['Option3']))
        $option3 = "yes";
    else
        $option3 = "no";

    $data = [
        'phone_Pass' => $option1,
        'Comp_pass' => $option2,
        'Cent_pass' => $option3,

    ];


    $factory = (new Factory)->withServiceAccount('C:\Users\henil\Desktop\P2P\Plan-to-Part-Week-1\secret\plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
    $u = $factory->createAuth()->getUserByEmail($email)->uid;
    $temp = $factory->createDatabase()->getReference("Users/".$u."/Questions")->update($data);

    header("Location: temp.php");
}
?>
