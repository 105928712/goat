<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "goat_solutions";
$conn = mysqli_connect($servername, $username, $password, $dbname);


// Check connection
if (!$conn) {
    die("Connection failed " . mysqli_connect_error());
}

?>