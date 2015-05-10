<?php
define('SU_RUN',0);
include_once 'config.php';
include_once 'constant.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['uid'] = 0;
$_SESSION['uflag'] = SU_ANONYMOUS &~SU_USER_OPS;
header('location: ./');
