<?php
	require '../includes/constants.php';
	
	$col_id = $_REQUEST['col_id'];
	$list = "";
    
	$sql_collections = mysql_query("select * from bs_products where collection_id=".$col_id);
	if( mysql_num_rows($sql_collections) > 0 ){
		while( $rows = mysql_fetch_array($sql_collections) ){                           
        	$list .=  "<option value=".$rows['product_id'].">".ucfirst($rows['product_name'])."</option>";
		}
	}else{
		$list .= "<option value='0'>Select</option>";
	}
	
	echo $list;
	
?>