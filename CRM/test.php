<?php
// Assuming you have fetched the data from your database and stored it in a variable called $products
// For demonstration, let's assume $products is an array of arrays containing product details
$products = [
    ['Product' => 'iPhone 13', 'Orders' => 2710, 'Status' => 'In Stock', 'Price' => '$599.99'],
    ['Product' => 'iPhone 13', 'Orders' => 2710, 'Status' => 'In Stock', 'Price' => '$599.99'],
    ['Product' => 'iPhone 13', 'Orders' => 2710, 'Status' => 'In Stock', 'Price' => '$599.99'],
    ['Product' => 'iPhone 13', 'Orders' => 2710, 'Status' => 'In Stock', 'Price' => '$599.99'],
    ['Product' => 'iPhone 13', 'Orders' => 2710, 'Status' => 'In Stock', 'Price' => '$599.99'],
    // Add more products here if needed
];

require_once 'WifiProfiles/configs.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($configValues['CONFIG_DB_HOST'], $configValues['CONFIG_DB_USER'], $configValues['CONFIG_DB_PASS'], $configValues['CONFIG_DB_NAME']);

$products = $mysqli->query("SELECT creationdate as Product, amount as Orders, invoice_id as Status, creationby as Price FROM payment ORDER BY creationdate DESC LIMIT 7");


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
        <th>Orders</th>
        <th>Rating</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody  class="zebra-stripe">

    <?php foreach ($products as $product): ?>
        <?php
        // Extract product details
        $productName = $product['Product'];
        $orders = number_format($product['Orders']); // Format orders with commas
        $status = $product['Status'];
        $price = $product['Price'];
        // Set status color based on availability
        $statusClass = $status == 'In Stock' ? 'db__status--green' : 'db__status--red';
        ?>

        <tr>
            <td>
                <div class="db__product">
                    <div class="db__product-details">
                        <div class="db__product-detail-line"><?= $productName ?></div>
                        <div class="db__product-detail-line">
                            <small><?= $orders ?> Orders</small>
                        </div>
                        <div class="db__status <?= $statusClass ?>"><?= $status ?></div>
                    </div>
                    <div class="db__product-details">
                        <strong><?= $price ?></strong>
                    </div>
                </div>
            </td>
            <td><?= $productName ?></td>
            <td><?= $orders ?></td>
            <td class="db__status <?= $statusClass ?>"><?= $status ?></td>
            <td><strong><?= $price ?></strong></td>
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
