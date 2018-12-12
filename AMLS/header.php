<?php
/*
*   ***************************************************************************
*	Using info from tutorial on PHP, 
*	by mmtuts channel: https://www.youtube.com/channel/UCzyuZJ8zZ-Lhfnz41DG5qLw
*	https://www.youtube.com/watch?v=LC9GaXkdxF8
*   ***************************************************************************
*/
  session_start();
  require "includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="This is an example of a meta description. This will often show up in search results.">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>AMLS</title>
	<!--jQuery-->
	  <script
		src="https://code.jquery.com/jquery-3.2.1.min.js"
		integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
		crossorigin="anonymous"></script>   
	
	
	<!--validate jQuery-->
      <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.3.min.js"></script>
      <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.17.0/jquery.validate.min.js"></script>
	<script src = "https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
	<script src = "https://ajax.aspnetcdn.com/ajax/jquery.validate/1.17.0/additional-methods.min.js"></script>

      <script src= "validation.js"></script>
	<!--reCaptcha-->
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
	<script src= "validation.js"></script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    
    <header>
      <nav class="nav-header-main">



        <ul class="main34">
          <li ><a  href="index.php">Home</a></li>
          <li><a href="forgotusername.php">Forgot Username or Password?</a></li>
        </ul>
      </nav>
      <div class="header-login">
       
        <?php
        require "includes/dbh.inc.php";
        if (!isset($_SESSION['id'])) {
          echo '<form action="includes/login.inc.php" method="post">
            <input  type="text" name="mailuid" placeholder="E-mail/Username">
            <input " type="password" name="pwd" placeholder="Password">
            <button  type="submit" name="login-submit">Login</button>
          </form>
          <a href="signup.php" class="header-signup">Signup</a>';
        }
        else if (isset($_SESSION['id'])) {
          echo '<form action="includes/logout.inc.php" method="post">
            <button type="submit" name="login-submit">Logout</button>
          </form>';

        }
        ?>
      </div>
    </header>
