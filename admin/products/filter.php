<?php
	require '../includes/constants.php';
	
	if( isset($_REQUEST['cat_id']) ){
	
		$cat_id = $_REQUEST['cat_id'];
		$list = "";
		
		$sql_categories = mysql_query("select * from bs_collections where category_id=".$cat_id);
		if( mysql_num_rows($sql_categories) > 0 ){
			while( $rows = mysql_fetch_array($sql_categories) ){                           
				$list .=  "<option value=".$rows['collection_id'].">".ucfirst($rows['collection_name'])."</option>";
			}
		}else{
			$list .= "<option value='0'>Select</option>";
		}
		
		echo $list;
	
	}
	
	if( isset($_REQUEST['col_id']) ){
	
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
	
	}
	
	if( isset($_REQUEST['prod_id']) ){
	
		$pid = $_REQUEST['prod_id'];
		$list = "";
		
		$sql_products = mysql_query("select * from bs_products where product_id=".$pid);
		if( mysql_num_rows($sql_products) > 0 ){
			while( $rows = mysql_fetch_array($sql_products) ){
				
				$sqlCollection = mysql_query("select * from bs_collections where collection_active=1 and collection_id=".$rows['collection_id']);
				if( mysql_num_rows( $sqlCollection ) > 0 ){
					while( $rows1 = mysql_fetch_array($sqlCollection) ){
						$product_collection = $rows1['collection_name'];
						$sqlCategory = mysql_query("select * from bs_categories where category_active=1 and category_id=".$rows1['category_id']);
						while( $rows2 = mysql_fetch_array($sqlCategory) ){
							if( $rows2['category_type'] == '0' ){
								$category_type = "Office";	
							}else{
								$category_type = "Living";	
							}
							$product_category = "<strong>".$category_type."</strong><br />".ucfirst($rows2['category_name']);
						}
					}	
				}
				
				$sqlImage = mysql_query("select * from bs_product_gallery where product_gallery_id=".$rows['product_id']." and product_gallery_active=1 order by product_gallery_sequence LIMIT 1");
				if( mysql_num_rows($sqlImage) > 0 ){
					while( $rows1 = mysql_fetch_array($sqlImage) ){
						$product_image = $rows1['product_gallery_thumb'];
					}
				}
						
				if( $rows['product_featured'] == 1 ){
					$product_featured = "Active";
				}else{
					$product_featured = "Inactive";
				}
				
				if( $rows['product_bestseller'] == 1 ){
					$product_bestseller = "Active";
				}else{
					$product_bestseller = "Inactive";
				}
				
				if( $rows['product_active'] == 1 ){
					$product_active = "Active";
				}else{
					$product_active = "Inactive";
				}
		
				
				$list = "<ul class='plist products'>";
				$list .= "<li class='col1'><input type='checkbox' name='chk_box_".$rows['product_id']."' id='chk_box_".$rows['product_id']."' /></li>";
				$list .= "<li class='col2'><a href='addproduct.php?pid=".$rows['product_id']."'>".$rows['product_id']."</a></li>";
				$list .= "<li class='col3'><a href='addproduct.php?pid=".$rows['product_id']."'>".$rows['product_name']."</a></li>";
				$list .= "<li class='col4'>".ucfirst($product_category)."</a></li>";
				$list .= "<li class='col5'>".ucfirst($product_collection)."</li>";
				$list .= "<li class='col6'><img src='".FILEPATH."images/products/".$product_image."' /></li>";
				$list .= "<li class='col7'>".$product_featured."</li>";
				$list .= "<li class='col8'>".$product_bestseller."</li>";
				$list .= "<li class='col9 last'>".$product_active."</li>";
				$list .= "</ul>";
			}
		}else{
			$list .= "<ul class='plist products'><li>There is no product matching the required Product Id</<li></ul>";
		}
		
		echo $list;
	
	}
	
	
	
	
?>