<?php 
include dirname(__FILE__).'/../config/config.php';

$globalConDBMySQL = mysqli_connect($config['dbMySQL-2']['server'],$config['dbMySQL-2']['username'],$config['dbMySQL-2']['password'],$config['dbMySQL']['database']);
$globalConDBMySQL->query("SET SESSION sql_mode=''");
 
?>
