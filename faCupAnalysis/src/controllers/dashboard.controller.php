<?php
//fetch team data from MySql Database
function fetchTeamDataFromDb($conn)
{
    $stmt = $conn->prepare("SELECT * FROM fa_cup_teams;");
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        // Store the result

        // Check if there is a matching row
        if ($result) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $rows;
        } else {
            $stmt->close();
            return false;
        }
    } else {
        // Handle execution error
        $stmt->close();
        return false;
    }
}

function deleteTeam($conn, $team)
{
    $stmt = $conn->prepare("DELETE FROM fa_cup_teams WHERE team = ?");
    $stmt->bind_param("s", $team);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
