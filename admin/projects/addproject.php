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
	
	
	
	$project_title = $project_designer = $project_company = $project_location = $project_display = $project_main = $product_desc = "";
	$project_sequence = $project_featured = $project_active = 0;
	$count = 0;
	
	if( isset($_REQUEST['pid']) ){
		$pid = $_REQUEST['pid'];
		$sql_project = mysql_query("select * from bs_projects where project_id=".$pid);
		if( mysql_num_rows($sql_project) > 0 ){
			while( $rows = mysql_fetch_array($sql_project) ){
				$project_title = clean_var($rows['project_title']);
				$project_designer = clean_var($rows['project_designer']);
				$project_company = clean_var($rows['project_company']);
				$project_location = clean_var($rows['project_location']);
				$project_desc = clean_var($rows['project_desc']);
				$project_display = clean_var($rows['project_display_img']);
				$project_main = clean_var($rows['project_main_img']);
				$project_sequence = clean_var($rows['project_sequence']);
				$project_active = $rows['project_active'];
				$project_featured = $rows['project_featured'];
			}
		}
		
		$sqlImages = mysql_query("select * from bs_project_gallery where project_id=".$pid);
		if( mysql_num_rows($sqlImages) > 0 ){
			while( $rows = mysql_fetch_array($sqlImages) ){
				$images_big[$count] = $rows['project_gallery_big'];
				$images_thumb[$count] = $rows['project_gallery_thumb'];
				$images_sequence[$count] = $rows['project_gallery_sequence'];
				$count++;
			}
		}
		
		$count = 0;
		
		$sql_products_used = mysql_query("select * from bs_project_product where project_id=".$pid);
		if( mysql_num_rows($sql_products_used) > 0 ){
			
			while( $rows = mysql_fetch_array($sql_products_used) ){
				$related_products[$count] = $rows['product_id'];
				
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
		
		$project_title = clean_var($_REQUEST['txt_title']);
		$project_designer = clean_var($_REQUEST['txt_designer']);
		$project_company = clean_var($_REQUEST['txt_company']);
		$project_location = clean_var($_REQUEST['txt_location']);
		$project_desc = clean_var($_REQUEST['txt_desc']);
		$project_sequence = clean_var($_REQUEST['txt_sequence']);
		
		if( isset($pid) ){
			if( $_FILES['fil_display_img']['name'] != '' ){
				$project_display = clean_var($_FILES['fil_display_img']['name']);	
			}else{
				$project_display = $_REQUEST['hid_fil_display_img'];
			}
			
			if( $_FILES['fil_main_img']['name'] != '' ){
				$project_main = clean_var($_FILES['fil_main_img']['name']);	
			}else{
				$project_main = $_REQUEST['hid_fil_main_img'];
			}
		}else{
			$project_display = clean_var($_FILES['fil_display_img']['name']);
			$project_main = clean_var($_FILES['fil_main_img']['name']);
		}
		
		$project_sequence = clean_var($_REQUEST['txt_sequence']);
		//$file_path = "/Applications/MAMP/htdocs/burosys/images/projects/";
		$file_path = "/home/sagpat2/sagarapatil.com/clients/burosys/images/projects/";
		
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
			$project_featured = 1;
		}else{
			$project_featured = 0;
		}
		
		if( isset($_REQUEST['chk_active']) ){
			$project_active = 1;
		}else{
			$project_active = 0;
		}
		
		$error[0] = validName($project_title);
		$error[1] = validName($project_designer);
		$error[2] = validName($project_company);
		$error[3] = validName($project_location);
		$error[4] = validMessage($project_desc);
		$error[5] = validMessage($project_sequence);
		
		if( !isset($pid) ){
			
			if( (($_FILES['fil_display_img']['name'] != '') || ($_FILES['fil_display_img']['error'] <= 0)) && (($_FILES['fil_display_img']['type'] == 'image/jpg') || ($_FILES['fil_display_img']['type'] == 'image/jpeg') || ($_FILES['fil_display_img']['type'] == 'image/png')) ){
				$error[6] = 0;
			}else{
				$error[6] = 1;
			}
			
			if( (($_FILES['fil_main_img']['name'] != '') || ($_FILES['fil_main_img']['error'] <= 0)) && (($_FILES['fil_main_img']['type'] == 'image/jpg') || ($_FILES['fil_main_img']['type'] == 'image/jpeg') || ($_FILES['fil_main_img']['type'] == 'image/png')) ){
				$error[7] = 0;
			}else{
				$error[7] = 1;
			}
		
		}else{
		
			if( ($_FILES['fil_display_img']['name'] == '') && ($_REQUEST['hid_fil_display_img'] == '') ){
				$error[6] = 1;
			}else{
				$error[6] = 0;
			}
		
			if( ($_FILES['fil_main_img']['name'] == '') && ($_REQUEST['hid_fil_main_img'] == '') ){
				$error[7] = 1;
			}else{
				$error[7] = 0;
			}
			
		}
		
		for( $i=0; $i<8; $i++ ){
			$validated += $error[$i];
		}
		
		if( $validated == 0 ){
			
			if( $sbt_value == 'Add project' ){
			
				//upload display image
				$file_extn = pathinfo($_FILES['fil_main_img']['name'],PATHINFO_EXTENSION);
				$newname = str_replace(' ', '', $_FILES['fil_display_img']['name']);
				$newname = str_replace($file_extn, '', $newname);
				$newname = str_replace('.', '', $newname);
					
				$db_filepath_display = $newname."_display.".$file_extn;
				$upload_path_display = $file_path.$newname."_display.".$file_extn;
				move_uploaded_file($_FILES['fil_display_img']['tmp_name'], $upload_path_display);
				
				//upload main image	
				$file_extn = pathinfo($_FILES['fil_main_img']['name'],PATHINFO_EXTENSION);
				$newname = str_replace(' ', '', $_FILES['fil_main_img']['name']);
				$newname = str_replace($file_extn, '', $newname);
				$newname = str_replace('.', '', $newname);
					
				$db_filepath_main = $newname."_main.".$file_extn;
				$upload_path_main = $file_path.$newname."_main.".$file_extn;
				move_uploaded_file($_FILES['fil_main_img']['tmp_name'], $upload_path_main);
			
				//$sql_project = "insert into bs_projects (project_title, project_designer, project_company, project_location, project_display_img, project_main_img, project_desc, project_sequence, project_featured, project_active) values ('".$project_title."', '".$project_designer."', '".$project_company."', '".$project_location."', '".$db_filepath_display."', '".$db_filepath_main."', '".$project_desc."', ".$project_sequence.", ".$project_featured.", ".$project_active.")";
				
				//echo $sql_project;
				
				$sql_project = mysql_query("insert into bs_projects (project_title, project_designer, project_company, project_location, project_display_img, project_main_img, project_desc, project_sequence, project_featured, project_active) values ('".$project_title."', '".$project_designer."', '".$project_company."', '".$project_location."', '".$db_filepath_display."', '".$db_filepath_main."', '".$project_desc."', ".$project_sequence.", ".$project_featured.", ".$project_active.")");
				
				//echo "<br />";
				
				$record_id = mysql_insert_id();
				
				for( $i=0; $i<9; $i++ ){
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
						
						$db_filepath_thumb_img = $images_thumb[$i] = $newname."_thumb_".$i.".".$file_extn;
						//$upload_path_thumb = "/Applications/MAMP/htdocs/burosys/images/projects/".$newname."_thumb_".$i.".".$file_extn;
						$upload_path_thumb = "/home/sagpat2/sagarapatil.com/clients/burosys/images/projects/".$newname."_thumb_".$i.".".$file_extn;
						move_uploaded_file($_FILES[$img_filename]['tmp_name'], $upload_path_thumb);
						
						$db_filepath_big_img = $images_big[$i] = $newname."_big_".$i.".".$file_extn;
						//$upload_path_big = "/Applications/MAMP/htdocs/burosys/images/projects/".$newname."_big_".$i.".".$file_extn;
						$upload_path_big = "/home/sagpat2/sagarapatil.com/clients/burosys/images/projects/".$newname."_big_".$i.".".$file_extn;
						move_uploaded_file($_FILES[$img_filename]['tmp_name'], $upload_path_big);
						
						
						//$sql_add_images = "insert into bs_project_gallery (project_id, project_gallery_title, project_gallery_big, project_gallery_thumb, project_gallery_sequence, project_gallery_active) values (".$record_id.", '".$project_title."', '".$db_filepath_big_img."', '".$db_filepath_thumb_img."', ".$_REQUEST['txt_img_sequence_'.$i].", 1)";
						//echo $sql_add_images."<br />";
						
						$sql_add_images = mysql_query("insert into bs_project_gallery (project_id, project_gallery_title, project_gallery_big, project_gallery_thumb, project_gallery_sequence, project_gallery_active) values (".$record_id.", '".$project_title."', '".$db_filepath_big_img."', '".$db_filepath_thumb_img."', ".$_REQUEST['txt_img_sequence_'.$i].", 1)");
						
					}
				}
				
				//echo "<br />";
				
				for( $i=0; $i<6; $i++ ){
					
					if( $related_products[$i] != 0 ){
						
						//$sql_rel_prod = "insert into bs_project_product (project_id, product_id, project_product_active) values (".$record_id.", ".$related_products[$i].", 1)";
						
						//echo $sql_rel_prod."<br />";
						
						$sql_rel_prod = mysql_query("insert into bs_project_product (project_id, product_id, project_product_active) values (".$record_id.", ".$related_products[$i].", 1)");
					}
				}
				
				//echo "<br />";
				echo "<script>window.location='../projects/'</script>";
				
			}
			
			if( $sbt_value == 'Update project' ){
				
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
				
				//$sqlProduct = "update bs_projects set project_title=".$project_title.", project_designer='".$project_designer."', project_company='".$project_company."', project_location='".$project_location."', project_desc='".$project_desc."', project_sequence='".$project_sequence."', project_display_img='".$db_filepath_display."', project_main_img='".$db_filepath_main."', project_featured=".$project_featured.", project_active=".$project_active." where project_id=".$pid;
				
				//echo $sqlProduct;
				
				$sqlProduct = mysql_query("update bs_projects set project_title=".$project_title.", project_designer='".$project_designer."', project_company='".$project_company."', project_location='".$project_location."', project_desc='".$project_desc."', project_sequence='".$project_sequence."', project_display_img='".$db_filepath_display."', project_main_img='".$db_filepath_main."', project_featured=".$project_featured.", project_active=".$project_active." where project_id=".$pid);
				
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
						
						$db_filepath_big_img = $images_big[$i] = $newname."_big_".$i.".".$file_extn;
						$db_filepath_thumb_img = $images_thumb[$i] = $newname."_thumb_".$i.".".$file_extn;
						
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
						//$filename_big = "/Applications/MAMP/htdocs/burosys/images/projects/". $db_filepath_big_img;
						$filename_big = "/home/sagpat2/sagarapatil.com/clients/burosys/images/projects/". $db_filepath_big_img;
						imagejpeg($tmp_big,$filename_big,100);
						
						imagecopyresampled($tmp_thumb,$src,0,0,0,0,$newwidth_thumb,$newheight_thumb,$width_thumb,$height_thumb);
						//$filename_thumb = "/Applications/MAMP/htdocs/burosys/images/projects/". $db_filepath_thumb_img;
						$filename_thumb = "/home/sagpat2/sagarapatil.com/clients/burosys/images/projects/". $db_filepath_thumb_img;
						imagejpeg($tmp_thumb,$filename_thumb,100);
						
						
						//$db_filepath_big_img = $images_big[$i] = $newname."_big_".$i.".".$file_extn;
						//$upload_path_big = "/Applications/MAMP/htdocs/burosys/images/projects/".$db_filepath_big_img;
						//move_uploaded_file($_FILES[$img_filename]['tmp_name'], $upload_path_big);
						
						//$db_filepath_thumb_img = $images_thumb[$i] = $newname."_thumb_".$i.".".$file_extn;
						//$upload_path_thumb = "/Applications/MAMP/htdocs/burosys/images/projects/".$db_filepath_thumb_img;
					    //move_uploaded_file($_FILES[$img_filename]['tmp_name'], $upload_path_thumb);
						
						if( $_REQUEST[$hid_img_big_filename] != '' ){
							
							//$sql_add_images = "update bs_project_gallery set project_id=".$pid.", project_gallery_title='".$project_title."', project_gallery_big='".$db_filepath_big_img."', project_gallery_thumb='".$db_filepath_thumb_img."', project_gallery_sequence=".$_REQUEST[$img_sequence].", project_gallery_active=1 where project_id=".$pid;
							
							//echo $sql_add_images;
							
							$sql_add_images = mysql_query("update bs_project_gallery set project_gallery_title='".$project_title."', project_gallery_big='".$db_filepath_big_img."', project_gallery_thumb='".$db_filepath_thumb_img."', project_gallery_active=1 where project_id=".$pid." and project_gallery_sequence=".$_REQUEST[$img_sequence]);
							
						}else{
							
							//$sql_add_images = "insert into bs_project_gallery (project_id, project_gallery_title, project_gallery_big, project_gallery_thumb, project_gallery_sequence, project_gallery_active) values (".$pid.", '".$project_title."', '".$db_filepath_big_img."', '".$db_filepath_thumb_img."', ".$_REQUEST[$img_sequence].", 1)";
							//echo $sql_add_images;
							
							$sql_add_images = mysql_query("insert into bs_project_gallery (project_id, project_gallery_title, project_gallery_big, project_gallery_thumb, project_gallery_sequence, project_gallery_active) values (".$pid.", '".$project_title."', '".$db_filepath_big_img."', '".$db_filepath_thumb_img."', ".$_REQUEST[$img_sequence].", 1)");
						
						}	
						
					}
					
				}
				
				
				for( $i=0; $i<6; $i++ ){
						
						$hid_related_products = "hid_relprod_".$i;
						
						if( $related_products[$i] != 0 ){
							
							if( $_REQUEST[$hid_related_products] != '' ){
								
								//$sql_rel_prod = "update bs_project_product set product_id=".$related_products[$i]." where project_id=".$pid." and product_id=".$_REQUEST[$hid_related_products];
								
								//echo $sql_rel_prod."<br />";
								
								$sql_rel_prod = mysql_query("update bs_project_product set product_id=".$related_products[$i]." where project_id=".$pid." and product_id=".$_REQUEST[$hid_related_products]);
							}else{
								
								//$sql_rel_prod = "insert into bs_project_product (project_id, product_id, project_product_active) values (".$record_id.", ".$related_products[$i].", 1)";
								
								//echo $sql_rel_prod."<br />";
								
								$sql_rel_prod = mysql_query( "insert into bs_project_product (project_id, product_id, project_product_active) values (".$pid.", ".$related_products[$i].", 1)");
							}
							
						}else{
						
							if( $_REQUEST[$hid_related_products] != '' ){
									
									//$sql_rel_prod = "update bs_project_product set product_id=".$related_products[$i]." where project_id=".$pid." and product_id=".$_REQUEST[$hid_related_products];
									
									//echo $sql_rel_prod."<br />";
									
									$sql_rel_prod = mysql_query("delete from bs_project_product where project_id=".$pid." and product_id=".$_REQUEST[$hid_related_products]);
							}
						
						}
						
					}
					
					echo "<br />";
					
					echo "<script>window.location='../projects/'</script>";
				
				
			}
			
			//header("Location:index.php");
			
			
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
                <li><a href="addproduct.php">Add / Edit product</a></li>
            </ul>
            
            <ul>
            	<li class="head">Project options</li>
            	<li><a href="../projects/">Manage projects</a></li>
                <li><a href="../projects/addproject.php" class="sel">Add / Edit project</a></li>
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
            <h2>Edit project</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']."?pid=".$_REQUEST['pid'];?>" method="post" name="frm_addproduct" id="frm_addproduct" enctype="multipart/form-data">
            <?php
				}else{
			?>
            <h2>Add a new project</h2>
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
                    	<label name="lbl_title" id="lbl_title">Project title *</label>
                        <input type="text" name="txt_title" id="txt_title" value="<?php echo $project_title;?>" class="<?php if( $error[0] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                    </li>
                    <li>
                    	<label name="lbl_designer" id="lbl_designer">Designer *</label>
                        <input type="text" name="txt_designer" id="txt_designer" value="<?php echo $project_designer;?>" class="<?php if( $error[1] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                    </li>
                    <li>
                    	<label name="lbl_company" id="lbl_company">Company *</label>
                        <input type="text" name="txt_company" id="txt_company" value="<?php echo $project_company;?>" class="<?php if( $error[2] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                    </li>
                    <li>
                    	<label name="lbl_location" id="lbl_location">Location *</label>
                        <input type="text" name="txt_location" id="txt_location" value="<?php echo $project_location;?>" class="<?php if( $error[3] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                    </li>
                    <li>
                    	<label name="lbl_desc" id="lbl_desc">Description *</label>
                        <input type="text" name="txt_desc" id="txt_desc" value="<?php echo $project_desc;?>" class="<?php if( $error[4] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                    </li>
                    <li>
                    	<label name="lbl_sequence" id="lbl_sequence">Sequence *</label>
                        <input type="text" name="txt_sequence" id="txt_sequence" value="<?php echo $project_sequence?>" class="<?php if( $error[5] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                    </li>
                    <li>
                    	<label name="lbl_display_img" id="lbl_display_img">Display image *</label>
                        <input type="file" name="fil_display_img" id="fil_display_img" value="<?php echo $project_display;?>" class="<?php if( $error[6] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                        <input type="hidden" name="hid_fil_display_img" id="hid_fil_display_img" value="<?php echo $project_display; ?>" />
                        <?php
                        	if( isset($pid) && !empty($project_display) ){
						?>
                        <img src="<?php echo FILEPATH."images/projects/".$project_display;?>" title="<?php echo $project_name;?>" class="current" />
						<?php
							}
						?>
                    </li>
                    <li>
                    	<label name="lbl_main_img" id="lbl_main_img">Main image *</label>
                        <input type="file" name="fil_main_img" id="fil_main_img" value="<?php echo $project_main;?>" class="<?php if( $error[7] == 1 ){ echo "error"; }else{ echo ""; } ?>"  />
                        <input type="hidden" name="hid_fil_main_img" id="hid_fil_main_img" value="<?php echo $project_main; ?>" />
                        <?php
                        	if( isset($pid) && !empty($project_main) ){
						?>
                        <img src="<?php echo FILEPATH."images/projects/".$project_main;?>" title="<?php echo $project_main;?>" class="current main" />
                        <?php
							}
						?>
                    </li>
                    <li>
                    	<input type="checkbox" name="chk_featured" id="btn_featured" <?php if( $project_featured == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> /> Featured?
                    </li>
                    <li>
                    	<input type="checkbox" name="chk_active" id="btn_active" <?php if( $project_active == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> /> Active?
                    </li>
                </ul>
            
            
            <h3 class="title">Project gallery images</h3>
            
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
                        <img src="<?php echo FILEPATH."images/projects/".$images_big[$i];?>" title="<?php echo $product_name;?>" class="current" />
						<?php
							}
						?>
                    </li>
                    
                    <?php
						}
					?>
                    
                </ul>
            	
            <h3 class="title">Products used</h3>
            
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
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Update project" />
                        <?php
							}else{
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Add project" />
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