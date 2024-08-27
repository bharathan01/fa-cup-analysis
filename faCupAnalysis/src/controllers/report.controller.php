<?php
function fetchSelectedTeamsData($conn, $selectedTeams) {
    // Prepare placeholders for each team in the SQL query
    $placeholders = implode(',', array_fill(0, count($selectedTeams), '?'));

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT * FROM fa_cup_teams WHERE team IN ($placeholders)");

    // Bind the selected teams as parameters to the query
    $stmt->bind_param(str_repeat('s', count($selectedTeams)), ...$selectedTeams);

    // Execute the query
    if ($stmt->execute()) {
        // Fetch all the results
        $result = $stmt->get_result();
        $teamsData = $result->fetch_all(MYSQLI_ASSOC);

        // Close the statement
        $stmt->close();

        // Return the fetched data
        return $teamsData;
    } else {
        // If the query fails, close the statement and return false
        $stmt->close();
        return false;
    }
}
?>
