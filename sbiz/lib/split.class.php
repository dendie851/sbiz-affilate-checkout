<?php 
/*******************************************************************************                                                      
* Lib:      Split-D                                                            *
* Version:  1.2.1                                                              *
* Date:     21-03-2006                                                         *
* Author:   Dendie                                                             *
* License:  Freeware                                                           *
*									       									   *
* This class for create pagging`					    					   *
*									       									   *
* You can  use, modification and distribution 								   *	                                                                  
*******************************************************************************/

if (!class_exists('split')) {
	class split 
	{
	    //Private atribut
		private $MaxData;	   //Menentukan maximum data setiap halaman
		private $MaxSplit;     //Menentukan jumlah split
		private $JmlData;      //Menyimpan jumlah data
		private $NamaFile;	   //Nama file yang digunakan
		private $CssStyle;     //Menyimpan CSS Style
		private $SplitLanjut;  //Menyimpan nomer pertama pembagian halaman
		private $SplitRecord;  //Menyimpan nomer halaman
		private $SplitData;    //Menyimpan jumlah halaman

		function __construct($NamaFile='index.php',$JmlData=100,$MaxData=20,$MaxSplit=9,$CssStyle='')
		{
		    //Inisialisasi attribut
			$this->MaxData=$MaxData; 
			$this->MaxSplit=$MaxSplit; 
			$this->JmlData=$JmlData;
			$this->NamaFile=$NamaFile;
			$this->CssStyle=$CssStyle;
		}
		
		function splitPage($SplitLanjut,$TambahUrl=array(),$KataBack='Back',$KataNext='Next')
		{
		    //Inisialisasi attribut
			$this->SplitLanjut=$SplitLanjut;
	        //Menghitung jumlah split
			$this->SplitData=$this->JmlData/$this->MaxData;
			if(is_float($this->SplitData))
	    	    $this->SplitData=intval($this->SplitData)+1;
			//Menampilkan link Back
			if($this->SplitLanjut>$this->MaxSplit)
			{
				//Menambah url
				$SplitUrl='';
				foreach($TambahUrl as $val)
				{
					$val='&'.$val;
				    $SplitUrl=$SplitUrl.$val;
				}	
				$back=$this->SplitLanjut-$this->MaxSplit;
				$SplitRecord=($this->SplitLanjut-2)*$this->MaxData;
				print "<a href='$this->NamaFile?SplitLanjut=$back&SplitRecord=$SplitRecord$SplitUrl' class='$this->CssStyle'>$KataBack</a>&nbsp;";
			}
			//Menampilkan nomer halaman
			if($this->MaxSplit>($this->SplitData-$this->SplitLanjut))
				$this->MaxSplit=($this->SplitData-$this->SplitLanjut)+1;	
			for($i=$this->SplitLanjut;$i<$this->SplitLanjut+$this->MaxSplit;$i++)
			{
				//Menambah url
				$SplitUrl='';
				foreach($TambahUrl as $val)
				{
					$val='&'.$val;
				    $SplitUrl=$SplitUrl.$val;
				}	
				$SplitRecord=($i-1)*$this->MaxData;
			    print "<a href='$this->NamaFile?SplitLanjut=$this->SplitLanjut&SplitRecord=$SplitRecord$SplitUrl' class='$this->CssStyle'>$i</a>&nbsp;";
			}	
			//Menampilkan link Next  
			if(($this->SplitData>=$this->MaxSplit)&&($i<=$this->SplitData))
			{
				//Menambah url
				$SplitUrl='';
				foreach($TambahUrl as $val)
				{
					$val='&'.$val;
				    $SplitUrl=$SplitUrl.$val;
				}	
				$SplitRecord=($i-1)*$this->MaxData;   
				print "<a href='$this->NamaFile?SplitLanjut=$i&SplitRecord=$SplitRecord$SplitUrl' class='$this->CssStyle'>$KataNext</a>";
			}
		}
		
		function noPage($SplitRecord)
		{
		    //Inisialisasi attribut
			$this->SplitRecord=$SplitRecord;
			//Menghitung nomer halaman yang aktif
			return ($this->SplitRecord+$this->MaxData)/$this->MaxData;
		} 
		
		function totalPage()
		{
	        //Menghitung jumlah split
			$this->SplitData=$this->JmlData/$this->MaxData;
			if(is_float($this->SplitData))
	    	    $this->SplitData=intval($this->SplitData)+1;
			return 	$this->SplitData;
		}
	}
}	

//Inisialisasi variabel url SplitLanjut
if(!isset($_GET['SplitLanjut']))
    $_GET['SplitLanjut']=1;
//Inisialisasi variabel url SplitRecord
if(!isset($_GET['SplitRecord']))
    $_GET['SplitRecord']=0; 	 
?>
