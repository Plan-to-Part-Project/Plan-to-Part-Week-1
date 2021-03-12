<?php
require 'C:\Users\henil\Desktop\P2P\Plan-to-Part-Week-1\vendor\autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;

    $response = file_get_contents('php://input');
    $res = json_decode($response, true);
if(isset($res)){
        $factory = (new Factory)->withServiceAccount('../../secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
        $user = $factory->createAuth()->getUserByEmail($res['email'])->uid;
        $newPostKey = $factory->createDatabase()->getReference('Users')->push()->getKey();
        $data = [];
        foreach ($res as $key => $value) {
            if(strcmp($key,"")) {
                if (strcmp($key, "email")) {
                    if (isset($res[$key])) {
                        $data += ["$key" => $value];
                    }
                }
            }
        }
        $parent_data = [
            //'Users/'.$newPostKey => $data,
            'Users/'.$user."/Financial_Data" => $data,
        ];
        $factory->createDatabase()->getReference()->update($parent_data);
        echo json_encode('done');
}
?>