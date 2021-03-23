<?php

require "C:\Users\Michael\PhpstormProjects\Plan-to-Part-Week-1/vendor\autoload.php";

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;
if(isset($_POST['sub'])){
$email = $_POST['email'];
$data = [];
foreach ($_POST as $key => $value) {
    if(strcmp($key,"sub")){
        if(strcmp($key,"email")) {
            if (isset($_POST[$key])) {
                $data += ["$key" => $value];
            }
        }
    }
}
    $factory = (new Factory)->withServiceAccount(__DIR__.'/../secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
    $u = $factory->createAuth()->getUserByEmail($email)->uid;
    $temp = $factory->createDatabase()->getReference("Users/".$u."/Questions")->update($data);

    header("Location: ../loginPage/login.html");
}

?>
