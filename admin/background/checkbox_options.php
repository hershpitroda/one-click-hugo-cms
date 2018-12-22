<?php
	require '../includes/constants.php';
	
	$opt_id = $_REQUEST['opt'];
	
	if( $opt_id == 1 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_featured = mysql_query("update bs_backgrounds set background_active=1 WHERE backgrounds_id=".$_POST['myCheckboxes'][$i]);	
		}
	}
	
	if( $opt_id == 2 ){
		for ( $i=0; $i < count( $_POST['myCheckboxes'] ); $i++ )
		{
			$sql_featured = mysql_query("update bs_backgrounds set background_active=0 WHERE backgrounds_id=".$_POST['myCheckboxes'][$i]);
		}
	}
	
?>