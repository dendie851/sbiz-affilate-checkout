<?php 
	@session_start();

	// ---------------------------------------------------------------
	// AJAX Endpoint - Lookup wilayah / kode pos
	// Sumber data : tabel district (code = kode pos, name = kecamatan,
	//               city = kota/kabupaten, province = provinsi)
	// Halaman ini PUBLIK (dipakai halaman order pembeli).
	// Format balikan : JSON (sama seperti pola modul API di project ini)
	// ---------------------------------------------------------------

	header('Content-Type: application/json');

	include_once 'sbiz/lib/connection.php';

	$keyword = isset($_REQUEST['keyword']) ? general::secureInput(trim($_REQUEST['keyword'])) : '';
	$keyword = str_replace(' ', '', $keyword);

	$result = array();
	$msgError = '';

	if(strlen($keyword) < 3) {
		$msgError = 'Minimal 3 karakter untuk mulai mencari';
	} else {
		// cari berdasarkan kode pos, kecamatan, atau kota/kabupaten
		$query = "select id, province_name, city_name, disctrict_name, subdistrict_name, zip_code
				  from postcal_code
				  where (replace(zip_code,' ','') like '%{$keyword}%'
				         or replace(disctrict_name,' ','') like '%{$keyword}%'
				         or replace(city_name,' ','') like '%{$keyword}%')
				  order by
				  	case when replace(zip_code,' ','') like '{$keyword}%' then 0 else 1 end,
				  	city_name, disctrict_name
				  limit 25";

		$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

		while($val = $tmp->fetch_array()) {
			$result[] = array(
				'id'         => $val['id'],
				'postalCode' => $val['zip_code'],
				'district'   => $val['disctrict_name'],
				'subdistrict'  => $val['subdistrict_name'],
				'city'       => $val['city_name'],
				'province'   => $val['province_name'],
				'city'       => $val['city_name'],
				'label'      => $val['city_name'].', '.$val['subdistrict_name'].', '.$val['zip_code']
			);
		}

		if(count($result) < 1) {
			$msgError = 'Wilayah tidak ditemukan';
		}
	}

	include_once 'sbiz/lib/connection-close.php';

	echo json_encode(array(
		'status'  => count($result) > 0 ? 'success' : 'error',
		'message' => $msgError,
		'total'   => count($result),
		'data'    => $result,
	));

	exit;
?>
