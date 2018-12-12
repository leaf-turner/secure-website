<?php
/*
*   ***************************************************************************
*	Using info from tutorial on PHP, 
*	by mmtuts channel: https://www.youtube.com/channel/UCzyuZJ8zZ-Lhfnz41DG5qLw
*	https://www.youtube.com/watch?v=LC9GaXkdxF8
*   ***************************************************************************
*/

if (isset($_POST['login-submit'])) {
	require 'dbh.inc.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];



  // check for any empty inputs
  if (empty($mailuid)||empty($password)  ) {
    header("Location: ../index.php?error=emptyfields&mailuid=".$mailuid);
    exit();
  }
  else {	
    //****notes from video: Next we need to get the password from the user in the database that has the same username as what the user typed in, 
	//and then we need to de-hash it and check if it matches the password the user typed into the login form.
    // We will connect to the database using prepared statements which work by us sending SQL to the database first, and then later we fill in the placeholders by sending the users data.
    $sql = "SELECT *, Email_Status FROM users WHERE uidUsers=? OR emailUsers=?;";
    // Here we initialize a new statement using the connection from the dbh.inc.php file.
    $stmt = mysqli_stmt_init($conn);
    // prepare our SQL statement AND check if there are any errors with it.
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      // If there is an error we send the user back to the signup page.
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {
    
      // bind the type of parameters we expect to pass into the statement, and bind the data from the user.
      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      // Then we execute the prepared statement and send it to the database
      mysqli_stmt_execute($stmt);
      // And we get the result from the statement.
      $result = mysqli_stmt_get_result($stmt);
      // Then we store the result into a variable.
      if ($row = mysqli_fetch_assoc($result)) {
        // Then we match the password from the database with the password the user submitted. The result is returned as a boolean.
        $pwdCheck = password_verify($password, $row['pwdUsers']);


        // If they don't match then we create an error message
        if ($pwdCheck == false ) {
          // If there is an error we send the user back to the signup page.
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        //if they DO match, then we know it is the correct user that is trying to log in
        else if ($pwdCheck == true) {
            if ($row['Email_Status'] == '0') {
                header("Location: ../index.php?error=NotReg");
                exit();

                $message = "Please Verif.\\nTry again.";
                echo "<script type='text/javascript'>alert('$message');</script>";



            } else {
                $date = date('Y-m-d');

                $conn -> query("UPDATE users SET LoginCount=LoginCount+1 WHERE emailUsers='$mailuid' OR uidUsers='$mailuid'" );
                $conn -> query("UPDATE users SET Date= '$date' WHERE emailUsers='$mailuid' OR uidUsers='$mailuid'" );



            session_start();
            // create the session variables.
            $_SESSION['id'] = $row['idUsers'];
            $_SESSION['uid'] = $row['uidUsers'];
            $_SESSION['email'] = $row['emailUsers'];

            header("Location: ../index.php?login=success");
            exit();
        }
        }
      }
      else {
        header("Location: ../index.php?login=wronguidpwd");
        exit();
      }
    }
  }
  // close the prepared statement and the database connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  // If the user tries to access this page an inproper way, we send them back to the signup page.
  header("Location: ../signup.php");
  exit();
}
