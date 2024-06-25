<?php
include_once __DIR__ .'/libs/csrf/csrfprotector.php';

// Initialise CSRFProtector library
try {
    csrfProtector::init();
} catch (configFileNotFoundException $e) {
}
if(!isset($_SESSION)) { session_start(); }

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
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>CodePen - Sales Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&amp;display=swap'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./style.css">
    <link href="priceupdate/style.css" rel="stylesheet">

</head>
<body>
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
        <h1 class="db__heading">Product Performance Management</h1>
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
        <h2 class="db__subheading" title="is the rate at which customers stop doing business with an entity">Sales Churn Rate in Last 7 Months</h2>
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
                <time datetime="2022-05-01">5/1</time>
            </div>
            <div class="db__bars-cell">
                <time datetime="2022-05-02">5/2</time>
            </div>
            <div class="db__bars-cell">
                <time datetime="2022-05-03">5/3</time>
            </div>
            <div class="db__bars-cell">
                <time datetime="2022-05-04">5/4</time>
            </div>
            <div class="db__bars-cell">
                <time datetime="2022-05-05">5/5</time>
            </div>
            <div class="db__bars-cell">
                <time datetime="2022-05-06">5/6</time>
            </div>
            <div class="db__bars-cell">
                <time datetime="2022-05-07">5/7</time>
            </div>
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
        <h2 class="db__subheading">Product Performance May,2024</h2>

        <div class="db__bubbles">
            <div class="db__bubble">
				<span class="db__bubble-text">
					Gross<br><strong class="db__bubble-value">$4,183</strong><br>per month
				</span>
            </div>
            <div class="db__bubble">
				<span class="db__bubble-text">
					Expenses<br><strong class="db__bubble-value">$2,215</strong><br>per month
				</span>
            </div>
            <div class="db__bubble">
				<span class="db__bubble-text">
					Net Income<br><strong class="db__bubble-value">$1,012</strong><br>per month
				</span>
            </div>
        </div>

    </div>
    <div class="db__cell">
        <h2 class="db__subheading">Modify Product Pricing</h2>
        <main class="update__price">
    <ul class="lists">
<?php
global $configValues;
require_once 'WifiProfiles/configs.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($configValues['CONFIG_DB_HOST'], $configValues['CONFIG_DB_USER'], $configValues['CONFIG_DB_PASS'], $configValues['CONFIG_DB_NAME']);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$sql = "SELECT planName as name, creationdate as datetime, planCost as price, planCurrency as currency, bp_id as id   
    FROM 
    billing_plans
";
$results = $mysqli->query($sql);

foreach ($results as $result) 
{
    $created_at = date_format(date_create($result["datetime"]), "M j \a\\t h:ia");
    $id = str_replace(" ", "_", $result["name"]);
    echo <<<HTML
         <li class="list-item" data-id=$id id=$id data-id_num={$result["id"]}>
          <section class="list-item__inner">
            <div>
              <svg
                class="img edit-icon"
                viewBox="0 0 512 512"
                xmlns="http://www.w3.org/2000/svg"
              >
                <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                />
              </svg>
              <div class="list-item-desc">
                <div class="center">
                  <h2>{$result["name"]}</h2>
                  <time datetime=$created_at>$created_at</time>
                </div>
              </div>
            </div>

            <aside>
              <h2 class="price__value">
                <span class="veeam-price">{$result["currency"]}</span>
                <span class="currency_price"> {$result["price"]} </span>
              </h2>
            </aside>
          </section>
          <section class="hidden_section hidden">
            <form method="UPDATE">
                <div>
                    <button class="save save__price" type="submit">Save</button>
                    <button class="cancel cancel__price">Cancel</button> 
                </div>
              <div>
                <div
                  id="curr_product"
                  style="text-align: center; vertical-align: middle"
                >
                    {$result["name"]}
                </div>
                <div class="veeam-license-wrap">
                  <div class="col border-right">
                    <h3>Update Price Tag</h3>
                    <div class="quantity">
                      <input
                        class="quantity-input"
                        max={$result["price"]}
                        min="0"
                        step="1"
                        type="number"
                        value={$result["price"]}
                      />
                    <div class="quantity-nav">
                    <div class="quantity-button quantity-up">
                    <i class="fa fa-plus"></i>
                </div>
                         <div class="quantity-button quantity-down">
                         <i class="fa fa-minus"></i>
                         </div>
                         </div>
                            </div>
                    <div class="veeam-footnote hidden">* price should be less than {$result["price"]} and greater than 0.</div>
                  </div>
                  <div class="col">
                    <div class="veeam-total" data-price={$result["price"]}>
                      <h3>New Total:</h3>
                      <div>
                        <span class="veeam-price">{$result["currency"]}</span>
                        <span class="price__cont"> {$result["price"]} </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </section>
        </li> 
HTML;
} 
?>
      </ul>
    </main> 
</main>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script type="text/javascript" src="./static/scripts/update-price.js" />
</body>
</html>
