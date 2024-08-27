
<?php
session_start();
function validate_input_field($username, $password)
{
    $error = [];

    if (empty($username)) {
        $error['username'] = 'username is required';
    }
    if (empty($password)) {
        $error['password'] = 'password is required';
    }


    return $error;
}


function logInUser($conn, $username, $password)
{
    // Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("SELECT username FROM userschema WHERE username = ? AND password = ?");

    if ($stmt === false) {
        // Handle prepare error
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind parameters: "ss" indicates that both parameters are strings
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        // Store the result
        $result = $result->fetch_assoc();
        // Check if there is a matching row
        if ($result) {
            $_SESSION['username'] = $result['username'];
            $stmt->close();
            return true;
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


?>