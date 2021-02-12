<?php
$username = 'htl5';
$password = 'Iloveyou14295!';
$dsn = "mysql:host=sql1.njit.edu;dbname=$username";

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo($error_message);
    exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

$query = 'INSERT INTO `contactUs`( `name`, `email`, `phone`, `message`) 
VALUES ('$name','$email','$phone','$message')';

$statement = $db->prepare($query);

$statement->bindValue(':name', $name);
$statement->bindValue(':email', $email);
$statement->bindValue(':phone', $phone);
$statement->bindValue(':message', $message);
$statement->execute();
$statement->closeCursor();


mysqli_close($db); // Close connection

?>

