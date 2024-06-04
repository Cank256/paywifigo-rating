<?php
require "../WifiProfiles/configs.php";

global $configValues;
$dbName = $configValues['CONFIG_DB_NAME'];
$dbHost = $configValues['CONFIG_DB_HOST'];
$dbUser = $configValues['CONFIG_DB_USER'];
$dbPass = $configValues['CONFIG_DB_PASS'];
$conn = null;
$stmt = null;

try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass, 
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    echo "Connected Successfully";
} catch (PDOException $e) {
    die("Error Connecting " . $e->getMessage());
}

?>
