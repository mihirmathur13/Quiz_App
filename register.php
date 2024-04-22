<?php

include 'connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $contact = $_POST["contact"];

    if (empty($username) || empty($password) || empty($name) || empty($email)) {
        echo '<script>alert("Please Enter the Details!");</script>';
        echo '<script>window.location.href = "loginog.html";</script>';
        exit(); // Stop further execution
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Store $hashed_password in the database
    // echo '<script>console.log(' . $hashed_password . ')</script>';
    $query = "INSERT INTO userlogin(name, username, emailid, password, contact_number) VALUES(?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sssss", $name, $username, $email, $hashed_password, $contact);
    $stmt->execute();
    
    if ($stmt->affected_rows == 1) {
        // Registration successful
        echo '<script>alert("User Registered");</script>';
        echo '<script>window.location.href = "loginog.html";</script>';
        exit(); // Stop further execution
    } else {
        // Registration failed
        echo '<script>alert("Registration failed due to some errors. Please try again later.");</script>';
        echo '<script>window.location.href = "loginog.html";</script>';
        exit(); // Stop further execution
    }
}

?>