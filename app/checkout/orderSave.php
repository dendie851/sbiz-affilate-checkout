<?php 
	@session_start();

	include_once 'sbiz/lib/connection.php';

	// ---------------------------------------------------------------
	// Simpan pesanan produk affiliate (PUBLIK - tanpa auth)
	// ---------------------------------------------------------------

	$affiliateUsername   = general::secureInput(trim($_POST['affiliateUsername']));
	$affiliateProductId  = general::secureInput(trim($_POST['affiliateProductId']));

	$name                = general::secureInput(trim($_POST['name']));
	$phone               = general::secureInput(trim($_POST['phone']));
	$address             = general::secureInput(trim($_POST['address']));
	$note                = general::secureInput(trim($_POST['note']));
	$amount              = (int)general::secureInput(trim($_POST['amount']));

	// data wilayah hasil lookup (kode pos)
	$districtId          = (int)general::secureInput(trim($_POST['districtId']));
	$postalCode          = general::secureInput(trim($_POST['postalCode']));

	// jasa pengiriman : disembunyikan dulu pada form order
	$expeditionId        = 0;

	// ---------------------------------------------------------------
	// Validasi input (pola $msgError sama dengan modul sbiz-php)
	// ---------------------------------------------------------------
	include_once 'app/checkout/orderValidate.php';

	$urlBack = $globalUrl.$affiliateUsername.'/'.$affiliateProductId;

	if(count($msgError) > 0) {
		$globalConDBMySQL->close();
		header('Location: '.$globalUrl.'checkout/order?affiliateUsername='.$affiliateUsername.'&affiliateProductId='.$affiliateProductId.'&msg=validation');
		exit;
	}

	// ---------------------------------------------------------------
	// Ambil ulang data produk dari DB (jangan percaya harga dari form)
	// ---------------------------------------------------------------
	$query = "select afs.id, afs.affiliate_id, afs.stuff_id, afs.price, afs.price_basic,
				afs.fee_affiliate_nominal, afs.fee_affiliate_percent, afs.point,
				s.name, s.nickname, s.stock, s.price as price_master, s.price_basic as price_basic_master, s.fee_sales
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

	if(!is_array($dataProduct) || !isset($dataProduct['id'])) {
		$globalConDBMySQL->close();
		header('Location: '.$urlBack);
		exit;
	}

	
	$stuffId          = (int)$dataProduct['stuff_id'];
	$affiliateId      = (int)$dataProduct['affiliate_id'];
	$affiliateStuffId = (int)$dataProduct['id'];

	$stuffName      = $dataProduct['name'];
	$stuffNickname  = $dataProduct['nickname'];
	$stuffStock     = (int)$dataProduct['stock'];

	// harga jual ke pembeli : pakai harga affiliate bila diisi, jika 0 pakai harga master
	$priceAffiliate = (double)$dataProduct['price'];
	$priceMaster    = (double)$dataProduct['price_master'];
	$price          = $priceAffiliate > 0 ? $priceAffiliate : $priceMaster;

	// harga dasar (HPP) : pakai harga dasar affiliate bila diisi, jika 0 pakai harga dasar master
	$priceBasicAffiliate = (double)$dataProduct['price_basic'];
	$priceBasicMaster    = (double)$dataProduct['price_basic_master'];
	$priceBasic          = $priceBasicMaster;

	$feeSales       = (double)$dataProduct['fee_sales'];

	$feeAffiliateNominal = (double)$dataProduct['fee_affiliate_nominal'];
	$feeAffiliatePercent = (double)$dataProduct['fee_affiliate_percent'];
	$affiliatePoint      = (double)$dataProduct['point'];

	// ---------------------------------------------------------------
	// Cek ketersediaan stok
	// ---------------------------------------------------------------
	if($amount < 1 || $amount > $stuffStock) {
		$globalConDBMySQL->close();
		header('Location: '.$urlBack.'?msg=stock');
		exit;
	}

	// ---------------------------------------------------------------
	// Ambil ulang data wilayah dari DB (jangan percaya isian form)
	// ---------------------------------------------------------------

	$query = "select id, province_name, city_name, disctrict_name, subdistrict_name, zip_code, country_name
			  from postcal_code
			  where id = '{$districtId}'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataDistrict = $tmp->fetch_array();

	if(!is_array($dataDistrict) || !isset($dataDistrict['id'])) {
		$globalConDBMySQL->close();
		header('Location: '.$globalUrl.'checkout/order?affiliateUsername='.$affiliateUsername.'&affiliateProductId='.$affiliateProductId.'&msg=validation&general=kode pos tidak ditemukan');
		exit;
	}

	$districtCode = $dataDistrict['id'];
	$districtName = $dataDistrict['disctrict_name'];
	$city         = $dataDistrict['city_name'];
	$province     = $dataDistrict['province_name'];
	$postalCode   = $dataDistrict['zip_code'];
	$country   	  = $dataDistrict['country_name'];
	$subdistrictName = $dataDistrict['subdistrict_name'];

	// ---------------------------------------------------------------
	// Cari / buat data client berdasarkan nomor telepon
	// ---------------------------------------------------------------
	$countryCode = substr($phone,0,2); 
	$phoneSplit = substr($phone,2); 

	$query = "select id
			  from customer
			  where phone_number = '{$phoneSplit}'
			   and country_code = {$countryCode}
			   and is_delete = '0'
			  order by id
			  limit 1";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataClient = $tmp->fetch_array();

	if(is_array($dataClient) && isset($dataClient['id'])) {
		$clientId = (int)$dataClient['id'];

		$query = "update customer
				   set name = '{$name}',
				     city = '{$city}'
				   where id = '{$clientId}'";

		$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	} else {
		$query = "insert into customer
				   set name = '{$name}',
				   	  country_code = {$countryCode},	
				       phone_number = '{$phoneSplit}',
				       date_input = now(),
				       city = '{$city}',
					   sales_id = '1'";

		$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));


		$query = "insert customer_group
				   set customer_id = (select max(id) as id from customer),
				   	  client_id = '1'";

		$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	
		$clientId = (int)$globalConDBMySQL->insert_id;
	}

	// ---------------------------------------------------------------
	// Generate nomor order (pola sama dengan modul salesOrderAffiliate)
	// ---------------------------------------------------------------
	$year = date('y');

	$query = "select max(no_order) + 1 as no_new
			  from sales_order 
			  where substr(no_order,1,2) = '{$year}'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataNoOrder = $tmp->fetch_array();
	$noOrder = isset($dataNoOrder['no_new']) ? $dataNoOrder['no_new'] : '';

	if(strlen($noOrder) < 1 || $noOrder == '0') {
		$noOrder = $year.'000001';
	}

	$dateOrder = date('Y-m-d');

	// ---------------------------------------------------------------
	// Hitung total
	// ---------------------------------------------------------------
	$amountSale          = $price * $amount;
	$amountBasicSale     = $priceBasic * $amount;
	$amountFeeAffiliate  = $feeAffiliateNominal * $amount;
	$affiliatePointTotal = $affiliatePoint * $amount;

	// ---------------------------------------------------------------
	// Simpan sales_order
	// ---------------------------------------------------------------
	$query = "insert into sales_order
			   set client_id = '{$clientId}',
			       sales_id = '0',
			       reseller_id = '0',
			       affiliate_id = '{$affiliateId}',
			       expedition_id = '{$expeditionId}',
			       period_order_id = '0',
			       no_order = '{$noOrder}',
			       name = '{$name}',
			       phone = '{$phone}',
			       address_shipping = '{$address}',
			       tipe_order = '0',
			       description_payment = '{$note}',
			       description_shipping = '',
			       discount_persen = '0',
			       discount_amount = '0',
			       amount_sale = '{$amountSale}',
			       amount_basic_sale = '{$amountBasicSale}',
			       amount_fee_affiliate = '{$amountFeeAffiliate}',
			       shipping_cost = '0',
			       no_resi = '',
			       marketplace = '',
			       country = '{$country}',
			       province = '{$province}',
			       city = '{$city}',
			       districts = '{$districtName}',
			       districts_sub = '{$subdistrictName}',
			       postal_code = '{$postalCode}',
			       date_order = '{$dateOrder}',
			       status_order = '4',
			       status_payment = '0',
			       is_affiliate = '1'";

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	$salesOrderId = (int)$globalConDBMySQL->insert_id;

	// ---------------------------------------------------------------
	// Simpan sales_order_detail
	// ---------------------------------------------------------------
	$query = "insert into sales_order_detail
			   set sales_order_id = '{$salesOrderId}',
			       stuff_id = '{$stuffId}',
			       price_basic = '{$priceBasic}',
			       price = '{$price}',
			       fee_sales = '{$feeSales}',
			       affiliate_fee_nominal = '{$feeAffiliateNominal}',
			       affiliate_fee_percent = '{$feeAffiliatePercent}',
			       amount = '{$amount}',
			       discount_persen = '0',
			       discount_money = '0',
			       name = '{$stuffName}',
			       nickname = '{$stuffNickname}',
			       is_bundling = '0',
			       affiliate_point = '{$affiliatePointTotal}'";

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	// ---------------------------------------------------------------
	// Kurangi stok & catat history stok
	// ---------------------------------------------------------------
	$query = "update stuff
			   set stock = stock - '{$amount}'
			   where id = '{$stuffId}'";

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	$descriptionHistory = "Penjualan Barang dgn No Sales Order : $noOrder";

	$query = "insert into stuff_history
			   set stuff_id = '{$stuffId}',
			       tipe = '0',
			       amount = '-$amount',
			       date = now(),
			       description = '{$descriptionHistory}',
			       price = '{$price}',
			       client_id = '{$clientId}',
			       sales_order_id = '{$salesOrderId}'";

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	// ---------------------------------------------------------------
	// Simpan data pesanan pada session untuk halaman konfirmasi & tracking
	// ---------------------------------------------------------------
	$_SESSION['checkoutOrder'] = array(
		'salesOrderId'       => $salesOrderId,
		'noOrder'            => $noOrder,
		'affiliateUsername'  => $affiliateUsername,
		'affiliateProductId' => $affiliateProductId,
		'affiliateStuffId'   => $affiliateStuffId,
		'clientId'           => $clientId,
		'name'               => $name,
		'phone'              => $phone,
		'total'              => $amountSale,
	);

	include_once 'sbiz/lib/connection-close.php';

	header('Location: '.$globalUrl.'checkout/confirmation?noOrder='.$noOrder);
	exit;
?>
