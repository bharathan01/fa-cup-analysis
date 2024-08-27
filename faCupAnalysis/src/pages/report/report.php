<?php
require __DIR__ . '/../../controllers/report.controller.php';
require __DIR__ . '/../../utils/connectDB.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected_teams'])) {
        $selectedTeams = $_POST['selected_teams']; // Array of selected team names
        if (isset($_POST['selected_teams'])) {
            $selectedTeams = $_POST['selected_teams']; // Array of selected team names

            // Fetch data for the selected teams
            $teamsData = fetchSelectedTeamsData($conn, $selectedTeams);
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../pages/report/report.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php require '../../components/header/header.php'; ?>
    <div class="main-container">
        <div class="container">
        </div>
        <?php if (count($teamsData) > 1) { ?>
            <div class="container team-section ">
                <canvas id="combinedBarChart"></canvas>
            </div>
        <?php } ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../pages/report/report.js?v=<?php echo time(); ?>"></script>

    <script>
        // Passing the PHP data to JavaScript
        const teamsData = <?= json_encode($teamsData); ?>;
        displayChart(teamsData);
        displayCombinedBarChart(teamsData);
    </script>
</body>

</html>