<?php
include_once('../nav/collegenav.php')


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
        <div class="main-container">
            <div class="status">
                <p>Applications</p>
                <p>0</p>
                <p>Pending </p>
            </div>
            <div class="status">
                <p>Applications</p>
                <p>1</p>
                <p>Approved </p>
            </div>
            <div class="status">
                <p>Applications</p>
                <p>0</p>
                <p>Rejected</p>
            </div>
        </div>
        <div class="applications">
            <table>
                <th>
                <td>Student Name</td>
                <td>Course</td>
                <td>Status</td>
                <td>View Documents</td>
                </th>
                <tr>

                </tr>
            </table>
        </div>
    </div>
    <script>
        const addcollege = document.querySelector('#addcollege');
        addcollege.addEventListener('click', () => {
            window.location.href = "../add-course/add-course.php";
        });
    </script>
</body>

</html>