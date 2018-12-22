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
	
	$background_image = "";
	$background_tiling = $background_page = $background_active = $background_fixed = 0;
	$count = 0;
	
	if( isset($_REQUEST['pid']) ){
		$pid = $_REQUEST['pid'];
		$sql_featured = mysql_query("select * from bs_backgrounds where backgrounds_id=".$pid);
		if( mysql_num_rows($sql_featured) > 0 ){
			while( $rows = mysql_fetch_array($sql_featured) ){
				$background_image = clean_var($rows['background_image']);
				if( $rows['background_tilex'] == 1 ){
					$background_tiling = 1;	
				}elseif( $rows['background_tiley'] == 1 ){
					$background_tiling = 2;
				}elseif( $rows['background_tilexy'] == 1 ){
					$background_tiling = 3;
				}elseif( $rows['background_notile'] == 1 ){
					$background_tiling = 4;
				}
				$background_page = $rows['pages_id'];
				$background_active = $rows['background_active'];
				$background_fixed = $rows['background_fixed'];
			}
		}
		$count = 0;
	}
	
	if( isset($_REQUEST['sbt_btn']) ){
		$validated = 0;
		$error[] = 0;
		$featured_images[] = "";
		
		if( isset($_POST['pid']) ){
			$pid = $_POST['pid'];
		}
		$sbt_value = $_REQUEST['sbt_btn'];
			
		if( isset($pid) ){
			if( $_FILES['fil_background']['name'] != '' ){
				$background_image = clean_var($_FILES['fil_background']['name']);
			}else{
				$background_image = clean_var($_REQUEST['hid_fil_background']);
			}
		}else{
			$background_image = clean_var($_FILES['fil_background']['name']);	
		}
		
		$background_tiling = $_REQUEST['rad_tiling'];
		$background_page = $_REQUEST['sel_pages'];
		
		$file_path = UPLOAD_PATH."images/layout/";
		
		if( isset($_REQUEST['chk_fixed']) ){
			$background_fixed = 1;
		}else{
			$background_fixed = 0;
		}
		
		if( isset($_REQUEST['chk_active']) ){
			$background_active = 1;
		}else{
			$background_active = 0;
		}
		
		if( $background_page == 0 ){
			$error[0] = 1;
		}else{
			$error[0] = 0;
		}
		
		if( !isset($background_tiling) ){
			$error[1] = 1;
		}else{
			$error[1] = 0;
		}
		
		if( !isset($pid) ){
		
			if( (($_FILES['fil_background']['name'] != '') || ($_FILES['fil_background']['error'] <= 0)) && (($_FILES['fil_background']['type'] == 'image/jpg') || ($_FILES['fil_background']['type'] == 'image/jpeg') || ($_FILES['fil_background']['type'] == 'image/png') || ($_FILES['fil_background']['type'] == 'image/gif')) ){
				$error[2] = 0;
			}else{
				$error[2] = 1;
			}
		
		}else{
		
			if( ($_FILES['fil_background']['name'] == '') && ($_REQUEST['hid_fil_background'] == '') ){
				$error[2] = 1;
			}else{
				$error[2] = 0;
			}
		
		}
		
		for( $i=0; $i<3; $i++ ){
			$validated += $error[$i];
		}
		
		if( $validated == 0 ){
			
			if( $sbt_value == 'Add background' ){
				
				if( $background_tiling == 1 ){
					$tiling_opt_1 = 1;
					$tiling_opt_2 = $tiling_opt_3 = $tiling_opt_4 = 0;
				}elseif( $background_tiling == 2 ){
					$tiling_opt_2 = 1;
					$tiling_opt_1 = $tiling_opt_3 = $tiling_opt_4 = 0;
				}elseif( $background_tiling == 3 ){
					$tiling_opt_3 = 1;
					$tiling_opt_1 = $tiling_opt_2 = $tiling_opt_4 = 0;
				}elseif( $background_tiling == 4 ){
					$tiling_opt_4 = 1;
					$tiling_opt_1 = $tiling_opt_2 = $tiling_opt_3 = 0;
				}
				
				
				//upload display image
				$file_extn = pathinfo($_FILES['fil_background']['name'],PATHINFO_EXTENSION);
				$newname = str_replace(' ', '', $_FILES['fil_background']['name']);
				$newname = str_replace($file_extn, '', $newname);
				$newname = str_replace('.', '', $newname);
				
				$upload_path_display = $file_path.$newname.".".$file_extn;
				move_uploaded_file($_FILES['fil_background']['tmp_name'], $upload_path_display);
			
				//$sqlProduct = "insert into bs_backgrounds (background_image, pages_id, background_tilex, background_tiley, background_tilexy, background_notile, background_active, background_date_entered, background_date_modified) values ('".$background_image."', ".$background_page.", ".$tiling_opt_1.", ".$tiling_opt_2.", ".$tiling_opt_3.", ".$tiling_opt_4.", ".$background_active.", '".InputDateTime()."', '".InputDateTime()."')";
				
				//echo $sqlProduct;
				
				$sqlProduct = mysql_query("insert into bs_backgrounds (background_image, pages_id, background_tilex, background_tiley, background_tilexy, background_notile, background_active, background_fixed, background_date_entered, background_date_modified) values ('".$background_image."', ".$background_page.", ".$tiling_opt_1.", ".$tiling_opt_2.", ".$tiling_opt_3.", ".$tiling_opt_4.", ".$background_active.", ".$background_fixed.", '".InputDateTime()."', '".InputDateTime()."')");
				
				echo "<script>window.location='index.php'</script>";
				
			}
			
			if( $sbt_value == 'Update background' ){
				
				
				if( $background_tiling == 1 ){
					$tiling_opt_1 = 1;
					$tiling_opt_2 = $tiling_opt_3 = $tiling_opt_4 = 0;
				}elseif( $background_tiling == 2 ){
					$tiling_opt_2 = 1;
					$tiling_opt_1 = $tiling_opt_3 = $tiling_opt_4 = 0;
				}elseif( $background_tiling == 3 ){
					$tiling_opt_3 = 1;
					$tiling_opt_1 = $tiling_opt_2 = $tiling_opt_4 = 0;
				}elseif( $background_tiling == 4 ){
					$tiling_opt_4 = 1;
					$tiling_opt_1 = $tiling_opt_2 = $tiling_opt_3 = 0;
				}
				
				if( $_FILES['fil_background']['name'] != '' ){
					//upload display image
					$file_extn = pathinfo($_FILES['fil_background']['name'],PATHINFO_EXTENSION);
					$newname = str_replace(' ', '', $_FILES['fil_background']['name']);
					$newname = str_replace($file_extn, '', $newname);
					$newname = str_replace('.', '', $newname);
					
					$upload_path_display = $file_path.$newname.".".$file_extn;
					move_uploaded_file($_FILES['fil_background']['tmp_name'], $upload_path_display);
				}else{
					if( $_REQUEST['hid_fil_background'] != '' ){
						$background_image = $_REQUEST['hid_fil_background'];
					}else{
						$background_image = "";
					}
				}
				
				//$sql_featured = "update bs_backgrounds set background_image='".$background_image."', pages_id=".$background_page.", background_tilex=".$tiling_opt_1.", background_tiley=".$tiling_opt_2.", background_tilexy=".$tiling_opt_3.", background_notile=".$tiling_opt_4.", background_active=".$background_active.", background_fixed=".$background_fixed.", background_date_modified='".InputDateTime()."' where backgrounds_id=".$pid;
				
				//echo $sql_featured;
				
				$sql_featured = mysql_query("update bs_backgrounds set background_image='".$background_image."', pages_id=".$background_page.", background_tilex=".$tiling_opt_1.", background_tiley=".$tiling_opt_2.", background_tilexy=".$tiling_opt_3.", background_notile=".$tiling_opt_4.", background_active=".$background_active.", background_fixed=".$background_fixed.", background_date_modified='".InputDateTime()."' where backgrounds_id=".$pid);
				
				echo "<script>window.location='index.php'</script>";
				
			}
			
		}
		
	}
	
	
	
