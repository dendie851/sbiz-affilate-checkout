<?php 
	@session_start();

	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$id = general::secureInput(trim($_GET['id']));		

	$query = "select id, name, is_active
			  from asset_category
			  where id = '{$id}'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$data = $tmp->fetch_array();

	include_once 'sbiz/lib/connection-close.php';

?>
