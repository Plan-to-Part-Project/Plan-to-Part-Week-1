<?php
require __DIR__.'/../../vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;

$response = file_get_contents('php://input');
$res = json_decode($response, true);
$factory = (new Factory)->withServiceAccount('../../secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
$user = $factory->createAuth()->getUserByEmail($res['email'])->uid;

?>
