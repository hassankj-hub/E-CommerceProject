<?php
// ========================================================================
// PROJECT: SoccerShoes XI User Login Authentication Engine
// STYLE: MySQLi Procedural (Beginner Friendly)
// ROUTING: Auto-Redirect to html/homepage.php upon successful validation
// ========================================================================

// 1. Initialize session memory tracking before headers or HTML outputs are sent
session_start();

// 2. Link your database connection parameter file (lives in the same php/ folder)
include('test_db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 3. Capture form values from login inputs and clean them for safety
    $userInput = mysqli_real_escape_string($conn, $_POST['username_or_email']);
    $plainPass = mysqli_real_escape_string($conn, $_POST['password']);

    // Guard logic: verify inputs are not empty strings
    if (empty($userInput) || empty($plainPass)) {
        die("Login Error: Please fill in both the username/email and password fields.");
    }

    // 4. Query the database to locate matching records across username OR email columns
    $sql = "SELECT * FROM users WHERE username='$userInput' OR email='$userInput'";
    $result = mysqli_query($conn, $sql);

    // 5. Verify if a matching row record exists
    if (mysqli_num_rows($result) > 0) {
        // Unpack user record array packet row
        $row = mysqli_fetch_assoc($result);

        // 6. Direct plain-text string comparison matching for verification
        if ($plainPass === $row['password']) {
            
            // 7. SUCCESS! Store user identity properties into global session tokens
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            
            // --- ALIGNMENT ADJUSTMENTS FOR YOUR DASHBOARD SIDEBAR ---
            $_SESSION['user_name'] = $row['username']; 
            $_SESSION['user_email'] = $row['email'];
            
            // 8. ROUTING HANDOFF FIX: Steps OUT of php/ and goes INTO html/ to find homepage.php
            header("Location: ../php/homepage.php");
            exit(); // Halts further background script compilations immediately
            
        } else {
            // Password mismatch error design - Path fix to step out to html/login.html
            echo "<div style='padding: 20px; font-family: sans-serif; background-color: #ffe6e6; color: #cc0000; border-radius: 12px; max-width: 450px; margin: 40px auto; border: 2px solid #ff3333;'>";
            echo "<strong>Authentication Failed:</strong> The password you entered is incorrect.";
            echo "<br><br><a href='../html/login.html' style='color: #cc0000; font-weight: bold; text-decoration: none;'>← Try Again</a>";
            echo "</div>";
        }
    } else {
        // Account not found error design - Path fix to step out to html/login.html
        echo "<div style='padding: 20px; font-family: sans-serif; background-color: #ffe6e6; color: #cc0000; border-radius: 12px; max-width: 450px; margin: 40px auto; border: 2px solid #ff3333;'>";
        echo "<strong>Authentication Failed:</strong> No account exists matching that username or email.";
        echo "<br><br><a href='../html/login.html' style='color: #cc0000; font-weight: bold; text-decoration: none;'>← Try Again</a>";
        echo "</div>";
    }

    // 9. Close communication pipeline lines safely
    mysqli_close($conn);
} else {
    // FALLBACK PROTECTION: If someone accesses login.php directly without submitting the form,
    // seamlessly kick them back to the actual visual interface.
    header("Location: ../html/login.html");
    exit();
}
?>