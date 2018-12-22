<?php

	require '../includes/constants.php';
	require '../includes/functions.php';

	$opt = $_REQUEST['opt'];
	$id = $_REQUEST['id'];
	
	if( $opt == 'enimg' ){
		mysql_query("update bs_product_gallery set product_gallery_active=1, product_gallery_date_modified='".InputDateTime()."' where product_gallery_id=".$id);
	}
	
	if( $opt == 'disimg' ){
		mysql_query("update bs_product_gallery set product_gallery_active=0, product_gallery_date_modified='".InputDateTime()."' where product_gallery_id=".$id);
	}
	
	if( $opt == 'delimg' ){
		mysql_query("delete from bs_product_gallery where product_gallery_id=".$id);
	}
	
	if( $opt == 'enrel' ){
		mysql_query("update bs_related set related_active=1, related_date_modified='".InputDateTime()."' where related_id=".$id);
	}
	
	if( $opt == 'disrel' ){
		mysql_query("update bs_related set related_active=0, related_date_modified='".InputDateTime()."' where related_id=".$id);
	}
	
	if( $opt == 'delrel' ){
		mysql_query("delete from bs_related where related_id=".$id);
	}

?>