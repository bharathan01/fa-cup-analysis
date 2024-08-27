<?php
// functions.php

function validate_signup_data($username, $email, $password)
{
    $errors = [];

    // Validate username
    if (empty($username)) {
        $errors['username'] = "Username is required.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate password
    if (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters long.";
    }

    return $errors;
}

function insert_user($conn, $username, $email, $password)
{
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO userschema (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        return true;
    } else {
        return $stmt->error;
    }

    $stmt->close();
}
