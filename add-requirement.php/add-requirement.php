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
    <link rel="stylesheet" href="add-requirement.css" />
</head>

<body>

    <div class="inner-container">

        <h1>Requirement of College for Enrty</h1>
        <!-- entry requirements-->
        <div class="input-section">
            <label for="courserequirements">English Requirements:</label>
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
            <label for="academic-requirements">Academic Requirements:</label>
        </div>
        <br />
        <!-- input field according to level selection -->


        <div class="input-section">
            <label for="secondary">Higher-Secondary</label>
        </div>
        <br />
        <div class="input-section">
            <label for="GPA">Min. GPA</label>
            <input type="number" name="hgpa" id="hgpa" />
            <label for="hpercentage">Min. Percentage</label>
            <input type="text" name="hpercentage" id="hpercentage" />
        </div>

        <br />

        <div class="input-section">

            <label for="bachelor">Bachelor</label>
            <br />
            <label for="GPA">Min. GPA</label>
            <input type="number" name="bgpa" id="bgpa" />
            <label for="bpercentage">Min. Percentage</label>
            <input type="text" name="bpercentage" id="bpercentage" />

        </div>
        <br />

        <div class="input-section">
            <label for="phd">Master</label>
            <br />
            <label for="GPA">Min. GPA</label>
            <input type="number" name="mgpa" id="mgpa" required />
            <label for="mpercentage">Min. Percentage</label>
            <input type="text" name="mpercentage" id="mpercentage" />
            <br />
        </div>


        <br />
        <div class="input-section">
            <div class="error">

            </div>

            <div class="input-section">

                </button>
                <button id="add_requirement">
                    <span style="font-size: 16px"> Add Requirement</span>
                </button>
            </div>

        </div>




        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const subjectInputElements = document.querySelectorAll('.input-section input');
                subjectInputElements.forEach(input => {
                    input.addEventListener('input', errorRemove);

                });
            });

            function errorRemove() {
                document.querySelector('.error').innerHTML = " ";
            }
            document.querySelector('#add_requirement').addEventListener('click', add_Requirement);
            async function add_Requirement() {

                const ilistening = document.querySelector("#ilistening").value;
                const ireading = document.querySelector("#ireading").value;
                const iwriting = document.querySelector("#iwriting").value;
                const ispeaking = document.querySelector("#ispeaking").value;
                const overallband = document.querySelector("#overallband").value;

                const plistening = document.querySelector("#plistening").value;
                const preading = document.querySelector("#preading").value;
                const pwriting = document.querySelector("#pwriting").value;
                const pspeaking = document.querySelector("#pspeaking").value;
                const overallscore = document.querySelector("#overallscore").value;


                const hgpa = document.querySelector("#hgpa").value;
                const hpercentage = document.querySelector("#hpercentage").value;
                const bgpa = document.querySelector("#bgpa").value;
                const bpercentage = document.querySelector("#bpercentage").value;
                const mgpa = document.querySelector("#mgpa").value;
                const mpercentage = document.querySelector("#mpercentage").value;





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

                //academic data
                // const secondary = {
                //     level: 'secondary',
                //     gpa: document.querySelector("#sgpa").value,
                //     percentage: document.querySelector("#spercentage").value,
                // }
                const higher_secondary = {
                    level: 'higher_secondary',
                    gpa: document.querySelector("#hgpa").value,
                    percentage: document.querySelector("#hpercentage").value,

                }

                const bachelor = {
                    level: 'bachelor',
                    gpa: document.querySelector("#bgpa").value,
                    percentage: document.querySelector("#bpercentage").value,
                }
                const master = {
                    level: 'master',
                    gpa: document.querySelector("#mgpa").value,
                    percentage: document.querySelector("#mpercentage").value,
                }

                const academic = {
                    // secondary: secondary,
                    higher_secondary: higher_secondary,
                    bachelor: bachelor,
                    master: master,
                }


                const data = {
                    collegeID: <?php print_r($_SESSION['collegeID']); ?>,
                    academic: academic,
                    IELTS: IELTS,
                    PTE: PTE,
                }
                //taking inputs


                if (ilistening === "" || ireading === "" || iwriting === "" || ispeaking === "" || overallband === "" || plistening === "" || preading === "" || pwriting === "" || pspeaking === "" || overallscore === "" || hgpa === "" || hpercentage === "" || mgpa === "" || mpercentage === "") {
                    document.querySelector('.error').innerHTML = ("Fill Out All Fields");
                    document.querySelector('.error').style.color = "red";

                    return;

                } else {

                    if (confirm("Do You Want to really add") == true) {
                        try {
                            const response = await fetch("../includes/add-requirement.inc.php/", {
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
                                    alert(result);
                                }
                            }
                        } catch (error) {
                            alert(
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