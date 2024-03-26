<?php
require_once('../includes/session.inc.php');
include_once('../nav/studentnav.php');
// echo'Session'.$_SESSION['studentID'];
if (!isset($_SESSION['studentID']) || empty($_SESSION['studentID'])) {
    header('location:/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Information</title>
</head>

<body>
    <div class="coursecontainer">
        <div class="course-details">

        </div>
        <div id="syllabus">

        </div>
        <div id="intakes">

        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", courseDetials);

        async function courseDetials() {
            param = new URLSearchParams(window.location.search);
            collegeID = param.get('collegeID');
            courseID = param.get('courseID');
            const reqparam = {
                collegeID: collegeID,
                courseID: courseID,
            };
            const url = '../includes/course-info.inc.php';
            const response = await fetch(url, {
                method: 'Post',
                body: JSON.stringify(reqparam),
                headers: {
                    "Content-Type": "application/json"
                }
            });
            if (!response.ok) {
                alert("Response Error");
            }
            const data = await response.json();
            console.log(data);
            let courseDetails = document.querySelector('.course-details');
            courseDetails.innerHTML = `
        <h1>${data.course_details.aboutcourse}</h1>
        <h3>${data.course_details.coursename}</h3>
        <h2>course Details</h2>
       <p> Level: ${data.course_details.level}</p>
        <p>Duration: ${data.course_details.duration} semesters </p>
        <p>Course Fee: ${data.course_details.course_fee}</p>
        `;

            var syllabus = document.querySelector('#syllabus');

            var syllabusStr = '';
            for (let j = 0; j < data.course_details.duration; j++) {
                syllabusStr += `<p> Semester ${j+1} </p>`;
                for (let index = 0; index < data.semester_subjects.length; index++) {
                    syllabusStr += `<p> ${data.semester_subjects[index].subject_name} </p>`;
                }
            }
            console.log(syllabusStr);
            syllabus.innerHTML = syllabusStr;

            var intakes = document.querySelector('#intakes');
            var intakeStr = `<p> Intakes </p>`;
            for (let index = 0; index < data.intakes.length; index++) {
                intakeStr += `<p> ${data.intakes[index].intake_name} <a href="../apply/apply.php?collegeID=${collegeID}&courseID=${courseID}&intakeID=${data.intakes[index].intakeID}">Apply </a> </P>`
            }
            console.log(intakeStr);
            intakes.innerHTML=intakeStr;
        }
    </script>

</body>

</html>