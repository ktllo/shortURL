<?php
if(!defined('SU_RUN')){
    die('Running config.php directly is NOT allowed');
}

define('SU_DB_PATH','localhost');
define('SU_DB_USER','root');
define('SU_DB_PASS','rootpass');
define('SU_DB_NAME','SURL');
define('SU_DB_PREFIX','su_');

define('SU_ID_TYPE',34);//Can be 34,36,58,62

define('SU_GEO_DB','includes/GeoLite2-City.mmdb');
