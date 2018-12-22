<?php
	require '../includes/constants.php';
	
	$opt_id = $_REQUEST['opt'];
	
	if( $opt_id == 1 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_featured = mysql_query("update bs_ads set ads_active=1 WHERE ads_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $opt_id == 2 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_featured = mysql_query("update bs_ads set ads_active=0 WHERE ads_id=".$_POST['myCheckboxes'][$i]);
		}
	}
	
?>