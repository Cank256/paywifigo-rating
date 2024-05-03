<?php
include_once __DIR__ .'/libs/csrf/csrfprotector.php';

// Initialise CSRFProtector library
try {
    csrfProtector::init();
} catch (configFileNotFoundException $e) {
}
if(!isset($_SESSION)) { session_start(); }

if (!isset($_SESSION['user_data'])) {
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
    echo "<div style='background-color: black' >Username: $username, Email: $hotspot_owner_id ";
} else {
    // The array doesn't exist in the session.
    echo "User data not found in the session.";
}

// You can access the username using $_SESSION['username'] here.
// Add a link or button for logging out.
echo '<a href="logout.php">Log Out</a></div>';

?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>CodePen - Sales Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&amp;display=swap'><link rel="stylesheet" href="./style.css">

</head>
<body >
<!-- partial:index.partial.html -->
<svg display="none">
    <symbol id="calendar" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="8,1 8,6" />
            <polyline points="16,1 16,6" />
            <polyline points="2,10 22,10" />
            <circle cx="7" cy="14" r="1" />
            <circle cx="12" cy="14" r="1" />
            <circle cx="17" cy="14" r="1" />
            <circle cx="7" cy="19" r="1" />
            <circle cx="12" cy="19" r="1" />
            <circle cx="17" cy="19" r="1" />
            <rect x="2" y="3" rx="3" ry="3" width="20" height="20" />
        </g>
    </symbol>
    <symbol id="export" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="8,5 12,1 16,5" />
            <polyline points="12,1 12,16" />
            <rect x="2" y="10" rx="3" ry="3" width="20" height="13" />
        </g>
    </symbol>
    <symbol id="hat" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle r="8" cx="12" cy="14" stroke-dasharray="25.13 25.13" stroke-dashoffset="25.13" />
            <polygon points="1,14 23,14" />
        </g>
    </symbol>
    <symbol id="laptop" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="2" rx="3" ry="3" width="18" height="12" />
            <polygon points="3,14 21,14 23,22 1,22" />
        </g>
    </symbol>
    <symbol id="monitor" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="1" rx="3" ry="3" width="22" height="16" />
            <polyline points="1,12 22,12" />
            <polyline points="12,19 12,21" />
            <polyline points="6,23 18,23" />
        </g>
    </symbol>
    <symbol id="pants" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="4,1 20,1 20,23 12,23 12,8 12,8 12,23 4,23" />
        </g>
    </symbol>
    <symbol id="shirt" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="8,3 12,6 16,3 23,6 21,11 18,10 20,21 4,21 6,10 3,11 1,6" />
        </g>
    </symbol>
    <symbol id="smartphone" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="4" y="1" rx="3" ry="3" width="16" height="22" />
            <polyline points="10,6 14,6" />
            <circle cx="12" cy="18" r="1" />
        </g>
    </symbol>
    <symbol id="tablet" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="1" rx="3" ry="3" width="20" height="22" />
            <circle cx="12" cy="18" r="1" />
        </g>
    </symbol>
