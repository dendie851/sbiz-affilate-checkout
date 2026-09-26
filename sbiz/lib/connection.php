<?php 
include dirname(__FILE__).'/../config/config.php';

$globalConDBMySQL = mysqli_connect($config['dbMySQL']['server'],$config['dbMySQL']['username'],$config['dbMySQL']['password'],$config['dbMySQL']['database']);
$globalConDBMySQL->query("SET SESSION sql_mode=''");
 
?>
