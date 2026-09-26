<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];
	
		
	$query = "select id,code,value
			  from affiliate_setting 
			  where is_delete = '0'
			   and is_active = '1'
			   and code ='001' 
			  ";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataAffiliateSetting = $tmp->fetch_array();


	$affiliateSetting = isset($dataAffiliateSetting['value']) ? $dataAffiliateSetting['value'] : 'http://example.com';

	$query = "select afs.id, afs.stuff_id, afs.id as affiliate_stuff_id, afs.stuff_id, afs.link_product_brosur,  afs.stuff_id, afs.point, afs.price,
	            afs.fee_affiliate_nominal, afs.fee_affiliate_percent,	
	            s.sku, s.name, s.stock, a.username
			  from affiliate_stuff as afs
			  inner join stuff as s
			   on s.id = afs.stuff_id
			  inner join affiliate as a
			   on a.id = afs.affiliate_id 
			  where afs.affiliate_id = '{$userId}'
			    and afs.is_delete = '0'
			  ";

	$data= $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	
	include_once 'sbiz/lib/connection-close.php';
?>
