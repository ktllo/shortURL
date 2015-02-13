<?php
define('SU_RUN',0);
include_once 'config.php';
include_once 'constant.php';
include_once 'dbconn.php';
include_once 'function.php';
define('UID',checkAuth());
?>
<!DOCTYPE html>
<html>
    <head>
        <title>URL Shorterner</title>
        <link rel="stylesheet" href="includes/jquery-ui.css">
        <script type="text/javascript" src="includes/jquery-2.0.3.js"></script>
        <script type="text/javascript" src="includes/jquery-ui.js"></script>
        
<script type="text/javascript">
function reloadList(){
    $.post('ajax.php',
        {action : 'list'},
        function(data){
//            alert(data);
            json = JSON.parse(data);
            $("#itemCount").html(json.count);
            items = json.data;
            $("#itemList").html('');
            for(i=0;i<json.count;i++){
                row='<tr><td><a href="<?php echo SU_BASE_URL;?>/'+json.data[i].id+'" target="_blank">'+json.data[i].id+'</a></td><td><a href="'+json.data[i].url+'" target="_blank">'+json.data[i].url+'</a></td><td>'+json.data[i].hit+'</td>';
                if(json.data[i].enabled){
                    row+='<td>Enabled</td><td><button onclick="disableLink(\''+json.data[i].id+'\');">Disable</button></td>';
                }else{
                    row+='<td>Disbaled</td><td><button onclick="enableLink(\''+json.data[i].id+'\');">Enable</button></td>';
                }
                row+='</tr>';
                $("#itemList").append(row);
            }
        }
    );
}
function disableLink(id){
    $.post('ajax.php',
            {
                action : 'disable',
                id : id
            }
    ,function(data){
        reloadList();
    });
}

function enableLink(id){
    $.post('ajax.php',
            {
                action : 'enable',
                id : id
            }
    ,function(data){
        reloadList();
    });
}
function changePassword(){
    var dialog =  $(document.createElement('div'));
    $( dialog ).attr('title','Change Password');
    $( dialog ).html('<table><tr><th>Old Password</th><td><input type="password" id="oldPassword"></td></tr><tr><th>New Password</th><td><input type="password" id="newpwd"></td></tr><tr><th>Retype new Password</th><td><input type="password" id="retypePassword"></td></tr></table>');
    $( dialog ).dialog({
            buttons: {
                Go : function() {
                    $( dialog ).dialog( "close" );
                    opwd = $( dialog ).find('#oldPassword').val();
                    npwd = $( dialog ).find('#newpwd').val();
                    rpwd = $( dialog ).find('#retypePassword').val();
                    if(npwd!=rpwd){
                        var error =  $(document.createElement('div'));
                        $( error ).attr('title','Error');
                        $( error ).html('Password does not match');
                        $( error ).dialog({ modal : true ,buttons:{OK : function(){  $( this ).dialog( "close" ); changePassword(); }}}).parent().addClass("ui-state-error");
                        return;
                    }
                    $.post('ajax.php',
                        {
                            action : 'password',
                            old : opwd,
                            new : npwd 
                        },
                        function(data){
                            result = JSON.parse(data);
                            if(result.Code == 200){
                                var error =  $(document.createElement('div'));
                                $( error ).attr('title','Hurray!');
                                $( error ).html('Password changed!');
                                $( error ).dialog();
                                return;
                            }else{
                                var error =  $(document.createElement('div'));
                                $( error ).attr('title','Error');
                                $( error ).html('Password incorrect');
                                $( error ).dialog({ modal : true ,buttons:{OK : function(){  $( this ).dialog( "close" ); changePassword(); }}}).parent().addClass("ui-state-error");
                                return;
                            }
                        }
                    );
                }
            }
        }
    );
}    

