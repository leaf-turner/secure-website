<?php
/*
*   ***************************************************************************
*	Using info from tutorial on PHP,
*	by mmtuts channel: https://www.youtube.com/channel/UCzyuZJ8zZ-Lhfnz41DG5qLw
*	https://www.youtube.com/watch?v=LC9GaXkdxF8
*   ***************************************************************************
*/
require "header.php";
?>
<?php
	require 'includes/dbh.inc.php';
	//re-captcha
	$private_key = "6LcdU38UAAAAAPfUAYM7Pq4MJdl7qVf5kmwdNgo1";
	$url = "https://www.google.com/recaptcha/api/siteverify"; /* Default end-point, please verify this before using it */

	/* Check if the form has been submitted */
	if(array_key_exists('forgotusername-submit',$_POST))
	{
		/* The response given by the form being submitted */
		$response_key = $_POST['g-recaptcha-response'];
		/* Send the data to the API for a response */
		$response = file_get_contents($url.'?secret='.$private_key.'&response='.$response_key.'&remoteip='.$_SERVER['REMOTE_ADDR']);
		/* json decode the response to an object */
		$response = json_decode($response);
	}
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Forgot Username Password</title>
	<!--jQuery-->
    <script
     src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>    
		
	<!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">	
	
	<!--reCaptcha-->
	<script src="https://www.google.com/recaptcha/api.js" ></script>	
		
	<!--webpage content-->
	
	
	
	<link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
	<div class="container">
	<div class = "col-lg-6 col-md-offset-3">
        <div class="panel">
		
		
             <div class="panel-heading" align= "center">
				<h3>Fill Out the Security Info</h3>
			 </div>
			<div class="panel-body">
				<form class ="forgot-username" method="post" action="forgotusername.php" id="forgotid_form">
					<div class ="form group">
							<label for="usernameid">Step 1:</label>
							<input type ="text" name="username" placeholder= "Check username" id= "usernameid" class="form-control"  >
							
							<!---------->
							
							<div class ="col-lg-12" align="center">
							<br>
								 
								<button type="submit" name="forgotusername-submit1" >Submit Username</button>
                            <br><br>
							<!--
								Security Question
							-->
							<?php
							require 'includes/dbh.inc.php';
							if (isset($_POST['forgotusername-submit1'])) {
								//connect to DB
								
								$username=mysqli_real_escape_string($conn,$_POST['username']);
								
								$sql= "SELECT * FROM users WHERE uidUsers =?;";
								$stmt = mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt, $sql)){
									header("Location: ../index.php?error=sqlerror");
									exit();
								}
								mysqli_stmt_bind_param($stmt,"s", $username);
								mysqli_stmt_execute($stmt);
								$result = mysqli_stmt_get_result($stmt);
								
								
								
								 if($row = mysqli_fetch_assoc($result)){
										echo "<b>Security Question:   </b>".$row['securityQuestion1']."<br>";
										
								 }else{
									 echo"<b>Username does not exist</b>";
								
								}
							}
							?>
				</form>			
				<form class ="forgot-username" method="post" action="includes/forgotusername.inc.php" id="forgotid_form">
							</div>
							<label for="answerid">Step 2:</label>
							
                            <input type ="text" name="securityanswer1" placeholder= "Enter The Answer" id ="answerid" class="form-control">
							<br><br>
							
                        </div>
					
					 
					 <div class ="form group">
						<label for="emailid">Step 3:</label>
						<input type ="text" name="username" placeholder= "Enter username" id= "usernameid" class="form-control"  >
						<input type ="email" name="mail" placeholder= "Enter your email" id ="emailid" class="form-control"  >
                            
                     </div>
				
					  <!--reCaptcha-->
					  <!--need api key for reCaptcha-->
					 </br>
					  <div align= "center" class="g-recaptcha" data-sitekey="6LcdU38UAAAAAHevFkeGW83zzndc-ZYYtDyE38A_"></div>
					 </br>
					 
					 <!--reCaptcha-->
					 

					 <div class ="col-lg-12" align="center">
                           
                            <button type="submit" name="forgotusername-submit">Submit</button>
                            
                        </div>
				</form>
			</div>
		
		</div>
	</div>
  </body>
</html>