<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "questionnaire";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->query("set character set utf8");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>