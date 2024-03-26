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
    <div class="filter-section">
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
    </div>
    <h2>Popular Universities and Colleges</h2>
    <div class="university-container">
        <!-- University Details population -->

    </div>

    </div>
    <script>
        const url = '../includes/college-info.inc.php';

    
//initial fetch
const urlParams = new URLSearchParams(window.location.search);
        const countryParam = urlParams.get('country');
    window.onload = IitialFetchData();
        
    
    async function IitialFetchData () {

        try {
            const urlParams = new URLSearchParams(window.location.search);
        const countryParam = urlParams.get('country')
        const query={
            country:countryParam,
        }
            const response = await fetch(url, {
                method: "POST",
                body: JSON.stringify(query),
                headers: {
                    "Content-Type": "application/json"
                },
            });
            if (!response.ok) {
                throw new Error("Response Error");
            }
            const result = await response.json();
            // console.log(result);
            const universitiesDetials = document.querySelector('.university-container');
            universitiesDetials.innerHTML = '';
            if (Array.isArray(result)) {
                const uniqueStates = [...new Set(result.map(data => data.state))];
                const stateDropdown = document.getElementById('state');
                stateDropdown.innerHTML = '<option value="">Select</option>';  
                uniqueStates.forEach(state => {
                    const option = document.createElement('option');
                    option.value = state;
                    option.textContent = state;
                    stateDropdown.appendChild(option);
                });
                const uniquePrograms = [...new Set(result.map(data => data.coursename))];
                const programDropdown = document.getElementById('program');
                programDropdown.innerHTML = '<option value="">Select</option>';  
                uniquePrograms.forEach(program => {
                    const option = document.createElement('option');
                    option.value = program;
                    option.textContent = program;
                    programDropdown.appendChild(option);
                });

                result.forEach(data => {
                    const academicRequirements = data.academic_requirements.split(',').map(req => req.trim());
                    const englishRequirements = data.english_requirements.split(',').map(req => req.trim());

                    universitiesDetials.innerHTML +=
                        ` <div class="university-details">
                            <h2>Study ${data.coursename} in ${data.collegename}</h2>
                            <div class="course-details">
                                <h3>Minimum Requirements</h3>
                                <p>${academicRequirements.join(', ')}</p>
                                <p>${englishRequirements.join(', ')}</p>
                            </div>
                            <a href="../course-info/course-info.php?collegeID=${data.collegeID}&courseID=${data.courseID}">Explore 
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="25px" width="25px" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path>
                                </svg>
                            </a>
                        </div>`;
                });
            } else {
                console.log("Invalid response format: expected an array");
            }
        } catch (error) {
            console.log("Error Occurred", error);
        }
    }
//filtered fetch
async function fetchData (query) {
        try {
            const response = await fetch(url, {
                method: "POST",
                body: JSON.stringify(query),
                headers: {
                    "Content-Type": "application/json"
                },
            });
            if (!response.ok) {
                throw new Error("Response Error");
            }
            const result = await response.json();
            console.log(result);
            const universitiesDetials = document.querySelector('.university-container');
            universitiesDetials.innerHTML = '';
            if (Array.isArray(result)) {
                result.forEach(data => {
                    const academicRequirements = data.academic_requirements.split(',').map(req => req.trim());
                    const englishRequirements = data.english_requirements.split(',').map(req => req.trim());

                    universitiesDetials.innerHTML +=
                        ` <div class="university-details">
                            <h2>Study ${data.coursename} in ${data.collegename}</h2>
                            <div class="course-details">
                                <h3>Minimum Requirements</h3>
                                <p>${academicRequirements.join(', ')}</p>
                                <p>${englishRequirements.join(', ')}</p>
                            </div>
                            <a href="../college-course-explore/college-course-explore.php?collegeID=${data.collegeID}&courseID=${data.courseID}">Explore 
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="25px" width="25px" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path>
                                </svg>
                            </a>
                        </div>`;
                });
            } else {
                const universitiesDetials = document.querySelector('.university-container');
            universitiesDetials.innerHTML = '<h2> No Universities Found <h2>';
            }
        } catch (error) {
            console.log("Error Occurred", error);
        }
    }
    if(countryParam!='all'){
            document.querySelector('.filter').style.display= 'none';
    }
    
if(countryParam=='all'){
        document.querySelector('#search').addEventListener('change', searchByCountry);

}
function searchByCountry(){
   const query ={
        country:document.querySelector('#search').value,
    }
    fetchData(query);
    console.log(query);

}

document.querySelector('#state').addEventListener('change', searchByState);

    function searchByState() {
        let country;
        if(countryParam!=='all'){
           country=countryParam;
        }
        else{
         country = document.querySelector('#search').value;
     }
        const state = document.querySelector('#state').value;
        const query={
            country:country,
            state :state,
        }
        fetchData(query);
        document.querySelector('#state').value
        console.log(query);

    }

    document.querySelector('#program').addEventListener('change', searchByProgram);

    function searchByProgram() {
        let country;
        if(countryParam!=='all'){
            country=countryParam;
        }
        else{
         country = document.querySelector('#search').value;
     }
        const program = document.querySelector('#program').value;
        const state = document.querySelector('#state').value;
        const  query={
            country:country,
            state:state,
            program:program,

        }
        fetchData(query);
        console.log(query);
    }


    </script>

</body>

</html>