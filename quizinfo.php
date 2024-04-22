<?php

include 'connect.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $num_ques = $_POST["num-questions"];
    $category = $_POST["category"];
    $difficulty = $_POST["difficulty"];
    $time = $_POST["time"];
    $username = $_SESSION['username'];
    $result = 0;

    if (empty($username) || empty($category) || empty($difficulty) || empty($num_ques)) {
        echo '<script>alert("Please Enter the Details!");</script>';
        echo '<script>window.location.href = "project1.html";</script>';
        exit(); // Stop further execution
    }

    $query = "INSERT INTO Quiz(username, questions, category, difficulty, timepq, result) VALUES(?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ssssss", $username, $num_ques, $category, $difficulty, $time, $result);
    $stmt->execute();
    
    if ($stmt->affected_rows == 1) {
        // Registration successful
        echo '<script>alert("Quiz Created");</script>';
        $_SESSION['success'] = true; 
        echo '<script>window.location.href = "project1.php";</script>';
        exit(); // Stop further execution
    } else {
        // Registration failed
        echo '<script>alert("Registration failed due to some errors. Please try again later.");</script>';
        echo '<script>window.location.href = "project1.html";</script>';
        exit(); // Stop further execution
    }
}

?>
