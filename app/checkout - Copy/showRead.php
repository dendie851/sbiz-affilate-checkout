<?php 
	@session_start();

	include_once 'sbiz/lib/connection.php';

	$affiliateUsername = general::secureInput(trim(globalFunctionUri(2, 1)));
	$affiliateProductId = general::secureInput(trim(globalFunctionUri(2, 2)));

	$query = "select afs.id, afs.affiliate_id, afs.stuff_id, afs.link_product_brosur, afs.price, afs.price_basic,
				afs.fee_affiliate_nominal, afs.fee_affiliate_percent, afs.point,
				a.name as affiliate_name, a.username as affiliate_username, a.city as affiliate_city,
				s.sku, s.name, s.nickname, s.stock, s.price as price_master, s.category_id, s.description,
				(select sc.name from stuff_category as sc where sc.id = s.category_id) as category_name
			  from affiliate_stuff as afs
			  inner join affiliate as a
			   on a.id = afs.affiliate_id
			  inner join stuff as s
			   on s.id = afs.stuff_id
			  where a.username = '{$affiliateUsername}'
			    and a.is_delete = '0'
			    and a.is_active = '1'
			    and afs.id = '{$affiliateProductId}'
			    and afs.is_delete = '0'
			    and s.is_delete = '0'
			    and s.is_hidden = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataProduct = $tmp->fetch_array();

	$hasProduct = is_array($dataProduct) && isset($dataProduct['id']) ? true : false;

	$showName           = $hasProduct ? $dataProduct['name'] : '';
	$showSku            = $hasProduct ? $dataProduct['sku'] : '';
	$showStock          = $hasProduct ? (int)$dataProduct['stock'] : 0;
	$showCategoryName   = $hasProduct && strlen(trim($dataProduct['category_name'])) > 0 ? $dataProduct['category_name'] : '-';
	$showAffiliateName  = $hasProduct ? $dataProduct['affiliate_name'] : '';
	$showAffiliateCity  = $hasProduct && strlen(trim($dataProduct['affiliate_city'])) > 0 ? $dataProduct['affiliate_city'] : '-';

	$showPriceNow       = $hasProduct ? $dataProduct['price'] : '';
	$showDescription    = $hasProduct ? $dataProduct['description'] : '';
	$showLinkProductBrosur  = $hasProduct ? $dataProduct['link_product_brosur'] : '';


	$showImage = $config['app']['assets'].'img/no-photo.png';

	$query = "select id, code, value
			  from affiliate_setting 
			  where is_delete = '0'
			   and is_active = '1'
			   and code = '001'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataAffiliateSetting = $tmp->fetch_array();

	$affiliateMasterLink = isset($dataAffiliateSetting['value']) ? $dataAffiliateSetting['value'] : $globalUrl;

	// link order akan diarahkan ke modul order (dibuat pada tahap berikutnya)
	$showUrlOrder = $globalUrl.'checkout/order?affiliateProductId='.$affiliateProductId.'&affiliateUsername='.$affiliateUsername;	
	
	include_once 'sbiz/lib/connection-close.php';
?>
