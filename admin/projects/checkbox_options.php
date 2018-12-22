<?php
	require '../includes/constants.php';
	
	$opt_id = $_REQUEST['opt'];
	
	if( $opt_id == 1 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_products = mysql_query("update bs_products set product_active=1 WHERE product_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $opt_id == 2 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_products = mysql_query("update bs_products set product_active=0 WHERE product_id=".$_POST['myCheckboxes'][$i]);
		}
	}
	
	if( $opt_id == 3 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			
			$sql_products = mysql_query("update bs_products set product_featured=1 WHERE product_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $opt_id == 4 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			
			$sql_products = mysql_query("update bs_products set product_bestseller=1 WHERE product_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $opt_id == 5 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			
			$sql_products = mysql_query("update bs_products set product_featured=0 WHERE product_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $opt_id == 6 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			
			$sql_products = mysql_query("update bs_products set product_bestseller=0 WHERE product_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
?>