</svg>
<main class="db">
    <div class="db__toolbar">
        <h1 class="db__heading">Sales</h1>
        <div class="db__toolbar-btns">
            <button class="db__select" type="button">
                <svg class="db__select-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#calendar" />
                </svg>
                Date
            </button>
            <button class="db__select" type="button">
                <svg class="db__select-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#export" />
                </svg>
                Export
            </button>

        </div>
    </div>




    <div class="db__cell">
        <h2 class="db__top-stat">Today’s Revenue</h2>
        <div class="db__progress">
            <div class="db__progress-fill" style="transform:translateX(15%)"></div>
        </div>
        <div class="db__counter">
            <div id="todaysales" class="db__counter-value" title="$0,000,000.00">$0.00M</div>
            <div class="db__counter-label-sales">
                <strong>+00%</strong><br><small>vs yesterday</small>
            </div>
        </div>
    </div>
    <div class="db__cell">
        <h2 class="db__top-stat">Today’s Orders</h2>
        <div class="db__progress">
            <div class="db__progress-fill" style="transform:translateX(20%)"></div>
        </div>
        <div class="db__counter">
            <div id="todayorders" class="db__counter-value">0,000</div>
            <div class="db__counter-label-orders">
                <strong>+00%</strong><br><small>vs yesterday</small>
            </div>
        </div>
    </div>
    <div class="db__cell">
        <h2 class="db__top-stat">Avg. Order Value</h2>
        <div class="db__progress">
            <div class="db__progress-fill" style="transform:translateX(42%)"></div>
        </div>
        <div class="db__counter">
            <div id="averagesales" class="db__counter-value">$000.00</div>
            <div class="db__counter-label-avg">
                <strong>+00%</strong><br><small>vs yesterday</small>
            </div>
        </div>
    </div>
    <div class="db__cell">
        <h2 class="db__subheading">Sales in Last 7 Days</h2>
        <div class="db__bars">
            <div class="db__bars-cell">
                <div class="db__bars-cell-bar" title="$4,610,555.90">
                    <div class="db__bars-cell-bar-fill" style="transform:translateY(-92.2%)"></div>
                </div>
            </div>
            <div class="db__bars-cell">
                <div class="db__bars-cell-bar" title="$3,612,857.76">
                    <div class="db__bars-cell-bar-fill" style="transform:translateY(-72.3%)"></div>
                </div>
            </div>
            <div class="db__bars-cell">
                <div class="db__bars-cell-bar" title="$2,137,371.54">
                    <div class="db__bars-cell-bar-fill" style="transform:translateY(-42.7%)"></div>
                </div>
            </div>
            <div class="db__bars-cell">
                <div class="db__bars-cell-bar" title="$4,856,109.94">
                    <div class="db__bars-cell-bar-fill" style="transform:translateY(-97.1%)"></div>
                </div>
            </div>
            <div class="db__bars-cell">
                <div class="db__bars-cell-bar" title="$3,662,766.81">
                    <div class="db__bars-cell-bar-fill" style="transform:translateY(-73.3%)"></div>
                </div>
            </div>
            <div class="db__bars-cell">
                <div class="db__bars-cell-bar" title="$2,895,150.25">
                    <div class="db__bars-cell-bar-fill" style="transform:translateY(-57.9%)"></div>
                </div>
            </div>
            <div class="db__bars-cell">
                <div class="db__bars-cell-bar" title="$3,330,050.90">
                    <div class="db__bars-cell-bar-fill" style="transform:translateY(-66.6%)"></div>
                </div>
            </div>
            <div class="db__bars-cell">$5M</div>
            <div class="db__bars-cell">$4M</div>
            <div class="db__bars-cell">$3M</div>
            <div class="db__bars-cell">$2M</div>
            <div class="db__bars-cell">$1M</div>
            <div class="db__bars-cell"></div>
            <div class="db__bars-cell">
                <time datetime="2022-05-01">MON</time>
            </div>
            <div class="db__bars-cell">
                <time datetime="2022-05-02">TUE</time>
            </div>
            <div class="db__bars-cell">
                <time datetime="2022-05-03">WED</time>
            </div>
            <div class="db__bars-cell">
                <time datetime="2022-05-04">THU</time>
            </div>
            <div class="db__bars-cell">
                <time datetime="2022-05-05">FRI</time>
            </div>
            <div class="db__bars-cell">
                <time datetime="2022-05-06">SAT</time>
            </div>
            <div class="db__bars-cell">
                <time datetime="2022-05-07">SUN</time>
            </div>
        </div>
    </div>
    <div class="db__cell">
        <h2 class="db__subheading">Best Selling Products</h2>
        <table class="db__product-table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Orders</th>
                <th>Status</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody  class="zebra-stripe">
            <tr>
                <td>
                    <div class="db__product">
                        <div class="db__product-details">
                            <div class="db__product-detail-line">iPhone 13</div>
                            <div class="db__product-detail-line">
                                <small>2,710 Orders</small>
                            </div>
                            <div class="db__status db__status--green">In Stock</div>
                        </div>
                        <div class="db__product-details">
                            <strong>$599.99</strong>
                        </div>
                    </div>
                </td>
                <td>iPhone 13</td>
                <td>2,710</td>
                <td class="db__status db__status--green">In Stock</td>
                <td><strong>$599.99</strong></td>
            </tr>
            <tr>
                <td>
                    <div class="db__product">
                        <div class="db__product-details">
                            <div class="db__product-detail-line">Macbook Air 2022</div>
                            <div class="db__product-detail-line">
                                <small>1,066 Orders</small>
                            </div>
                            <div class="db__status db__status--red">Out of Stock</div>
                        </div>
                        <div class="db__product-details">
                            <strong>$1199.99</strong>
                        </div>
                    </div>
                </td>
                <td>Macbook Air 2022</td>
                <td>1,066</td>
                <td class="db__status db__status--red">Out of Stock</td>
                <td><strong>$1199.99</strong></td>
            </tr>
            <tr>
                <td>
                    <div class="db__product">
                        <div class="db__product-details">
                            <div class="db__product-detail-line">Denim #142 Light Blue</div>
                            <div class="db__product-detail-line">
                                <small>102 Orders</small>
                            </div>
                            <div class="db__status db__status--orange">Low In Stock</div>
                        </div>
                        <div class="db__product-details">
                            <strong>$44.99</strong>
                        </div>
                    </div>
                </td>
                <td>Denim #142 Light Blue</td>
                <td>327</td>
                <td class="db__status db__status--orange">Low In Stock</td>
                <td><strong>$44.99</strong></td>
            </tr>
            <tr>
                <td>
                    <div class="db__product">
                        <div class="db__product-details">
                            <div class="db__product-detail-line">iPad Air 5</div>
                            <div class="db__product-detail-line">
                                <small>303 Orders</small>
                            </div>
                            <div class="db__status db__status--green">In Stock</div>
                        </div>
                        <div class="db__product-details">
                            <strong>$549.99</strong>
                        </div>
                    </div>
                </td>
                <td>iPad Air 5</td>
                <td>303</td>
                <td class="db__status db__status--green">In Stock</td>
                <td><strong>$549.99</strong></td>
            </tr>
            <tr>
                <td>
                    <div class="db__product">
                        <div class="db__product-details">
                            <div class="db__product-detail-line">iMac 2022</div>
                            <div class="db__product-detail-line">
                                <small>104 Orders</small>
                            </div>
                            <div class="db__status db__status--green">In Stock</div>
                        </div>
                        <div class="db__product-details">
                            <strong>$1,699.99</strong>
                        </div>
                    </div>
                </td>
                <td>iMac 2022</td>
                <td>104</td>
                <td class="db__status db__status--green">In Stock</td>
                <td><strong>$1,699.99</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="db__cell">
        <h2 class="db__subheading">Top Selling Categories</h2>
        <div class="db__bubbles">
            <div class="db__bubble">
				<span id="biggest" class="db__bubble-text">
                    <span id="category-1">Data</span><br><strong class="db__bubble-value">0,000</strong><br>orders made
				</span>
            </div>
            <div class="db__bubble">
				<span id="bigger" class="db__bubble-text"><span id="category-2">Time</span><br><strong class="db__bubble-value">0,000</strong><br>orders made
				</span>
            </div>
            <div class="db__bubble">
				<span id="big" class="db__bubble-text"><span id="category-3">TimeData</span><br><strong class="db__bubble-value">0,000</strong><br>orders made
				</span>
            </div>
        </div>
    </div>
    <div class="db__cell">
        <h2 class="db__subheading">Recent Orders</h2>
        <div class="db__order db__order-item">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#smartphone" />
                </svg>
            </div>
            <div class="db__order-name">
                iPhone 13<br>
                <small>
                    <time datetime="2022-05-07 18:49:00">May 7 at 6:49 PM</time>
                </small>
            </div>
            <div><strong>$599.99</strong></div>
        </div>
        <div class="db__order db__order-item">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#laptop" />
                </svg>
            </div>
            <div class="db__order-name">
                Macbook Air 2022<br>
                <small>
                    <time datetime="2022-05-07 18:49:00">May 7 at 6:49 PM</time>
                </small>
            </div>
            <div><strong>$1199.99</strong></div>
        </div>
        <div class="db__order db__order-item">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#pants" />
                </svg>
            </div>
            <div class="db__order-name">
                Denim #142 Light Blue<br>
                <small>
                    <time datetime="2022-05-07 18:49:00">May 7 at 6:49 PM</time>
                </small>
            </div>
            <div><strong>$44.99</strong></div>
        </div>
        <div class="db__order db__order-item">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#shirt" />
                </svg>
            </div>
            <div class="db__order-name">
                White Blouse<br>
                <small>
                    <time datetime="2022-05-07 18:49:00">May 7 at 6:49 PM</time>
                </small>
            </div>
            <div><strong>$54.99</strong></div>
        </div>
        <div class="db__order db__order-item">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#monitor" />
                </svg>
            </div>
            <div class="db__order-name">
                iMac 2022<br>
                <small>
                    <time datetime="2022-05-07 18:49:00">May 7 at 6:49 PM</time>
                </small>
            </div>
            <div><strong>$1,699.99</strong></div>
        </div>
        <div class="db__order db__order-item">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#tablet" />
                </svg>
            </div>
            <div class="db__order-name">
                iPad Air 5<br>
                <small>
                    <time datetime="2022-05-07 18:49:00">May 7 at 6:49 PM</time>
                </small>
            </div>
            <div><strong>$549.99</strong></div>
        </div>
        <div class="db__order db__order-item">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#hat" />
                </svg>
            </div>
            <div class="db__order-name">
                Fedora Hat<br>
                <small>
                    <time datetime="2022-05-07 18:49:00">May 7 at 6:49 PM</time>
                </small>
            </div>
            <div><strong>$224.99</strong></div>
        </div>
    </div>
