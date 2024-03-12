<?php
require('../includes/dbconnect.inc.php');
file_get_contents("php://input");
if(isset($_POST['key'])){
    $key=$_POST['key'];
}
isset($_POST['username']) && isset($_POST['password']);
$username = $_POST['username'];
$password = $_POST['password'];
if($key=='1'){
    $stmt = $conn->prepare("SELECT * FROM students WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $resultdata = mysqli_fetch_assoc($result);
    if ($result->num_rows == 0) {
        echo "user not found";
        exit();
    } elseif (password_verify($password, $resultdata['password']) == true) {
        $_SESSION['ID']=$resultdata['studentID'];
        echo "success";
        exit();
    } else {
        echo "password doesn't match";
        exit();
    }
}
elseif($key=='2'){
    $stmt = $conn->prepare("SELECT * FROM colleges WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $resultdata = mysqli_fetch_assoc($result);
    if ($result->num_rows == 0) {
        echo "user not found";
        exit();
    } elseif (password_verify($password, $resultdata['password']) == true) {
        $_SESSION['ID']=$resultdata['collegeID'];        
        echo "success";
        exit();
    } else {
        echo "password doesn't match";
        exit();
    }
}
else{
    echo "error";
    exit();
}










// if (isset($_POST['username']) && isset($_POST['password'])) {
//     $usernae = $_POST['username'];
//     $password = $_POST['password'];

//     // $hashpwd=password_hash($password,'DEFAULT')

//         $stmt = $conn->prepare("SELECT * FROM students WHERE username = ?");
//         $stmt->bind_param("s", $username);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         $resuldata = mysqli_fetch_assoc($result);
//         if ($result->num_rows == 0) {
//             echo "user not found";
//             die(mysqli_error($conn));
//             exit();
//         } elseif (password_verify($password, $resuldata['password']) == true) {
//             echo "success";
//             exit();
//         } else {
//             echo "password doesn't match";
//             exit();
//         }
//     } elseif ($key == 2) {
//         echo "password desnot match";
//         exit();
//     } else {
//     }
