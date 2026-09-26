<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$id = general::secureInput(trim($_POST['id']));		
	$name = general::secureInput(trim($_POST['name']));
	$isActive = general::secureInput(trim($_POST['isActive']));

	$query = "update asset_category 
			   set name = '{$name}',
			     is_active = '{$isActive}'
			   where id = '{$id}'";

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';

	header('Location: '.$globalUrl.'assetCategory/index?msg=editSuccess');

?>
