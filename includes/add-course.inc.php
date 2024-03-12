<?php
$rawdata = file_get_contents("php://input");

$data =json_decode( $rawdata, true );
var_dump( $data );

