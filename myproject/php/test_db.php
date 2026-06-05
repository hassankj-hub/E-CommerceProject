<?php
// ========================================================================
// PROJECT: SoccerShoes XI Database Connection Configuration
// STYLE: MySQLi Procedural (Beginner Friendly)
// ========================================================================

$host     = "localhost"; 
$username = "root";   // XAMPP default username
$password = "";       // XAMPP default password is empty
$dbname   = "testdb"; // Your database name in phpMyAdmin

// Establish the link handshake to MySQL
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection worked
if ($conn) {
   // echo "Connected Successfully to " . $dbname;
} else {
    // If it fails, stop execution and print the exact error message
    die("Connection Failed: " . mysqli_connect_error());
}
?>