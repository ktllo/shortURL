<?php
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
