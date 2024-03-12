<?php
  if(session_status()==PHP_SESSION_NONE){
  session_start();
  }
  $servername = "localhost"; 
  $dBUsername = "root";
  $dBPassword = "";
  $dBName = "abroadcollegesystem";
  $conn=mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

  if (!$conn) {
    die("Connection Failed: ".mysqli_connect_error());
  }