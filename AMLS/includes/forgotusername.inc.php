<?php

/*
*   ***************************************************************************
*	Using info from tutorial on PHP, 
*	by mmtuts channel: https://www.youtube.com/channel/UCzyuZJ8zZ-Lhfnz41DG5qLw
*	https://www.youtube.com/watch?v=LC9GaXkdxF8
*   ***************************************************************************

https://www.youtube.com/watch?v=I4JYwRIjX6c&list=PL0eyrZgxdwhwBToawjm9faF1ixePexft-&index=40

https://websitebeaver.com/prepared-statements-in-php-mysqli-to-prevent-sql-injection
*/

if (isset($_POST['forgotusername-submit'])) {
  require 'dbh.inc.php';
  require '../PHPMailer/PHPMailerAutoload.php';
  
  
  $username=mysqli_real_escape_string($conn,$_POST['username']);
  $email = mysqli_real_escape_string($conn,$_POST['mail']);
  $securityAnswer = mysqli_real_escape_string($conn,$_POST['securityanswer1']);
  
  if (empty($username)||empty($email)||empty($securityAnswer)) {
    header("Location: ../forgotusername.php");
    exit();
  }else{
	  //
	 $sql= "SELECT * FROM users WHERE uidUsers =?;";
	 $stmt = mysqli_stmt_init($conn);
	 if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: ../index.php?error=sqlerror");
		exit();
	 }else{
		 
		 mysqli_stmt_bind_param($stmt,"s", $username);
		 mysqli_stmt_execute($stmt);
		 $result = mysqli_stmt_get_result($stmt);
		 if($row = mysqli_fetch_assoc($result)){
			$answerCheck =  $row['securityAnswer1'];
			echo $answerCheck;
			if($answerCheck != $securityAnswer){
				header("Location: ../forgotusername.php?error=wrongpwd");
				exit();
			}else if($answerCheck == $securityAnswer){
				
					echo'<h1>Recovery email Sent to </h1>'.$email;
					//send email to entered email
					//php mailer   https://github.com/PHPMailer/PHPMailer/tree/5.2-stable
					
					$mail = new PHPMailer();
					$mail->isSMTP();
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = 'ssl';
					$mail->Host = 'smtp.gmail.com';
					$mail->Port = '465';
					$mail->isHTML(true);//
					$mail->Username = 'amlsservice005@gmail.com ';
					$mail->Password = 'basketball#45';
					//setfrom?
					//content  https://www.experts-exchange.com/questions/22568779/How-to-make-a-URL-link-clickable-in-and-email-sent-by-PHPmailer.html
					////////////////////////////
					$body= "<h1>AMLS recovery</h1>Please click on the link below: <br> <br>
                        
                        <a href='http://ec2-18-144-47-183.us-west-1.compute.amazonaws.com/resetpassword.php'>
            
                        Click Here
							</a>
                        ";
					$mail->SetFrom('no-reply@AMLSservice.com');
					$mail->Subject = 'Password recovery AMLS';
					//will need to change if hosted on internet
					$mail->Body = $body;
					$mail->AddAddress($email);
					
					$mail->Send();
					
					
					
					
				
			}else{
				//just in case answerCheck doesnt evaluate into a boolean
				header("Location: ../forgotusername.php?error=wrongpwd");
				
				exit();	
			}
		 }else{
			 header("Location: ../forgotusername.php?error=nouser");
			 exit();
		 }
		 
		 
		 
	 }
	

	 
  }
}


else {
  header("Location: ../index.php?error=inputerror");
  exit();
}