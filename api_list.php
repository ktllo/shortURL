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
