<?php
require_once('./sessionHeader.php');
// This will "logout" the user by destroying the session and all session variables

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Finally, destroy the session.
session_destroy();

// Redirect back to initial search page

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.html';
header("Location: http://$host$uri/$extra");
exit;


/*

if (isset($_SESSION['Token'])) {
    print " <a href=\"./Logout.php\">Logout</a>";
} else {
    print "<p>You have successfully logged out.<p>";
    print " <a href=\"./index.html\">eBay Search</a>";
}

*/

?>



