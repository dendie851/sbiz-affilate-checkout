<?php 
/*******************************************************************************                                                      
* Lib:      Language Class                                                     *
* Version:  1.0.0 	                                                           *
* Date:     12-03-2019                                                         *
* Author:   Dendie                                                             *
* License:  Freeware                                                           *
*									       									   *
* This class for handle languange`					    					   *
*									       									   *
* You can  use, modification and distribution 								   *	                                                                  
*******************************************************************************/

if (!class_exists('language')) {
	class language 
	{		

		public static function set($str='id')
		{
			$_SESSION['lang']['set'] = $str;
			return $str;
		}

		public static function get($fileName,$varName)
		{ 
			$langSet = isset($_SESSION['lang']['set']) ? $_SESSION['lang']['set'] : 'id';

			include 'sbiz/lang/'.'lang-'.$langSet.'/'.$fileName.'.php';

			$rst = isset($lang[$varName]) ? $lang[$varName] : '@lang-'.$varName; 

			return $rst;
		}	

		public static function status() {
			$rst = isset($_SESSION['lang']['set']) ? $_SESSION['lang']['set'] : 'id';
			return $rst;
		}	 		
	}
}	

?>
