<?php
require_once '../includes/dbconnect.inc.php';
$rawdata = file_get_contents("php://input", true);
$data=json_decode($rawdata,true);


 
if ($data != null) {

  
    try {
        $conn->begin_transaction();
        // course details insertion 
        $query = $conn->prepare("insert into courses(coursename, level, aboutcourse, duration, course_fee, collegeID) values(?,?,?,?,?,?)");
        $query->bind_param('sssidi', $data['coursename'], $data['level'], $data['about_course'], $data['duration'], $data['courseFee'], $data['collegeID']);
        $query->execute();
        $courseID = $query->insert_id;
        
         
        // Intakes insertion
        foreach ($data['intakes'] as $intake) {
            $query = $conn->prepare("insert into intakes (intake_name, courseID) values (?,?)");
            $query->bind_param("si", $intake, $courseID);
            $query->execute();
        }
        
        // Semester and sem_sub insertions
        $semesterDetails = $data['semesterDetails'];
        
        for ($semester = 1; $semester < count($semesterDetails); $semester++) {
            // $querysem = $conn->prepare("insert into semesters(semester_no, courseID) values (?,?)");
            // $querysem->bind_param("ii", $semester, $courseID);
            // $querysem->execute();
            foreach ($semesterDetails[$semester] as $subject) {
                $querysub = $conn->prepare("insert into semester_subjects(subject_name, semester,courseID) values (?,?,?)");
                $querysub->bind_param("sii", $subject, $semester,$courseID);
                $querysub->execute();
            }
        }
        
        $conn->commit();
        echo "success";
    } catch (Exception $e) {
        $conn->rollback();
        echo "error" . $e->getMessage();
    } finally {
        $conn->close();
    }
} else {
    echo "error";
}
