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
	
	$product_name = $product_desc = $product_materials = $product_dimensions = $product_display = $product_main = "";
	$product_price = $product_collection = 0;
	$count = 0;
	
	if( isset($_REQUEST['pid']) ){
		$pid = $_REQUEST['pid'];
		$sqlProduct = mysql_query("select * from bs_products where product_id=".$pid);
		if( mysql_num_rows($sqlProduct) > 0 ){
			while( $rows = mysql_fetch_array($sqlProduct) ){
				$product_name = clean_var($rows['product_name']);
				$product_desc = clean_var($rows['product_desc']);
				$product_materials = clean_var($rows['product_materials']);
				$product_dimensions = clean_var($rows['product_dimensions']);
				$product_price = clean_var($rows['product_price']);
				$product_display = clean_var($rows['product_display_img']);
				$product_main = clean_var($rows['product_main_img']);
				$product_collection = clean_var($rows['collection_id']);
				
				$sqlCategory = mysql_query("select bsca.category_id as category_id, bsca.category_name as category_name from bs_collections as bsc inner join bs_categories as bsca on bsca.category_id = bsc.category_id where bsc.collection_id=".$product_collection);
				if( mysql_num_rows($sqlCategory) > 0 ){
					while( $rows1 = mysql_fetch_array($sqlCategory) ){
						$product_category = $rows1['category_id'];
					}
				}
				$product_active = $rows['product_active'];
				$product_featured = $rows['product_featured'];
				$product_bestseller = $rows['product_bestseller'];
			}
		}
		
		$sqlImages = mysql_query("select * from bs_product_gallery where product_id=".$pid);
		if( mysql_num_rows($sqlImages) > 0 ){
			while( $rows = mysql_fetch_array($sqlImages) ){
				$images_big[$count] = $rows['product_gallery_big'];
				$images_thumb[$count] = $rows['product_gallery_thumb'];
				$images_sequence[$count] = $rows['product_gallery_sequence'];
				$count++;
			}
		}
		
		$count = 0;
		
		$sql_related_products = mysql_query("select * from bs_related where main_product_id=".$pid);
		if( mysql_num_rows($sql_related_products) > 0 ){
			
			while( $rows = mysql_fetch_array($sql_related_products) ){
				$related_products[$count] = $rows['related_product_id'];
				
				$sql_related_collection = mysql_query("select * from bs_products where product_id=".$related_products[$count]);
				if( mysql_num_rows($sql_related_collection) > 0 ){
					while( $rows1 = mysql_fetch_array($sql_related_collection) ){
						$related_collections[$count] = $rows1['collection_id'];
						
						$sql_related_category = mysql_query("select * from bs_collections where collection_id=".$related_collections[$count]);
						if( mysql_num_rows($sql_related_category) > 0 ){
							while( $rows2 = mysql_fetch_array($sql_related_category) ){
								$related_categories[$count] = $rows2['category_id'];
							}
						}
					}
				}
				//echo $related_categories[$count]." ".$related_collections[$count]." ".$related_products[$count]."<br />";
				$count++;
				
			}
		}
	}
	
	if( isset($_REQUEST['sbt_btn']) ){
		$validated = 0;
		$error[] = 0;
		$images[] = "";
		$related_categories[] = 0;
		$related_collections[] = 0;
		$related_products[] = 0;
		
		if( isset($_POST['pid']) ){
			$pid = $_POST['pid'];
		}
		
		$sbt_value = $_REQUEST['sbt_btn'];
		
		$product_name = clean_var($_REQUEST['txt_name']);
		$product_category = clean_var($_REQUEST['sel_category']);
		$product_collection = clean_var($_REQUEST['sel_collection']);
		$product_desc = clean_var($_REQUEST['txt_desc']);
		$product_desc = str_replace("'","&#39;",$product_desc);
		$product_materials = clean_var($_REQUEST['txt_materials']);
		$product_materials = str_replace("'","&#39;",$product_materials);
		$product_dimensions = clean_var($_REQUEST['txt_dimensions']);
		$product_dimensions = str_replace("'","&#39;",$product_dimensions);
		$product_price = clean_var($_REQUEST['txt_price']);
		
		if( isset($pid) ){
		
			if( $_FILES['fil_display_img']['name'] != '' ){
				$product_display = clean_var($_FILES['fil_display_img']['name']);
			}else{
				$product_display = clean_var($_REQUEST['hid_fil_display_img']);
			}
			
			if( $_FILES['fil_main_img']['name'] != '' ){
				$product_main = clean_var($_FILES['fil_main_img']['name']);
			}else{
				$product_main = clean_var($_REQUEST['hid_fil_main_img']);
			}
		
		}else{
			$product_display = clean_var($_FILES['fil_display_img']['name']);
			$product_main = clean_var($_FILES['fil_main_img']['name']);
		}
		
		
		
		$sql_category_name = mysql_query("select * from bs_categories where category_id=".$product_category);
		if( mysql_num_rows($sql_category_name) > 0 ){
			while( $rows = mysql_fetch_array($sql_category_name) ){
				if( $rows['category_type'] == '0' ){
					$category_type = "office";
				}else{
					$category_type = "living";
				}
				$category_name = $rows['category_name'];
			}
		}
		
		$db_path = $category_type."/".$category_name."/";
		//$file_path = "/Applications/MAMP/htdocs/burosys/images/products/".$db_path;
		$file_path = UPLOAD_PATH."images/products/".$db_path;
		
		for( $i=0; $i<=9; $i++ ){
			$images_sequence[$i] = $_REQUEST["txt_img_sequence_".$i];
		}
		
		for( $i=0; $i<6; $i++ ){
			
			$rel_cat = "sel_relcat_".$i;
			$rel_col = "sel_relcol_".$i;
			$rel_prod = "sel_relprod_".$i;
			
			$related_categories[$i] = $_REQUEST[$rel_cat];
			$related_collections[$i] = $_REQUEST[$rel_col];
			$related_products[$i] = $_REQUEST[$rel_prod];
			
			//echo $i." - Categories - ".$related_categories[$i]." - Collections - ".$related_collections[$i]." - ".$related_products[$i]."<br />";
		}
		
		if( isset($_REQUEST['chk_featured']) ){
			$product_featured = 1;
		}else{
			$product_featured = 0;
		}
		
		if( isset($_REQUEST['chk_bseller']) ){
			$product_bestseller = 1;
		}else{
			$product_bestseller = 0;
		}
		
		if( isset($_REQUEST['chk_active']) ){
			$product_active = 1;
		}else{
			$product_active = 0;
		}
		
		$error[0] = validName($product_name);
		if( $product_category != 0 ){
			$error[1] = 0;
		}else{
			$error[1] = 1;
		}
		if( $product_collection != 0 ){
			$error[2] = 0;
		}else{
			$error[2] = 1;
		}
		$error[3] = validMessage($product_desc);
		$error[4] = validMessage($product_materials);
		$error[5] = validMessage($product_dimensions);
		$error[6] = validMessage($product_price);
		
		if( !isset($pid) ){
		
			if( (($_FILES['fil_display_img']['name'] != '') || ($_FILES['fil_display_img']['error'] <= 0)) && (($_FILES['fil_display_img']['type'] == 'image/jpg') || ($_FILES['fil_display_img']['type'] == 'image/jpeg') || ($_FILES['fil_display_img']['type'] == 'image/png')) ){
				$error[7] = 0;
			}else{
				$error[7] = 1;
			}
			
			if( (($_FILES['fil_main_img']['name'] != '') || ($_FILES['fil_main_img']['error'] <= 0)) && (($_FILES['fil_main_img']['type'] == 'image/jpg') || ($_FILES['fil_main_img']['type'] == 'image/jpeg') || ($_FILES['fil_main_img']['type'] == 'image/png')) ){
				$error[8] = 0;
			}else{
				$error[8] = 1;
			}
		
		}else{
		
			if( ($_FILES['fil_display_img']['name'] == '') && ($_REQUEST['hid_fil_display_img'] == '') ){
				$error[7] = 1;
			}else{
				$error[7] = 0;
			}
		
			if( ($_FILES['fil_main_img']['name'] == '') && ($_REQUEST['hid_fil_main_img'] == '') ){
				$error[8] = 1;
			}else{
				$error[8] = 0;
			}
		
		}
		
		for( $i=0; $i<9; $i++ ){
			$validated += $error[$i];
		}
		
		if( $validated == 0 ){
			
			if( $sbt_value == 'Add product' ){
			
				//upload display image
				$file_extn = pathinfo($_FILES['fil_main_img']['name'],PATHINFO_EXTENSION);
				$newname = str_replace(' ', '', $_FILES['fil_display_img']['name']);
				$newname = str_replace($file_extn, '', $newname);
				$newname = str_replace('.', '', $newname);
					
				$db_filepath_display = $db_path.$newname."_display.".$file_extn;
				$upload_path_display = $file_path.$newname."_display.".$file_extn;
				move_uploaded_file($_FILES['fil_display_img']['tmp_name'], $upload_path_display);
				
				//upload main image	
				$file_extn = pathinfo($_FILES['fil_main_img']['name'],PATHINFO_EXTENSION);
				$newname = str_replace(' ', '', $_FILES['fil_main_img']['name']);
				$newname = str_replace($file_extn, '', $newname);
				$newname = str_replace('.', '', $newname);
					
				$db_filepath_main = $db_path.$newname."_main.".$file_extn;
				$upload_path_main = $file_path.$newname."_main.".$file_extn;
				move_uploaded_file($_FILES['fil_main_img']['tmp_name'], $upload_path_main);
			
				//$sqlProduct = "insert into bs_products (collection_id, product_name, product_desc, product_materials, product_dimensions, product_price, product_display_img, product_main_img, product_featured, product_bestseller, product_active) values (".$product_collection.", '".$product_name."', '".$product_desc."', '".$product_materials."', '".$product_dimensions."', '".$product_price."', '".$db_filepath_display."', '".$db_filepath_main."', ".$product_featured.", ".$product_bestseller.",".$product_active.")";
				
				//echo $sqlProduct."<br /><br />";
				
				$sqlProduct = mysql_query("insert into bs_products (collection_id, product_name, product_desc, product_materials, product_dimensions, product_price, product_display_img, product_main_img, product_featured, product_bestseller, product_active) values (".$product_collection.", '".$product_name."', '".$product_desc."', '".$product_materials."', '".$product_dimensions."', '".$product_price."', '".$db_filepath_display."', '".$db_filepath_main."', ".$product_featured.", ".$product_bestseller.",".$product_active.")");
				
				$record_id = mysql_insert_id();
				
				for( $i=0; $i<=9; $i++ ){
					$img_filename = "fil_img_".$i;
					$img_sequence = "txt_img_sequence_".$i;
					
					if( $_FILES[$img_filename]['name'] != '' ){
						
						if($_FILES[$img_filename]['error'] != UPLOAD_ERR_OK) {
							echo 'Upload file error';
							return;
						}
						
						if(!is_uploaded_file($_FILES[$img_filename]['tmp_name'])) {
							echo 'Invalid request';
							return;
						}
						
						$file_extn = pathinfo($_FILES[$img_filename]['name'],PATHINFO_EXTENSION);
						$newname = str_replace(' ', '', $_FILES[$img_filename]['name']);
						$newname = str_replace('.', '', $newname);
						$newname = str_replace($file_extn, '', $newname);
						
						$db_filepath_big_img = $images_big[$i] = $db_path.$newname."_big_".$i.".".$file_extn;
						$db_filepath_thumb_img = $images_thumb[$i] = $db_path.$newname."_thumb_".$i.".".$file_extn;
						
						/*image resize for thumbnail*/
						$src = imagecreatefromjpeg($_FILES[$img_filename]['tmp_name']);
						
						list($width_big,$height_big)=getimagesize($_FILES[$img_filename]['tmp_name']);
						list($width_thumb,$height_thumb)=getimagesize($_FILES[$img_filename]['tmp_name']);
					
						$newwidth_big=455;
						$newheight_big=($height_big/$width_big)*$newwidth_big;
						$tmp_big=imagecreatetruecolor($newwidth_big,$newheight_big);
						
						$newwidth_thumb=60;
						$newheight_thumb=($height_thumb/$width_thumb)*$newwidth_thumb;
						$tmp_thumb=imagecreatetruecolor($newwidth_thumb,$newheight_thumb);
						
						imagecopyresampled($tmp_big,$src,0,0,0,0,$newwidth_big,$newheight_big,$width_big,$height_big);
						//$filename_big = "/Applications/MAMP/htdocs/burosys/images/products/". $db_filepath_big_img;
						$filename_big = UPLOAD_PATH."images/products/". $db_filepath_big_img;
						imagejpeg($tmp_big,$filename_big,100);
						
						imagecopyresampled($tmp_thumb,$src,0,0,0,0,$newwidth_thumb,$newheight_thumb,$width_thumb,$height_thumb);
						//$filename_thumb = "/Applications/MAMP/htdocs/burosys/images/products/". $db_filepath_thumb_img;
						$filename_thumb = UPLOAD_PATH."images/products/". $db_filepath_thumb_img;
						imagejpeg($tmp_thumb,$filename_thumb,100);
						
						/*upload files*/
						//$db_filepath_big_img = $images_big[$i] = $db_path.$newname."_big_".$i.".".$file_extn;
						//$upload_path_big = "/Applications/MAMP/htdocs/burosys/images/products/".$db_filepath_big_img;
						//move_uploaded_file($_FILES[$img_filename]['tmp_name'], $upload_path_big);
						
						//$db_filepath_thumb_img = $images_thumb[$i] = $db_path.$newname."_thumb_".$i.".".$file_extn;
						//$upload_path_thumb = "/Applications/MAMP/htdocs/burosys/images/products/".$db_filepath_thumb_img;
						//move_uploaded_file($_FILES[$img_filename]['tmp_name'], $upload_path_thumb);
						
						
						//$sql_add_images = "insert into bs_product_gallery (product_id, product_gallery_title, product_gallery_big, product_gallery_thumb, product_gallery_sequence, product_gallery_active) values (".$record_id.", '".$product_name."', '".$db_filepath_big_img."', '".$db_filepath_thumb_img."', ".$_REQUEST[$img_sequence].", 1)";
						//echo $sql_add_images."<br /><br />";
						
						$sql_add_images = mysql_query("insert into bs_product_gallery (product_id, product_gallery_title, product_gallery_big, product_gallery_thumb, product_gallery_sequence, product_gallery_active) values (".$record_id.", '".$product_name."', '".$db_filepath_big_img."', '".$db_filepath_thumb_img."', ".$_REQUEST[$img_sequence].", 1)");
						
					}
				}
				
				for( $i=0; $i<6; $i++ ){
					
					if( $related_products[$i] != 0 ){
						
						//$sql_rel_prod = "insert into bs_related (main_product_id, related_product_id, related_active) values (".$record_id.", ".$related_products[$i].", 1)";
						//echo $sql_rel_prod;
						
						$sql_rel_prod = mysql_query("insert into bs_related (main_product_id, related_product_id, related_active) values (".$record_id.", ".$related_products[$i].", 1)");
					}
				}
				
				echo "<script>window.location='../products/'</script>";
				
			}
			
			if( $sbt_value == 'Update product' ){
				
				if( $_FILES['fil_display_img']['name'] != '' ){
					//upload display image
					$file_extn = pathinfo($_FILES['fil_display_img']['name'],PATHINFO_EXTENSION);
					$newname = str_replace(' ', '', $_FILES['fil_display_img']['name']);
					$newname = str_replace($file_extn, '', $newname);
					$newname = str_replace('.', '', $newname);
						
					$db_filepath_display = $db_path.$newname."_display.".$file_extn;
					$upload_path_display = $file_path.$newname."_display.".$file_extn;
					move_uploaded_file($_FILES['fil_display_img']['tmp_name'], $upload_path_display);
				}else{
					if( $_REQUEST['hid_fil_display_img'] != '' ){
						$db_filepath_display = $_REQUEST['hid_fil_display_img'];
					}else{
						$db_filepath_display = "";
					}
				}
				
				if( $_FILES['fil_main_img']['name'] != '' ){
					//upload main image
					$file_extn = pathinfo($_FILES['fil_main_img']['name'],PATHINFO_EXTENSION);
					$newname = str_replace(' ', '', $_FILES['fil_main_img']['name']);
					$newname = str_replace($file_extn, '', $newname);
					$newname = str_replace('.', '', $newname);
						
					$db_filepath_main = $db_path.$newname."_main.".$file_extn;
					$upload_path_main = $file_path.$newname."_main.".$file_extn;
					move_uploaded_file($_FILES['fil_main_img']['tmp_name'], $upload_path_main);
				}else{
					if( $_REQUEST['hid_fil_main_img'] != '' ){
						$db_filepath_main = $_REQUEST['hid_fil_main_img'];
					}else{
						$db_filepath_main = "";
					}
				}
				
				//$sqlProduct = "update bs_products set collection_id=".$product_collection.", product_name='".$product_name."', product_desc='".$product_desc."', product_materials='".$product_materials."', product_dimensions='".$product_dimensions."', product_price='".$product_price."', product_display_img='".$db_filepath_display."', product_main_img='".$db_filepath_main."', product_featured=".$product_featured.", product_bestseller=".$product_bestseller.", product_active=".$product_active." where product_id=".$pid;
				
				//echo $sqlProduct."<br /><br />";
				
				$sqlProduct = mysql_query("update bs_products set collection_id=".$product_collection.", product_name='".$product_name."', product_desc='".$product_desc."', product_materials='".$product_materials."', product_dimensions='".$product_dimensions."', product_price='".$product_price."', product_display_img='".$db_filepath_display."', product_main_img='".$db_filepath_main."', product_featured=".$product_featured.", product_bestseller=".$product_bestseller.", product_active=".$product_active." where product_id=".$pid);
				
				for( $i=0; $i<=9; $i++ ){
					
					$img_filename = "fil_img_".$i;
					$hid_img_big_filename = "hid_fil_img_big_".$i;
					$hid_img_thumb_filename = "hid_fil_img_thumb_".$i;
					$img_sequence = "txt_img_sequence_".$i;
					
					if( $_FILES[$img_filename]['name'] != '' ){
						
						if($_FILES[$img_filename]['error'] != UPLOAD_ERR_OK) {
							echo 'Upload file error';
							return;
						}
						
						if(!is_uploaded_file($_FILES[$img_filename]['tmp_name'])) {
							echo 'Invalid request';
							return;
						}
						
						$file_extn = pathinfo($_FILES[$img_filename]['name'],PATHINFO_EXTENSION);
						$newname = str_replace(' ', '', $_FILES[$img_filename]['name']);
						$newname = str_replace('.', '', $newname);
						$newname = str_replace($file_extn, '', $newname);
						
						$db_filepath_big_img = $images_big[$i] = $db_path.$newname."_big_".$i.".".$file_extn;
						$db_filepath_thumb_img = $images_thumb[$i] = $db_path.$newname."_thumb_".$i.".".$file_extn;
						
						/*image resize for thumbnail*/
						$src = imagecreatefromjpeg($_FILES[$img_filename]['tmp_name']);
						
						list($width_big,$height_big)=getimagesize($_FILES[$img_filename]['tmp_name']);
						list($width_thumb,$height_thumb)=getimagesize($_FILES[$img_filename]['tmp_name']);
					
						$newwidth_big=455;
						$newheight_big=350;
						$tmp_big=imagecreatetruecolor($newwidth_big,$newheight_big);
						
						$newwidth_thumb=60;
						$newheight_thumb=60;
						$tmp_thumb=imagecreatetruecolor($newwidth_thumb,$newheight_thumb);
						
						imagecopyresampled($tmp_big,$src,0,0,0,0,$newwidth_big,$newheight_big,$width_big,$height_big);
						//$filename_big = "/Applications/MAMP/htdocs/burosys/images/products/". $db_filepath_big_img;
						$filename_big = UPLOAD_PATH."images/products/". $db_filepath_big_img;
						imagejpeg($tmp_big,$filename_big,100);
						
						imagecopyresampled($tmp_thumb,$src,0,0,0,0,$newwidth_thumb,$newheight_thumb,$width_thumb,$height_thumb);
						//$filename_thumb = "/Applications/MAMP/htdocs/burosys/images/products/". $db_filepath_thumb_img;
						$filename_thumb = UPLOAD_PATH."images/products/". $db_filepath_thumb_img;
						imagejpeg($tmp_thumb,$filename_thumb,100);
						
						//$db_filepath_big_img = $images_big[$i] = $db_path.$newname."_big_".$i.".".$file_extn;
						//$upload_path_big = "/Applications/MAMP/htdocs/burosys/images/products/".$db_filepath_big_img;
						//move_uploaded_file($_FILES[$img_filename]['tmp_name'], $upload_path_big);
						
						//$db_filepath_thumb_img = $images_thumb[$i] = $db_path.$newname."_thumb_".$i.".".$file_extn;
						//$upload_path_thumb = "/Applications/MAMP/htdocs/burosys/images/products/".$db_filepath_thumb_img;
					    //move_uploaded_file($_FILES[$img_filename]['tmp_name'], $upload_path_thumb);
						
						if( $_REQUEST[$hid_img_big_filename] != '' ){
							
							//$sql_add_images = "update bs_product_gallery set product_gallery_title='".$product_name."', product_gallery_big='".$db_filepath_big_img."', product_gallery_thumb = '".$db_filepath_thumb_img."', product_gallery_active = 1 where product_id=".$pid." and product_gallery_sequence=".$_REQUEST[$img_sequence];
							
							//echo $sql_add_images."<br />";
							
							$sql_add_images = mysql_query("update bs_product_gallery set product_gallery_title='".$product_name."', product_gallery_big='".$db_filepath_big_img."', product_gallery_thumb = '".$db_filepath_thumb_img."', product_gallery_active = 1 where product_id=".$pid." and product_gallery_sequence=".$_REQUEST[$img_sequence]);
							
						}else{
							
							//$sql_add_images = "insert into bs_product_gallery (product_id, product_gallery_title, product_gallery_big, product_gallery_thumb, product_gallery_sequence, product_gallery_active) values (".$pid.", '".$product_name."', '".$db_filepath_big_img."', '".$db_filepath_thumb_img."', ".$_REQUEST[$img_sequence].", 1)";
							
							//echo $sql_add_images."<br />";
							
							$sql_add_images = mysql_query("insert into bs_product_gallery (product_id, product_gallery_title, product_gallery_big, product_gallery_thumb, product_gallery_sequence, product_gallery_active) values (".$pid.", '".$product_name."', '".$db_filepath_big_img."', '".$db_filepath_thumb_img."', ".$_REQUEST['txt_img_sequence_'.$i].", 1)");
						
						}	
						
					}
					
				}
				
				for( $i=0; $i<6; $i++ ){
					
					$hid_related_products = "hid_relprod_".$i;
						
					if( $related_products[$i] != 0 ){
							
						if( $_REQUEST[$hid_related_products] != '' ){
								
								//$sql_rel_prod = "update bs_related set related_product_id=".$related_products[$i]." where main_product_id=".$pid." and related_product_id=".$_REQUEST[$hid_related_products];
								
								//echo $sql_rel_prod."<br />";
								
								$sql_rel_prod = mysql_query("update bs_related set related_product_id=".$related_products[$i]." where main_product_id=".$pid." and related_product_id=".$_REQUEST[$hid_related_products]);
						}else{
								
								//$sql_rel_prod = "insert into bs_related (main_product_id, related_product_id, related_active) values (".$record_id.", ".$related_products[$i].", 1)";
								//echo $sql_rel_prod."<br />";
								
								$sql_rel_prod = mysql_query("insert into bs_related (main_product_id, related_product_id, related_active) values (".$pid.", ".$related_products[$i].", 1)");
						}
							
					}else{
					
						if( $_REQUEST[$hid_related_products] != '' ){
								
								//$sql_rel_prod = "update bs_related set related_product_id=".$related_products[$i]." where main_product_id=".$pid." and related_product_id=".$_REQUEST[$hid_related_products];
								
								//echo $sql_rel_prod."<br />";
								
								$sql_rel_prod = mysql_query("delete from bs_related where main_product_id=".$pid." and related_product_id=".$_REQUEST[$hid_related_products]);
						}
					
					
					}
						
				}	
				
				echo "<script>window.location='../products/'</script>";
				
			}
			
		}
		
	}
	
	
	
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
            	<li><a href="../products/">Manage products</a></li>
                <li><a href="addproduct.php" class="sel">Add / Edit product</a></li>
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
        	
            
            <?php
            	if( isset($_REQUEST['pid']) ){
			?>
            <h2Edit product</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']."?pid=".$_REQUEST['pid'];?>" method="post" name="frm_addproduct" id="frm_addproduct" enctype="multipart/form-data">
            <?php
				}else{
			?>
            <h2>Add a new product</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="frm_addproduct" id="frm_addproduct" enctype="multipart/form-data">
            <?php
				}
			?>
            
            
            
            <?php
            	if( $validated != 0 ){
			?>
                <div class="alert">
                    Please correct the errors in the fields beow.
                </div>
            <?php
				}
			?>
            
            <h3 class="title">Product details</h3>
            
            
                <ul class="form">
                    <li>
                    	<label name="lbl_name" id="lbl_name">Product name *</label>
                        <input type="text" name="txt_name" id="txt_name" value="<?php echo $product_name;?>" class="<?php if( $error[0] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                    </li>
                    <li>
                    	<label name="lbl_category" id="lbl_category">Category *</label>
                        <select id="sel_category" name="sel_category" class="<?php if( $error[1] == 1 ){ echo "error"; }else{ echo ""; } ?>">
                        	<option value="0">Select</option>
                            <?php
                            	$sql_category = mysql_query("select * from bs_categories");
								if( mysql_num_rows($sql_category) > 0 ){
									while( $rows = mysql_fetch_array($sql_category) ){
										
										if( $rows['category_type'] == '0' ){
											$category_type = "Office";
										}else{
											$category_type = "Living";
										}
										
							?>
                            	<option value="<?php echo $rows['category_id']; ?>" <?php if( $product_category == $rows['category_id'] ){ echo "selected='selected'"; }else{ echo ""; } ?>><?php echo $category_type." - ".ucfirst($rows['category_name']); ?></option>
                            <?php
									}
								}
							?>
                        </select>
                    </li>
                    <li>
                    	<label name="lbl_collection" id="lbl_collection">Collection *</label>
                        <select id="sel_collection" name="sel_collection" class="<?php if( $error[2] == 1 ){ echo "error"; }else{ echo ""; } ?>">
                        	<option value="0">Select</option>
                            <?php
								//if( isset($pid) ){
									$sqlCollection = mysql_query("select * from bs_collections where category_id=".$product_category);
									if( mysql_num_rows($sqlCollection) > 0 ){
										while( $rows = mysql_fetch_array($sqlCollection) ){
							?>
                            <option value="<?php echo $rows['collection_id']; ?>" <?php if( $product_collection == $rows['collection_id'] ){ echo "selected='selected'"; }else{ echo ""; } ?>><?php echo ucfirst($rows['collection_name']); ?></option>
                            <?php
										}
									}
								//}
							?>
                        </select>
                    </li>
                    <li>
                    	<label name="lbl_desc" id="lbl_desc">Product description *</label>
                        <textarea name="txt_desc" id="txt_desc" class="<?php if( $error[3] == 1 ){ echo "error"; }else{ echo ""; } ?>"><?php echo $product_desc;?></textarea>
                    </li>
                    <li>
                    	<label name="lbl_materials" id="lbl_materials">Product materials *</label>
                        <textarea name="txt_materials" id="txt_materials" class="<?php if( $error[4] == 1 ){ echo "error"; }else{ echo ""; } ?>"><?php echo $product_materials;?></textarea>
                    </li>
                    <li>
                    	<label name="lbl_dimensions" id="lbl_dimensions">Product dimensions *</label>
                        <textarea name="txt_dimensions" id="txt_dimensions" class="<?php if( $error[5] == 1 ){ echo "error"; }else{ echo ""; } ?>"><?php echo $product_dimensions;?></textarea>
                    </li>
                    <li>
                    	<label name="lbl_price" id="lbl_price">Product price *</label>
                        <textarea name="txt_price" id="txt_price" class="<?php if( $error[6] == 1 ){ echo "error"; }else{ echo ""; } ?>"><?php echo $product_price;?></textarea>
                    </li>
                    <li>
                    	<label name="lbl_display_img" id="lbl_display_img">Display image *</label>
                        <input type="file" name="fil_display_img" id="fil_display_img" value="<?php echo $product_display;?>" class="<?php if( $error[7] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                        <input type="hidden" name="hid_fil_display_img" id="hid_fil_display_img" value="<?php echo $product_display; ?>" />
                        <?php
                        	if( isset($pid) && !empty($product_display) ){
						?>
                        <img src="<?php echo FILEPATH."images/products/".$product_display;?>" title="<?php echo $product_name;?>" class="current" />
						<?php
							}
						?>
                    </li>
                    <li>
                    	<label name="lbl_main_img" id="lbl_main_img">Main image *</label>
                        <input type="file" name="fil_main_img" id="fil_main_img" value="<?php echo $product_main;?>" class="<?php if( $error[8] == 1 ){ echo "error"; }else{ echo ""; } ?>"  />
                        <input type="hidden" name="hid_fil_main_img" id="hid_fil_main_img" value="<?php echo $product_main; ?>" />
                        <?php
                        	if( isset($pid) && !empty($product_main) ){
						?>
                        <img src="<?php echo FILEPATH."images/products/".$product_main;?>" title="<?php echo $product_main;?>" class="current main" />
						<?php
							}
						?>
                    </li>
                    <li>
                    	<input type="checkbox" name="chk_featured" id="btn_featured" <?php if( $product_featured == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> /> Featured?
                    </li>
                    <li>
                    	<input type="checkbox" name="chk_bseller" id="btn_bseller" <?php if( $product_bestseller == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> /> Best seller?
                    </li>
                    <li>
                    	<input type="checkbox" name="chk_active" id="btn_active" <?php if( $product_active == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> /> Active?
                    </li>
                </ul>
            
            
            <h3 class="title">Product gallery images</h3>
            
            	<ul class="form">
                
                	<?php
                    	for( $i=0; $i<=9; $i++ ){
					?>
                    
                    <li>
                    	<label name="lbl_img_<?php echo $i; ?>" id="lbl_img_<?php echo $i; ?>">Related image <?php echo ($i+1); ?></label>
                        <input type="file" name="fil_img_<?php echo $i; ?>" id="fil_img_<?php echo $i; ?>" value="<?php echo $images_big[$i]; ?>" />
                        <label name="lbl_imgseq_<?php echo $i; ?>" id="lbl_imgseq_<?php echo $i; ?>" style="clear:both; margin:20px 0 10px;">Sequence number <?php echo $i+1; ?></label> 
                        <input type="text" name="txt_img_sequence_<?php echo $i; ?>" id="txt_img_sequence_<?php echo $i; ?>" style="clear:both;width:30px;" value="<?php echo $images_sequence[$i]; ?>" />
                        <input type="hidden" name="hid_fil_img_big_<?php echo $i?>" id="hid_fil_img_big_<?php echo $i?>" value="<?php echo $images_big[$i]; ?>" />
                        <input type="hidden" name="hid_fil_img_thumb_<?php echo $i?>" id="hid_fil_img_thumb_<?php echo $i?>" value="<?php echo $images_thumb[$i]; ?>" />
                        <?php
                        	if( isset($pid) && !empty($images_big[$i]) ){
						?>
                        <img src="<?php echo FILEPATH."images/products/".$images_big[$i];?>" title="<?php echo $product_title;?>" class="current" />
						<?php
							}
						?>
                    </li>
                    
                    <?php
						}
					?>
                    
                </ul>
            	
            <h3 class="title">Related products</h3>
            
            	<ul class="form">
                	
                    <?php
                    	for( $i=0; $i<6; $i++ ){
					?>
                    
                    <li>
                    	<label name="lbl_related_<?php echo $i; ?>" id="lbl_related_<?php echo $i; ?>">Related product <?php echo ($i+1); ?></label>
                        <select name="sel_relcat_<?php echo $i; ?>" id="sel_relcat_<?php echo $i; ?>" class="relcat">
                        	<option value="0">Select</option>
                            <?php
                            	$sql_category = mysql_query("select * from bs_categories");
								if( mysql_num_rows($sql_category) > 0 ){
									while( $rows = mysql_fetch_array($sql_category) ){
										
										if( $rows['category_type'] == '0' ){
											$category_type = "Office";
										}else{
											$category_type = "Living";
										}
										
							?>
                            	<option value="<?php echo $rows['category_id']; ?>" <?php if( $related_categories[$i] == $rows['category_id'] ){ echo "selected='selected'"; }else{ echo ""; }?>><?php echo $category_type." - ".ucfirst($rows['category_name']); ?></option>
                            <?php
									}
								}
							?>
                        </select>
                        <select name="sel_relcol_<?php echo $i; ?>" id="sel_relcol_<?php echo $i; ?>" class="relcol">
                        	<option value="0">Select</option>
                            <?php
								$sqlRelatedCollection = mysql_query("select * from bs_collections where category_id=".$related_categories[$i]);
								if( mysql_num_rows($sqlRelatedCollection) > 0 ){
									while( $rows = mysql_fetch_array($sqlRelatedCollection) ){
							?>
                            <option value="<?php echo $rows['collection_id'];?>" <?php if( $rows['collection_id'] == $related_collections[$i] ){ echo "selected='selected'"; }else{ ""; } ?>><?php echo ucfirst($rows['collection_name']); ?></option>
                            <?php
									}
								}
							?>
                        </select>
                        <select name="sel_relprod_<?php echo $i; ?>" id="sel_relprod_<?php echo $i; ?>" class="relprod">
                        	<option value="0">Select</option>
                            <?php
                            	$sqlRelatedProducts = mysql_query("select * from bs_products where collection_id=".$related_collections[$i]);
								if( mysql_num_rows($sqlRelatedProducts) > 0 ){
									while( $rows = mysql_fetch_array($sqlRelatedProducts) ){
							?>
                            <option value="<?php echo $rows['product_id'];?>" <?php if( $rows['product_id'] == $related_products[$i] ){ echo "selected='selected'"; }else{ ""; } ?>><?php echo ucfirst($rows['product_name']); ?></option>
                            <?php
									}
								}
							?>
                        </select>
                        <input type="hidden" name="hid_relcat_<?php echo $i?>" id="hid_relcat_<?php echo $i?>" value="<?php echo $related_categories[$i]; ?>" />
                        <input type="hidden" name="hid_relcol_<?php echo $i?>" id="hid_relcol_<?php echo $i?>" value="<?php echo $related_collections[$i]; ?>" />
                        <input type="hidden" name="hid_relprod_<?php echo $i?>" id="hid_relprod_<?php echo $i?>" value="<?php echo $related_products[$i]; ?>" />
                    </li>
                    
                    <?php
						}
					?>
                   
                </ul>
                
                <ul class="form">
                	<li>
                    	<?php
                        	if( isset($pid) ){
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Update product" />
                        <?php
							}else{
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Add product" />
                        <?php
							}
						?>
                    	
                    </li>
                </ul>
                
            
            </form>
            
        </div>
    </div>

<?php
	require "../includes/footer.php";
?>