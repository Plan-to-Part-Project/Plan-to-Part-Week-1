<?php
require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;


if(isset($_POST['push'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $userProperties = [
        'email' => $email,
        'emailVerified' => false,
        //'phoneNumber' => '+15555550100',
        'password' => $pass,
        'displayName' => $name,
        'photoUrl' => ' ',
        'disabled' => false,
    ];
    //creates an new user with email and pass.
    $u = (new Factory)->withServiceAccount('./secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json')->createAuth()->createUser($userProperties)->uid;
    $factory = (new Factory)->withServiceAccount('./secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
    $temp = $factory->createDatabase();

    $data = [
        'name' => $name,
        'email' => $email,
        ];

    $newPostKey = $temp->getReference('Users')->push()->getKey();

    $parent_data = [
        //'Users/'.$newPostKey => $data,
        'Users/'.$u."/User_Data" => $data,
    ];

    //Sending the verification link to the new user

    (new Factory)->withServiceAccount('./secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json')-> createAuth()->sendEmailVerificationLink($email);


//die(print_r($data));

    $temp->getReference()->update($parent_data);

    //echo $_POST['email'];
    header("Location: ./formPage/Introduction.html");
    //echo "Done";
}
else{
    $response = file_get_contents('php://input');
    $Questions = json_decode($response, true);
    $factory = (new Factory)->withServiceAccount('./secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
    $u = $factory->createAuth()->signInWithGoogleIdToken($Questions['id_token'])->firebaseUserId();
    //$factory = (new Factory)->withServiceAccount('./secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
    $temp = $factory->createDatabase();
    $name = $factory->createAuth()->getUserByEmail($Questions['email'])->photoUrl;
    $email = $Questions['email'];
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

    echo json_encode("./formPage/Introduction.html");
    //header("Location: ./formPage/Introduction.html");
}
