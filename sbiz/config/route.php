<?php
	$globalModul = globalFunctionUri(2);	
	$globalModul = str_replace(explode('/',$config['app']['path']), '', $globalModul);

	if(strlen(str_replace('/', '', $globalModul)) < 1) {
		$globalModul = $config['app']['homepage'];
	}=====================================================

	switch ($globalModul) {		
	case (globalFunctionUri(2) == 'home/dashboard'): 
			language::set($config['app']['language']);
			$globalModulActive = 'home';
			$globalViewScroolGroupMenu = 'grupMenuDashboard';												
			include_once 'app/home/index.php';
		break;		
	case (globalFunctionUri(2) == 'checkout/postalLookup'):
			include_once 'app/checkout/postalLookup.php';
	break;
	case (globalFunctionUri(2) == 'checkout/order'):
			language::set($config['app']['language']);
			$globalModulActive = 'checkout';
			$globalViewScroolGroupMenu = 'grupCheckout';
			include_once 'app/checkout/order.php';
	break;
	case (globalFunctionUri(2) == 'checkout/orderSave'):
			language::set($config['app']['language']);
			$globalModulActive = 'checkout';
			$globalViewScroolGroupMenu = 'grupCheckout';
			include_once 'app/checkout/orderSave.php';
	break;
	case (globalFunctionUri(2) == 'checkout/confirmation'):
			language::set($config['app']['language']);
			$globalModulActive = 'checkout';
			$globalViewScroolGroupMenu = 'grupCheckout';
			include_once 'app/checkout/confirmation.php';
	break;
	case (globalFunctionUri(2) == 'checkout/tracking'):
			language::set($config['app']['language']);
			$globalModulActive = 'checkout';
			$globalViewScroolGroupMenu = 'grupCheckout';
			include_once 'app/checkout/tracking.php';
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