</main>
<!-- partial -->
<script src="assets/js/jquery.min.js"></script>
<!-- Load Payment Tile Dynamically using Ajax -->
<script type="text/javascript">
    function convertStringToFloat(strtofloat){
        /// Convert the string to a decimal number
        var decimalValue = parseFloat(strtofloat);

        // console.log(decimalValue); // Output: 123.45

        var defaultValue = 0.00; // Default value to use for nulls

        var result = parseFloat(decimalValue) || defaultValue;
        return result
    }
    function computePercentages(yesterday,today){
        // Example string representing an integer
        let percentageDifference = 0;
        const yesterfloat = convertStringToFloat(yesterday);
        const todayfloat =convertStringToFloat(today);
        percentageDifference = ((today * 100) / yesterfloat) - 100;
        return percentageDifference;
    }
    var currency = "KES";
    callSalesDB = function (){
        $.get("SalesDashboard/Todays_Revenue_Orders_Value.php", function (data) {
            data = $.parseJSON(data);
            console.log(data);
            for (i = 0; i < data.length; i++) {


                // Update the title and inner value
                $('#todaysales').attr('title', '$' + data[i]["todays_sales"]);//.toFixed(2)); // Update title
                $('#todaysales').text('$' + data[i]["todays_sales"]);//.toFixed(2)); // Update inner value
                // Update the +15% vs yesterday
                let salesdiff = computePercentages(data[i]["yesterday_sales"],data[i]["todays_sales"]);
                // Check if sales difference is positive or negative
                var salesText = (salesdiff >= 0) ? '+' + salesdiff.toFixed(2) : salesdiff.toFixed(2);

                // Update the text
                $('.db__counter-label-sales strong').text(`${salesText}%`);// Update the percentage

                // Update the title and inner value
                $('#todayorders').attr('title', data[i]["todaysorders"]);//.toFixed(2)); // Update title
                $('#todayorders').text(data[i]["todaysorders"]);//.toFixed(2)); // Update inner value
                // Update the +15% vs yesterday
                salesdiff = computePercentages(data[i]["yesterdayorders"],data[i]["todaysorders"]);
                // Check if sales difference is positive or negative
                var ordersText = (salesdiff >= 0) ? '+' + salesdiff.toFixed(2) : salesdiff.toFixed(2);

                // Update the text
                $('.db__counter-label-orders strong').text(`${ordersText}%`);// Update the percentage


                // Update the title and inner value
                $('#averagesales').attr('title', '$' + data[i]["averageorderamt"]);//.toFixed(2)); // Update title
                $('#averagesales').text('$' + data[i]["averageorderamt"]);//.toFixed(2)); // Update inner value
                // Update the +15% vs yesterday
                salesdiff = computePercentages(data[i]["avgorderamt_yesterday"],data[i]["averageorderamt"]);
                // Check if sales difference is positive or negative
                var avgsText = (salesdiff >= 0) ? '+' + salesdiff.toFixed(2) : salesdiff.toFixed(2);

                // Update the text
                $('.db__counter-label-avg strong').text(`${avgsText}%`);// Update the percentage




            }

        });

    }

    callCategoriesDB = function (){
        $.get("SalesDashboard/Top_Selling_Categories.php", function (data) {
            data = $.parseJSON(data);
            console.log(data);
            // Sort the data array based on DAILY_ORDERS in descending order
            data.sort(function(a, b) {
                return parseFloat(b.DAILY_ORDERS) - parseFloat(a.DAILY_ORDERS);
            });
            console.log(data);
            for (i = 0; i < data.length; i++) {

                if (i == 0){
                    document.querySelector("span[id='biggest'] strong[class='db__bubble-value']").innerText=`${data[i]["DAILY_ORDERS"]}`;
                    document.querySelector("#category-1").innerHTML = `${data[i]["planType"]} pkg`;

                }
                else if (i == 1){
                    document.querySelector("span[id='bigger'] strong[class='db__bubble-value']").innerText=`${data[i]["DAILY_ORDERS"]}`;
                    document.querySelector("#category-2").innerHTML = `${data[i]["planType"]} pkg`;

                }
                else if (i == 2){
                    document.querySelector("span[id='big'] strong[class='db__bubble-value']").innerText=`${data[i]["DAILY_ORDERS"]}`;
                    document.querySelector("#category-3").innerHTML = `${data[i]["planType"]} pkg`;
                }
            }

        });

    }

    // Define a variable to keep track of the number of polls
    var pollCountSales = 0;

    // Define a function to load dashboard categories
    function load_sales_dash() {
        // Check if the poll count has reached 15
        if (pollCountSales >= 15) {
            console.log("Max Polling of 15 times reached UPdate UI by displaying a refresh button.")
            return;
        }

    if (pollCountSales <= 1)
    {
        console.info("Loading Database Information Before Introducing polling........");
        callSalesDB();
    }

        // Increment the poll count
        pollCountSales++;

        // Call a function to generate a random sleep time
        var randomSleepTime = getRandomSleepTime();
        console.info("Browser will sleep for "+ randomSleepTime/1000 + " Seconds");

        // Use setTimeout to introduce a random sleep time before each poll
        setTimeout(function() {
            // Place your database polling code here
            // For now, I'll just log a message
            console.log("Polling database...");

            callSalesDB();

            // Call the function recursively after the sleep time
            load_sales_dash();
        }, randomSleepTime);
    }

    // Function to generate a random sleep time between 1 and 10 seconds
    function getRandomSleepTime() {
        return Math.floor(Math.random() * 10000) + 1000; // Random number between 1000 and 10000 milliseconds (1 to 10 seconds)
    }

    // Call the load_dash_categories function to start polling
    // load_dash_categories();
    // ------------------------------Start Handles Billing Categories --------------------------
    var pollCountCategories = 0;

    // Define a function to load dashboard categories
    function load_categories_dash() {
        // Check if the poll count has reached 15
        if (pollCountCategories >= 15) {
            console.log("Max Polling of 15 times reached UPdate UI by displaying a refresh button.")
            return;
        }

        if (pollCountCategories <= 1)
        {
            console.info("Loading Database Information Before Introducing polling........");
            callCategoriesDB();
        }

        // Increment the poll count
        pollCountCategories++;

        // Call a function to generate a random sleep time
        var randomSleepTime = getRandomSleepTime();
        console.info("Browser will sleep for "+ randomSleepTime/1000 + " Seconds");

        // Use setTimeout to introduce a random sleep time before each poll
        setTimeout(function() {
            // Place your database polling code here
            // For now, I'll just log a message
            console.log("Polling database...");

            callCategoriesDB();

            // Call the function recursively after the sleep time
            load_categories_dash();
        }, randomSleepTime);
    }

    // ------------------------------END Handles Billing Categories --------------------------

    $(document).ready(function () {
        load_sales_dash();
        load_categories_dash();
    });


</script>


</body>
</html>

<!-- Your page content here -->