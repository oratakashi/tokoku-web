<?php
error_reporting(E_ALL ^ E_DEPRECATED);
date_default_timezone_set('Asia/Jakarta');
$mysql_user="root";
$mysql_password="";
$mysql_database="aplikasikuco_dbs";
$mysql_host="localhost";
$koneksi_db = mysql_connect($mysql_host, $mysql_user, $mysql_password);
mysql_select_db($mysql_database, $koneksi_db);  
?>
