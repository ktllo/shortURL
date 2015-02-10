<?php

include "includes/phpqrcode/qrlib.php";
define('SU_RUN',0);
include_once 'config.php';
include_once 'constant.php';
include_once 'dbconn.php';
$target = $_GET['id'];

//Handle incorrect type of ID
if( SU_ID_TYPE == 58){
    $target = str_replace(array('0','1','l','o'),array('O','I','I','O'),$target);
}else if( SU_ID_TYPE == 36 ){
    $target = str_replace(array('l'),array('I'),$target);
    $target = strtoupper($target);
}else if( SU_ID_TYPE == 34 ){
    $target = str_replace(array('0','1','l','o'),array('O','I','I','O'),$target);
    $target = strtoupper($target);
}
$stmt = $db->prepare('SELECT * FROM '.SU_TABLE_ENTRY.' WHERE `id`=?');
$stmt->execute(array($target));
if($stmt->rowCount() == 0){
    header("HTTP/1.1 404 Not Found");
    include 'info/404.php';
    return;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(!($row['flags'] & SU_FLAG_ENABLE) || ($row['flags'] & SU_FLAG_ADMIN_DISABLE)){
    header("HTTP/1.1 403 Forbidden");
    include 'info/403.php';
    return;
}

QRcode::png(SU_BASE_URL.'/'.$target,false,QR_ECLEVEL_H,6,2);
