<?php
require_once __DIR__ . '/../../utils/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../components/header/header.css">

</head>

<body>
  <nav>
    <a href=<?php echo BASE_URL . "home/home.php" ?>>FA CUP </a>
    <ul class="list">
      <li><a href="../../pages/dashboard/dashboard.php">Dashboard</a></li>
      <li><a href="../../pages/createTeam/createTeam.php">Team Entry Form</a></li>
      <li><a href=<?php echo BASE_URL . "logout/logout.php" ?>>logout</a></li>
    </ul>
  </nav>
</body>

</html>