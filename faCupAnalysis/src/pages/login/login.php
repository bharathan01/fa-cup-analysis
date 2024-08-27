<?php
require __DIR__ . '/../../controllers/login.controller.php';
require __DIR__ . '/../../utils/connectDB.php';
require_once __DIR__ . '/../../utils/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $error = validate_input_field($username, $password);


    if (empty($error)) {
        try {
            $result = logInUser($conn, $username, $password . '');
            if ($result == true) {
                header('Location: ' . BASE_URL . 'home/home.php');
            } else {
                $error['failed'] = 'Incorrect username or password !';
            }
        } catch (mysqli_sql_exception $e) {
            // Handle the specific MySQLi exception (e.g., duplicate entry)
            $error['database'] = 'An unexpected error occurred. Please try again later!';
        } catch (Exception $e) {
            // Handle other exceptions
            $error['general'] = 'An unexpected error occurred. Please try again later.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Task-2/src/pages/login/login.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <div class="background-image"></div> <!-- Background image container -->
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form method="post" action="">
                <span style="color:red;"><?php echo isset($error['failed']) ? $error['failed'] : '' ?></span>
                <span style="color:red;"><?php echo isset($error['database']) ? $error['database'] : '' ?></span>
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">
                    <P style="color:red;"><?php echo (isset($error['username'])) ? $error['username'] : '' ?></P>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                    <P style="color:red;"><?php echo (isset($error['password'])) ? $error['password'] : '' ?></P>
                </div>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="../Task-2/src/pages/signup/signup.php">Signup</a></p>
        </div>
    </div>
</body>

</html>