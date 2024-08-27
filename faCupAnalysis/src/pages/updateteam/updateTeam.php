<?php
require __DIR__ . '/../../controllers/updateTeam.controller.php';
require __DIR__ . '/../../utils/connectDB.php';
if (isset($_GET['team'])) {
    $teamName = $_GET['team'];
    $teamData =  getTeamInfo($conn, $teamName);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updatedTeamData = $_POST;
    $isValidFields = validateFormData($updatedTeamData);
    if (empty($isValidFields['errors'])) {
        $result = updateTeamData($conn, $teamName, $isValidFields);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../pages/updateteam/updateTeam.css">
</head>

<body>
    <?php require '../../components/header/header.php'; ?>
    <?php if (isset($teamData)) { ?>

        <?php
        if (isset($result)) { ?>
            <div class="container">
                <span style="color: green;">Team data updated successfully</span>
                <a href="../../pages/dashboard/dashboard.php">
                    <button>Go to dashboard</button>
                </a>
            </div>
        <?php } else { ?>
            <form action="" method="POST">
                <?php if (isset($isValidFields['errors'])) { ?>
                    <p style="color: red;"><?php print_r($isValidFields['errors']) ?></p>
                <?php } ?>
                <div class="form-group">
                    <label for="team">Team</label>
                    <input type="text" id="team" name="team" required value=<?= $teamData['team'] ?>>
                </div>

                <div class="form-group">
                    <label for="manager">Manager</label>
                    <input type="text" id="manager" name="manager" required value=<?= $teamData['manager'] ?>>
                </div>

                <div class="form-group">
                    <label for="played">Played</label>
                    <input type="number" id="played" name="played" min="0" required value=<?= $teamData['played'] ?>>
                </div>

                <div class="form-group">
                    <label for="won">Won</label>
                    <input type="number" id="won" name="won" min="0" required value=<?= $teamData['won'] ?>>
                </div>

                <div class="form-group">
                    <label for="drawn">Drawn</label>
                    <input type="number" id="drawn" name="drawn" min="0" required value=<?= $teamData['drawn'] ?>>
                </div>

                <div class="form-group">
                    <label for="lost">Lost</label>
                    <input type="number" id="lost" name="lost" min="0" required value=<?= $teamData['lost'] ?>>
                </div>

                <div class="form-group">
                    <label for="gf">Goals For (GF)</label>
                    <input type="number" id="gf" name="gf" min="0" required value=<?= $teamData['gf'] ?>>
                </div>

                <div class="form-group">
                    <label for="ga">Goals Against (GA)</label>
                    <input type="number" id="ga" name="ga" min="0" required value=<?= $teamData['ga'] ?>>
                </div>

                <div class="form-group">
                    <label for="gd">Goal Difference (GD)</label>
                    <input type="number" id="gd" name="gd" required value=<?= $teamData['gd'] ?>>
                </div>

                <div class="form-group">
                    <label for="points">Points</label>
                    <input type="number" id="points" name="points" min="0" required value=<?= $teamData['points'] ?>>
                </div>

                <div class="form-group">
                    <label for="form">Form</label>
                    <input type="text" id="form" name="form" placeholder="e.g., WWLDD" required value=<?php print_r($teamData['form']) ?>>
                </div>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        <?php } ?>

    <?php } ?>
</body>

</html>