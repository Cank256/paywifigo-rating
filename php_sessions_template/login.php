<?php
include_once __DIR__ .'/libs/csrf/csrfprotector.php';

// Initialise CSRFProtector library
try {
    csrfProtector::init();
} catch (configFileNotFoundException $e) {
}

    if(!isset($_SESSION))
    {
        session_start();
    }

if (isset($_SESSION['user_data'])) {
    header('Location: page1.php');
    exit();
}
if (isset($_SESSION['referer']))
{
    $orig_url = $_SESSION['referer'];
    echo "Orig_url: $orig_url <br>";
}

?>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // Imports database Contants
        require_once 'moviefi.conf.php';

// Create connection
        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Data submitted via the form
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Use prepared statement to prevent SQL injection
        $sql = "SELECT hotspot_owner_id, username, password FROM Hotspot_Owners_Administrators WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['hotspot_owner_id'] = $row['hotspot_owner_id'];
                $_SESSION['username'] = $row['username'];
                $data = array(
                    'username' => $username,
                    'hotspot_owner_id' => $_SESSION['hotspot_owner_id']
                );
                // Save the updated data in the session.
                $_SESSION['user_data'] = $data;


                // After a successful login, check if there is a referer in the session.
                if (isset($_SESSION['referer'])) {
                    $referer = $_SESSION['referer'];
                    // Clear the referer from the session, so it's not used again.
                    unset($_SESSION['referer']);

                    // Redirect the user back to the referring page.
                    header("Location: $referer");
                    exit();
                } else {
                    // If there's no referer in the session, redirect to a default page.
                    header('Location: page1.php');
                    exit();
                }
                exit();
            } else {
                echo "Invalid password. <a href='login.html'>Try again</a>";
            }
        } else {
            echo "User not found. <a href='register.html'>Register</a>";
        }

// Close connection
        $stmt->close();
        $conn->close();



    }
    ?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <!--  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css'>-->
    <link rel='stylesheet' href='assets/lcss/bootstrap.min.css'>
    <!--<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>-->
    <link rel='stylesheet' href='assets/lcss/all.min.css'>
    <!--<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css'>-->
    <link rel='stylesheet' href='assets/lcss/animate.min.css'>
    <link rel="stylesheet" href="login_style.css">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">-->
    <link rel="stylesheet" href="assets/lcss/normalize.min.css">
    <!--    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.0/build/css/intlTelInput.css'>-->
    <link rel='stylesheet' href='assets/lcss/intlTelInput.css'>
</head>
<body>
<h2>User Login</h2>
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-5">

            <!-- Login-->
            <div class="card shadow animated zoomIn slow p-5">
                <h3 class="text-center font-weight-bold text-uppercase mb-3">Login Here</h3>

                <form action="login.php" method="post" autocomplete="off">
                    <!--          <form action="#" method="post">-->
                    <!--        <div class="form-group">-->
                    <!--          <label>Enter Username</label>-->
                    <!--          <input type="text" class="form-control">-->
                    <!--        </div>-->
                    <div class="form-group">
                        <label>Enter Contact</label>
                        <input autocomplete="off" class="form-control" type="tel" id="phone" value="" name="username" style="display:block;width:100%" required>
                        <!-- partial -->
                        <!--              <script src='https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.0/build/js/intlTelInput.js'>-->
                        <script src='assets/intlTelInput.js'>

                        </script><script  src="script.js"></script>

                        <!--              <label>Enter Username</label>-->
                        <!--          <input type="text" class="form-control">-->
                    </div>
                    <div class="form-group">
                        <label>Enter Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <input type="hidden" name="submit" value="1">
                    <button onclick="document.getElementById('phone').value=window.iti.getNumber();"
                            type="submit" class="btn btn-outline-dark btn-block rounded-pill">Login</button>
                </form>
                <h6 class="mt-3">Don't have an account ? <a href="register.php"> Create Account Here</a></h6>
                <h6 class="mt-3">Recover your account ? <a href="recover_account.html"> Forgot Password Click Here</a></h6>
                <!--        <p class="text-center mt-3"> or Login with<p>-->
                <!--        <div class="text-center">-->
                <!--          <i class="fab fa-facebook mx-2 fa-2x"></i>-->
                <!--          <i class="fab fa-twitter  mx-2 fa-2x"></i>-->
                <!--          <i class="fab fa-instagram  mx-2 fa-2x"></i>-->
                <!--          <i class="fab fa-google  mx-2 fa-2x"></i>-->
                <!--        </div>-->

            </div>
        </div>

    </div>
</div>
<!-- partial -->

</body>
</html>