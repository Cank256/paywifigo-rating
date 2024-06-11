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
} catch (PDOException $e) {
    die("Error Connecting " . $e->getMessage());
}

$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$planCost = filter_var($_POST['planCost'], FILTER_SANITIZE_NUMBER_INT);
$sql = null;

if ($id && $planCost) {
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE billing_plans 
            SET 
            planCost = :planCost 
            WHERE 
            bp_id = :bp_id
";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":planCost", $planCost);
        $stmt->bindParam(":bp_id", $bp_id);
        $stmt->execute();
        echo json_encode(["planCost" => $planCost, "bp_id" => $id]);
        http_response_code(200);
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Internal Server Error";
        echo json_encode($e->getMessage());
    }
} else {
    http_response_code(400);
    echo "Bad Request";
    echo json_encode($_POST);
}
?>
