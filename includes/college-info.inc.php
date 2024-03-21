<?php
require_once "../includes/dbconnect.inc.php";

$rawdata = file_get_contents("php://input", true);
$data = json_decode($rawdata, true);
$country = $data['country'];

try {
    if ($country == 'others') {
        $query = "SELECT collegeID, collegename, country, state, city, level, courseID, coursename, aboutcourse, duration, course_fee FROM colleges NATURAL JOIN courses;";
        $stmt = $conn->prepare($query);
    } else {
        $query = "SELECT collegeID, collegename, country, state, city, level, courseID, coursename, aboutcourse, duration, course_fee FROM colleges NATURAL JOIN courses WHERE country = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $country);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo json_encode(array());
    }

    $stmt->close();
    } catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
?>