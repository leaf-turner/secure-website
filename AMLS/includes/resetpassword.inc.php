<?php
if (isset($_POST['resetpassword-submit'])) {
	require 'dbh.inc.php';
	
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn,$_POST['pwd']);
	$passwordRepeat = mysqli_real_escape_string($conn,$_POST['pwdrepeat']);
	
	if(empty(empty($username) ||$password) || empty($passwordRepeat)){
		
		header("Location: ../resetpassword.php?emptyfields");
		
		exit();	
	}else if($password !== $passwordRepeat){
		header("Location: ../resetpassword.php?passworddoesntmatch");
		
		exit();	
	}else{
		$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
		$sql= "UPDATE users SET pwdUsers='$hashedPwd' WHERE uidUsers ='$username'";
		//$stmt = mysqli_stmt_init($conn);
		//if(!mysqli_stmt_prepare($stmt, $sql)){
			//header("Location: ../resetpassword.php?error=sqlerror");
			//exit();
		//}
		if (mysqli_query($conn, $sql)) {
			echo "Record updated successfully";
		}
		
		// mysqli_stmt_bind_param($stmt, "s", $u);
		// mysqli_stmt_execute($stmt);
		 //exit();
		  header("Location: ../index.php?resetpasswordsuccess");
          exit();
	}
	//mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
	
















	





?>