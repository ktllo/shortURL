<?php
require 'includes/geoip2.phar';
use GeoIp2\Database\Reader;
define('SU_RUN',0);
include_once 'config.php';
include_once 'constant.php';
include_once 'dbconn.php';
$target = $_GET['id'];

//Handle incorrect type of ID
if( SU_ID_TYPE == 58){
    $target = str_replace(array('0','1','l','o'),array('O','I','I','O'),$target);
}if( SU_ID_TYPE == 36 ){
    $target = str_replace(array('l'),array('I'),$target);
    $target = strtoupper($target);
}else{
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
if(!($row['flags'] & SU_FLAG_ENABLE)){
    header("HTTP/1.1 403 Forbidden");
    include 'info/403.php';
    return;
}
#TODO : Logging
$needLog = true;
#TODO : Check is logging needed
if($needLog){
    $reader = new Reader(SU_GEO_DB);
    try{
        $record = $reader->city($_SERVER['REMOTE_ADDR'])->country->isoCode;
    }catch(GeoIp2\Exception\AddressNotFoundException $e){
        $record = 'XX';
    }
    if(empty($_SERVER['HTTP_REFERER']))
        $refer = '';
    else
        $refer =$_SERVER['HTTP_REFERER']; 
    $stmt = $db->prepare('INSERT INTO `su_log`(`id`,`num`,`datetime`,`source`,`refer`,`country`) VALUES (?,ROUND(RAND()*1000000000),NOW(),?,?,?);');
    $stmt->execute(array($target,$_SERVER['REMOTE_ADDR'],$refer,$record));

}

header('Location: '.$row['url']);
