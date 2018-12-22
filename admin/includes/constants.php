<?php
	$localmode = false;
	if( $localmode ){
		define("FILEPATH","/burosys/");
		$Host = "localhost"; 
		$Username = "root";
		$Password = "root";
		$Database = "burosys";
		define("UPLOAD_PATH","/applications/mamp/htdocs/burosys/");
	}else{
		//define("FILEPATH","/development/");
		define("FILEPATH","/");
		$Host = "localhost";
		$Username = "burosxeo_think";
		$Password = "think21tech%";
		$Database = "burosxeo_burosys";
		//define("UPLOAD_PATH","/home/burosys/www/development/");
		define("UPLOAD_PATH","/home/burosxeo/public_html/");
	}
	
	$link =  mysql_connect($Host,$Username,$Password) or die("Mysql Connection Error ".mysql_error());
    if($link){ 
       $getDB = mysql_select_db($Database) or die("Data Base Selection Error ".mysql_error());
    }
?>