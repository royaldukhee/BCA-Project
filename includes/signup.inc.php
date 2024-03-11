<?php
$postdata = json_decode(file_get_contents("php://input"), true);

if (isset($postdata['username']) && isset($postdata['email']) && isset($postdata['password'])) {
    $username = $postdata['username'];
    $email = $postdata['email'];
    $country = $postdata['country'];
    $password = $postdata['password'];
    require_once '../includes/dbconnect.inc.php';

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