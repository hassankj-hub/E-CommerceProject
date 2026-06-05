<?php
// ========================================================================
// PROJECT: SoccerShoes XI User Registration Engine (with DOB Integration)
// STYLE: MySQLi Procedural 
// ========================================================================

// 1. Link directly to your applicable connection script
include('test_db.php');
echo "<br><br>"; // Provides formatting spacing below the connection log status string

// 2. Only run processing routines if arriving from a legitimate POST action
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 3. Harvest field contents and protect them against SQL issues
    $userIn    = mysqli_real_escape_string($conn, $_POST['username']);
    $userEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $userDob   = mysqli_real_escape_string($conn, $_POST['dob']); 
    $plainPass = mysqli_real_escape_string($conn, $_POST['password']); 

    // 4. Server-Side Safety Validation Check
    if (empty($userIn) || empty($userEmail) || empty($userDob) || empty($plainPass)) {
        die("Registration Error: All parameters must be populated.");
    }

    // 5. Structure the SQL code array maps to send into the 'users' table
    $sql = "INSERT INTO users (username, email, password, dob) 
            VALUES ('$userIn', '$userEmail', '$plainPass', '$userDob')";

    // 6. Execute the instruction via your connection link ($conn)
    if (mysqli_query($conn, $sql)) {
        echo "<div style='padding: 25px; font-family: sans-serif; background-color: #e2fef4; color: #27563f; border-radius: 12px; max-width: 450px; margin: 40px auto; border: 2px solid #9ee5c4;'>";
        echo "<h2 style='font-weight: 800; text-transform: uppercase; margin-bottom: 10px;'>Account Locked In!</h2>";
        echo "<p>Welcome to the SoccerShoes XI squad, <strong>" . htmlspecialchars($userIn) . "</strong>.</p>";
        echo "<p style='font-size: 0.9rem; color: #555; margin-top: 5px;'>Profile Birthdate Logged: " . htmlspecialchars($userDob) . "</p>";
        echo "<br><a href='login.html' style='display: inline-block; padding: 10px 20px; background-color: #27563f; color: #ffffff; text-decoration: none; font-weight: bold; border-radius: 6px;'>Proceed to Login Panel →</a>";
        echo "</div>";
    } else {
        echo "<div style='padding: 20px; font-family: sans-serif; background-color: #ffe6e6; color: #cc0000; border-radius: 12px; max-width: 450px; margin: 40px auto; border: 2px solid #ff3333;'>";
        echo "<strong>Database Processing Error:</strong> " . mysqli_error($conn);
        echo "</div>";
    }

    // 7. Disengage active communication line links
    mysqli_close($conn);
}
?>