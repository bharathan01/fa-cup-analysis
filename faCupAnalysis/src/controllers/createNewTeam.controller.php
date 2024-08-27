

<?php

function validateFormData($data)
{
    $errors = [];

    // Trim and sanitize input data
    $team = trim($data['team']);
    $manager = trim($data['manager']);
    $played = filter_var($data['played'], FILTER_VALIDATE_INT);
    $won = filter_var($data['won'], FILTER_VALIDATE_INT);
    $drawn = filter_var($data['drawn'], FILTER_VALIDATE_INT);
    $lost = filter_var($data['lost'], FILTER_VALIDATE_INT);
    $gf = filter_var($data['gf'], FILTER_VALIDATE_INT);
    $ga = filter_var($data['ga'], FILTER_VALIDATE_INT);
    $gd = filter_var($data['gd'], FILTER_VALIDATE_INT);
    $points = filter_var($data['points'], FILTER_VALIDATE_INT);
    $form = trim($data['form']);

    // Validate required fields
    if (empty($team)) {
        $errors[] = "Team name is required.";
    }

    if (empty($manager)) {
        $errors[] = "Manager name is required.";
    }

    // Validate numeric fields
    if ($played === false || $played < 0) {
        $errors[] = "Played games must be a non-negative integer.";
    }
    if ($won === false || $won < 0) {
        $errors[] = "Won games must be a non-negative integer.";
    }
    if ($drawn === false || $drawn < 0) {
        $errors[] = "Drawn games must be a non-negative integer.";
    }
    if ($lost === false || $lost < 0) {
        $errors[] = "Lost games must be a non-negative integer.";
    }
    if ($gf === false || $gf < 0) {
        $errors[] = "Goals For (GF) must be a non-negative integer.";
    }
    if ($ga === false || $ga < 0) {
        $errors[] = "Goals Against (GA) must be a non-negative integer.";
    }
    if ($gd === false) {
        $errors[] = "Goal Difference (GD) must be an integer.";
    }
    if ($points === false || $points < 0) {
        $errors[] = "Points must be a non-negative integer.";
    }

    // Validate form pattern
    if (empty($form) || !preg_match('/^(W|D|L)(,(W|D|L))*$/', $form)) {
        $errors[] = "Form must contain only 'W', 'D', or 'L' characters, separated by commas.";
    }

    // Return errors if any, or return sanitized data
    if (!empty($errors)) {
        return ['errors' => $errors];
    }

    return [
        'team' => $team,
        'manager' => $manager,
        'played' => $played,
        'won' => $won,
        'drawn' => $drawn,
        'lost' => $lost,
        'gf' => $gf,
        'ga' => $ga,
        'gd' => $gd,
        'points' => $points,
        'form' => $form,
    ];
}
function insertTeamData($conn, $validatedData)
{
    $stmt = $conn->prepare("INSERT INTO fa_cup_teams (team, manager, played, won, drawn, lost, gf, ga, gd, points, form) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param(
        "ssiiiiiiiis",
        $validatedData['team'],
        $validatedData['manager'],
        $validatedData['played'],
        $validatedData['won'],
        $validatedData['drawn'],
        $validatedData['lost'],
        $validatedData['gf'],
        $validatedData['ga'],
        $validatedData['gd'],
        $validatedData['points'],
        $validatedData['form']
    );

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}
