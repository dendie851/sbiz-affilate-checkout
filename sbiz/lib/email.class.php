<?php 
/*******************************************************************************                                                      
* Lib:      Language Class                                                     *
* Version:  1.0.0 	                                                           *
* Date:     07-05-2019                                                         *
* Author:   Dendie                                                             *
* License:  Freeware                                                           *
*									       									   *
* This class for email`					    					   *
*									       									   *
* You can  use, modification and distribution 								   *	                                                                  
*******************************************************************************/

if (!class_exists('email')) {
	class email 
	{		
		public function sendEmail($from,$to,$subject,$message,$ulrAssets)
		{
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <'.$from.'>' . "\r\n";

			$_EMAILURLASSETS = $ulrAssets; 
			$_EMAILMESSAGE = $message;
			include_once 'app/template/email.php';

			//mail($to,$subject,$message,$headers);			

			return $templateEmail; 	
		}
	}
}	

?>
