<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	$query = "select so.id, so.no_order, so.name, so.date_order
			  from sales_order as so
			  where so.affiliate_id = '{$userId}'
			   and so.is_affiliate = '1'
			   and so.is_delete = '0' ";

	$data = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';
?>
