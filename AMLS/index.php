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

    <main>
      <div class="wrapper-main">
        <section class="section-default">

            <?php
            // Here we create an error message if the user made an error trying to sign up.
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "NotReg") {

                }
                else if ($_GET["error"] == "wrongpwd") {
                    echo '<p class="signuperror">Invalid Password!</p>';
                }

            }
            // Here we create a success message if the new user was created.
            else if (isset($_GET["signup"])) {
                if ($_GET["signup"] == "success") {
                    echo '<p class="signupsuccess">Signup successful!</p>';
                }
            }
            ?>
          
          <?php
          require 'includes/dbh.inc.php';
          if (!isset($_SESSION['id'])) {
            echo '<p class="login-status"></p>';
			
          }
          else if (isset($_SESSION['id'])) {
              $UsersName=$_SESSION['uid'];
              $Emailsname=$_SESSION['email'];
              $sql=$conn -> query("SELECT * FROM users WHERE  uidUsers= '$UsersName' OR emailUsers='$Emailsname'" );
              $row = $sql->fetch_assoc();
              $firstName = $row['firstName'];
              $lastName= $row['lastName'];
              $LastLogin=  $row['OldDate'];
              $Count=$row['LoginCount'];
              $result=explode("-",$LastLogin);
              $day= $result[2];
              $month = $result[1];
              $year = $result[0];
              $newdate= $day. "-".$month."-".$year;
            echo '<p class="login-status"> Welcome ' .$firstName." ". $lastName. '</p>';
            echo '<p class="login-status"> You were last logged on ' .$newdate. '</p>';
            echo '<p class="login-status"> Total Logins ' .$Count. '</p>';

			echo '<a href= files/confidential.txt download ><h2>Files</h2></a>';
          }
		  
          ?>
		  <br>
		  <div class = "center">
			<h1>AMLS</h1>
			<br>
			<img class="centernew" src="imgs/aLogo.jpg" alt="Front page logo" width="500" height="333">
			</div>
        </section>
      </div>
    </main>
<?php
  require "footer.php";
?>
