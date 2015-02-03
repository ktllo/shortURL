<?php
include_once 'constant.php';
/**
 *  This function will check is the user authorized to the server.
 *  Will return 0 if not authorized.
 */
function checkAuth(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(empty($_SESSION['uid']))
        return 0;
    else
        return $_SESSION['uid'];
}

function getUserFlag(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(empty($_SESSION['uid']))
        return SU_ANONYMOUS;
    return $_SESSION['uflag'];
}


