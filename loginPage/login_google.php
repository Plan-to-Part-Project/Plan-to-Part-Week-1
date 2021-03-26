<?php

require __DIR__ . '../../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;

$response = file_get_contents('php://input');
$res = json_decode($response, true);
if(isset($res)){
$factory = (new Factory)->withServiceAccount('../secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
$u = $factory->createAuth()->signInWithGoogleIdToken($res['id_token'])->firebaseUserId();
//$factory = (new Factory)->withServiceAccount('./secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
$temp = $factory->createDatabase();
$name = $factory->createAuth()->getUserByEmail($res['email'])->displayName;
$email = $res['email'];
$data = [
    'name' => $name,
    'email' => $email,
];

$newPostKey = $temp->getReference('Users')->push()->getKey();

$parent_data = [
    //'Users/'.$newPostKey => $data,
    'Users/'.$u."/User_Data" => $data,
];
$temp->getReference()->update($parent_data);
echo json_encode("../Dashboard_SideBar/Membership_Section/membership.html");
//header("Location: ./formPage/Introduction.html");
}
?>