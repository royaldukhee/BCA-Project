<?php
require_once '../includes/dbconnect.inc.php';
$rawdata = file_get_contents("php://input",true);

$data = json_decode($rawdata);
// echo json_encode($data);
if($data!=null){


// $level =$data->level;
// $coursename =$data->coursename;
// $duration =$data->duration;
// $startdate =$data->startdate;
// $enddate =$data->enddate;
// $collegeID =$data->collegeID;
try {
    $conn->begin_transaction();

    $query = $conn->prepare("insert into course_details(course_name,level,duration,start_date,end_date,collegeID) values(?,?,?,?,?,?)");
    $query->bind_param('ssissi', $data->coursename, $data->level, $data->duration, $data->startdate, $data->enddate, $data->collegeID);
    $query->execute();
    $courseID = $query->insert_id;
    $ielts = $data->IELTS;
    $pte = $data->PTE;
    $test_type = 'IELTS';
    $query = $conn->prepare("insert into english_test_requirements (courseID,test_type,listening,reading,writing,speaking,overall) values(?,?,?,?,?,?,?)");
    $query->bind_param("isddddd", $courseID, $test_type, $ielts->listening, $ielts->reading, $ielts->writing, $ielts->speaking, $ielts->overall);
    $query->execute();
    $test_type = 'PTE';

    
    $query = $conn->prepare("insert into english_test_requirements (courseID,test_type,listening,reading,writing,speaking,overall) values(?,?,?,?,?,?,?)");
    $query->bind_param("isddddd", $courseID, $test_type, $pte->listening, $pte->reading, $pte->writing, $pte->speaking, $pte->overall);
    $query->execute();

    if ($data->level == "phd") {
        $secondaryeducation = $data->academic->secondary;
        $level="secondary";
        $query = $conn->prepare("insert into academic_requirements(courseID,level,gpa,percentage)values(?,?,?,?)");
        $query->bind_param("isdd", $courseID, $level, $secondaryeducation->gpa, $secondaryeducation->percentage);
        $query->execute();

        $higher_secondaryeducation = $data->academic->higher_secondary;
        $level="higher secondary";
        $query = $conn->prepare("insert into academic_requirements(courseID,level,gpa,percentage)values(?,?,?,?)");
        $query->bind_param("isdd", $courseID, $level, $higher_secondaryeducation->gpa, $higher_secondaryeducation->percentage);
        $query->execute();

        
        $bacheloreducation = $data->academic->bachelor;
        $level="bachelor";
        $query = $conn->prepare("insert into academic_requirements(courseID,level,gpa,percentage)values(?,?,?,?)");
        $query->bind_param("isdd", $courseID, $level, $bacheloreducation->gpa, $bacheloreducation->percentage);
        $query->execute();

        $mastereducation = $data->academic->master;
        $level="master";
        $query = $conn->prepare("insert into academic_requirements(courseID,level,gpa,percentage)values(?,?,?,?)");
        $query->bind_param("isdd", $courseID, $level, $mastereducation->gpa, $mastereducation->percentage);
        $query->execute();

    }
    else if ($data->level == "master") {
        $secondaryeducation = $data->academic->secondary;
        $level="secondary";
        $query = $conn->prepare("insert into academic_requirements(courseID,level,gpa,percentage)values(?,?,?,?)");
        $query->bind_param("isdd", $courseID, $level, $secondaryeducation->gpa, $secondaryeducation->percentage);
        $query->execute();

        $higher_secondaryeducation = $data->academic->higher_secondary;
        $level="higher secondary";
        $query = $conn->prepare("insert into academic_requirements(courseID,level,gpa,percentage)values(?,?,?,?)");
        $query->bind_param("isdd", $courseID, $level, $higher_secondaryeducation->gpa, $higher_secondaryeducation->percentage);
        $query->execute();
 
        $bacheloreducation = $data->academic->bachelor;
        $level="bachelor";
        $query = $conn->prepare("insert into academic_requirements(courseID,level,gpa,percentage)values(?,?,?,?)");
        $query->bind_param("isdd", $courseID, $level, $bacheloreducation->gpa, $bacheloreducation->percentage);
        $query->execute();
    }
    else{
        $secondaryeducation = $data->academic->secondary;
        $level="secondary";
        $query = $conn->prepare("insert into academic_requirements(courseID,level,gpa,percentage)values(?,?,?,?)");
        $query->bind_param("isdd", $courseID, $level, $secondaryeducation->gpa, $secondaryeducation->percentage);
        $query->execute();

        $higher_secondaryeducation = $data->academic->higher_secondary;
        $level="higher secondary";
        $query = $conn->prepare("insert into academic_requirements(courseID,level,gpa,percentage)values(?,?,?,?)");
        $query->bind_param("isdd", $courseID, $level, $higher_secondaryeducation->gpa, $higher_secondaryeducation->percentage);
        $query->execute();
    }
    $conn->commit();
    echo "success";
    }
catch (Exception $e){
    $conn->rollback();
    echo"error".$e->getMessage();
}
finally{
    $conn->close();

}
}
else{
    echo "error";
}


