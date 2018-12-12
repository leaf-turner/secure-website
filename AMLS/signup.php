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
        <style>
            /* Style all input fields */
            input {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                margin-top: 6px;
                margin-bottom: 16px;
            }

            /* Style the submit button */
            input[type=submit] {
                background-color: #4CAF50;
                color: white;
            }

            /* Style the container for inputs */
            .container {
                background-color: #f1f1f1;
                padding: 20px;
            }

            /* The message box is shown when the user clicks on the password field */
            #message {
                display:none;
                background: white;
                color: #000;
                position: static;

            }

            #message p {
                padding: 5px 5px 5px 5px;

                font-size: 15px;
            }

            /* Add a green text color and a checkmark when the requirements are right */
            .valid {
                color: green;
            }

            .valid:before {
                position: relative;
                left: -35px;
                content: "✔";
            }

            /* Add a red text color and an "x" when the requirements are wrong */
            .invalid {
                color: red;
            }

            .invalid:before {
                position: relative;
                left: -35px;
                content: "✖";
            }
        </style>
      <div class="wrapper-main" >
        <section class="section-default">
          <h1>Register</h1>
		  <hr>
		 
			
          <?php
          // Here we create an error message if the user made an error trying to sign up.
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyfields") {
              echo '<p class="signuperror">Fill in all fields!</p>';
            }
            else if ($_GET["error"] == "invaliduidmail") {
              echo '<p class="signuperror">Invalid username and e-mail!</p>';
            }
            else if ($_GET["error"] == "invaliduid") {
              echo '<p class="signuperror">Invalid username!</p>';
            }
            else if ($_GET["error"] == "invalidmail") {
              echo '<p class="signuperror">Invalid e-mail!</p>';
            }
            else if ($_GET["error"] == "NotStrong") {
                echo '<p class="signuperror">Please Enter a Strong Password!</p>';
            }
            else if ($_GET["error"] == "passwordcheck") {
              echo '<p class="signuperror">Your passwords do not match!</p>';
            }
            else if ($_GET["error"] == "usertaken") {
              echo '<p class="signuperror">Username is already taken!</p>';
            }
            else if ($_GET["error"] == "Notregistered") {
                echo '<p class="signuperror">You are are not registered yet.</p>';
            }
          }
          // Here we create a success message if the new user was created.
          else if (isset($_GET["signup"])) {
            if ($_GET["signup"] == "success") {
              echo '<p class="signupsuccess">Signup successful!</p>';
            }
          }
          ?>
          <form class="form-signup" action="includes/signup.inc.php" method="post" id = "signup-form">
            <?php
            

            //check username.
            if (!empty($_GET["uid"])) {
              echo '<input type="text" name="uid" placeholder="Username" value="'.$_GET["uid"].'">';
            }
            else {
              echo '<input type="text" align="left" name="uid" placeholder="Username">';
            }

            //check e-mail.
            if (!empty($_GET["mail"])) {
              echo '<input type="text" name="mail" placeholder="E-mail" value="'.$_GET["mail"].'">';
            }
            else {
              echo '<input type="text" name="mail" placeholder="E-mail">';
            }
            ?>
			<input class="input-area1" type ="text" name="firstname" placeholder= "First name">
			
			<input class="input-area1" type ="text" name="lastname" placeholder= "Last name">
			
			<input class="input-area1"  type ="date" name="dateofbirth">
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




            <input type="password" id= "password" name="pwd" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

        <div id="message">
            <h5 width="300" ><b>Password Requirements:</b></h5>
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
        </div>


            <input type="password" name="pwdrepeat" placeholder="Repeat password">





        <!--reCaptcha-->
        <h5><b>Verify Identity</b></h5>
        <!--need api key for reCaptcha-->
        <br>
        <div align= "center" class="g-recaptcha" data-sitekey="6Lf8i38UAAAAAK8sWeo8clyzyxYFL92mqq-qQ3rh"></div>
        <br>
            <button type="submit" name="signup-submit">Signup</button>
          </form>



        <script>
            var myInput = document.getElementById("password");
            var letter = document.getElementById("letter");
            var capital = document.getElementById("capital");
            var number = document.getElementById("number");
            var length = document.getElementById("length");

            // When the user clicks on the password field, show the message box
            myInput.onfocus = function() {
                document.getElementById("message").style.display = "block";
            }

            // When the user clicks outside of the password field, hide the message box
            myInput.onblur = function() {
                document.getElementById("message").style.display = "none";
            }

            // When the user starts to type something inside the password field
            myInput.onkeyup = function() {
                // Validate lowercase letters
                var lowerCaseLetters = /[a-z]/g;
                if(myInput.value.match(lowerCaseLetters)) {
                    letter.classList.remove("invalid");
                    letter.classList.add("valid");
                } else {
                    letter.classList.remove("valid");
                    letter.classList.add("invalid");
                }

                // Validate capital letters
                var upperCaseLetters = /[A-Z]/g;
                if(myInput.value.match(upperCaseLetters)) {
                    capital.classList.remove("invalid");
                    capital.classList.add("valid");
                } else {
                    capital.classList.remove("valid");
                    capital.classList.add("invalid");
                }

                // Validate numbers
                var numbers = /[0-9]/g;
                if(myInput.value.match(numbers)) {
                    number.classList.remove("invalid");
                    number.classList.add("valid");
                } else {
                    number.classList.remove("valid");
                    number.classList.add("invalid");
                }

                // Validate length
                if(myInput.value.length >= 8) {
                    length.classList.remove("invalid");
                    length.classList.add("valid");
                } else {
                    length.classList.remove("valid");
                    length.classList.add("invalid");
                }
            }
        </script>
        </section>



      </div>

    </main>

<?php
  require "footer.php";
?>
