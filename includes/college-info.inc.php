<?php
require_once "../includes/dbconnect.inc.php";

$rawdata = file_get_contents("php://input", true);
$data = json_decode($rawdata);

try {
    $country = isset($_GET['country']) ? $_GET['country'] : '';
echo $country;
    if ($country === 'others') {
        $query = "SELECT collegeID, collegename, country, state, city, level, courseID, coursename, aboutcourse, duration, course_fee FROM colleges NATURAL JOIN courses;";
    } else {
        // Fetch data based on the specified country
        $query = "SELECT collegeID, collegename, country, state, city, level, courseID, coursename, aboutcourse, duration, course_fee FROM colleges NATURAL JOIN courses WHERE country = '$country';";
    }

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo json_encode(array());  
    }
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));  
}
?>
