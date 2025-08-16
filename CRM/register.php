<?php
include_once __DIR__ .'/libs/csrf/csrfprotector.php';

// Initialise CSRFProtector library
csrfProtector::init();
if(!isset($_SESSION)) { session_start(); }


if ($_SERVER && isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

// Validate passwords
    if ($password !== $confirmPassword) {
        echo "Passwords do not match. Please try again.";
        echo "Error: Registration failed. Please try again. <a href='register.html'>Register</a>";
        // You can also redirect back to the registration form or handle it accordingly.
    } else {

// Imports database Contants
        require_once 'moviefi.conf.php';

// Create connection
        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


// Retrieve registration data
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO hotspot_owners_administrators (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            echo "Registration successful. <a href='login.php'>Login</a>";
            if (!isset($_SESSION['user_data'])) {
                header('Location: login.php');
                exit();
            }
        } else {
            echo "Error: Registration failed. Please try again. <a href='register.html'>Register</a>";
        }

// Close connection
        $stmt->close();
        $conn->close();
    }
}
else if($_SERVER["REQUEST_METHOD"] == "GET") {
    //parse the query string to retrieve the query parameters
    $currentQueryString = $_SERVER['QUERY_STRING'];
    parse_str($currentQueryString, $queryParams);

//    echo '<pre>';
//    var_dump($queryParams);
//    var_dump($queryParams['username']);
//    echo '</pre>';
    $username = $queryParams['username'] ?? null;

}


?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <!--    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css'>-->
    <link rel='stylesheet' href='assets/lcss/bootstrap.min.css'>
    <!--    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>-->
    <link rel='stylesheet' href='assets/lcss/all.min.css'>
    <!--    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css'>-->
    <link rel='stylesheet' href='assets/lcss/animate.min.css'>
    <link rel="stylesheet" href="login_style.css">
    <link rel='stylesheet' href='assets/lcss/intlTelInput.css'>

</head>
<body>
<h2>User Registration</h2>
<form action="register.php" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5">

                <!-- Registration-->
                <div class="card shadow p-5 animated zoomIn slow">
                    <h3 class="text-center font-weight-bold text-uppercase mb-3">SIGN UP</h3>

                    <form >
                        <!--                    <form action="register.php" method="post">-->
                        <div class="form-group">
                            <label>Enter Contact</label>

                            <input autocomplete="off" class="form-control" type="tel" id="phone" value="<?=isset($username) ? $username : ''?>" name="username" style="display:block;width:100%" required>
                            <!-- partial -->
                            <!--              <script src='https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.0/build/js/intlTelInput.js'>-->
                            <script src='assets/intlTelInput.js'>

                            </script><script  src="script.js"></script>

                            <!--              <label>Enter Username</label>-->
                            <!--          <input type="text" class="form-control">-->
                        </div>
                        <div class="form-group">
                            <label>Enter Password</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" id="password" name="password" required class="form-control">
                        </div>
                        <button onclick="if (validateForm()){document.getElementById('phone').value=window.iti.getNumber();}else {document.getElementById('password').value='';}" type="submit" class="btn btn-outline-dark btn-block rounded-pill">Register</button>
                        <h6 class="mt-3">Already have an account? <a href="login.php"> Log in Here</a></h6>
                    </form>
                    <script>
                        function validateForm() {
                            var password = document.getElementById("password").value;
                            var confirmPassword = document.getElementById("confirmPassword").value;

                            if (password !== confirmPassword) {
                                alert("Passwords do not match. Please try again.");
                                return false;
                            }

                            // Continue with the registration process if passwords match
                            return true;
                        }
                    </script>

                </div>
            </div>


        </div>
    </div>
    <!-- partial -->

</body>
</html>
