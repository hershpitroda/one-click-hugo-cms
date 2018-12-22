<?php
	require '../includes/constants.php';
	
	$opt_id = $_REQUEST['opt'];
	
	if( $opt_id == 1 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_products = mysql_query("update bs_clients set client_active=1 WHERE client_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $opt_id == 2 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_products = mysql_query("update bs_clients set client_active=0 WHERE client_id=".$_POST['myCheckboxes'][$i]);
		}
	}
	
	if( $opt_id == 3 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_products = mysql_query("update bs_clients set client_featured=1 WHERE client_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $opt_id == 4 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_products = mysql_query("update bs_clients set client_featured=0 WHERE client_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
?>