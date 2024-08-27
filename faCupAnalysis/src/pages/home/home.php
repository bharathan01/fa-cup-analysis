<?php
session_start();
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header('Location: ../Task-2/src/pages/login/login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../pages/home/home.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php require '../../components/header/header.php'; ?>
    <div class="background-image">
        <div class="intro-container">
            <h1>Welcome to the FA Cup Insights Hub.</h1>
            <p>Dive deep into the rich history of the FA Cup with comprehensive reports, in-depth match analytics, and seamless team management tools. Whether you're a passionate fan or a data-driven strategist, this platform offers everything you need to explore, analyze, and engage with the tournament like never before.</p>
        </div>
    </div>
</body>

</html>