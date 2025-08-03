<?php
include_once __DIR__ . '/libs/csrf/csrfprotector.php';

// Initialise CSRFProtector library
try {
    csrfProtector::init();
} catch (configFileNotFoundException $e) {
}
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user_data'])) {
    $_SESSION['referer'] = "Sales-Product-Performance-Dashboard.php";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CodePen - Sales Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&amp;display=swap'>
    <link rel="stylesheet" href="./style.css">

    <script src="assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
    <script src="static/scripts/graph_revenue_expenses.js"></script>
    <script src="static/scripts/bar_revenue_expenses.js"></script>
</head>
<body>
<!-- partial:index.partial.html -->
<svg display="none">
    <symbol id="calendar" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="8,1 8,6"/>
            <polyline points="16,1 16,6"/>
            <polyline points="2,10 22,10"/>
            <circle cx="7" cy="14" r="1"/>
            <circle cx="12" cy="14" r="1"/>
            <circle cx="17" cy="14" r="1"/>
            <circle cx="7" cy="19" r="1"/>
            <circle cx="12" cy="19" r="1"/>
            <circle cx="17" cy="19" r="1"/>
            <rect x="2" y="3" rx="3" ry="3" width="20" height="20"/>
        </g>
    </symbol>
    <symbol id="export" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="8,5 12,1 16,5"/>
            <polyline points="12,1 12,16"/>
            <rect x="2" y="10" rx="3" ry="3" width="20" height="13"/>
        </g>
    </symbol>
    <symbol id="hat" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle r="8" cx="12" cy="14" stroke-dasharray="25.13 25.13" stroke-dashoffset="25.13"/>
            <polygon points="1,14 23,14"/>
        </g>
    </symbol>
    <symbol id="laptop" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="2" rx="3" ry="3" width="18" height="12"/>
            <polygon points="3,14 21,14 23,22 1,22"/>
        </g>
    </symbol>
    <symbol id="monitor" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="1" rx="3" ry="3" width="22" height="16"/>
            <polyline points="1,12 22,12"/>
            <polyline points="12,19 12,21"/>
            <polyline points="6,23 18,23"/>
        </g>
    </symbol>
    <symbol id="pants" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="4,1 20,1 20,23 12,23 12,8 12,8 12,23 4,23"/>
        </g>
    </symbol>
    <symbol id="shirt" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="8,3 12,6 16,3 23,6 21,11 18,10 20,21 4,21 6,10 3,11 1,6"/>
        </g>
    </symbol>
    <symbol id="smartphone" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="4" y="1" rx="3" ry="3" width="16" height="22"/>
            <polyline points="10,6 14,6"/>
            <circle cx="12" cy="18" r="1"/>
        </g>
    </symbol>
    <symbol id="tablet" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="1" rx="3" ry="3" width="20" height="22"/>
            <circle cx="12" cy="18" r="1"/>
        </g>
    </symbol>
</svg>
<main class="db">
    <div class="db__toolbar">
        <h1 class="db__heading">Product Sales Accounting Management</h1>
        <div class="db__toolbar-btns">
            <button class="db__select" type="button">
                <svg class="db__select-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#calendar"/>
                </svg>
                Date
            </button>
            <button class="db__select" type="button">
                <svg class="db__select-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#export"/>
                </svg>
                Export
            </button>
        </div>
    </div>
    <div class="db__cell">
        <h2 class="db__top-stat"><strong>82%</strong> Win/Lost Customer Revenue</h2>
        <div class="db__progress">
            <div class="db__progress-fill" style="transform:translateX(15%)"></div>
        </div>
        <div class="db__counter">
            <div class="db__counter-value" title="$3,330,050.90">$3.33M</div>
            <div class="db__counter-label">
                <strong>+15%</strong><br><small>vs last month</small>
            </div>
        </div>
    </div>
    <div class="db__cell">
        <h2 class="db__top-stat">88% Win/Lost Customer Opportunities</h2>
        <div class="db__progress">
            <div class="db__progress-fill" style="transform:translateX(20%)"></div>
        </div>
        <div class="db__counter">
            <div class="db__counter-value">7,410</div>
            <div class="db__counter-label">
                <strong>+20%</strong><br><small>vs last month</small>
            </div>
        </div>
    </div>
    <div class="db__cell">
        <h2 class="db__top-stat">Total Traffic This Month</h2>
        <div class="db__progress">
            <div class="db__progress-fill" style="transform:translateX(42%)"></div>
        </div>
        <div class="db__counter">
            <div class="db__counter-value">449K</div>
            <div class="db__counter-label">
                <strong>+42%</strong><br><small>vs last month</small>
            </div>
        </div>
    </div>
    <div class="db__cell">
        <h2 class="db__subheading" title="is the rate at which customers stop doing business with an entity">Revenue And
            Expenses</h2>
        <canvas id="revenueAndExpenses" width="500" height="200" arial-label="Graph of Revenue And Expense"
                role="img"></canvas>
    </div>
    </div>
    <div class="db__cell">
        <h2 class="db__subheading">Accounts Payable (Sales & Marketing)</h2>
        <table class="db__product-table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Orders</th>
                <th>Status</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
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
        <h2 class="db__subheading">Product Price Preview</h2>
        <div class="db__bubbles">
            <canvas id="barNetRevnueAndEx" width="500" height="200" arial-label="Barchart showing revenue expenses"
                    role="img"></canvas>
        </div>
    </div>
    <div class="db__cell">
        <h2 class="db__subheading">Modify Product Pricing</h2>
        <div class="db__order">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#smartphone"/>
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
        <div class="db__order">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#laptop"/>
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
        <div class="db__order">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#pants"/>
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
        <div class="db__order">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#shirt"/>
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
        <div class="db__order">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#monitor"/>
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
        <div class="db__order">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#tablet"/>
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
        <div class="db__order">
            <div class="db__order-cat">
                <svg class="db__order-cat-icon" width="24px" height="24px" aria-hidden="true">
                    <use xlink:href="#hat"/>
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

</body>
</html>
