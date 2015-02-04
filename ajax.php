<?php
define('SU_RUN',0);
include_once 'config.php';
include_once 'constant.php';
include_once 'dbconn.php';
include_once 'function.php';
if($_POST['action']=='new'){
    if(!(getUserFlag() & SU_USER_ADDURL)){
        header("HTTP/1.1 403 Forbidden");
?>
{
    "Code"  : 403,
    "Info"  : "No Permission" 
}
<?php
    }
    if(SU_ID_TYPE == 34)
        $idSpace = SU_ID_34;
    else if(SU_ID_TYPE == 36)
        $idSpace = SU_ID_36;
    else if(SU_ID_TYPE == 58)
        $idSpace = SU_ID_58;
    else 
        $idSpace = SU_ID_62;
    //Prepare to add
    $count = 0;
    while(true){
        $stmt = $db->prepare('INSERT INTO '.SU_TABLE_ENTRY.
            ' (`id`,`url`,`flags`,`created`,`owner`) VALUES'.
            ' (?,?,?,NOW(),?);');
        $id = '';
        for($i=0;$i<SU_ID_LENGTH;$i++){
            $id.=$idSpace{rand(0,SU_ID_TYPE-1)};
        }
        $stmt->execute(array($id,$_POST['url'],SU_DEFAULT_URL_FLAGS,checkAuth()));
        $count++;
        if($stmt->rowCount()==1){
            break;
        }
    }
?>
{
    "Code"  : 200,
    "id" : "<?php echo $id;?>",
    "long"  : "<?php echo $_POST['url'];?>",
    "round" : <?php echo $count;?>
}
<?php
}
