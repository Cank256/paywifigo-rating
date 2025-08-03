<?php
/**
 * Configuration File that Stores all the global variables including database credentials and
 * relevant api keys
 *
 * For the Database Queries Maintain the Least Privilege policy in that actions are limited in access privileges
 * to do this create several database user accounts that will be responsible for carrying out specific tasks.
 * 1. adding items to the cart
 * 2. loading movie ui element (select * from movies);
 * 3. processing/resolving payments
 * 4. adding purchased movies to the purchased table so that it is available for download.
 * 5. A user responsible for only loading purchased movies with their relevant ftp url's for enduser download.
 *
 * todo: secure the generation auto_increment ids in columns to make use of uuid4 from 'get_uuid.php' instead of use of predictable sequence numbers 1,2,3...n
 */
// Define constants for database configuration
define('DB_SERVER', 'localhost');
//define('DB_SERVER', 'paywifigo.me');
//define('DB_SERVER', '127.0.0.1');
//define('DB_SERVER', '192.168.1.68');
 define('DB_USERNAME', 'root');
//define('DB_USERNAME', 'remote_user');
 define('DB_PASSWORD', 'cheserem');
//define('DB_PASSWORD', 'S@Xh89xwed');


// define('DB_USERNAME', 'cheserem');
//define('DB_PASSWORD', 'thisismylifeandhowiliveit');
//define('DB_PASSWORD', 'ilikechickenandcheese');

define('DB_NAME', 'radius_paywifigorating');
define('MOVIES_PER_PAGE', 4); // Defines the Number of Movies to be displayed per page


