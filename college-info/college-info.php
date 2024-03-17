<?php
include_once '../nav/nav.php'
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
    <label for="country">Country</label>
    <input type="search" id=search placeholder="search country">
    <label for="state">State</label>
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
                    <th>Country</th>
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
            <tbody id="table-body">
              <tr>
                    <!-- <td>loregdjkj</td>
                    <td>hxkjlf</td>
                    <td>lfffnvcvnn</td>
                    <td>fcvb,mckm</td>
                    <td>xfhkmbkk</td>
                    <td>gjrjgjbjvod</td>
                    <td>xbmkjbdljkckc</td>
                    <td>fgkjijfgigxj</td>
                    <td>fkgkhgjhfbb</td>
                    <td><button id="view">view</button></td>
                </tr> -->
                        </tbody>

        </table>
        
    </div>
    <script>
    window.onload = async function initialFetch() {
        try {
            const response = await fetch('../includes/college-info.inc.php', {
                method: "POST",
                body: '',
                headers: {
                    "Content-Type": "application/JSON"
                },
            });
            if (!response.ok) {
                throw new Error("Response Error");
            } else {
                const result = await response.json();
                console.log(result);
                const tableBody = document.querySelector('#table-body');

                if (Array.isArray(result)) { // Check if result is an array
                    result.forEach(data => {
                        const tr = document.createElement('tr');
                        tr.id=data.courseID;
                        tr.innerHTML = `
                            <td>${data.country}</td>
                            <td>${data.collegename}</td>
                            <td>${data.state}</td>
                            <td>${data.city}</td>
                            <td id=${data.courseID}>${data.coursename}</td>
                            <td>${data.level}</td>
                            <td>${data.duration} Semester</td>
                            <td>${data.course_fee}</td>
                            <td><button> view </button> </td>`;

                        tableBody.appendChild(tr);
                    });
                } else {
                    console.log("Invalid response format: expected an array");
                }
            }
        } catch (error) {
            console.log("Error Occurred", error);
        }
    }
</script>

</body>
</html>