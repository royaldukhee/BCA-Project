<?php
include_once './session.inc.php';
session_unset();
session_destroy();
header("Location: http://localhost/index.php");
exit();
