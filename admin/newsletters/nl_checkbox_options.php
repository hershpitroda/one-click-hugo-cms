<?php
	require '../includes/constants.php';
	
	$opt_id = $_REQUEST['opt'];
	
	if( $opt_id == 1 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_products = mysql_query("update bs_newsletters set newsletter_subscribe=0 WHERE newsletter_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $opt_id == 2 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_products = mysql_query("update bs_newsletters set newsletter_subscribe=1 WHERE newsletter_id=".$_POST['myCheckboxes'][$i]);
		}
	}
	
	if( $opt_id == 3 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_products = mysql_query("update bs_newsletters set newsletter_active=1 WHERE newsletter_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $opt_id == 4 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_products = mysql_query("update bs_newsletters set newsletter_active=0 WHERE newsletter_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
?>