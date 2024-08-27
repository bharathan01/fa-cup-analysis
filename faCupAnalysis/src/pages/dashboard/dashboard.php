<?php

use function PHPSTORM_META\type;

require __DIR__ . '/../../controllers/dashboard.controller.php';
require __DIR__ . '/../../utils/connectDB.php';
//section start - for get the logged in user details
session_start();

if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header('Location: ../Task-2/src/pages/login/login.php');
    exit();
}
// calling the function to declared on the controller
$teamData = fetchTeamDataFromDb($conn);

//sorting the data base on the point
if ($teamData) {

    foreach ($teamData as $key => $value) {
        $teamData[$key]['points'] = $value['won'] * 3 + $value['drawn'];
    }
    $pointsArray = array_column($teamData, 'points');
    array_multisort($pointsArray, SORT_DESC, $teamData);

    foreach ($teamData as $index => $value) {
        $teamData[$index]['Position'] = (string)($index + 1);
    }
}

//delete team info
if (isset($_POST['team'])) {
    $team = $_POST['team'];
    $isTeamDeleted = deleteTeam($conn, $team);
    if ($isTeamDeleted) {
        header("Refresh:0");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../pages/dashboard/dashboard.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php require '../../components/header/header.php'; ?>
    <section>
        <form class="form-table" action="../../pages/report/report.php" method="POST">
            <div class="report">
                <!-- Report related content -->
            </div>
            <div class="league-table">
                <table>
                    <thead id="topteam-table-head">
                        <tr>
                            <th class="td-tr-style table-th">Select</th>
                            <th class="td-tr-style table-th">Team</th>
                            <th class="td-tr-style table-th">Manager</th>
                            <th class="td-tr-style table-th">Played</th>
                            <th class="td-tr-style table-th">Won</th>
                            <th class="td-tr-style table-th">Drawn</th>
                            <th class="td-tr-style table-th">Lost</th>
                            <th class="td-tr-style table-th">GF</th>
                            <th class="td-tr-style table-th">GA</th>
                            <th class="td-tr-style table-th">GD</th>
                            <th class="td-tr-style table-th">Points</th>
                            <th class="td-tr-style table-th">Form</th>
                            <th class="td-tr-style table-th">Option</th>
                        </tr>
                    </thead>
                    <tbody id="topteam-table-body">
                        <?php
                        if ($teamData) {
                            foreach ($teamData as $team) { ?>
                                <tr class="td-tr-style">
                                    <td class="select-box"><input type="checkbox" id="check-box" name="selected_teams[]" value="<?= htmlspecialchars($team['team']) ?>"></td>
                                    <td><?= $team['team'] ?></td>
                                    <td><?= $team['manager'] ?></td>
                                    <td><?= $team['played'] ?></td>
                                    <td><?= $team['won'] ?></td>
                                    <td><?= $team['drawn'] ?></td>
                                    <td><?= $team['lost'] ?></td>
                                    <td><?= $team['gf'] ?></td>
                                    <td><?= $team['ga'] ?></td>
                                    <td><?= $team['gd'] ?></td>
                                    <td><?= $team['points'] ?></td>
                                    <td class="form-td">
                                        <?php
                                        $form = explode(',', $team['form']);
                                        foreach ($form as $f) { ?>
                                            <?php if ($f == 'W') { ?>
                                                <img src="https://i.postimg.cc/MT10jpdB/win-icon.png" alt="Win">
                                            <?php } elseif ($f == 'L') { ?>
                                                <img src="https://i.postimg.cc/GpyGZp0f/loss-icon.png" alt="Loss">
                                            <?php } else { ?>
                                                <img src="https://i.postimg.cc/KcrrG4KS/draw-icon.png" alt="Draw">
                                        <?php }
                                        } ?>
                                    </td>
                                    <td class="option-btn">
                                        <a href="../../pages/updateteam/updateTeam.php?team=<?= urlencode($team['team']) ?>">
                                            <span class="option update-btn">Update</span>
                                        </a>
                                        <a>
                                            <span class="option delete-btn" onclick="deleteTeam('<?= htmlspecialchars($team['team']) ?>')">Delete</span>
                                        </a>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </section>

    <script>
        // deleting the team using ajax
        function deleteTeam(teamName) {
            if (confirm('Are you sure you want to delete this team?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                alert(teamName ,'deleted successfully');
                location.reload(); 
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        
                        if (response.status === 'success') {
                        } else {
                            alert(response.message);
                        }
                    }
                };

                xhr.send('team=' + encodeURIComponent(teamName));
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            const checkBox = document.getElementById('check-box');
            const report = document.querySelector(".report");

            checkBox.addEventListener('change', () => {
                // Clear any existing buttons
                report.innerHTML = '';

                // Check if the checkbox is checked
                if (checkBox.checked) {
                    const button = document.createElement('button');
                    button.type = 'submit';
                    button.textContent = 'Generate Report';
                    button.className = 'report-button';
                    report.appendChild(button);
                }
            });
        });
    </script>
</body>

</html>