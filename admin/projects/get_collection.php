<?php
	require '../includes/constants.php';
	
	$cat_id = $_REQUEST['cat_id'];
	$list = "";
    
	$sql_collections = mysql_query("select * from bs_collections where category_id=".$cat_id);
	if( mysql_num_rows($sql_collections) > 0 ){
		while( $rows = mysql_fetch_array($sql_collections) ){                           
        	$list .=  "<option value=".$rows['collection_id'].">".ucfirst($rows['collection_name'])."</option>";
		}
	}else{
		$list .= "<option value='0'>Select</option>";
	}
	
	echo $list;
	
?>