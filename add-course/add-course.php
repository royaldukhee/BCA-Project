<?php
require_once("../includes/session.inc.php");
include_once("../nav/collegenav.php");
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

        <div class="inner-container" id="formSteps">

            <div class="form-step" id="step1">
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
                    <label for="no-of-subs">No of Subjects in Semester</label>
                    <input type="number" name="no-of-subs" id="no-of-subs" value="0" />


                    <!-- input div for sub input -->
                    <div id="subjectInputs"></div>
                </div>
                <div class="input-section">
                    <button onclick="nextStep()">
                        <span style="font-size:16px"> Next </span>
                    </button>
                </div>
            </div>
            <div class="form-step hide" id="step2">


                <!-- entry requirements-->
                <div class="input-section">
                    <label for="courserequirements">Entry Requirements:</label>
                </div>
                <br />


                <!--  IELTS INPUTS -->
                <div class="input-section">
                    <label for="ielts">IELTS</label>
                    <br />
                    <label for="listening">Listening</label>
                    <input type="number" name="listening" id="ilistening" placeholder="Listening" required />
                    <label for="reading">Reading</label>
                    <input type="number" name="reading" id="ireading" placeholder="Reading" required />
                    <label for="writing">Writing</label>
                    <input type="number" name="writing" id="iwriting" placeholder="Writing" required />
                    <label for="speaking">Speaking</label>
                    <input type="number" name="speaking" id="ispeaking" placeholder="Speaking" required />
                    <label for="overall-band">Overall Band</label>
                    <input type="number" name="overallband" id="overallband" placeholder="Overall Band" required />
                </div>

                <br />
                <!-- PTE INPUTES -->
                <div class="input-section">
                    <label for="pte">PTE</label>
                    <br />
                    <label for="listening">Listening</label>
                    <input type="number" name="listening" id="plistening" placeholder="Listening" required />
                    <label for="reading">Reading</label>
                    <input type="number" name="reading" id="preading" placeholder="Reading" required />
                    <label for="writing">Writing</label>
                    <input type="number" name="writing" id="pwriting" placeholder="Writing" required />
                    <label for="speaking">Speaking</label>
                    <input type="number" name="speaking" id="pspeaking" placeholder="Speaking" required />
                    <label for="overall-score">Overall Score </label>
                    <input type="number" name="overallscore" id="overallscore" placeholder="Overall Score" required />
                </div>
                <div class="input-section">

                    <button onclick="previousStep(1)">
                        <span style="font-size:16px"> Previous </span>
                    </button>
                    <button onclick="nextStep()">
                        <span style="font-size:16px"> Next </span>
                    </button>
                </div>
            </div>
            <br />
            <div class="form-step hide" id="step3">

                <div class="input-section">
                    <label for="academic-requirements">Academic Requirements:</label>
                </div>

                <br />
                <!-- input field according to level selection -->
                <div class="input-section">
                    <label for="secondary">Secondary</label>
                </div>
                <br />

                <div class="input-section">
                    <label for="GPA"> Min. GPA</label>
                    <input type="number" name="sgpa" id="sgpa" required />
                    <label for="spercentage">Min. Percentage</label>
                    <input type="text" name="spercentage" id="spercentage" required />
                </div>
                <br />

                <div class="input-section">
                    <label for="secondary">Higher-Secondary</label>
                </div>
                <br />
                <div class="input-section">
                    <label for="GPA">Min. GPA</label>
                    <input type="number" name="hgpa" id="hgpa" required />
                    <label for="hpercentage">Min. Percentage</label>
                    <input type="text" name="hpercentage" id="hpercentage" required />
                </div>

                <br />

                <div class="input-section">
                    <div class="hide bachelor">
                        <label for="bachelor">Bachelor</label>
                        <br />
                        <label for="GPA">Min. GPA</label>
                        <input type="number" name="bgpa" id="bgpa" required />
                        <label for="bpercentage">Min. Percentage</label>
                        <input type="text" name="bpercentage" id="bpercentage" required />
                    </div>
                </div>
                <br />

                <div class="input-section">
                    <div class="hide master">
                        <label for="phd">Master</label>
                        <br />
                        <label for="GPA">Min. GPA</label>
                        <input type="number" name="mgpa" id="mgpa" required />
                        <label for="mpercentage">Min. Percentage</label>
                        <input type="text" name="mpercentage" id="mpercentage" required />
                        <br />
                    </div>
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
                    <button onclick="previousStep(2)">
                        <span style="font-size:16px"> Previous </span>
                    </button>
                    <button onclick="addcourse()">
                        <span style="font-size: 16px">Add Course</span>
                    </button>
                </div>

            </div>
        </div>

        <style>
            .hide {
                display: none;
            }
        </style>
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

            document.querySelector('#duration').addEventListener("input", updateSemesterOptions, event);
            //function for sub inputs
            function updateSubjectInputs(event) {
                event.preventDefault();
                const semester = document.querySelector('#semester').value;
                const numOfSubjects = document.querySelector('#no-of-subs').value;
                const subjectInputsDiv = document.querySelector('#subjectInputs');
                subjectInputsDiv.innerHTML = ''; // Clear previous inputs
                if (document.querySelector('#semester').value == null || document.querySelector('#semester').value == '') {
                    subjectInputsDiv.innerHTML = '';
                } else {
                    for (let i = 1; i <= numOfSubjects; i++) {
                        const input = document.createElement('input');
                        input.type = 'text';
                        input.id = `semester${semester}-subject${i}`;
                        input.placeholder = `Enter Subject ${i} name for ${semester}`;
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


            var allSemesterSubjects = [];
          
         async   function add_sub_var() {
                for (i = 1; i <= document.querySelector("#duration").value; i++) {
                    var semester = document.querySelector('#semester').value;
                    var sub = [];
                    console.log("Current semester:", semester);
                    var numOfSubjects = parseInt(document.querySelector('#no-of-subs').value);

                    console.log("Number of subjects:", numOfSubjects);
                    for (i = 1; i <= numOfSubjects; i++) {

                        let subjectValue = document.getElementById(`semester${semester}-subject${i}`).value;
                        if (subjectValue) {
                            sub.push(subjectValue);
                        }
                    }
                    allSemesterSubjects[semester]=sub;
                    semester++;
                    document.querySelector('#semester').value = semester;
                    console.log(document.querySelector('#semester').value);
                    document.querySelector('#no-of-subs').value = 0;
                    document.querySelector('#subjectInputs').innerHTML = "";
                    console.log(allSemesterSubjects);
                    }
                }

          async  function updateintake() {
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

            // getting intakes name
        
      
            let currentStep = 1;

          async  function nextStep() {
                if (currentStep < 3) {
                    document.getElementById(`step${currentStep}`).classList.add('hide');
                    currentStep++;
                    document.getElementById(`step${currentStep}`).classList.remove('hide');
                }
            }

           async function previousStep() {
                document.getElementById(`step${currentStep}`).classList.add('hide');
                currentStep--;
                document.getElementById(`step${currentStep}`).classList.remove('hide');
            }

            function showhide() {
                let level = document.getElementById("level").value;
                if (level == "master") {
                    document.querySelector(".bachelor").classList.remove("hide");
                    document.querySelector(".master").classList.add("hide");
                } else if (level == "phd") {
                    document.querySelector(".bachelor").classList.remove("hide");
                    document.querySelector(".master").classList.remove("hide");
                } else {
                    document.querySelector(".bachelor").classList.add("hide");
                    document.querySelector(".master").classList.add("hide");
                }
            }
           
//backend function 

         async   function addcourse() {
            intakesName=[];
            let number=   document.querySelector("#num_of_intakes").value;
            for(i=1;i<=number;i++){
                let intake= document.querySelector(`#intake${i}`).value;
                if(intake){
                    intakesName.push(intake);
                }
            }
        
        // console.log("intakes",intakesName);



                const level = document.getElementById("level").value;
                const coursename = document.querySelector("#coursename").value;
                const about_course = document.querySelector("#about-course").value;
                const duration = document.querySelector("#duration").value;
                const semesterDetails = allSemesterSubjects;
                const courseFee =document.querySelector('#coursefee').value;
                const collegeID =<?php echo $_SESSION['collegeID'];
                
                                    ?>;
                const IELTS = {
                    listening: document.querySelector("#ilistening").value,
                    reading: document.querySelector("#ireading").value,
                    writing: document.querySelector("#iwriting").value,
                    speaking: document.querySelector("#ispeaking").value,
                    overall: document.querySelector("#overallband").value,
                };

                const PTE = {
                    listening: document.querySelector("#plistening").value,
                    reading: document.querySelector("#preading").value,
                    writing: document.querySelector("#pwriting").value,
                    speaking: document.querySelector("#pspeaking").value,
                    overall: document.querySelector("#overallscore").value,
                }
                const secondary = {
                    gpa: document.querySelector("#sgpa").value,
                    percentage: document.querySelector("#spercentage").value,
                }
                const higher_secondary = {
                    gpa: document.querySelector("#hgpa").value,
                    percentage: document.querySelector("#hpercentage").value,
                }
              
                let academic;
                if (level == "master") {
                    const bachelor = {
                        gpa: document.querySelector("#bgpa").value,
                        percentage: document.querySelector("#bpercentage").value,
                    }
                    academic = {
                        secondary: secondary,
                        higher_secondary: higher_secondary,
                        bachelor: bachelor,
                    }
                } else if (level == "phd") {
                    const bachelor = {
                        gpa: document.querySelector("#bgpa").value,
                        percentage: document.querySelector("#bpercentage").value,
                    }
                    const master = {

                        gpa: document.querySelector("#mgpa").value,
                        percentage: document.querySelector("#mpercentage").value,
                    }

                    academic = {
                        secondary: secondary,
                        higher_secondary: higher_secondary,
                        bachelor: bachelor,
                        master: master,
                    }

                } else {
                    academic = {
                        secondary: secondary,
                        higher_secondary: higher_secondary,
                    }
                }
                const data = {
                    collegeID: collegeID,
                    level: level,
                    coursename: coursename,
                    about_course:about_course,
                    duration: duration,
                    semesterDetails: allSemesterSubjects,
                    courseFee: courseFee,
                    IELTS: IELTS,
                    PTE: PTE,
                    academic: academic,
                    intakes:intakesName,
                }

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
                        }
                        else{
                        const result = await response.text();
                        if (result === "success") {
                            alert("Course Added Successfully");
                            window.location.href="../college-home/college-home.php";
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
        </script>
</body>

</html>