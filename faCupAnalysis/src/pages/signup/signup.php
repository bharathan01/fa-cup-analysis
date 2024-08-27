<?php
require "../../controllers/signin.controller.php";
require '../../utils/connectDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $error = validate_signup_data($username, $email, $password);

    if (empty($error)) {
        try {
            $result = insert_user($conn, $username, $email, $password);
            if ($result == true) {
                header('location:../login/login.php');
            } else {
                $error['faildToSingup'] = 'Failed to sing up!';
            }
        } catch (mysqli_sql_exception $e) {
            // Handle the specific MySQLi exception (e.g., duplicate entry)
            $error['database'] = 'A user with username or email already exists!';
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <div class="background-image"></div>
    <div class="signup-container">
        <div class="signup-box">
            <h2>Sign Up</h2>
            <span style="color:red;"><?php echo isset($error['faildToSingup']) ? $error['faildToSingup'] : '' ?></span>
            <span style="color:red;"><?php echo isset($error['database']) ? $error['database'] : '' ?></span>
            <form method="POST" action="">
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">
                    <P style="color:red;"><?php echo (isset($error['username'])) ? $error['username'] : '' ?></P>
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                    <P style="color:red;"><?php echo (isset($error['email'])) ? $error['email'] : '' ?></P>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                    <P style="color:red;"><?php echo (isset($error['password'])) ? $error['password'] : '' ?></P>
                </div>
                <button type="submit">Sign Up</button>
            </form>
            <p>Already have an account? <a href="../../../index.php">Login</a></p>
        </div>
    </div>
</body>

</html>