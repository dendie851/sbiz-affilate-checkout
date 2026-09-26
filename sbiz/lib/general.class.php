<?php 
/*******************************************************************************                                                      
* Lib:      Generic Class                                                      *
* Version:  1.0.0 	                                                           *
* Date:     12-03-2019                                                         *
* Author:   Dendie                                                             *
* License:  Freeware                                                           *
*									       									   *
* This class for generic function`					    					   *
*									       									   *
* You can  use, modification and distribution 								   *	                                                                  
*******************************************************************************/

if (!class_exists('general')) {
	class general 
	{		
		public static function secureInput($str)
		{
			$rst = addslashes(htmlentities($str));
			return $rst;
		}


		function stripTags($text, $tags = '', $invert = FALSE) {

		  preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
		  $tags = array_unique($tags[1]);
		   
		  if(is_array($tags) AND count($tags) > 0) {
		    if($invert == FALSE) {
		      return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
		    }
		    else {
		      return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
		    }
		  }
		  elseif($invert == FALSE) {
		    return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
		  }
		  
		  return $text;
		} 

    	public function terbilang($angka) {
	        $angka = (float)$angka;
	        $bilangan = array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas');
	        if ($angka < 12) {
	            return $bilangan[$angka];
	        } else if ($angka < 20) {
	            return $bilangan[$angka - 10] . ' Belas';
	        } else if ($angka < 100) {
	            $hasil_bagi = (int)($angka / 10);
	            $hasil_mod = $angka % 10;
	            return trim(sprintf('%s Puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
	        } else if ($angka < 200) { return sprintf('Seratus %s', $this->terbilang($angka - 100));
	        } else if ($angka < 1000) { $hasil_bagi = (int)($angka / 100); $hasil_mod = $angka % 100; return trim(sprintf('%s Ratus %s', $bilangan[$hasil_bagi], $this->terbilang($hasil_mod)));
	        } else if ($angka < 2000) { return trim(sprintf('Seribu %s', $this->terbilang($angka - 1000)));
	        } else if ($angka < 1000000) { $hasil_bagi = (int)($angka / 1000); $hasil_mod = $angka % 1000; return sprintf('%s Ribu %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod));
	        } else if ($angka < 1000000000) { $hasil_bagi = (int)($angka / 1000000); $hasil_mod = $angka % 1000000; return trim(sprintf('%s Juta %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
	        } else if ($angka < 1000000000000) { $hasil_bagi = (int)($angka / 1000000000); $hasil_mod = fmod($angka, 1000000000); return trim(sprintf('%s Milyar %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
	        } else if ($angka < 1000000000000000) { $hasil_bagi = $angka / 1000000000000; $hasil_mod = fmod($angka, 1000000000000); return trim(sprintf('%s Triliun %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));        
	        } else {
	            return 'Data Salah';
	        }		 		
	    }  

		public static function getDateStartEnd() {	
			$tmpDate = date('Y-m');
			$date = new DateTime($tmpDate);
			$date->modify('last day of this month');

			$starDate = $tmpDate.'-01';			
			$endDate = $date->format('Y-m-d');

			return array($starDate, $endDate);	
		}
	    
	}      
}	

?>
