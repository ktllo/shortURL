<?php
if(!defined('SU_RUN')){
    die('Running config.php directly is NOT allowed');
}



define('SU_DB_PATH','localhost');
define('SU_DB_USER','root');
define('SU_DB_PASS','rootpass');
define('SU_DB_NAME','SURL');
define('SU_DB_PREFIX','su_');

include_once 'constant.php';

define('SU_ID_TYPE',58);//Can be 34,36,58,62
define('SU_ID_LENGTH',5);//Upto 200
define('SU_DEFAULT_URL_FLAGS',  0x0001);    #Default flags for new entries
define('SU_USER_DEFAULT',       0x0004);    #Default flags for new users
define('SU_ANONYMOUS',          0x0000);    #Flags for unidentified user
define('SU_GEO_DB','includes/GeoLite2-City.mmdb');
define('SU_BASE_URL','http://localhost/short');
define('SU_LOG_GEOINFO',    true);
define('SU_DEFAULT_SCHEMA','http');
$permittedSchema=array('http','https','ftp','irc','ircs');

### Admin-permittion settings
#Notice the use of admin panel are available to all ops
#And changes of ops status are restricted to SOP only
#Please note the access level listed here are the minimum level required
#And please be reminded that SU_USER_HOP | SU_USER_OP = SU_USER_SOP
define('SU_ACCESS_USER_MGMT',   SU_USER_HOP);
define('SU_ACCESS_REVIEW_URL',  SU_USER_OP);
define('SU_ACCESS_LOCK_URL',    SU_USER_HOP);
define('SU_ACCESS_UNLOCK_URL',  SU_USER_SOP);
