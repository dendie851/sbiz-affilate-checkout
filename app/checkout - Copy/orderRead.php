<?php 
	@session_start();

	include_once 'sbiz/lib/connection.php';

	// ---------------------------------------------------------------
	// Halaman ini PUBLIK (dibuka oleh calon pembeli melalui link afiliasi)
	// sehingga TIDAK memakai auth::isAuth().
	// Halaman order diakses via : /checkout/order?affiliateUsername=x&affiliateProductId=y
	// ---------------------------------------------------------------

	$affiliateUsername = isset($_REQUEST['affiliateUsername']) ? general::secureInput(trim($_REQUEST['affiliateUsername'])) : '';
	$affiliateProductId = isset($_REQUEST['affiliateProductId']) ? general::secureInput(trim($_REQUEST['affiliateProductId'])) : '';

	$query = "select afs.id, afs.affiliate_id, afs.stuff_id, afs.link_product_brosur, afs.price, afs.price_basic,
				afs.fee_affiliate_nominal, afs.fee_affiliate_percent, afs.point,
				a.name as affiliate_name, a.username as affiliate_username, a.city as affiliate_city,
				s.sku, s.name, s.nickname, s.stock, s.price as price_master, s.price_basic as price_basic_master, s.category_id, s.description, s.fee_sales,
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

	// ---------------------------------------------------------------
	// Data produk untuk form order
	// ---------------------------------------------------------------
	$orderStuffId        = $hasProduct ? (int)$dataProduct['stuff_id'] : 0;
	$orderAffiliateId    = $hasProduct ? (int)$dataProduct['affiliate_id'] : 0;
	$orderAffiliateStuffId = $hasProduct ? (int)$dataProduct['id'] : 0;

	$orderName           = $hasProduct ? $dataProduct['name'] : '';
	$orderSku            = $hasProduct ? $dataProduct['sku'] : '';
	$orderStock          = $hasProduct ? (int)$dataProduct['stock'] : 0;
	$orderCategoryName   = $hasProduct && strlen(trim($dataProduct['category_name'])) > 0 ? $dataProduct['category_name'] : '-';
	$orderAffiliateName  = $hasProduct ? $dataProduct['affiliate_name'] : '';
	$orderAffiliateCity  = $hasProduct && strlen(trim($dataProduct['affiliate_city'])) > 0 ? $dataProduct['affiliate_city'] : '-';

	// harga jual ke pembeli : pakai harga affiliate bila diisi, jika 0 pakai harga master stuff
	$orderPriceAffiliate = $hasProduct ? (double)$dataProduct['price'] : 0;
	$orderPriceMaster    = $hasProduct ? (double)$dataProduct['price_master'] : 0;
	$orderPriceNow       = $orderPriceAffiliate > 0 ? $orderPriceAffiliate : $orderPriceMaster;
	$orderPriceBefore    = $orderPriceMaster > $orderPriceNow ? $orderPriceMaster : 0;

	// harga dasar (HPP) : pakai harga dasar affiliate bila diisi, jika 0 pakai harga dasar master stuff
	$orderPriceBasicAffiliate = $hasProduct ? (double)$dataProduct['price_basic'] : 0;
	$orderPriceBasicMaster    = $hasProduct ? (double)$dataProduct['price_basic_master'] : 0;
	$orderPriceBasic          = $orderPriceBasicAffiliate > 0 ? $orderPriceBasicAffiliate : $orderPriceBasicMaster;

	$orderImage = $config['app']['assets'].'img/no-photo.png';

	// ---------------------------------------------------------------
	// Jasa pengiriman : DISEMBUNYIKAN dulu (disimpan default 0)
	// Daftar expedisi tidak ditampilkan pada form order.
	// ---------------------------------------------------------------
	$orderExpeditionId = 0;

	// ---------------------------------------------------------------
	// Nilai default form (repopulate bila validasi gagal)
	// ---------------------------------------------------------------
	$msgError = array();

	if(isset($_GET['msg']) && $_GET['msg'] == 'validation') {
		$msgError['general'] = $_GET['general'];
	}

	$orderInputName     = isset($_POST['name']) ? general::secureInput(trim($_POST['name'])) : '';
	$orderInputPhone    = isset($_POST['phone']) ? general::secureInput(trim($_POST['phone'])) : '';
	$orderInputAddress  = isset($_POST['address']) ? general::secureInput(trim($_POST['address'])) : '';
	$orderInputNote     = isset($_POST['note']) ? general::secureInput(trim($_POST['note'])) : '';
	$orderInputAmount   = isset($_POST['amount']) ? (int)general::secureInput(trim($_POST['amount'])) : 1;

	if($orderInputAmount < 1) {
		$orderInputAmount = 1;
	}

	// ---------------------------------------------------------------
	// Data wilayah hasil lookup (diisi via AJAX / repopulate)
	// ---------------------------------------------------------------
	$orderInputDistrictId    = isset($_POST['districtId']) ? general::secureInput(trim($_POST['districtId'])) : '';
	$orderInputPostalCode    = isset($_POST['postalCode']) ? general::secureInput(trim($_POST['postalCode'])) : '';
	$orderInputDistrictName  = isset($_POST['districtName']) ? general::secureInput(trim($_POST['districtName'])) : '';
	$orderInputCity          = isset($_POST['city']) ? general::secureInput(trim($_POST['city'])) : '';
	$orderInputProvince      = isset($_POST['province']) ? general::secureInput(trim($_POST['province'])) : '';
	$orderInputRegionLabel   = isset($_POST['regionLabel']) ? general::secureInput(trim($_POST['regionLabel'])) : '';

	// ---------------------------------------------------------------
	// URL aksi form
	// ---------------------------------------------------------------
	$orderUrlSave   = $globalUrl.'checkout/orderSave';
	$orderUrlBack   = $globalUrl.$affiliateUsername.'/'.$affiliateProductId;
	$orderUrlLookup = $globalUrl.'checkout/postalLookup';

	include_once 'sbiz/lib/connection-close.php';
?>
