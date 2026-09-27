<?php 
	// ---------------------------------------------------------------
	// Validasi input form order product affiliate
	// Mengembalikan array $msgError (pola sama dengan modul sbiz-php)
	// ---------------------------------------------------------------

	$msgError = array();

	$name       = isset($_POST['name']) ? general::secureInput(trim($_POST['name'])) : '';
	$phone      = isset($_POST['phone']) ? general::secureInput(trim($_POST['phone'])) : '';
	$address    = isset($_POST['address']) ? general::secureInput(trim($_POST['address'])) : '';
	$districtId = isset($_POST['districtId']) ? general::secureInput(trim($_POST['districtId'])) : '';
	$postalCode = isset($_POST['postalCode']) ? general::secureInput(trim($_POST['postalCode'])) : '';
	$note       = isset($_POST['note']) ? general::secureInput(trim($_POST['note'])) : '';
	$amount     = isset($_POST['amount']) ? (int)general::secureInput(trim($_POST['amount'])) : 0;

	
	if(strlen($name) < 3) {
		$msgError['name'] = 'Nama penerima minimal 3 karakter';
	}

	if(strlen($phone) < 8) {
		$msgError['phone'] = 'Nomor telepon minimal 8 karakter';
	} else {
		if(!preg_match('/^[0-9+()\-\s]+$/', $phone)) {
			$msgError['phone'] = 'Nomor telepon hanya boleh berisi angka';
		}
	}

	if(strlen($address) < 10) {
		$msgError['address'] = 'Alamat pengiriman minimal 10 karakter';
	}

	// wilayah wajib dipilih dari hasil lookup kode pos
	if(strlen($districtId) < 1 || (int)$districtId < 1 || strlen($postalCode) < 4) {
		$msgError['region'] = 'Silakan pilih kota / kecamatan dari daftar pencarian';
	}

	if($amount < 1) {
		$msgError['amount'] = 'Jumlah pembelian minimal 1';
	}
	

?>
