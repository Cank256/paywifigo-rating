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
    $stmt = $con->prepare("
select count(*) as todaysorders, coalesce(sum(amount),0.00) as todays_sales, (SELECT DATE_SUB(CURDATE(), INTERVAL 1 DAY) AS yesterday_date) as
yesterday_date, (select coalesce(sum(amount),0.00) from payment where creationdate >= yesterday_date and creationdate < CURDATE()) as yesterday_sales,
 (select count(*) from payment where creationdate >= yesterday_date and creationdate < CURDATE()) as yesterdayorders,
 ROUND(COALESCE(AVG(amount), 0.00), 2)  as averageorderamt,
 (select ROUND(COALESCE(AVG(amount), 0.00), 2)  from payment where creationdate >= yesterday_date and creationdate < CURDATE()) as avgorderamt_yesterday 
  from payment where creationdate >= CURDATE();
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
