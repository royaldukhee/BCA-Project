<?php
file_get_contents("php://input");
(isset($_POST['collegename']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['country']));
    $collegename = $_POST['collegename'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $country = $_POST['country'];
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
        $insstmt =$conn->prepare("INSERT INTO colleges (collegename, email, password, country) VALUES (?,?, ?, ?)");
        $insstmt->bind_param("ssss",$country, $email, $passhash, $country);
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
