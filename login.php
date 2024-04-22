<?php

include 'connect.php'; 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Simple validation example (checking for empty fields)
    if (empty($username) || empty($password)) {
        echo '<script>alert("Please enter username and password")</script>';
        echo '<script>window.location.href = "loginog.html";</script>';
        exit(); // Stop further execution
    }

    // Prepare and execute the SQL query using prepared statements
    $query = "SELECT username, password FROM userlogin WHERE username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row with the given username exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session
            session_start();
            $_SESSION['username'] = $row['username'];

            echo '<script>alert("Login successful")</script>';
            echo '<script>window.location.href = "project1.html";</script>';
            exit(); // Stop further execution
        } else {
            // Invalid password
            echo '<script>alert("Invalid password")</script>';
            echo '<script>window.location.href = "loginog.html";</script>';
            exit(); // Stop further execution
        }
    } else {
        // No user found with the given username
        echo '<script>alert("Invalid username")</script>';
        echo '<script>window.location.href = "loginog.html";</script>';
        exit(); // Stop further execution
    }
}

// Close the database connection
$connection->close();
?>
