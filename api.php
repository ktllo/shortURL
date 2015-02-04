<?php
define('SU_RUN',0);
include_once 'config.php';
include_once 'constant.php';
include_once 'dbconn.php';
include_once 'function.php';


if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('HTTP/1.1 480 Malformed Request');
    return;
}

if($_POST['action'] == 'add'){
    include 'api_add.php';
}
