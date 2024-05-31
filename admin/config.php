<?php
$hostname="http://localhost/news-site";


$servername = "localhost";
$username = "root";
$password = "";
$dbname="news-site";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "";
?>