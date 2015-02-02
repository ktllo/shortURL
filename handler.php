<?php
define('SU_RUN',0);
include_once 'config.php';
include_once 'constant.php';
include_once 'dbconn.php';
$target = $_GET['id'];
$stmt = $db->prepare('SELECT * FROM '.SU_TABLE_ENTRY.' WHERE `id`=?');
$stmt->execute(array($target));
if($stmt->rowCount() == 0){
    header("HTTP/1.1 404 Not Found");
    include 'info/404.php';
    return;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(!($row['flags'] & SU_FLAG_ENABLE)){
    header("HTTP/1.1 403 Forbidden");
    include 'info/403.php';
    return;
}
#TODO : Logging

header('Location: '.$row['url']);
