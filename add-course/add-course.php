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
                    <label for="coursename">Course Name</label>
                    <input type="text" name="coursename" id="coursename" placeholder="coursename" required />
                </div>
                <br />
                <div class="input-section">
                    <label for="duration">Duration</label>
                    <input type="text" name="duration" id="duration" placeholder="duration (in semester)" required />
                </div>
                <br />
                <div class="input-section">
                    <label for="startdate">Start Date</label>
                    <input type="date" name="startdate" id="startdate" required value="<?php echo date("Y-m-d") ?>" />
                    <label for="enddate">End Date</label>
                    <input type="date" name="enddate" id="enddate" required value="<?php echo date("Y-m-d") ?>" />
                </div>
                <br />
                <div class="input-section">
                    <button onclick="nextStep()">
                        <span style="font-size:16px"> Next </span>
                    </button>
                </div>
            </div>
            <div class="form-step hide" id="step2">
                <div class="input-section">
                    <label for="courserequirements">Course Requirements:</label>
                </div>
                <br />

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
                    <button onclick="previousStep(2)">
                        <span style="font-size:16px"> Previous </span>
                    </button>
                    <button onclick="addcourse()">
                        <span style="font-size: 16px">Add Course</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hide {
            display: none;
        }
    </style>
    <script>
        let currentStep = 1;


        function nextStep() {
            if (currentStep < 3) {
                document.getElementById(`step${currentStep}`).classList.add('hide');
                currentStep++;
                document.getElementById(`step${currentStep}`).classList.remove('hide');
            }
        }

        function previousStep() {
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

        function addcourse() {
            let level = document.getElementById("level").value;
            const coursename = document.querySelector("#coursename").value;
            const duration = document.querySelector("#duration").value;
            const startdate = document.querySelector("#startdate").value;
            const enddate = document.querySelector("#enddate").value;
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
            const collegeID = <?php echo ( $_SESSION['collegeID']); ?>;
            
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
                collegeID:collegeID,
                level: level,
                coursename: coursename,
                duration: duration,
                startdate: startdate,
                enddate: enddate,
                IELTS: IELTS,
                PTE: PTE,
                academic: academic,
            }

            if (confirm("Do You Want to really add") == true) {
                try {
                    const response = fetch("../includes/add-course.inc.php/", {
                        method: "post",
                        body: JSON.stringify(data),
                        headers: {
                            "Content-Type": "application/json"
                        },
                    });
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    const result = response.text();
                    console.log(result);
                    if (result == "success") {
                        alert("Course Added Successfully");
                    } else {
                        alert("There has been a problem with your fetch operation");
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