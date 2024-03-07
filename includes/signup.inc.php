<?php
require('../includes/dbconnect.inc.php');
file_get_contents("php://input");
isset($_POST['key']);
$key = ($_POST);
if ($key == 1) {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        require 'dbconnect.inc.php';

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Use prepared statement to check if username already exists
        $stmt = $conn->prepare("SELECT username FROM students WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt->close();
            $conn->close();
            echo "User Already Exists";
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email not valid";
        } else {
            $stmt->close();

            $passhash = password_hash($password, PASSWORD_DEFAULT);

            // Use prepared statement to insert user data
            $stmt = $conn->prepare("INSERT INTO students (username, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $passhash, $email,);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $stmt->close();
                $conn->close();
                echo ("success");
                exit();
            } else {
                $stmt->close();
                $conn->close();
                echo "Not Success";
                exit();
            }
        }
    }
}
else{
    echo "not success"
}
