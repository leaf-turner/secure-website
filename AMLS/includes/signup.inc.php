
<?php

/*
*   ***************************************************************************
*	Using info from tutorial on PHP, 
*	by mmtuts channel: https://www.youtube.com/channel/UCzyuZJ8zZ-Lhfnz41DG5qLw
*	https://www.youtube.com/watch?v=LC9GaXkdxF8
*   ***************************************************************************
*/


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../TestingPHPmailer/Exception.php';
require '../TestingPHPmailer/PHPMailer.php';
require '../TestingPHPmailer/SMTP.php';





function validpw($password){
    if(strlen($password)>=8){
        if(!ctype_upper($password) && !ctype_lower($password)){
            return TRUE;
        }
    }
}
if (isset($_POST['signup-submit'])) {

  require 'dbh.inc.php';

  // We grab all the data which we passed from the signup form so we can use it later.
  /*
			<input type ="text" name="firstname" placeholder= "First name">
			<input type ="text" name="lastname" placeholder= "Last name">
			<input type ="date" name="dateofbirth">
			<div class="label"<h4>Select a security question</h4></div>
			<select class="dropdown" name="securityQuestion1" >
				<option>What hospital where you born in?</option>
				<option>What was your favorite teacher's name?</option>
				<option>What is your mother's maiden name?</option>
				<option>What is the current make and model of your car?</option> 
			</select>
			<br><Br>
			<input type ="text" name= "securityAnswer1" placeholder= "Answer to security question">
			<input type ="text" name="phonenumber" placeholder= "Phone number">
            <input type="password" id= "password" name="pwd" placeholder="Password">
            <input type="password" name="pwdrepeat" placeholder="Repeat password">
  */
  
  //escape inputs to prevent sql injection//
  $username = mysqli_real_escape_string($conn, $_POST['uid']);
  $email = mysqli_real_escape_string($conn,$_POST['mail']);
  $password = mysqli_real_escape_string($conn,$_POST['pwd']);
  $passwordRepeat = mysqli_real_escape_string($conn,$_POST['pwdrepeat']);
  $firstName= mysqli_real_escape_string($conn,$_POST['firstname']);
  $lastName = mysqli_real_escape_string($conn,$_POST['lastname']);
  $userBirthday = mysqli_real_escape_string($conn,$_POST['dateofbirth']);
  $securityQuestion = mysqli_real_escape_string($conn,$_POST['securityQuestion1']);
  $securityAnswer = mysqli_real_escape_string($conn,$_POST['securityAnswer1']);
  $phonenumber = mysqli_real_escape_string($conn,$_POST['phonenumber']);

 




  // We check for any empty inputs. 
  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)||empty($firstName)||empty($lastName)||empty($userBirthday)||empty($securityQuestion)||empty($securityAnswer)||empty($phonenumber)){
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
  }
  // We check for an invalid username AND invalid e-mail.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invaliduidmail");
    exit();
  }
  // We check for an invalid username. In this case ONLY letters and numbers.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invaliduid&mail=".$email);
    exit();
  }
  // We check for an invalid e-mail.
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();
  }
  /*else if (!preg_match("/^(?=.*\d)$/", $password)) {
      echo '<script type="text/javascript">alert("Please have atleast one number in your password ");window.history.go(-1);</script>';;
      exit();
  }
  else if (!preg_match("/^(?=.*[A-Za-z])$/", $password)) {
      echo '<script type="text/javascript">alert("Please have atleast one letter in your password");window.history.go(-1);</script>';;
      exit();
  }
  else if (!preg_match("/^[0-9A-Za-z!@#$%]$/", $password)) {
      echo '<script type="text/javascript">alert(" It has to be a number, a letter or one of the following: !@#$%");window.history.go(-1);</script>';;
      exit();
  }
  else if (!preg_match("/^{8,12}$/", $password)) {
      echo '<script type="text/javascript">alert("Your password should be more than 8, but less than 12 characters");window.history.go(-1);</script>';;
      exit();
  }*/
  /*else if (!preg_match("/^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[^A-Za-z\d])[\s\S]{8,12$/", $password)) {
      echo '<script type="text/javascript">alert("Please enter a stronger password. Use the strong password guidelines");window.history.go(-1);</script>';;
      exit();
  }*/
  // We check if the repeated password is NOT the same.
  else if ($password !== $passwordRepeat) {
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
    exit();
  }
  else {
    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?;";
    // We create a prepared statement.
    $stmt = mysqli_stmt_init($conn);
    // Then we prepare our SQL statement AND check if there are any errors with it.
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      // If there is an error we send the user back to the signup page.
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    else {
      
      //  "s" "string", "i""integer", "b" "blob", "d""double".
      mysqli_stmt_bind_param($stmt, "s", $username);
      // Then we execute the prepared statement and send it to the database!
      mysqli_stmt_execute($stmt);
      // Then we store the result from the statement.
      mysqli_stmt_store_result($stmt);
      // Then we get the number of result we received from our statement. This tells us whether the username already exists or not!
      $resultCount = mysqli_stmt_num_rows($stmt);
      // Then we close the prepared statement!
      mysqli_stmt_close($stmt);
      // Here we check if the username exists.
      if ($resultCount > 0) {
        header("Location: ../signup.php?error=usertaken&mail=".$email);
        exit();
      }
      else {
          $UserActivation_code ="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM[]\;'/~!@$%^&*()" ;
          $UserActivation_code= str_shuffle($UserActivation_code);
          $UserActivation_code= substr($UserActivation_code,0,5);
          $Email_Status= "0";

        // Next thing we do is to prepare the SQL statement that will insert the users info into the database. We HAVE to do this using prepared statements to make this process more secure. DON'T JUST SEND THE RAW DATA FROM THE USER DIRECTLY INTO THE DATABASE!

        // Prepared statements works by us sending SQL to the database first, and then later we fill in the placeholders (this is a placeholder -> ?) by sending the users data.
        $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, firstName, lastName, userBirthday, phonenumber,UserActivation_code, Email_Status, securityQuestion1,securityAnswer1 ) 
                  VALUES (?, ?, ?,?,?,?,?,?,? ,?,?);";
        // Here we initialize a new statement using the connection from the dbh.inc.php file.
        $stmt = mysqli_stmt_init($conn);
        // Then we prepare our SQL statement AND check if there are any errors with it.
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          // If there is an error we send the user back to the signup page.

          header("Location: ../signup.php?error=sqlerror");
          exit();
        }
        else {

		  // hash password      
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);







	  
		  /*
		  *$username = $_POST['uid'];
		  $email = $_POST['mail'];
		  $password = $_POST['pwd'];
		  $passwordRepeat = $_POST['pwdrepeat'];
		  $firstName= $_POST['firstname'];
		  $lastName = $_POST['lastname'];
		  $userBirthday = $_POST['dateofbirth'];
		  $securityQuestion = $_POST['securityQuestion1'];
		  $securityAnswer = $_POST['securityAnswer1'];
		  $phonenumber = $_POST['phonenumber'];
		  
		  
		  */
		 
          //***//
		  //,$firstName,$lastName, $userBirthday,$securityQuestion,$securityAnswer,$phonenumber);
          mysqli_stmt_bind_param($stmt, "sssssssssss", $username, $email, $hashedPwd, $firstName, $lastName,$userBirthday, $phonenumber ,$UserActivation_code, $Email_Status, $securityQuestion, $securityAnswer  );
         
          mysqli_stmt_execute($stmt);
           include_once "../TestingPHPmailer/PHPMailer.php";
            include_once "../TestingPHPmailer/Exception.php";
            include_once "../TestingPHPmailer/SMTP.php";


            $mail = new PHPMailer(true);
            $mail -> SMTPDebug=2;
            $mail -> isSMTP();
            $mail  -> Host = "smtp.gmail.com";
            $mail -> SMTPAuth=true;
            $mail -> SMTPSecure='tls';
            $mail -> Port = 587;
            $mail -> Username=   "testingcomp424@gmail.com";
            $mail -> Password ='StudentNest1';
            $mail -> Priority = 1;
            $mail -> CharSet = 'UTF-8';
            $mail -> Encoding = '8bit';



            $mail -> setFrom( "testingcomp424@gmail.com");
            $mail -> addAddress ($email,$username);
            $mail -> Subject =" Email Verification Required";
            $mail -> isHtml (true);
            $mail -> Body =" 
                     Please click on the link below: <br> <br>
                        
                        <a href='http://ec2-18-144-47-183.us-west-1.compute.amazonaws.com/confirm.php?email=$email&UserActivation_code=$UserActivation_code'>
            
                        Click Here
</a>
                        ";
            if($mail -> send())
          header("Location: ../signup.php?signup=success");
          exit();


        }
      }
    }
  }
  // Close DB
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  // If the user tries to access this page an inproper way, we send them back to the signup page.
  header("Location: ../signup.php");
  exit();
}
