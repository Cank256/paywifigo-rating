<?php
//require "test_configs.php";
require "../WifiProfiles/configs.php";

global $configValues;
$dbName = $configValues['CONFIG_DB_NAME'];
$dbHost = $configValues['CONFIG_DB_HOST'];
$dbUser = $configValues['CONFIG_DB_USER'];
/** @var TYPE_NAME $dbPass */
$dbPass = $configValues['CONFIG_DB_PASS'];

$last_session_id = null;
$retarray = null;

# 1.1.1 establish a connection
try {
    $con = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
//    echo "Connection was successful";
} catch (PDOException $e) {
    die("Error Connecting " . $e->getMessage());
}
try {
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*
    $stmt = $con->prepare("
SELECT 
	(SELECT COALESCE(
    (
        SELECT MAX(amount) 
        FROM payment 
        WHERE creationdate BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
    ), 
    0.00
)) AS max_amount_30days,
    CURDATE() AS today,
    COALESCE(SUM(amount), 0.00) AS todaySales,
    DATE_SUB(CURDATE(), INTERVAL 1 DAY) AS day1_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
        AND creationdate < CURDATE()
    ), 0.00) AS yesterday_sales,
    DATE_SUB(CURDATE(), INTERVAL 2 DAY) AS day2_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 2 DAY)
        AND creationdate < DATE_SUB(CURDATE(), INTERVAL 1 DAY)
    ), 0.00) AS day2_before_sales,
    DATE_SUB(CURDATE(), INTERVAL 3 DAY) AS day3_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)
        AND creationdate < DATE_SUB(CURDATE(), INTERVAL 2 DAY)
    ), 0.00) AS day3_before_sales,
    DATE_SUB(CURDATE(), INTERVAL 4 DAY) AS day4_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 4 DAY)
        AND creationdate < DATE_SUB(CURDATE(), INTERVAL 3 DAY)
    ), 0.00) AS day4_before_sales,
    DATE_SUB(CURDATE(), INTERVAL 5 DAY) AS day5_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 5 DAY)
        AND creationdate < DATE_SUB(CURDATE(), INTERVAL 4 DAY)
    ), 0.00) AS day5_before_sales,
    DATE_SUB(CURDATE(), INTERVAL 6 DAY) AS day6_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
        AND creationdate < DATE_SUB(CURDATE(), INTERVAL 5 DAY)
    ), 0.00) AS day6_before_sales
FROM payment
WHERE creationdate >= CURDATE();

");
    */
    $stmt = $con->prepare("
SELECT 
    (
        SELECT COALESCE(MAX(daily_total), 0.00)
        FROM (
            SELECT DATE(creationdate) AS sale_day, SUM(amount) AS daily_total
            FROM payment
            WHERE creationdate >= CURDATE() - INTERVAL 30 DAY
              AND creationdate <= NOW()
            GROUP BY DATE(creationdate)
        ) AS daily_sums
    ) AS max_amount_30days,

    CURDATE() AS today,
    COALESCE(SUM(amount), 0.00) AS todaySales,

    DATE_SUB(CURDATE(), INTERVAL 1 DAY) AS day1_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
          AND creationdate < CURDATE()
    ), 0.00) AS yesterday_sales,

    DATE_SUB(CURDATE(), INTERVAL 2 DAY) AS day2_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 2 DAY)
          AND creationdate < DATE_SUB(CURDATE(), INTERVAL 1 DAY)
    ), 0.00) AS day2_before_sales,

    DATE_SUB(CURDATE(), INTERVAL 3 DAY) AS day3_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)
          AND creationdate < DATE_SUB(CURDATE(), INTERVAL 2 DAY)
    ), 0.00) AS day3_before_sales,

    DATE_SUB(CURDATE(), INTERVAL 4 DAY) AS day4_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 4 DAY)
          AND creationdate < DATE_SUB(CURDATE(), INTERVAL 3 DAY)
    ), 0.00) AS day4_before_sales,

    DATE_SUB(CURDATE(), INTERVAL 5 DAY) AS day5_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 5 DAY)
          AND creationdate < DATE_SUB(CURDATE(), INTERVAL 4 DAY)
    ), 0.00) AS day5_before_sales,

    DATE_SUB(CURDATE(), INTERVAL 6 DAY) AS day6_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
          AND creationdate < DATE_SUB(CURDATE(), INTERVAL 5 DAY)
    ), 0.00) AS day6_before_sales

FROM payment
WHERE creationdate >= CURDATE();


");
//    $stmt->bindParam(':billingplanrowid', $billingplanrowid);
    $stmt->execute();

    // set the resulting array to associative
//        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $counter = $stmt->fetchAll(PDO::FETCH_ASSOC);
    /**
     * Scenario:
     * A user attempts to purchase a bundle. He clicks on multiple packages that are inserted into the
     * purchase_queue and there is a delay in the reception of the stk push.
     * and finally when the stkpush is received and the selected amount is paid. The program needs to
     * perform a matching with the most recent and likely purchased package and select that one.
     * The selected purchase_queue entry should be one that was selected within a 10 minute window
     * from the current timestamp.
     *
     *
     *
     * TODO: When someone Cancels the Mpesa Stkpush bann them for the next 5 minutes before they are allowed to try again.
     */


//        echo "Total rows" .count($counter);
//        $rows = count($counter);
    if (is_null($counter)) {
        $con = null;
    } else {
//            echo "Records returned for " . $stkpush_payments_insert_row_id. " " .print_r($counter);
//            $keycloak_id = $counter[0];
//            $Purchase_Profile_id = $counter[1];
        $retarray = $counter;
//        echo "Something returnd";
        $con = null;

    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $con = null;
}
//print_r($retarray);
//echo json_encode(retarray);

//header('Content-type: application/json');
echo json_encode($retarray);
?>
