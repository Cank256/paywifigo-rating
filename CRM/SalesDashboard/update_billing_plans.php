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
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    echo "Connected Successfully";
} catch (PDOException $e) {
    die("Error Connecting " . $e->getMessage());
}

$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$planCost = filter_var($_POST['planCost'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$sql = null;

if ($id && $planCost) {
    echo "id: $id, planCost: $planCost\n";
    $sql = "UPDATE billing_plans 
                SET 
                planCost = :planCost 
                WHERE 
                bp_id = :bp_id AND planCost > :planCost
            ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([":planCost" => $planCost, ":bp_id" => $id]);
    $stmt->closeCursor();
    $conn = null;
    http_response_code(200);
    exit();
} else {
    http_response_code(400);
    echo "Bad Request";
    echo json_encode($_POST);
}
?>
