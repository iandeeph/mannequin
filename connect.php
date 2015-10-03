<?php
//HOST MYSQL
$config['db_host'] = "localhost";
//USERNAME
$config['db_user'] = "root";
//PASS
$config['db_password'] = "c3rmat";
$config['db_name'] = "dbmannequin";

$conn=mysql_connect($config['db_host'], $config['db_user'], $config['db_password'], true) or die("Connection failed.");
$db=mysql_select_db($config['db_name'],$conn) or die('Database sedang dalam perbaikan !');
?>