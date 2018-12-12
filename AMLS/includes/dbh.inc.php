<?php
//fill out with own DB credentials
/*********************************/
$dBServername = "comp424project.c6dby1z6cevw.us-west-1.rds.amazonaws.com";
$dBUsername = "comp424project";
$dBPassword = "comp424project";
$dBName = "comp424project";
// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
