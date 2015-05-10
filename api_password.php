<?php if(checkAuth() == 0){?>
{
{"Code":403,"Info":"You have to login first"}
}
<?php    
    return;
    }
    #check old password
    $stmt = $db->prepare('SELECT * FROM '.SU_TABLE_USER.' WHERE `uid`=?;');
    $stmt->execute(array(checkAuth()));
    $ok = false;
    if($stmt->rowCount()==1){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(password_verify($_POST['old'],$row['password']))
            $ok = true;
    }
    if(!$ok){
?>
{"Code":403,"Info":"Incorrect password"}

<?php
        return;
    }
    #update password
    $hash = password_hash($_POST['new'],PASSWORD_DEFAULT);
    $stmt = $db->prepare('UPDATE '.SU_TABLE_USER.' SET `password`=? WHERE `uid`=?');
    $stmt->execute(array($hash,checkAuth()));
?>
{"Code":200,"Info":"Password updated"}
