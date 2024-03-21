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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Home</title>
    <link rel="stylesheet" href="college-home.css">
</head>

<body>
    <div class="content">
        <div class="text">
            <h1>Welcome to College Home</h1>
        </div>
        <!-- min req section -->
        <div class="add-link">
        <ul>
           <li><a href="#">Min Requirements</a>
                <ul>
                    <li><a href="..\add-requirement.php\add-requirement.php">Add</a></li>
                    <li><a id="showcourse">Update</a></li>
                </ul>
            </li>
            
        </ul>
        </div>
        <div class="main-container">
            <div class="status">

                <p>0</p>
                <p>Applications</p>
                <p>Pending </p>
            </div>
            <div class="status">

                <p>1</p>
                <p>Applications</p>
                <p>Approved </p>
            </div>
            <div class="status">

                <h3>0</h3>
                <p>Applications</p>
                <p>Rejected</p>
            </div>
        </div>
        <div class="applications">
            <div class="applications-table">
                <table class="tableClass">
                    <thead>
                        <tr>

                            <!-- <th id=countryColumn>Country</th>

                            <th>Student Name</th>
                            <th>Country</th>
                            <th>Course</th>
                            <th>Level</th>
                            <th>Course</th>
                            <th>View</th>
                        </tr>
                    </thead> -->
                    <tbody id="tableBody">

                    </tbody>

                </table>

            </div>
        </div>
    </div>
    <script>
        // const addcollege = document.querySelector('#addcollege');
        // addcollege.addEventListener('click', () => {
        //     window.location.href = "../add-course/add-course.php";
        // });
    </script>
</body>

</html>