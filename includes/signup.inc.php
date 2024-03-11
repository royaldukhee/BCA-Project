<?php
file_get_contents("php://input");

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    require_once '../includes/dbconnect.inc.php';
// var_dump($username);
// var_dump($email);
// var_dump($password);

    $query = "SELECT username FROM students WHERE username = '$username'";

    if ($result = $conn->query($query)) {
        if ($result->num_rows > 0) {
            echo "username already exists";
            exit();
        } else {
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            $query1 = "INSERT INTO students (username, email, password) VALUES ('$username', '$email', '$hashedpassword')";

            if ($conn->query($query1) === true) {
                echo "success";
                exit();
            } else {
                echo "error";
                exit();
            }
        }
    } else {
        echo "error";
        exit();
    }
} else {
    echo "error";
    exit();
}