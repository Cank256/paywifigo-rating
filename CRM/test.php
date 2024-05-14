<?php

require_once 'WifiProfiles/configs.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($configValues['CONFIG_DB_HOST'], $configValues['CONFIG_DB_USER'], $configValues['CONFIG_DB_PASS'], $configValues['CONFIG_DB_NAME']);

$products = $mysqli->query("
SELECT bp.planName AS plan_name, p.creationBy AS creation_by, COUNT(*) as orders,
    SUM(p.amount) as revenue, ROUND(AVG(r.rating),1) AS ratings
    FROM billing_plans bp JOIN radcheck rc on bp.bp_id = rc.bp_id 
    JOIN payment p ON rc.payment_id_fk = p.id 
    JOIN ratings r ON bp.bp_id = r.prod_id 
    group by bp.planName, p.creationBy 
    order by ratings 
    DESC LIMIT 10;
  ");


// Start output buffering to capture the HTML content
ob_start();
?>
    <meta charset="UTF-8">
    <title>CodePen - Sales Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&amp;display=swap'><link rel="stylesheet" href="./style.css">
<link rel='stylesheet' href='style.css'/>

<table class="db__product-table">
    <thead>
    <tr>
        <th>Plan Name</th>
        <th>Access Point</th>
        <th>Orders</th>
        <th>Rating</th>
        <th>Revenue</th>
    </tr>
    </thead>
    <tbody  class="zebra-stripe">

    <?php foreach ($products as $product): ?>
        <?php
        // Extract product details
        $productName = $product['plan_name'];
        $productLocation= $product['creation_by'];
        $orders = number_format($product['orders']); // Format orders with commas
        $productRating = $product['ratings'];
        $price = $product['revenue'];
        // Set status color based on availability
        if ($productRating > 4)
        {
            $statusClass = 'db__status--green';
        }
        else if ($productRating < 4 &&  $productRating > 3){
            $statusClass = 'db__status--orange';

        }
        else{
            $statusClass = 'db__status--red';
        }
        ?>

        <tr>
            <td>
                <div class="db__product">
                    <div class="db__product-details">
                        <div class="db__product-detail-line"><?= $productName ?></div>
                        <div class="db__product-detail-line">
                            <small><?= $orders ?> Orders@<?= $productLocation?></small>
                        </div>
                        <div class="db__status <?= $statusClass ?>"><?= $productRating ?></div>
                    </div>
                    <div class="db__product-details">
                        <strong>$<?= $price ?></strong>
                    </div>
                </div>
            </td>
            <td><?= $productName ?></td>
            <td><?= $productLocation ?></td>
            <td><?= $orders ?></td>
            <td class="db__status <?= $statusClass ?>"><?= $productRating ?></td>
            <td><strong>$<?= $price ?></strong></td>
        </tr>

    <?php endforeach; ?>

    </tbody>
</table>

<?php
// Get the contents of the output buffer and clean it
$tableHTML = ob_get_clean();

// Now you can use $tableHTML variable wherever you want to display the HTML
echo $tableHTML;
?>
