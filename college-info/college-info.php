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
    <!-- <div class="filter">
        <label for="country">Country</label>
        <input type="search" id="search" placeholder="search country">
    </div> -->
    <label for="state">Filter By State</label>
    <select name="state" id="state">
        <option value="">Select</option>
    </select>
    <label for="program">Filter By Course</label>
    <select name="program" id="program">
        <option value="">Select</option>
    </select>
    <h2>Popular Universities and Colleges</h2>
    <div class="university-container">
        <div class="university-details">
            <h4>Study BBA in university</h4>
            <div class=course-Detials>
                <h3>Minimun Requirements</h3>
                <p>55% or 2.56 GPA in Higher Secondary</P>
                <p>IELTS overall 6 not less than 5.5 in each band </p>
                <p>PTE overall 61 not less than 55 in each score </p>
                <h3>
                    About Course
                </h3>
                <p>BBA TU</p>
            </div>


            <a href="../college-course-explore/college-course-explore.php?collegeID=1">Explore <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="25px" width="25px" xmlns="http://www.w3.org/2000/svg">
                    <path d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path>
                </svg>
            </a>
        </div>
        <div class="university-details">
            <h4>Study BBA in university</h4>
            <div class=course-Detials>
                <h3>Minimun Requirements</h3>
                <p>55% or 2.56 GPA in Higher Secondary</P>
                <p>IELTS overall 6 not less than 5.5 in each band </p>
                <p>PTE overall 61 not less than 55 in each score </p>
                <h3>
                    About Course
                </h3>
                <p>BBA TU</p>
            </div>


            <a href="../college-course-explore/college-course-explore.php?collegeID=1">Explore <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="25px" width="25px" xmlns="http://www.w3.org/2000/svg">
                    <path d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path>
                </svg>
            </a>
        </div>
    </div>

    </div>
    <script>
        const url = '../includes/college-info.inc.php';

        const fetchData = async (country) => {
            if (country !== 'others') {
                document.querySelector('#countryColumn').style.display = 'none';

            }
            try {
                const response = await fetch(url, {
                    method: "POST",
                    body: JSON.stringify({
                        country,
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
                        if (country === 'others') {
                            tr.innerHTML = `<td>${data.country}</td>`;
                        };
                        tr.innerHTML += `
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



        // console.log(countryParam);
        window.onload = async () => {
            const urlParams = new URLSearchParams(window.location.search);
            const countryparam = {
                country: urlParams.get('country'),

            }
            const countryParam = urlParams.get('country');

            await fetchData(countryParam);
        };


        async function updateCourses(country) {

            const response = await fetch(`${url}?country=${country}`);
            const data = await response.json()
        };
    </script>

</body>

</html>