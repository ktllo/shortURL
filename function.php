<?php
include_once 'constant.php';
include_once 'config.php';
/**
 *  This function will check is the user authorized to the server.
 *  Will return 0 if not authorized.
 */
function checkAuth($mode=SU_WEB){
    if($mode == SU_WEB){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(empty($_SESSION['uid']))
            return 0;
        else
            return $_SESSION['uid'];
    }
    return -1;
}

function getUserFlag(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(empty($_SESSION['uid']))
        return SU_ANONYMOUS;
    return $_SESSION['uflag'];
}

function processURL($url){
    global $permittedSchema;
    $pos = strpos($url,'://');
    if($pos === false){
        return SU_DEFAULT_SCHEMA.'://'.$url;
    }
    $schema = substr($url,0,$pos);
    foreach($permittedSchema as $target){
        if($schema == $target)
            return $url;
    }
    return false;
}

