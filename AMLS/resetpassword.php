<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
	
	<script
     src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>    
		
	<!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">	
	<!--stylesheet-->
	<link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
	<div class="container">
		<div class = "col-lg-6 col-md-offset-3">
			<div class="panel">
				<div class="panel-heading" align= "center">
				<h3>Reset Password</h3>
				
			 
				<div class="panel-body">
					<form class ="forgot-username" method="post" action="includes/resetpassword.inc.php" id="forgotid_form">
						<div class ="form group">
								
							 <input type ="text" name="username" placeholder= "Enter username" id= "usernameid" class="form-control"  >
								<br>
							 <input type="password" id= "password" name="pwd" placeholder="Enter new password"class="form-control">
								 <br>
							 <input type="password" name="pwdrepeat" placeholder="Repeat password"class="form-control">
							 
							 <div class ="col-lg-12" align="center">
								<br><br>
								<button type="submit" name="resetpassword-submit">Reset Password</button>
								<br><br>
							</div>
						</div>
					</form>
				</div>
		</div>	
		</div>
	</div>	
	
  </body>
</html>