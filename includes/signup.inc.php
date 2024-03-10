<?php
require('../includes/dbconnect.inc.php');
file_get_contents("php://input");
 (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']));
    require 'dbconnect.inc.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT username FROM students WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "User Already Exists";
        $stmt->close();
        $conn->close();
        exit();
    } else {
        $passhash = password_hash($password, PASSWORD_DEFAULT);
        $insstmt = $conn->prepare("INSERT INTO students (username, password, email) VALUES (?, ?, ?)");
        $insstmt->bind_param("sss", $username, $passhash, $email);
        $insstmt->execute();
        if ($insstmt->affected_rows > 0) {
            echo ("success");
            $insstmt->close();
            $conn->close();
            exit();
        } else {
            $insstmt->close();
            $conn->close();
            echo "Not Success";
            exit();
        }
    }
