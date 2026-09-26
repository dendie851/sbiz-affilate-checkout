<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$id = general::secureInput(trim($_GET['id']));

	$query = "update asset_category
			   set is_delete = '1'
			  where id = '{$id}'";

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';

	header('Location: '.$globalUrl.'assetCategory/index?msg=deleteSuccess');

?>
