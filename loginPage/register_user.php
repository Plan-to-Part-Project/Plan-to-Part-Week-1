<?php
include("db.php");
$name = "Henil";
$email = "testing@whatever.com";
$message = "did it work";

    $data = [
        'name' => $name,
        'email' => $email,
        'message' => $message
    ];
    $ref = "plantopart-4c826/Users";
    $pushData = $database->getReference($ref)->push($data);
    header("https://web.njit.edu/~an543/planTopart/formPage/Introduction.html");
?>