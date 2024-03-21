<?php
require_once('../includes/session.inc.php');
include_once('../nav/collegenav.php');
// echo'Session'.$_SESSION['collegeID'];
if (!isset($_SESSION['collegeID']) || empty($_SESSION['collegeID'])) {
    header('location:/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Course</title>
    <link rel="stylesheet" href="add-course.css" />
</head>

<body>

    <div class="container">

        <div class="inner-container">


            <div class="input-section">


                <!-- level Selection -->
                <label for="level">Select Level</label>
                <select name="level" id="level" onchange="showhide()">
                    <option value="">select</option>
                    <option value="undergraduate">Under-Graduate</option>
                    <option value="bachelor">Bachelor</option>
                    <option value="master">Master</option>
                    <option value="phd">PhD</option>
                </select>
            </div>
            <br />
            <div class="input-section">


                <!-- course name and about Course -->
                <label for="coursename">Course Name</label>
                <input type="text" name="coursename" id="coursename" placeholder="coursename" />
            </div>
            <br />
            <div class="input-section">
                <label for="about-course">About Course </label>
                <input type="textarea" name="about-course" id="about-course" placeholder="about-course" />
            </div>
            <br>


            <!-- course detials duration, semester... -->
            <h1>Course Details</h1>
            <div class="input-section">
                <label for="duration">Duration</label>
                <input type="number" name="duration" id="duration" placeholder="duration (in semesters)" />
            </div>
            <br />
            <div class="input-section" id="syllabus">
                <label for="semester">Semester</label>
                <select name="semester" id="semester"></select>
                <br>
                <div class="num-of-subs">
                    <label for="no-of-subs">No of Subjects per Semester</label>
                    <input type="number" name="no-of-subs" id="no-of-subs" value="" />
                </div>

                <!-- input div for sub input -->
            </div>
            <div class="input-section" id="input-section-sub">
                <div id="subjectInputs"></div>
                <div class="subjectInputsError"></div>

            </div>



            <div class="input-section">
                <label for="no-of-intakes">No of Intakes</label>
                <input type="number" name="num_of_intakes" id="num_of_intakes" />
                <!--input fields for intake according to no of intakes input  -->
                <div id=intake_name>

                </div>
            </div>
            <br />
            <div class="input-section">
                <label for="course-fee">Course Fee</label>
                <input type="number" name="coursefee" id="coursefee" placeholder="course fee(in dollars)" required />
            </div>
            <div class="input-section">
                <div class="error">

                </div>
            </div>

            <div class="input-section">
                <button onclick="addcourse()">
                    <span style="font-size: 16px">Add Course</span>
                </button>
            </div>
            
        </div>


        <script>
            //semester select option creation 
            function updateSemesterOptions(event) {
                event.preventDefault();
                const duration = document.querySelector('#duration').value;
                const semesterSelect = document.querySelector('#semester');
                semesterSelect.innerHTML = '';
                if (duration) {
                    for (let i = 1; i <= duration; i++) {
                        const option = document.createElement("option");
                        option.value = `${i}`;
                        option.textContent = `${i}`;
                        semesterSelect.appendChild(option);
                    }

                }

            }
            // var allSemesterSubjects = [];
            document.querySelector('#duration').addEventListener("input", updateSemesterOptions, event);
            //function for sub inputs
            let allSemesterSubjects = [];

            function updateSubjectInputs(event) {

                event.preventDefault();
                const semester = document.querySelector('#semester').value;
                const numOfSubjects = document.querySelector('#no-of-subs').value;
                const subjectInputsDiv = document.querySelector('#subjectInputs');
                subjectInputsDiv.innerHTML = ''; // Clear previous inputs
                if (document.querySelector('#semester').value == null || document.querySelector('#semester').value == '') {
                    subjectInputsDiv.innerHTML = '';
                } else if (numOfSubjects == null || numOfSubjects === '' || numOfSubjects == 0) {
                    document.querySelector('.subjectInputsError').innerHTML = "<span style='color:red'> Please fill in all no of subjects before proceeding.</span>";

                } else if (numOfSubjects == 0) {
                    document.querySelector('.subjectInputsError').innerHTML = "<span style='color:red'> Please fill valid Number.</span>";

                } else {



                    for (let i = 1; i <= numOfSubjects; i++) {
                        const label = document.createElement('label')
                        label.textContent = `Subject ${i} name`;
                        subjectInputsDiv.appendChild(label);
                        const input = document.createElement('input');
                        input.type = 'text';
                        input.id = `semester${semester}-subject${i}`;
                        input.placeholder = `Enter Subject ${i} name for ${semester} semester`;
                        subjectInputsDiv.appendChild(input);
                        subjectInputsDiv.appendChild(document.createElement("br"));


                    }
                    const button = document.createElement("button");
                    button.id = "add_sub";
                    button.textContent = "Add Subject";
                    subjectInputsDiv.appendChild(button);
                    document.querySelector('#add_sub').addEventListener('click', add_sub_var);

                }

            }

            document.querySelector('#no-of-subs').addEventListener('input', updateSubjectInputs);

            //all sem_subjects

            function add_sub_var() {
                if (document.querySelector("#duration").value) {
                    for (i = 1; i <= document.querySelector("#duration").value; i++) {
                        var semester = document.querySelector('#semester').value;
                        var sub = [];
                        console.log("Current semester:", semester);
                        var numOfSubjects = parseInt(document.querySelector('#no-of-subs').value);

                        console.log("Number of subjects:", numOfSubjects);
                        if (numOfSubjects == null || numOfSubjects === '') {
                            document.querySelector('.error').innerHTML = "<span style='color:red'> Please fill in all required fields before proceeding.</span>";
                        } else {
                            for (i = 1; i <= numOfSubjects; i++) {

                                let subjectValue = document.getElementById(`semester${semester}-subject${i}`).value;
                                if (subjectValue == null || subjectValue === '') {
                                    document.querySelector('.subjectInputsError').innerHTML = "<span style='color:red'> Please fill in all subjects fields before proceeding.</span>";
                                } else {
                                    sub.push(subjectValue);
                                }
                            }
                            allSemesterSubjects[semester] = sub;
                            semester++;
                            document.querySelector('#semester').value = semester;
                            console.log(document.querySelector('#semester').value);
                            document.querySelector('#no-of-subs').value = 0;
                            document.querySelector('#subjectInputs').innerHTML = "";
                            console.log(allSemesterSubjects);
                        }
                    }
                }
            }

            function updateintake() {
                const intake_no = document.querySelector('#num_of_intakes').value;
                const intakeInput = document.querySelector('#intake_name');
                intakeInput.innerHTML = '';
                if (intake_no) {
                    for (let i = 1; i <= intake_no; i++) {
                        const input = document.createElement("input");
                        input.type = 'text';
                        input.id = `intake${i}`
                        input.placeholder = `enter name of intake ${i}`;
                        intakeInput.appendChild(input);
                        intakeInput.appendChild(document.createElement("br"));

                    }
                }
            }
            document.querySelector('#num_of_intakes').addEventListener("input", updateintake);



           

           





            const inputElements = document.querySelectorAll('input');
            inputElements.forEach(input => {
                input.addEventListener('input', errorRemove);
            });


            const selectElements = document.querySelectorAll('select');
            selectElements.forEach(input => {
                input.addEventListener('input', errorRemove);
            });
            document.addEventListener('DOMContentLoaded', function() {
                const subjectInputElements = document.querySelectorAll('#subjectInputs input');
                subjectInputElements.forEach(input => {
                    input.addEventListener('input', errorRemove);

                });
            });


            function errorRemove() {
                document.querySelector('.error').innerHTML = " ";
                document.querySelector('.subjectInputsError').innerHTML = " ";

            }


            //backend fetch function 

            async function addcourse() {



                intakesName = [];
                let number = document.querySelector("#num_of_intakes").value;
                for (i = 1; i <= number; i++) {
                    let intake = document.querySelector(`#intake${i}`).value;
                    if (intake == null || intake === '') {
                        document.querySelector('.error').innerHTML = "<span style='color:red'> Please fill in all required fields before proceeding.</span>";
                    } else {
                        intakesName.push(intake);
                    }
                }


                // console.log("intakes",intakesName);



                const level = document.getElementById("level").value;
                const coursename = document.querySelector("#coursename").value;
                const about_course = document.querySelector("#about-course").value;
                const duration = document.querySelector("#duration").value;
                const semesterDetails = allSemesterSubjects;
                const courseFee = document.querySelector('#coursefee').value;
                const collegeID = <?php echo $_SESSION['collegeID'];

                                    ?>;
              
                const data = {
                    collegeID: collegeID,
                    level: level,
                    coursename: coursename,
                    about_course: about_course,
                    duration: duration,
                    semesterDetails: allSemesterSubjects,
                    courseFee: courseFee,
                    intakes: intakesName,
                }
                if (!level || !coursename || !about_course || !duration||!courseFee || !intakesName || !allSemesterSubjects) {
                document.querySelector('.error').innerHTML = "<span style='color:red'> Please fill in all required fields before proceeding.</span>";

            } else {

                if (confirm("Do You Want to really add") == true) {
                    try {
                        const response = await fetch("../includes/add-course.inc.php/", {
                            method: "POST",
                            body: JSON.stringify(data),
                            headers: {
                                "Content-Type": "application/json"
                            },
                        });
                        if (!response.ok) {
                            throw new Error("Network Error");
                        } else {
                            const result = await response.text();
                            if (result === "success") {
                                alert("Course Added Successfully");
                                window.location.href = "../college-home/college-home.php";
                            } else {
                                console.log(result);
                                alert("problem with your fetch operation");
                            }
                        }
                    } catch (error) {
                        console.error(
                            "There has been a problem with your fetch operation:",
                            error
                        );
                    }
                } else {
                    alert("Declined");
                }
            }
        }
        </script>
</body>

</html>