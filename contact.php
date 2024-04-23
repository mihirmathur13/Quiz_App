<?php

include 'connect.php';

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_SESSION['username'];
    $message = $_POST["message"];

    $query = "INSERT INTO feedback(name, username, emailid, message) VALUES(?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ssss", $name, $username, $email, $message);
    $stmt->execute();
    
    if ($stmt->affected_rows == 1) {
        // Registration successful
        echo '<script>alert("Feedback received!");</script>';
        echo '<script>window.location.href = "contact.html";</script>';
        exit(); // Stop further execution
    } else {
        // Registration failed
        echo '<script>alert("Registration failed due to some errors. Please try again later.");</script>';
        echo '<script>window.location.href = "contact.html";</script>';
        exit(); // Stop further execution
    }
}

?>