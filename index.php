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
        <script src="includes/jquery-2.0.3.js"></script>
        <script src="includes/jquery-ui.js"></script>
        <script>
$(function(){
    <?php if(UID != 0){ ?>
    $("#logoff").button().click(
        function(event){
            window.location='logoff.php';
        }
    );
<?php }else{ ?>
    $("#login").button().click(
        function(event){
            document.getElementById('flogin').submit();
        }
    );
<?php }if(getUserFlag() & SU_USER_ADDURL){ ?>
    $( "#newURL" ).accordion({
        collapsible: true
    });
    $( "#shortern" ).button().click(
        function(event){
            alert("Shortern!");
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
});
        </script>
    </head>
    <body>
        <?php if(isset($_GET['msg'])){ ?>
        <div id="dialog" title="Error">
            <p>Incorrect username/password</p>
        </div>
        <?php } ?>
        <div>
        <?php if(UID == 0){ ?>
            <form action="login.php" method="post" name="flogin" id="flogin">
                <label for="uname">User Name</label>
                <input name="uname" id="uname" type="text">
                <label for="password">User Name</label>
                <input name="password" id="password" type="password">
                <button id="login">Login</button>
            </form>
        <?php }else{ ?>
            <button id="logoff">Logoff</button>
        <?php } ?>
        </div>
        <?php if(getUserFlag() & SU_USER_ADDURL){ ?>
        <div id="newURL">
            <h3>Add New ShortURL</h3>
            <form>
                <label for="url">Shorten </label><input type="url" name="url" id="url">
                <button id="shortern">Shorten!</button>
            </form>
        </div>
        <?php } ?>


        <hr/>
        URL Shortener Version <?php echo SU_VERSION;?>
    </body>
</html>