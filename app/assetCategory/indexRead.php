<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';
	$isActive =  isset($_GET['isActive']) ? general::secureInput(trim($_GET['isActive'])) : '1';

	$query = "select id, name, is_active
			  from asset_category
			  where is_delete = '0'
			  order by name";

	$data = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';
?>
