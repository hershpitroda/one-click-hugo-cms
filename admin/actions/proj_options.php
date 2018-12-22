<?php

	require '../includes/constants.php';
	require '../includes/functions.php';

	$opt = $_REQUEST['opt'];
	$id = $_REQUEST['id'];
	
	if( $opt == 'enimg' ){
		mysql_query("update bs_project_gallery set project_gallery_active=1, project_gallery_date_modified='".InputDateTime()."' where project_gallery_id=".$id);
	}
	
	if( $opt == 'disimg' ){
		mysql_query("update bs_project_gallery set project_gallery_active=0, project_gallery_date_modified='".InputDateTime()."' where project_gallery_id=".$id);
	}
	
	if( $opt == 'delimg' ){
		mysql_query("delete from bs_project_gallery where project_gallery_id=".$id);
	}
	
	if( $opt == 'enrel' ){
		mysql_query("update bs_project_product set project_product_active=1, project_product_date_modified='".InputDateTime()."' where project_product_id=".$id);
	}
	
	if( $opt == 'disrel' ){
		mysql_query("update bs_project_product set project_product_active=0, project_product_date_modified='".InputDateTime()."' where project_product_id=".$id);
	}
	
	if( $opt == 'delrel' ){
		mysql_query("delete from bs_project_product where project_product_id=".$id);
	}

?>