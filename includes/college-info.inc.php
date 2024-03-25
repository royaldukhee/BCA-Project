<?php
require_once '../includes/dbconnect.inc.php';
$input = json_decode(file_get_contents("php://input"), true);
$country = isset($input['country']) ? $input['country'] : null;
$state = isset($input['state']) ? $input['state'] : null;
$course = isset($input['course']) ? $input['course'] : null;

$query = "
    SELECT 
        c.collegeID,
        c.collegename,
        c.country,
        c.state,
        c.city,
        co.courseID,
        co.level,
        co.coursename,
        co.aboutcourse,
        co.duration,
        co.course_fee,
        GROUP_CONCAT(DISTINCT CONCAT(ar.level, ': ', ar.percentage, '% (', ar.gpa, ') percentage(gpa)') ORDER BY ar.level) AS academic_requirements,
        GROUP_CONCAT(DISTINCT CONCAT(er.test_type, ': Listening - ', er.listening, ', Reading - ', er.reading, ', Writing - ', er.writing, ', Speaking - ', er.speaking, ', Overall - ', er.overall) ORDER BY er.test_type) AS english_requirements
    FROM 
        colleges c
    JOIN 
        courses co ON c.collegeID = co.collegeID
    JOIN 
        academic_requirements ar ON co.courseID = ar.courseID
    JOIN 
        english_requirements er ON co.courseID = er.courseID
    GROUP BY 
        c.collegeID, co.courseID;
";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(array("message" => "No data found"));
}
$conn->close();
?>
