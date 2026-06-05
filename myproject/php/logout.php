<?php
// 1. Initialize the session to access active session variables
session_start();

// 2. Unset all session variables to clear user data from memory
$_SESSION = array();

// 3. Destroys the session cookie if it exists to completely clean the browser tracking
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// 4. Destroy the session registration on the server side
session_destroy();

// 5. Redirect the user back out to the main login screen
header("Location: ../html/login.html");
exit;
?>