
<?php
/**
 * Created by IntelliJ IDEA.
 * User: WHIWPO
 * Date: 12/6/2018
 * Time: 8:36 PM
 */

    function redirect() {
        header("Location: signup.php");
        exit();
    }

function red() {
    header("Location: header.php");
    exit();
}




if( !isset($_GET["email"])|| !isset($_GET['UserActivation_code'])) {

    redirect();
} else{

    $dBServername = "comp424project.c6dby1z6cevw.us-west-1.rds.amazonaws.com";
    $dBUsername = "comp424project";
    $dBPassword = "comp424project";
    $dBName = "comp424project";
// Create connection
    $con = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);
    if($con-> connect_errno){
        printf("Connection Failed: %s\n",$con->connect_error);
        exit();
    }


    $email = mysqli_real_escape_string($con,$_GET['email']);
    $UserActivation_code = mysqli_real_escape_string($con,$_GET['UserActivation_code']);


    echo $UserActivation_code;



    $sql = $con-> query("SELECT idUsers FROM users WHERE emailUsers='$email' AND UserActivation_code= '$UserActivation_code' AND Email_Status=0");




    if ($sql ->num_rows > 0){
        $con -> query("UPDATE users SET Email_Status=1 , UserActivation_code='' WHERE emailUsers='$email'" );
        echo 'Your email has been verified! You can log in now!';
        red();

    }
    else{
        //$con -> query("UPDATE users SET Email_Status=1 , UserActivation_code='' WHERE emailUsers='$email'" );
        redirect();

    }





}
?>