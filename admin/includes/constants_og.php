<?php
	$localmode = false;
	if( $localmode ){
		define("FILEPATH","/burosys/");
		$Host = "localhost"; 
		$Username = "root";
		$Password = "root";
		$Database = "burosys";
	}else{
		define("FILEPATH","/clients/burosys/");
		$Host = "burosys.sagarapatil.com";
		$Username = "burosys_user";
		$Password = "ChottaSP123";
		$Database = "burosys";
	}
	
	$link =  mysql_connect($Host,$Username,$Password) or die("Mysql Connection Error ".mysql_error());
    if($link){ 
       $getDB = mysql_select_db($Database) or die("Data Base Selection Error ".mysql_error());
    }
?>