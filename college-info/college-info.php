<?php
require_once('../includes/session.inc.php');
include_once('../nav/studentnav.php');
// echo'Session'.$_SESSION['studentID'];
if (!isset($_SESSION['studentID']) || empty($_SESSION['studentID'])) {
    header('location:/index.php');
    exit();
}
if (isset($_GET['country'])) {
    $country = $_GET['country'];
} else {
    $country = '';
}
echo 'country:' . $country;
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
    <?php
    if (!empty($country)) {
        echo `
    <label for="country">Country</label>
    <input type="search" id=search placeholder="search country">
    `;
    }
    ?>

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
                    <?php
                    if (empty($country)) {
                        echo `
                    <th>Country</th>`;
                    }
                    echo 'result:'. empty($country);
                    ?>
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
                <!-- <tr>
                    <td>loregdjkj</td>
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
            const country = "<?php echo $country; ?>";
            console.log('country: ', country)
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
                    let result = await response.json();
                    console.log(result);
                    const tableBody = document.querySelector('#table-body');

                    if (Array.isArray(result)) { // Check if result is an array
                        result.forEach(data => {
                            const tr = document.createElement('tr');
                            tr.setAttribute('id', data.courseID);

                            if (country == null) {
                                tr.innerHTML = `<td>${data.country}</td>`
                            };
                            tr.innerHTML += `
                            <td>${data.collegename}</td>
                            <td>${data.state}</td>
                            <td>${data.city}</td>
                            <td id=${data.courseID}>${data.coursename}</td>
                            <td>${data.level}</td>
                            <td>${data.duration} Semester</td>
                            <td>${data.course_fee}</td>
                            <td><button id =${data.courseID}> view </button> </td>`;

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