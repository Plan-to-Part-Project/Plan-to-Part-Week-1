<?php
require __DIR__.'/../../vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;


$response = file_get_contents('php://input');
$res = json_decode($response, true);
$factory = (new Factory)->withServiceAccount('../../secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
$user = $factory->createAuth()->getUserByEmail($res['email'])->uid;
$flag = $factory->createDatabase()->getReference('Users/'.$user."/HomeProperty_Data")->getSnapshot()->exists();
if($flag) {
    $Data = $factory->createDatabase()->getReference('Users/' . $user . "/HomeProperty_Data")->getValue();
    $data = [];
    try {
        foreach ($Data as $key => $value) {
            $data += ["$key" => $value];
        }
    } catch (Exception $e) {

    }
    echo json_encode($data);

}
else {
    echo json_encode('NO');
}

?>