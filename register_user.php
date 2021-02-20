<?php
require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

if(isset($_POST['push'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $data = [
        'name' => $name,
        'email' => $email
    ];


    $factory = (new Factory)->withServiceAccount('./secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
    $temp = $factory->createDatabase();
//die(print_r($data));

    $temp->getReference('Users/')->push($data);


    header("Location: homePage.html");
}
?>