?>

	<div id="content" class="admin">
    	<div id="sidebar">
        	<h2>Menu</h2>
            
            <ul>
            	<li class="head">Featured image management</li>
            	<li><a href="../home/">Manage featured images</a></li>
                <li><a href="../home/addfeatured.php">Add / Edit featured</a></li>
            </ul>
            
            <ul>
            	<li class="head">Background management</li>
            	<li><a href="../background/">Manage background images</a></li>
                <li><a href="../background/addbackground.php" class="sel">Add / Edit background image</a></li>
            </ul>
            
            <ul>
            	<li class="head">Ad banner management</li>
            	<li><a href="../ads/">Manage ad banners</a></li>
                <li><a href="../ads/addads.php">Add / Edit ad banners</a></li>
            </ul>
            
            <ul>
            	<li class="head">Intro banner management</li>
            	<li><a href="../intro/">Manage intro banners</a></li>
                <li><a href="../intro/addintro.php">Add / Edit intro banners</a></li>
            </ul>
            
            <ul>
            	<li class="head">Product management</li>
            	<li><a href="../products/">Manage products</a></li>
                <li><a href="addproduct.php">Add / Edit product</a></li>
            </ul>
            
            <ul>
            	<li class="head">Project management</li>
            	<li><a href="../projects/">Manage projects</a></li>
                <li><a href="../projects/addproject.php">Add / Edit project</a></li>
            </ul>
            
            <ul>
            	<li class="head">Downloads management</li>
            	<li><a href="../downloads/">Manage downloads</a></li>
                <li><a href="../downloads/adddownload.php">Add / Edit downloads</a></li>
            </ul>
            
            <ul>
            	<li class="head">Client management</li>
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
            <h2>Edit featrued images</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']."?pid=".$_REQUEST['pid'];?>" method="post" name="frm_featured" id="frm_featured" enctype="multipart/form-data">
            <?php
				}else{
			?>
            <h2>Add a featured image</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="frm_featured" id="frm_featured" enctype="multipart/form-data">
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
            
            <h3 class="title">Background image details</h3>
            
            
                <ul class="form">
                    <li>
                    	<label name="lbl_pages" id="lbl_pages">Page *</label>
                        <select name="sel_pages" id="sel_pages">
                        	<option value="0">Select</option>
                            <?php
                            	$sql_pages = mysql_query("select * from bs_pages");
								if( mysql_num_rows($sql_pages) > 0 ){
									while( $rows = mysql_fetch_array($sql_pages) ){
							?>
                            <option value="<?php echo $rows['pages_id']; ?>" class="<?php if( $error[0] == 1 ){ echo "error"; }else{ echo ""; } ?>" <?php if( $rows['pages_id'] == $background_page ){ echo "selected='selected'"; }else{ echo ""; } ?>><?php echo ucfirst($rows['pages_name']); ?></option>
                            <?php
									}
								}
							?>
                        </select>
                    </li>
                    <li>
                    	<label name="lbl_background" id="lbl_background">Background image *</label>
                        <input type="file" name="fil_background" id="fil_background" value="<?php echo $background_image;?>" class="<?php if( $error[2] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                        <input type="hidden" name="hid_fil_background" id="hid_fil_background" value="<?php echo $background_image; ?>" />
                        <?php
                        	if( isset($pid) && !empty($background_image) ){
						?>
                        <img src="<?php echo FILEPATH."images/layout/".$background_image;?>" class="current" style="width:500px; height:auto;" />
						<?php
							}
						?>
                    </li>
                    <li>
                    	<label name="lbl_tiling" id="lbl_tiling" class="<?php if( $error[1] == 1 ){ echo "error"; }else{ echo ""; } ?>">Tiling options *</label>
                        <input type="radio" name="rad_tiling" id="rad_tiling" value="1" <?php if( $background_tiling == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> />Tile horizontally
                        <input type="radio" name="rad_tiling" id="rad_tiling" value="2" <?php if( $background_tiling == 2 ){ echo "checked='checked'"; }else{ echo ""; } ?>/>Tile vertically
                        <input type="radio" name="rad_tiling" id="rad_tiling" value="3" <?php if( $background_tiling == 3 ){ echo "checked='checked'"; }else{ echo ""; } ?> />Tile horizontally and vertically
                        <input type="radio" name="rad_tiling" id="rad_tiling" value="4" <?php if( $background_tiling == 4 ){ echo "checked='checked'"; }else{ echo ""; } ?> />No tiling
                    </li>

					<li>
                    	<input type="checkbox" name="chk_fixed" id="btn_fixed" <?php if( $background_fixed == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> /> Fixed?
                    </li>

                    <li>
                    	<input type="checkbox" name="chk_active" id="btn_active" <?php if( $background_active == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> /> Active?
                    </li>
                </ul>
                
                <ul class="form">
                	<li>
                    	<?php
                        	if( isset($pid) ){
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Update background" />
                        <?php
							}else{
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Add background" />
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