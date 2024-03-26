<?php
require_once '../includes/dbconnect.inc.php';
$rawdata = file_get_contents("php://input", true);
$data = json_decode($rawdata, true);



if ($data != null) {

    // echo json_encode($data);
    $conn->begin_transaction();
    try {
        $checkQuery = $conn->prepare("SELECT courseID FROM courses WHERE collegeID = ? AND coursename = ?");
        $checkQuery->bind_param("is", $data['collegeID'], $data['coursename']);
        $checkQuery->execute();
        $checkResult = $checkQuery->get_result();


        if ($checkResult->num_rows > 0) {
            echo "Course already exists plese proceed for update course if any changes to be made";
        } else {


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


            foreach ($semesterDetails as $semester => $subjects) {
                if (is_array($subjects)) {
                    foreach ($subjects as $subject) {
                        $querysub = $conn->prepare("INSERT INTO semester_subjects (subject_name, semester, courseID) VALUES (?, ?, ?)");
                        $querysub->bind_param("sii", $subject, $semester, $courseID);
                        $querysub->execute();
                    }
                }
            }

            $conn->commit();
            if ($querysub->affected_rows > 0) {
                echo "success";
            } else {
                echo "error";
            }
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "error" . $e->getMessage();
    } finally {
        $conn->close();
    }
} else {
    echo "error";
}
