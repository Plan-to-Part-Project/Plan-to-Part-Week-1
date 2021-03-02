<?php
require __DIR__.'./vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;


if(isset($_POST['push'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    //creates an new user with email and pass.
    $u = (new Factory)->withServiceAccount('./secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json')->createAuth()->createUserWithEmailAndPassword($email, $pass)->uid;
    $factory = (new Factory)->withServiceAccount('./secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
    $temp = $factory->createDatabase();
    $name = $_POST['name'];
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
?>
