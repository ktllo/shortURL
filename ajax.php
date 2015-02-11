<?php
define('SU_RUN',0);
include_once 'config.php';
include_once 'constant.php';
include_once 'dbconn.php';
include_once 'function.php';
if($_POST['action']=='new'){
    if(!(getUserFlag() & SU_USER_ADDURL)){
?>
{
    "Code"  : 403,
    "Info"  : "No Permission" 
}
<?php
    return;
    }
    $url = processURL($_POST['url']);
    if($url === false){?>
{
    "Code"  : 403,
    "Info"  : "Illegal URL Schema" 
}
<?php 
    return;
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
        $stmt->execute(array($id,$url,SU_DEFAULT_URL_FLAGS,checkAuth()));
        $count++;
        if($stmt->rowCount()==1){
            break;
        }
    }
?>
{
    "Code"  : 200,
    "id" : "<?php echo $id;?>",
    "long"  : "<?php echo $url?>",
    "round" : <?php echo $count;?>
}
<?php
    return;
}
if($_POST['action']=='list'){
    if(checkAuth() == 0){
?>
{
    "count" : 0,
    "data" : []
}
<?php
        return;
    }
    $uid = checkAuth();
    $stmt = $db->prepare('SELECT * FROM '.SU_TABLE_ENTRY.' WHERE `owner`=?');
    $stmt->execute(array($uid));
?>
{
    "count" : <?php echo $stmt->rowCount();?>,
    "data"  : [
<?php
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>
        {
        "id"    :   "<?php echo $row['id'];?>",
        "url"   :   "<?php echo $row['url'];?>",
<?php
        $details = $db->prepare('SELECT COUNT(*) FROM '.SU_TABLE_LOG.' WHERE `id`=?');
        $details->execute(array($row['id']));
        $detailRow = $details->fetch(PDO::FETCH_NUM);
?>
        "hit"   :   <?php echo $detailRow[0];?>,
        "enabled" : <?php echo ($row['flags'] & SU_FLAG_ENABLE); ?>
        },
<?php
    }
?>
    {}]
}
<?php
    return;
}

if($_POST['action']=='enable'){
    $target = $_POST['id'];
    #TODO: Check owner
    $uid = checkAuth();
    $stmt = $db->prepare('SELECT * FROM '.SU_TABLE_ENTRY.' WHERE `id`=?');
    $stmt->execute(array($target));
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if($record['owner']!=$uid){
?>
{"Code":403,"Info":"You does not own this entry"}
<?php
        return;
    }
    $db->beginTransaction();
    #Start transaction and disable autocommit
    #retrive current flag
    #calculate new flag(new = old & ~flag)
    $flag = $record['flags'] | SU_FLAG_ENABLE;
    $stmt = $db->prepare('UPDATE '.SU_TABLE_ENTRY.' SET `flags`=? WHERE `id`=?');
    $stmt->execute(array($flag,$target));
    $db->commit();
    #Commit and enable autocommit
    return;
}
if($_POST['action']=='disable'){
    $target = $_POST['id'];
    #TODO: Check owner
    $uid = checkAuth();
    $stmt = $db->prepare('SELECT * FROM '.SU_TABLE_ENTRY.' WHERE `id`=?');
    $stmt->execute(array($target));
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if($record['owner']!=$uid){
?>
{"Code":403,"Info":"You does not own this entry"}
<?php
        return;
    }
    $db->beginTransaction();
    #Start transaction and disable autocommit
    #retrive current flag
    #calculate new flag(new = old & ~flag)
    $flag = $record['flags'] & ~SU_FLAG_ENABLE;
    $stmt = $db->prepare('UPDATE '.SU_TABLE_ENTRY.' SET `flags`=? WHERE `id`=?');
    $stmt->execute(array($flag,$target));
    $db->commit();
    #Commit and enable autocommit
    return;
}
