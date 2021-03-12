<?php
require "/Users/christy/PhpstormProjects/PTPLink/Plan-to-Part-Week-1/vendor/autoload.php";

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;

//This file is used to check if the user's email is marked as verified
$email = $_POST ['email'];
$pass = $_POST['password'];

$factory = (new Factory)->withServiceAccount('/Users/christy/PhpstormProjects/PTPLink/Plan-to-Part-Week-1/secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
$auth = $factory->createAuth();

try{
    $verified = $auth->getUserByEmail($email)->emailVerified;

    if ($verified == true) {
        try{
            $auth->signInWithEmailAndPassword($email, $pass);
            ?>
            <script>
                alert(" Welcome to Plan To Part");
                window.location.href='../Dashboard_SideBar/Membership_Section/membership.html';
            </script>
            <?php
        }catch(Exception $e){
            $err = $e->getMessage();
            ?>
            <script>
                let err = "<?php echo $err ?>";
                alert(err);
                window.location.href='login.html';
            </script>"
            <?php
        }
    }else{
        ?>
        <script>
            alert('Please verify your email.');
            window.location.href='login.html';
        </script>"
        <?php
    }
}catch(Exception $e){
    $NoUserError = $e->getMessage();
    ?>
    <script language="javascript">
        let NoUserError = "<?php echo $NoUserError ?>";
        alert(NoUserError);
        window.location.href="login.html";
    </script>

<?php
}


