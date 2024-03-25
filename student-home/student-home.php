<?php
require_once ('../includes/session.inc.php');
include_once('../nav/studentnav.php');
// echo'Session'.$_SESSION['studentID'];
if(!isset($_SESSION['studentID']) || empty($_SESSION['studentID']) ){
    header('location:/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="student-home.css">
    <title>Student Home</title>
</head>
<body>
    
    <div class="main-container">
        <h1>Your Study Abroad Solution</h1>
        <h2>Find Your Perfect Program</h2>
        <p>We will help you find and get into the perfect program in your dream destination.</p>

        <div class="information">
            <div class="information-container">
                <p>2000+</p>
                <p>Students Helped</p>
            </div>
            <div class="information-container">
                <p>1400+</p>
                <p>Programs Offered</p>
            </div>
            <div class="information-container">
                <p>200+</p>
                <p>Institutions</p>
            </div>
            <div class="information-container">
                <p>10+</p>
                <p>Destination Countries</p>
            </div>
        </div>

        <div class="text">
            <h1>Study in Your Dream Destination</h1>
        </div>
        <div class="destination-countries-container"> 
            <div class="destination-country">
                <img src="./country-img/USA.png" alt="">
                <h4>Study in USA</h4>
                <a href="../college-info/college-info.php?country=usa">Explore <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="25px" width="25px" xmlns="http://www.w3.org/2000/svg">
                        <path d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path>
                    </svg>
                </a>

            </div>
            <div class="destination-country">
                <img src="./country-img/CANADA.png" alt="">
                <h4>Study in CANADA</h4>
                <a href="../college-info/college-info.php?country=canada">Explore <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="25px" width="25px" xmlns="http://www.w3.org/2000/svg">
                        <path d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path>
                    </svg>
                </a>
            </div>

            <div class="destination-country">
                <img src="./country-img/AUSTRALIA.png" alt="">
                <h4>Study in AUSTRALIA</h4>
                <a href="../college-info/college-info.php?country='australia'">Explore <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="25px" width="25px" xmlns="http://www.w3.org/2000/svg">
                        <path d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path>
                    </svg>
                </a>
            </div>

            <div class="destination-country">
                <img src="./country-img/UK.png" alt="">
                <h4>Study in UK</h4>
                <a href="../college-info/college-info.php?country=uk">Explore <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="25px" width="25px" xmlns="http://www.w3.org/2000/svg">
                        <path d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path>
                    </svg>
                </a>
            </div>
            <div class="destination-country">
                <img src="./country-img/OTHERCOUNTRY.png" alt="">
                <h4>Study All Countries</h4>
                <a href="../college-info/college-info.php?country=all" target="_self">Explore <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="25px" width="25px" xmlns="http://www.w3.org/2000/svg">
                        <path d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

</body>

</html>