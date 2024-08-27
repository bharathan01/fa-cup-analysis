<?php
require __DIR__ . '/../../controllers/createNewTeam.controller.php';
require __DIR__ . '/../../utils/connectDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $formData = $_POST;
    $fieldData = validateFormData($formData);
    if (empty($fieldData['errors'])) {
        $result =  insertTeamData($conn, $fieldData);
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../pages/createTeam/createTeam.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php require '../../components/header/header.php'; ?>
    <form action="" method="POST">
        <?php if (isset($isValidFields['errors'])) { ?>
            <p style="color: red;"><?php print_r($isValidFields['errors']) ?></p>
        <?php } ?>
        <div class="form-group">
            <label for="team">Team</label>
            <input type="text" id="team" name="team" required>
        </div>

        <div class="form-group">
            <label for="manager">Manager</label>
            <input type="text" id="manager" name="manager" required>
        </div>

        <div class="form-group">
            <label for="played">Played</label>
            <input type="number" id="played" name="played" min="0" required>
        </div>

        <div class="form-group">
            <label for="won">Won</label>
            <input type="number" id="won" name="won" min="0" required>
        </div>

        <div class="form-group">
            <label for="drawn">Drawn</label>
            <input type="number" id="drawn" name="drawn" min="0" required>
        </div>

        <div class="form-group">
            <label for="lost">Lost</label>
            <input type="number" id="lost" name="lost" min="0" required>
        </div>

        <div class="form-group">
            <label for="gf">Goals For (GF)</label>
            <input type="number" id="gf" name="gf" min="0" required>
        </div>

        <div class="form-group">
            <label for="ga">Goals Against (GA)</label>
            <input type="number" id="ga" name="ga" min="0" required>
        </div>

        <div class="form-group">
            <label for="gd">Goal Difference (GD)</label>
            <input type="number" id="gd" name="gd" required>
        </div>

        <div class="form-group">
            <label for="points">Points</label>
            <input type="number" id="points" name="points" min="0" required>
        </div>

        <div class="form-group">
            <label for="form">Form</label>
            <input type="text" id="form" name="form" placeholder="e.g., WWLDD" required>
        </div>

        <button type="submit" class="submit-btn">Submit</button>
    </form>
</body>

</html>