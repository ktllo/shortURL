<?php
define('SU_RUN',0);
include_once 'config.php';
include_once 'constant.php';
include_once 'dbconn.php';
include_once 'function.php';
$stmt = $db->prepare('SELECT * FROM '.SU_TABLE_USER.' WHERE `uname`=?;');
$stmt->execute(array($_POST['uname']));
if($stmt->rowCount()==1){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(password_verify($_POST['password'],$row['password'])){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['uflag'] = $row['flags'];
        header('location: ./');
        return;    
    }
}
header('location: ./?msg=0');
