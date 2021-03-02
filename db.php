<?php
require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;

$option1 = "test";
$option2 = "test";
$option3 = "test";





$data = [
    'phone_Pass' => $option1,
    'Comp_pass' => $option2,
    'Cent_pass' => $option3,
];


    $factory = (new Factory)->withServiceAccount('./secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
    $u = $factory->createAuth()->getUserByEmail("newtestcase@gmail.com")->uid;
    $temp = $factory->createDatabase()->getReference("Users/".$u."/Questions")->update($data);

    echo "done"
?>
