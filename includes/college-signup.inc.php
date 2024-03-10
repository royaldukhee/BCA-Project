<?php
require('../includes/dbconnect.inc.php');
file_get_contents("php://input");
(isset($_POST['countryname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['country']));
    require 'dbconnect.inc.php';
    $collegename = $_POST['collegename'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $counrey = $_POST['country'];

    $stmt = $conn->prepare("SELECT email FROM colleges WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "User Already Exists";
        $stmt->close();
        $conn->close();
        exit();
    } else {
        $passhash = password_hash($password, PASSWORD_DEFAULT);
        $insstmt = $conn->prepare("INSERT INTO colleges (collegename, email, password, country) VALUES (?,?, ?, ?)");
        $insstmt->bind_param("ssss",$countryname, $email, $passhash, $country);
        $insstmt->execute();
        echo 'success';
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
