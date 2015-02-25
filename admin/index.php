<?php
define('SU_RUN',0);
include_once '../config.php';
include_once '../constant.php';
include_once '../dbconn.php';
include_once '../function.php';
define('UID',checkAuth());
if(!(getUserFlag() & SU_USER_OPS)){
    header('HTTP/1.1 403 Forbidden');
    header('location: '.SU_BASE_URL);
    return;
}
$opLevel = getUserFlag() & SU_USER_OPS;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>URL Shorterner</title>
        <link rel="stylesheet" href="includes/jquery-ui.css">
        <script type="text/javascript" src="includes/jquery-2.0.3.js"></script>
        <script type="text/javascript" src="includes/jquery-ui.js"></script>
    </head>
    <body>
        <a href="<?php echo SU_BASE_URL;?>">Return to main user interface</a>
        <h1>Select Admin Function</h1>
        <ul>
            <?php if($opLevel > SU_ACCESS_USER_MGMT){ ?>
            <li>User Mangament</li>
            <?php } ?>
            <?php if($opLevel > SU_ACCESS_REVIEW_URL ||
                    $opLevel > SU_ACCESS_LOCK_URL ||
                    $opLevel > SU_ACCESS_UNLOCK_URL
            ){ ?>
            <li>Link Managenent</li>
            <?php } ?>

        </ul>
    </body>
</html>
