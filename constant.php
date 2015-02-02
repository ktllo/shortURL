<?php

##User Permission Bits
define('SU_USER_OP',            0x0001);    #Sys Admin
define('SU_USER_HOP',           0x0002);    #Half admin
define('SU_USER_SOP',           0x0003);    #Super admin
define('SU_USER_ADDURL',        0x0004);    #Able to add URL
define('SU_USER_APIUSE',        0x0008);    #Can use API
define('SU_USER_REMOVE',        0x0010);    #Can remove self created link
define('SU_USER_NOLOG',         0x0020);    #No log for link usage

##URL flags
define('SU_FLAG_ENABLE',        0x0001);    #URL enabled
define('SU_FLAG_NOLOG',         0x0002);    #No log for this entry
define('SU_FLAG_AUTH',          0x0004);    #Authorization needed

##DB Names
define('SU_TABLE_USER',SU_DB_PREFIX.'user');
define('SU_TABLE_ENTRY',SU_DB_PREFIX.'entry');
define('SU_TABLE_LOG',SU_DB_PREFIX.'log');

