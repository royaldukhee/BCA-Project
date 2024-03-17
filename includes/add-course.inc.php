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
        
        // English test data insertion
        $ielts = $data['IELTS'];
        $pte = $data['PTE'];
        $test_type = 'IELTS';
        $query = $conn->prepare("insert into english_requirements (courseID, test_type, listening, reading, writing, speaking, overall) values(?,?,?,?,?,?,?)");
        $query->bind_param("isddddd", $courseID, $test_type, $ielts['listening'], $ielts['reading'], $ielts['writing'], $ielts['speaking'], $ielts['overall']);
        $query->execute();
        $test_type = 'PTE';
        $query = $conn->prepare("insert into english_requirements (courseID, test_type, listening, reading, writing, speaking, overall) values(?,?,?,?,?,?,?)");
        $query->bind_param("isddddd", $courseID, $test_type, $pte['listening'], $pte['reading'], $pte['writing'], $pte['speaking'], $pte['overall']);
        $query->execute();
        
        // Academic requirements insertion
        if ($data['level'] == "phd" || $data['level'] == "master" || $data['level'] == "bachelor") {
            $secondaryeducation = $data['academic']['secondary'];
            $level = "secondary";
            $query = $conn->prepare("insert into academic_requirements(courseID, level, gpa, percentage) values(?,?,?,?)");
            $query->bind_param("isdd", $courseID, $level, $secondaryeducation['gpa'], $secondaryeducation['percentage']);
            $query->execute();
        
            if ($data['level'] == "phd" || $data['level'] == "master") {
                $higher_secondaryeducation = $data['academic']['higher_secondary'];
                $level = "higher secondary";
                $query = $conn->prepare("insert into academic_requirements(courseID, level, gpa, percentage) values(?,?,?,?)");
                $query->bind_param("isdd", $courseID, $level, $higher_secondaryeducation['gpa'], $higher_secondaryeducation['percentage']);
                $query->execute();
        
                if ($data['level'] == "phd") {
                    $bacheloreducation = $data['academic']['bachelor'];
                    $level = "bachelor";
                    $query = $conn->prepare("insert into academic_requirements(courseID, level, gpa, percentage) values(?,?,?,?)");
                    $query->bind_param("isdd", $courseID, $level, $bacheloreducation['gpa'], $bacheloreducation['percentage']);
                    $query->execute();
        
                    $mastereducation = $data['academic']['master'];
                    $level = "master";
                    $query = $conn->prepare("insert into academic_requirements(courseID, level, gpa, percentage) values(?,?,?,?)");
                    $query->bind_param("isdd", $courseID, $level, $mastereducation['gpa'], $mastereducation['percentage']);
                    $query->execute();
                } else {
                    $bacheloreducation = $data['academic']['bachelor'];
                    $level = "bachelor";
                    $query = $conn->prepare("insert into academic_requirements(courseID, level, gpa, percentage) values(?,?,?,?)");
                    $query->bind_param("isdd", $courseID, $level, $bacheloreducation['gpa'], $bacheloreducation['percentage']);
                    $query->execute();
                }
            }
        }
        
        // Intakes insertion
        foreach ($data['intakes'] as $intake) {
            $query = $conn->prepare("insert into intakes (intake_name, courseID) values (?,?)");
            $query->bind_param("si", $intake, $courseID);
            $query->execute();
        }
        
        // Semester and sem_sub insertions
        $semesterDetails = $data['semesterDetails'];
        
        for ($semester = 1; $semester < count($semesterDetails); $semester++) {
            $querysem = $conn->prepare("insert into semesters(semester_no, courseID) values (?,?)");
            $querysem->bind_param("ii", $semester, $courseID);
            $querysem->execute();
            foreach ($semesterDetails[$semester] as $subject) {
                $querysub = $conn->prepare("insert into semester_subjects(subject_name, semester) values (?,?)");
                $querysub->bind_param("si", $subject, $semester);
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
