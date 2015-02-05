<?php
if(!defined('SU_RUN')){
    die('Running config.php directly is NOT allowed');
}

define('SU_DB_PATH','localhost');
define('SU_DB_USER','root');
define('SU_DB_PASS','rootpass');
define('SU_DB_NAME','SURL');
define('SU_DB_PREFIX','su_');

define('SU_ID_TYPE',58);//Can be 34,36,58,62
define('SU_ID_LENGTH',5);//Upto 200
define('SU_DEFAULT_URL_FLAGS',  0x0001);
define('SU_USER_DEFAULT',       0x0004);    #Default flags for new users
define('SU_ANONYMOUS',          0x0000);    #Flags for unidentified user
define('SU_GEO_DB','includes/GeoLite2-City.mmdb');
define('SU_BASE_URL','http://localhost/short');

define('SU_DEFAULT_SCHEMA','http');
$permittedSchema=array('http','https','ftp','irc','ircs');
