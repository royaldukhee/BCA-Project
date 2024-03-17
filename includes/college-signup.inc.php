<?php
file_get_contents("php://input");
(isset($_POST['collegename']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['country'])&& isset($_POST['state'])&& isset($_POST['city']));
    $collegename = $_POST['collegename'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];


    // var_dump($collegename, $email, $password, $country);
    require_once '../includes/dbconnect.inc.php';
    $stmt = $conn->prepare("SELECT email FROM colleges WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
        echo "User Already Exists";
        $stmt->close();
        $conn->close();
        exit();
    } else {
        $passhash = password_hash($password, PASSWORD_DEFAULT);
        $insstmt =$conn->prepare("INSERT INTO colleges (collegename, email, password, country,state,city) VALUES (?,?, ?, ?,?,?)");
        $insstmt->bind_param("ssssss",$collegename, $email, $passhash, $country,$state,$city);
        $insstmt->execute();
        if ($insstmt->affected_rows > 0) {
            echo "success";
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
