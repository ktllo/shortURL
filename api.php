<?php
define('SU_RUN',0);
include_once 'config.php';
include_once 'constant.php';
include_once 'dbconn.php';
include_once 'function.php';
if($_POST['action']=='new'){
    include 'api_add.php';
    return;
}
if($_POST['action']=='list'){
    include 'api_list.php';
    return;
}

if($_POST['action']=='enable'){
    include 'api_enable.php';
    return;
}
if($_POST['action']=='disable'){
    include 'api_disbale.php';
    return;
}
if($_POST['action'] == 'password'){
    include 'api_password.php'; 
    return;
}
