<?php
require_once '../includes/dbconnect.inc.php'; 

$rawdata = file_get_contents("php://input");
$data = json_decode($rawdata, true); // Decoding as associative array

// Accessing IELTS and PTE using array key access
$ielts = $data['IELTS'];
$pte = $data['PTE'];

$query=$conn->prepare("select * from  english_requirements natural join academic_requirements where collegeID = ?;");
$query->bind_param("i",$data['collegeID']);
$result= $query->execute();
if($result > 0){
    echo "Data already exists please preoceed for update requirement";
    exit();
}
try {
    $conn->begin_transaction();

    //   IELTS data
    $query = $conn->prepare("INSERT INTO english_requirements (test_type, listening, reading, writing, speaking, overall, collegeID) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("siiiiii", $test_type, $ielts['listening'], $ielts['reading'], $ielts['writing'], $ielts['speaking'], $ielts['overall'], $data['collegeID']);
    $test_type = "IELTS"; // Set test type
    $query->execute();

    //   PTE data
    $query = $conn->prepare("INSERT INTO english_requirements (test_type, listening, reading, writing, speaking, overall, collegeID) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("siiiiii", $test_type, $pte['listening'], $pte['reading'], $pte['writing'], $pte['speaking'], $pte['overall'], $data['collegeID']);
    $test_type = "PTE"; // Set test type
    $query->execute();

    //   academic requirements
    foreach ($data['academic'] as $key => $value) {
        $query = $conn->prepare("INSERT INTO academic_requirements (level, percentage, gpa, collegeID) VALUES (?, ?, ?, ?)");
        $query->bind_param("sssi", $value['level'], $value['percentage'], $value['gpa'], $data['collegeID']);
        $query->execute();
    }

    $conn->commit();
    echo "success";
} catch (Exception $e) {
    $conn->rollback();
    echo "failed, $e";
}
?>
