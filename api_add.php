<?php
if(!(getUserFlag() & SU_USER_ADDURL)){
?>
{
    "Code"  : 403,
    "Info"  : "No Permission" 
}
<?php
    return;
    }
    if(empty($_POST['url'])){
?>
{
    "Code" : 480,
    "Info" : "Malformed request",
    "Details" : "url required"
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
    $count = 0;
    if(isset($_POST['id'])){
        #Use given ID
        $id = $_POST['id'];
        for($i=0;$i<strlen($id);$i++){
            $char = $id{$i};
            if(strpos($idSpace,$char) === false){
?>
{
    "Code" : 481,
    "Info" : "Illegal Character",
    "id" : "<?php echo $id;?>",
    "detail" : "Legal characters are <?php echo $idSpace;?>",
    "violoating" : "<?php echo $id{$i};?>"
}
<?php
                return;
            }
        }
        #ID Looks OK. Attempts to insert
        $stmt = $db->prepare('INSERT INTO '.SU_TABLE_ENTRY.
            ' (`id`,`url`,`flags`,`created`,`owner`,`source`) VALUES'.
            ' (?,?,?,NOW(),?,?);');
        $stmt->execute(array($id,$url,SU_DEFAULT_URL_FLAGS,checkAuth(),$_SERVER['REMOTE_ADDR']));
        if($stmt->rowCount()!=1){
?>
{
    "Code" : "481",
    "Info" : "ID in use",
    "id" : "<?php echo $id;?>"
}
<?php
            return;
        }
    }else{
        while(true){
            $stmt = $db->prepare('INSERT INTO '.SU_TABLE_ENTRY.
                ' (`id`,`url`,`flags`,`created`,`owner`,`source`) VALUES'.
                ' (?,?,?,NOW(),?,?);');
            $id = '';
            for($i=0;$i<SU_ID_LENGTH;$i++){
                $id.=$idSpace{rand(0,SU_ID_TYPE-1)};
            }
            $stmt->execute(array($id,$url,SU_DEFAULT_URL_FLAGS,checkAuth(),$_SERVER['REMOTE_ADDR']));
            $count++;
            if($stmt->rowCount()==1){
                break;
            }
        }
    }
?>
{
    "Code"  : 200,
    "id" : "<?php echo $id;?>",
    "long"  : "<?php echo $url?>",
    "round" : <?php echo $count;?>,
    "short" : "<?php echo SU_BASE_URL."/$id";?>"
}
