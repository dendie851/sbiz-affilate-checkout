<?php
	$globalModul = globalFunctionUri(2);	
	$globalModul = str_replace(explode('/',$config['app']['path']), '', $globalModul);

	if(strlen(str_replace('/', '', $globalModul)) < 1) {
		$globalModul = $config['app']['homepage'];
	}

	// =================================================================
	// ROUTING PUBLIK - SBiZ Affiliate Checkout
	// Format URL : https://server/{username}/{affiliate-product-id}
	// Contoh     : https://namadomain.com/jokowi/prod-12345
	// Pembeli TIDAK perlu login. Halaman ini tidak boleh menimpa
	// route internal (modul/aksi) yang sudah didefinisikan di switch.
	// =================================================================

	switch ($globalModul) {		
	case (globalFunctionUri(2) == 'home/dashboard'): 
			language::set($config['app']['language']);
			$globalModulActive = 'home';
			$globalViewScroolGroupMenu = 'grupMenuDashboard';												
			include_once 'app/home/index.php';
		break;		
	default:
			$globalModulActive = 'checkout';
			$globalViewScroolGroupMenu = 'grupCheckout';												
			include_once 'app/checkout/show.php';
		break;
	}


	function globalFunctionUri($indexLast,$position=0) {
		$globalUri = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		if($indexLast == 4) {
			$globalModul = $globalUri[count($globalUri)-4].'/'.$globalUri[count($globalUri)-3].'/'.$globalUri[count($globalUri)-2].'/'.$globalUri[count($globalUri)-1];
		}			

		if($indexLast == 3) {
			$globalModul = $globalUri[count($globalUri)-3].'/'.$globalUri[count($globalUri)-2].'/'.$globalUri[count($globalUri)-1];
		}			
		if($indexLast == 2) {
			$globalModul = $globalUri[count($globalUri)-2].'/'.$globalUri[count($globalUri)-1];
		}			

		if($indexLast == 1) {
			$globalModul = $globalUri[count($globalUri)-1];
		}	

		if($position != 0) {
		  	$tmp = explode('/',$globalModul);	
		  	$globalModul = $tmp[$position-1];
		}		

		return $globalModul;
	}	

?>


