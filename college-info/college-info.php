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
    <link rel="stylesheet" href="college-info.css">
    <title>Colleges information</title>
</head>

<body>
    <h1>Choose Your Interest</h1>
    <div class="filter">
        <label for="country">Country</label>
        <input type="search" id="search" placeholder="search country">
    </div>
    <label for="state">Filter By State</label>
    <select name="state" id="state">
        <option value="">Select</option>
    </select>
    <label for="program">Filter By Course</label>
    <select name="program" id="program">
        <option value="">Select</option>
    </select>
    <h2>Popular Universities and Colleges</h2>
    <div class="collegeInfo-table">
        <table class="tableClass">
            <thead>
                <tr>

                    <th id=countryColumn>Country</th>

                    <th>College Name</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Course Name</th>
                    <th>Level</th>
                    <th>Duration</th>
                    <th>Course Fee</th>
                    <th>View Requirements</th>
                </tr>
            </thead>
            <tbody id="tableBody">

            </tbody>

        </table>

    </div>
    <script>
        const url = '../includes/college-info.inc.php';

        const fetchData = async (country, state, course) => {
            if(country!=='others'){
                document.querySelector('#countryColumn').style.display = 'none';

            }
            try {
                const response = await fetch(url, {
                    method: "POST",
                    body: JSON.stringify({
                        country,
                        state,
                        course
                    }),
                    headers: {
                        "Content-Type": "application/JSON"
                    },
                });
                if (!response.ok) {
                    throw new Error("Response Error");
                }
                const result = await response.json();
                console.log(result);
                const tableBody = document.querySelector('#tableBody');
                tableBody.innerHTML = '';
                if (Array.isArray(result)) {
                    result.forEach(data => {
                const tr = document.createElement('tr');
                tr.setAttribute('id', data.courseID);
                        if(country==='others'){
                                                tr.innerHTML = `<td>${data.country}</td>`;
                        };
                        tr.innerHTML+=`
                    <td id=${data.CollegeID}>${data.collegename}</td>
                    <td>${data.state}</td>
                    <td>${data.city}</td>
                    <td>${data.coursename}</td>
                    <td>${data.level}</td>
                    <td>${data.duration} Semester</td>
                    <td>${data.course_fee}</td>
                    <td><button id=${data.courseID}>View</button></td>`;
                        tableBody.appendChild(tr);
                    });
                } else {
                    console.log("Invalid response format: expected an array");
                }
            } catch (error) {
                console.log("Error Occurred", error);
            }
        };

        const countryInput = document.getElementById('search');
        countryInput.addEventListener('change', async () => {
            const country = countryInput.value;
            await fetchData(country);

        });

         
        const urlParams = new URLSearchParams(window.location.search);
        const countryParam = urlParams.get('country');
        console.log(countryParam);
        window.onload = async () => {
            await fetchData(countryParam);
        };
        const searchInput = document.getElementById('search');
        const stateSelect = document.getElementById('state');
        const programSelect = document.getElementById('program');

       
        async function updateStates(country) {
           stateSelect.innerHTML = '<option value="">Select</option>';
            const response = await fetch(`${url}?country=${country}`);
            const data = await response.json();

            data.states.forEach(state => {
                const option = document.createElement('option');
                option.value = state;
                option.textContent = state;
                stateSelect.appendChild(option);
            });
        }

        
        async function updateCourses(country) {
           
            programSelect.innerHTML = '<option value="">Select</option>';

          
            const response = await fetch(`${url}?country=${country}`);
            const data = await response.json();

            data.courses.forEach(course => {
                const option = document.createElement('option');
                option.value = course;
                option.textContent = course;
                programSelect.appendChild(option);
            });
        }

    </script>

</body>

</html>