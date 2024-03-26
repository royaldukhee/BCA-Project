<?php
$rawdata = file_get_contents("php://input", true);
$data = json_decode($rawdata, true);
// echo json_encode($data);
$collegeID=$data['collegeID'];
$courseID=$data['courseID'];

$return=[];
require_once '../includes/dbconnect.inc.php';
try{
$conn->begin_transaction();

// Query to select course details
$query = $conn->prepare("SELECT c.collegename, co.coursename, co.level, co.aboutcourse, co.duration, co.course_fee FROM colleges c JOIN courses co ON c.collegeID = co.collegeID WHERE co.courseId = ? AND c.collegeID = ?");
$query->bind_param("ii", $courseID, $collegeID);
$query->execute();
$result = $query->get_result();

// Fetch course details
$courseDetails = $result->fetch_assoc();
$return['course_details']= $courseDetails;
// echo json_encode($courseDetails);

// Query to select semester subjects
$query = $conn->prepare("SELECT * FROM semester_subjects WHERE courseID = ?");
$query->bind_param("i", $courseID);
$query->execute();
$result = $query->get_result();

// Fetch semester subjects
$semesterSubjects = [];
while ($row = $result->fetch_assoc()) {
    $semesterSubjects[] = $row;
}
$return['semester_subjects']=$semesterSubjects;
// echo json_encode($semesterSubjects);

// Query to select intakes
$query = $conn->prepare("SELECT * FROM intakes WHERE courseID = ?");
$query->bind_param("i", $courseID);
$query->execute();
$result = $query->get_result();

// Fetch intakes
$intakes = [];
while ($row = $result->fetch_assoc()) {
    $intakes[] = $row;
}
$return['intakes']=$intakes;
// echo json_encode($intakes);
// Commit transaction and close connection
echo json_encode($return);
$conn->commit();
}
catch (exception $e) {
    $conn->rollback();
    echo json_encode(array('error'=> $e->getMessage()));
$conn->close();
}
?>
