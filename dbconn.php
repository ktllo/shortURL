<?php
include_once 'config.php';

$db = new PDO('mysql:host='.SU_DB_PATH.';dbname='.SU_DB_NAME,SU_DB_USER,SU_DB_PASS);
