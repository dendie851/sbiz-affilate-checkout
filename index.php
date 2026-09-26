<?php 
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

    $Lifetime = 60*30*1;
    
    if (ini_get("session.use_trans_sid") == true) {
        ini_set("url_rewriter.tags", "");
        ini_set("session.use_trans_sid", false);
    
    }

    ini_set("session.gc_maxlifetime", $Lifetime);
    ini_set("session.gc_divisor", "1");
    ini_set("session.gc_probability", "1");
    ini_set("session.cookie_lifetime", "0");
    
    ini_set('post_max_size', '64M');
    ini_set('upload_max_filesize', '64M');    

    //$DirectoryPath = '/public_html/arbukopin/session';
    //ini_set("session.save_path", $DirectoryPath);
    	
	@session_start();

	include_once 'sbiz/config/config.php';

	$globalUrl = $config['app']['domain'].$config['app']['path'].$config['app']['index'];

	include_once 'sbiz/lib/general.class.php';
	include_once 'sbiz/lib/language.class.php';
	include_once 'sbiz/lib/auth.class.php';
	include_once 'sbiz/config/route.php'; 
    
    //auth::token();
?>
