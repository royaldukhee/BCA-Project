<?php
include_once './session.inc.php';
session_unset();
session_destroy();
header("Location: http://localhost/BCA-Project/login/login.php?key=2");
exit();
