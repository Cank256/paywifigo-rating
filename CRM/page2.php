<?php
include_once __DIR__ .'/libs/csrf/csrfprotector.php';

// Initialise CSRFProtector library
try {
    csrfProtector::init();
} catch (configFileNotFoundException $e) {
}
session_start();

if (!isset($_SESSION['user_data'])) {
    $_SESSION['referer'] = "page2.php";
    header('Location: login.php');
    exit();
}
// Check if the array exists in the session.
if (isset($_SESSION['user_data'])) {
    $data = $_SESSION['user_data'];

    // Now, you can access individual elements in the array.
    $username = $data['username'];
    $hotspot_owner_id = $data['hotspot_owner_id'];

    // Use the data as needed.
    echo "Username: $username, Email: $hotspot_owner_id";
} else {
    // The array doesn't exist in the session.
    echo "User data not found in the session.";
}

// You can access the username using $_SESSION['username'] here.
// Add a link or button for logging out.
echo '<a href="logout.php">Log Out</a>';

?>

<!-- Your page content here -->