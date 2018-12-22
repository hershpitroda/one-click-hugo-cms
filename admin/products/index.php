<?php
	session_start();
	if( !isset($_SESSION['username']) ){
		header("Location:../index.php");
	}
	
	if( isset($_REQUEST['log']) ){
		session_unset();
		header("Location:../index.php");
	}
	
	require "../includes/header.php";
?>

	<div id="content" class="admin">
    	<div id="sidebar">
        	<h2>Menu</h2>
            
            <ul>
            	<li class="head">Home options</li>
            	<li><a href="../home/">Manage featured images</a></li>
                <li><a href="../home/addfeatured.php">Add / Edit featured</a></li>
            </ul>
            
            <ul>
            	<li class="head">Product options</li>
            	<li><a href="../products/" class="sel">Manage products</a></li>
                <li><a href="addproduct.php">Add / Edit product</a></li>
            </ul>
            
            <ul>
            	<li class="head">Project options</li>
            	<li><a href="../projects/">Manage projects</a></li>
                <li><a href="../projects/addproject.php">Add / Edit project</a></li>
            </ul>
            
            <ul>
            	<li class="head">Downloads</li>
            	<li><a href="../downloads/">Manage downloads</a></li>
            </ul>
            
            <ul>
            	<li class="head">Client options</li>
            	<li><a href="../client/">Manage clients</a></li>
                <li><a href="../client/addclient.php">Add / Edit client</a></li>
            </ul>
            
            <ul>
            	<li class="head">Newsletters</li>
            	<li><a href="../newsletters/">View newsletter registrations</a></li>
            </ul>
            
            <ul>
            	<li><strong><a href="<?php echo $_SERVER['PHP_SELF']."?log=t"?>">Logout</a></strong></li>
            </ul>
        </div>
        
        <div id="main">
        	<h2>Manage products</h2>
             
            <?php
				$sqlProducts = mysql_query("select * from bs_products order by product_id");
            	$record_count = mysql_num_rows($sqlProducts);
			?>
            
            <div class="opt-box">
            	<ul>
                	<li><strong>Total products: </strong><?php echo $record_count;?></li>
                    <li class="filter" style="margin-top:10px;">
                    	<h3>FILTER</h3>
                        <ul>
                        	<li>
                            	Category
                            	<select name="filter_category" id="filter_category">
                                	<option value="0">Select</option>
                                    <?php
                                    	$sqlCategory = mysql_query("select * from bs_categories");
										if( mysql_num_rows($sqlCategory) > 0 ){
											while( $rows = mysql_fetch_array($sqlCategory) ){
												
												if( $rows['category_type'] == '0' ){
													$category_type = 'Office';
												}else{
													$category_type = 'Living';
												}
												
									?>
                                    <option value="<?php echo $rows['category_id']; ?>"><?php echo $category_type." - ".ucfirst($rows['category_name']); ?></option>
                                    <?php
											}
										}
									?>
                                </select>
                            </li>
                            <li>
                            	Collection
                            	<select name="filter_collection" id="filter_collection">
                                	<option value="0">Select</option>
                                </select>
                            </li>
                            <li>
                            	Product
                            	<select name="filter_product" id="filter_product">
                                	<option value="0">Select</option>
                                </select>
                            </li>
                        </ul>
                    </li>
                    <li class="filter" style="margin-top:20px;">
                    	<h3>OPTIONS</h3>
                        <ul id="options">
                        	<li><a href="#" class="enable_sel btn" onClick="return false;">Enable selected</a></li>
                            <li><a href="#" class="disable_sel btn" onClick="return false;">Disable selected</a></li>
                            <li><a href="#" class="delete btn" id="product-del" onClick="return false;">Delete</a></li>
                            <li><a href="#" class="featured_sel btn" onClick="return false;">Make featured</a></li>
                            <li><a href="#" class="bestseller_sel btn" onClick="return false;">Make best seller</a></li>
                            <li><a href="#" class="featured_inactive_sel btn" onClick="return false;">Disable featured</a></li>
                            <li><a href="#" class="bestseller_inactive_sel btn" onClick="return false;">Disable best seller</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
             
            <ul class="head plist products">
            	<li class="col1"><input type="checkbox" name="chk_box" id="chk_box" /></li>
            	<li class="col2">Product ID</li>
                <li class="col3">Product Name</li>
                <li class="col4">Category</li>
                <li class="col5">Collection</li>
                <li class="col6">Image</li>
                <li class="col7">Featured</li>
                <li class="col8">Best seller</li>
                <li class="col9 last">Active</li>
            </ul>
            
            <div id="listing">
           	<?php
            	
				if( mysql_num_rows($sqlProducts) > 0 ){
					while( $rows = mysql_fetch_array($sqlProducts) ){
						
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
						
			?>
            
            
            	<ul class="plist products">
                    <li class="col1"><input type="checkbox" name="chk_box_<?php echo $rows['product_id']; ?>" id="chk_box_<?php echo $rows['product_id']; ?>" /></li>
                    <li class="col2"><a href="addproduct.php?pid=<?php echo $rows['product_id']; ?>"><?php echo $rows['product_id']; ?></a></li>
                    <li class="col3"><a href="addproduct.php?pid=<?php echo $rows['product_id']; ?>"><?php echo $rows['product_name']; ?></a></li>
                    <li class="col4"><?php echo ucfirst($product_category); ?></li>
                    <li class="col5"><?php echo ucfirst($product_collection); ?></li>
                    <!--<li class="col6"><img src="<?php echo FILEPATH."images/products/".$product_image; ?>" /></li>-->
                    <li class="col6"><img src="<?php echo FILEPATH."images/products/".$rows['product_display_img']; ?>" style="width:60px; height:auto;" /></li>
                    <li class="col7"><?php echo $product_featured; ?></li>
                    <li class="col8"><?php echo $product_bestseller; ?></li>
                    <li class="col9 last"><?php echo $product_active; ?></li>
                </ul>
            
			<?php
					}
				}
			?>
            </div>
            
        </div>
    </div>

<?php
	require "../includes/footer.php";
?>