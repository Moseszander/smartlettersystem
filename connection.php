<?php
$servername = "localhost";
$username = "root"; // Replace with your actual database username
$password = ""; // Replace with your actual database password
$dbname = "project";

// Create connection
$link =(mysqli_connect($servername, $username, $password, $dbname));

  if(mysqli_connect_errno()){
    exit('failed to connect to mysqli:'.mysqli_connect_errno());
  }
  
?>
