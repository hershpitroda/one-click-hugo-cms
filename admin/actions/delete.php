<?php
	require '../includes/constants.php';
	
	$page = $_REQUEST['page'];
	
	if( $page == "home" ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_featured = mysql_query("delete from bs_home_featured WHERE featured_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $page == "product" ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_featured = mysql_query("delete from bs_products WHERE product_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $page == "project" ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_featured = mysql_query("delete from bs_projects WHERE project_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $page == "client" ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_featured = mysql_query("delete from bs_clients WHERE client_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $page == "downloads" ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_featured = mysql_query("delete from bs_downloads WHERE download_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $page == "intro" ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_featured = mysql_query("delete from bs_intro WHERE intro_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $page == "backgrounds" ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_featured = mysql_query("delete from bs_backgrounds WHERE backgrounds_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $page == "ads" ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_featured = mysql_query("delete from bs_ads WHERE ads_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
?>