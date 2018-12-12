<?php
require "dbh.inc.php";
session_start();

$Usersnew=$_SESSION['uid'];
$Emailsnew=$_SESSION['email'];
$date = date('Y-m-d');


$conn -> query("UPDATE users SET OldDate= '$date' WHERE uidUsers='$Usersnew' OR emailUsers='$Emailsnew'" );
session_unset();
session_destroy();
header("Location: ../index.php");
