<?php
include_once __DIR__ .'/libs/csrf/csrfprotector.php';

// Initialise CSRFProtector library
try {
    csrfProtector::init();
} catch (configFileNotFoundException $e) {
}
session_start();

// Check if the user is logged in. If not, redirect to the login page.
if (!isset($_SESSION['user_data'])) {
    header('Location: login.php');
    exit();
}

// Unset all session variables and destroy the session.
session_unset();
session_destroy();

// Redirect to the login page after logout.
header('Location: login.php');
exit();
?>