$(function(){
    <?php if(UID != 0){ ?>
    $("#logoff").button().click(
        function(event){
            window.location='logoff.php';
        }
    );
    $("#newPassword").button().click(
        function(event){
            changePassword();
        }  
    );
<?php }else{ ?>
    $("#login").button().click(
        function(event){
            document.getElementById('flogin').submit();
        }
    );
<?php }if(getUserFlag() & SU_USER_ADDURL){ ?>
   /* $( "#newURL" ).accordion({
        collapsible: true
});*/
    $( "#shortern" ).button().click(
        function(event){
            $.post('ajax.php',
                {
                    action : 'new',
                    url : document.getElementById('long').value
                },
                function(data, status){
                    json = JSON.parse(data);
                    if( json.Code == 200 ){
                        var dialog =  $(document.createElement('div'));
                        $( dialog ).attr('title','Hurray!');
                        $( dialog ).html('The short URL you requested is created.<br><a href="<?php echo SU_BASE_URL;?>/'+json.id+'" target="_blank"><?php echo SU_BASE_URL;?>/'+json.id+'</a>');
                        $('#lastID').html('<?php echo SU_BASE_URL;?>/'+json.id);
                        $( dialog ).dialog({
                            buttons: {
                                OK : function() {
                                    $( this ).dialog( "close" );
                                    }
                            }
                                
                            }
                        );
                        reloadList();
                    }else{
                        var dialog =  $(document.createElement('div'));
                        $( dialog ).attr('title','Error!');
                        $( dialog ).html('You are not allowed to add new URL because <span style="font-weight:bold">'+json.Info+'</span>');
                        $( dialog ).dialog({
                            buttons: {
                                OK : function() {
                                    $( this ).dialog( "close" );
                                    }
                                }
                            }
                        ).parent().addClass("ui-state-error");
                    }
                }
            
            );
        }
    );
<?php }if(isset($_GET['msg'])){ ?>
    $("#dialog").dialog(
        {
            modal : true,
            buttons: {
                OK : function() {
                    $( this ).dialog( "close" );
                }
            }
        }
    ).parent().addClass("ui-state-error");
<?php } ?>
    $("#reload").button({
        icons : {primary : "ui-icon-arrowrefresh-1-e"},
        text: false
    }) .click(function( event ) {
        reloadList();
    });
    
});


        </script>
    </head>
    <body onLoad="reloadList()">
        <?php if(isset($_GET['msg'])){ ?>
        <div id="dialog" title="Error">
            <p id="dialogMessage">Incorrect username/password</p>
        </div>
        <?php } ?>
        <div>
        <?php if(UID == 0){ ?>
            <form action="login.php" method="post" name="flogin" id="flogin">
                <label for="uname">User Name</label>
                <input name="uname" id="uname" type="text">
                <label for="password">Password</label>
                <input name="password" id="password" type="password">
                <button id="login">Login</button>
            </form>
        <?php }else{ ?>
            <button id="newPassword">Change Password</button>    
            <button id="logoff">Logoff</button>
        <?php } ?>
        </div>
        <?php if(getUserFlag() & SU_USER_ADDURL){ ?>
        <div id="newURL">
            <h3>Add New ShortURL</h3>
            <input type="text" name="url" id="long">
            <input type="button" id="shortern" value="Shorten!">
        </div>

	<div style="font-weight:bold">Please use user demo and password demo to login<br>Please note that the database will be reseted everday</div>
        <?php }if(checkAuth()!=0){ ?>
            <h3>Created items<button id="reload">Reload</button></h3>
            <div>You have <span id="itemCount">?</span> shortURL created.</div>
                <table>
                    <tr>
                       <th>ShortURL</th>
                       <th>URL</th>
                       <th>Hit Count</th>
                       <th>Status</th>
                       <th>Action</th>
                    </tr>
                    <tbody id="itemList">

                    </tbody>
                </table>
        <?php } ?>
        <hr/>
        URL Shortener Version <?php echo SU_VERSION;?>
        <div style="display:none;" id="lastID"></div>
    </body>
</html>
