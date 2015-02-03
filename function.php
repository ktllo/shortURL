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
        return 0;
    else
        return $_SESSION['uflag'];
}

function login($user,$password,$mode=SU_AUTH_PASSWORD){
    global $db;
    if($mode = SU_AUTH_PASSWORD){
        $stmt = $db->prepare('SELECT * FROM '.SU_TABLE_USER.'WHERE `uname`=?;');
        $stmt->execute(array($user));
        if($stmt->rowCount()==1){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password,$row['password']){
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['uid'] = $row['uid'];
                $_SESSION['uflag'] = $row['flags'];
                return true;
            }
        }
    }
    return false;
}
