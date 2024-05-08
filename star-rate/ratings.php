<?php
include 'configs.php';

$review = $_POST['review'];
$customer_id = "fdd832a4-7280-4f43-bed0-a24f2a9a25a4";//$_POST['cust_id'];
$product_id =2;//$_POST['prod_id'];
$rating =$_POST['rating'];
$hotspot_toOwner_id=1;

global $configValues;
$dbName = $configValues['CONFIG_DB_NAME'];
$dbHost = $configValues['CONFIG_DB_HOST'];
$dbUser = $configValues['CONFIG_DB_USER'];
/** @var TYPE_NAME $dbPass */
$dbPass = $configValues['CONFIG_DB_PASS'];

# 1.1.1 establish a connection
try {

    $con = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//    echo "Connection was successful";
} catch (PDOException $e) {
    $con=null;
    die("Error Connecting " . $e->getMessage());
}
try {



            $insert = $con->prepare("
            INSERT INTO `ratings`(`id`, `posted`, `cust_id`, `user_total__session_bandwidth_GiB`, 
            `user_total__session_time_hrs`, `hotspot_to_owner_id`, `prod_id`, `rating`, `message`)
             VALUES (default,default,:cust_id,
             default,default,:hotspot_to_owner_id,:prod_id,:rating,:message)
            ");
            $insert->bindParam(':cust_id', $customer_id);
            $insert->bindParam(':hotspot_to_owner_id', $hotspot_toOwner_id);
            $insert->bindParam(':prod_id', $product_id);
            $insert->bindParam(':rating', $rating);
            $insert->bindParam(':message', $review);
    $insert->execute();



} catch (PDOException $e) {
    throw $e;
}

//print_r($_POST);