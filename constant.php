<?php
include_once 'config.php';
##User Permission Bits
define('SU_USER_HOP',           0x0001);    #Half admin
define('SU_USER_OP',            0x0002);    #Sys Admin
define('SU_USER_SOP',           0x0003);    #Super admin
define('SU_USER_OPS',           SU_USER_HOP | SU_USER_OP | SU_USER_SOP);    #All admin
define('SU_USER_ADDURL',        0x0004);    #Able to add URL
define('SU_USER_APIUSE',        0x0008);    #Can use API
define('SU_USER_REMOVE',        0x0010);    #Can remove self created link
define('SU_USER_NOLOG',         0x0020);    #No log for link usage


##URL flags
define('SU_FLAG_ENABLE',        0x0001);    #URL enabled
define('SU_FLAG_NOLOG',         0x0002);    #No log for this entry
define('SU_FLAG_AUTH',          0x0004);    #Authorization needed
define('SU_FLAG_ADMIN_DISABLE', 0x0008);    #Indicate the link is disable by admin
define('SU_FLAG_REVIEWED',      0x0010);    #Indicate the link is reviewed by admin
##Auth Mode
define('SU_AUTH_PASSWORD', 0);
define('SU_WEB', 0);

##DB Names
define('SU_TABLE_USER',SU_DB_PREFIX.'user');
define('SU_TABLE_ENTRY',SU_DB_PREFIX.'entry');
define('SU_TABLE_LOG',SU_DB_PREFIX.'log');

##ID Space
define('SU_ID_34','23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
define('SU_ID_36','0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
define('SU_ID_58','23456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz');
define('SU_ID_62','0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz');




define('SU_VERSION', '0.1-alpha-1');
