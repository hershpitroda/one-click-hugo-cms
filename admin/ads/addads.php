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
	
	$ad_image = $ad_url = "";
	$ad_page = $ad_active = 0;
	$count = 0;
	
	if( isset($_REQUEST['pid']) ){
		$pid = $_REQUEST['pid'];
		$sql_ads = mysql_query("select * from bs_ads where ads_id=".$pid);
		if( mysql_num_rows($sql_ads) > 0 ){
			while( $rows = mysql_fetch_array($sql_ads) ){
				$ad_image = clean_var($rows['ads_image']);
				$ad_url = $rows['ads_url'];
				$ad_page = $rows['pages_id'];
				$ad_active = $rows['ads_active'];
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
		
		$ad_url = $_REQUEST['txt_url'];
		$ad_page = $_REQUEST['sel_pages'];
			
		if( isset($pid) ){
			if( $_FILES['fil_ad']['name'] != '' ){
				$ad_image = clean_var($_FILES['fil_ad']['name']);
			}else{
				$ad_image = clean_var($_REQUEST['hid_fil_ad']);
			}
		}else{
			$ad_image = clean_var($_FILES['fil_ad']['name']);	
		}
		
		//$file_path = "/Applications/MAMP/htdocs/burosys/images/intro/home/";
		$file_path = UPLOAD_PATH."images/ads/";
		
		if( isset($_REQUEST['chk_active']) ){
			$ad_active = 1;
		}else{
			$ad_active = 0;
		}
		
		if( !empty($ad_url) || ($ad_url != '') ){
			$error[0] = 0;
		}else{
			$error[0] = 1;
		}
		
		if( $ad_page != 0 ){
			$error[1] = 0;
		}else{
			$error[1] = 1;
		}
		
		if( !isset($pid) ){
		
			if( (($_FILES['fil_ad']['name'] != '') || ($_FILES['fil_ad']['error'] <= 0)) && (($_FILES['fil_ad']['type'] == 'image/jpg') || ($_FILES['fil_ad']['type'] == 'image/jpeg') || ($_FILES['fil_ad']['type'] == 'image/png')) ){
				$error[2] = 0;
			}else{
				$error[2] = 1;
			}
		
		}else{
		
			if( ($_FILES['fil_ad']['name'] == '') && ($_REQUEST['hid_fil_ad'] == '') ){
				$error[2] = 1;
			}else{
				$error[2] = 0;
			}
		
		}
		
		for( $i=0; $i<3; $i++ ){
			$validated += $error[$i];
		}
		
		if( $validated == 0 ){
			
			if( $sbt_value == 'Add ad' ){
			
				//upload display image
				$file_extn = pathinfo($_FILES['fil_ad']['name'],PATHINFO_EXTENSION);
				$newname = str_replace(' ', '', $_FILES['fil_ad']['name']);
				$newname = str_replace($file_extn, '', $newname);
				$newname = str_replace('.', '', $newname);
				
				$upload_path_display = $file_path.$newname.".".$file_extn;
				move_uploaded_file($_FILES['fil_ad']['tmp_name'], $upload_path_display);
			
				//$sqlProduct = "insert into bs_ads (pages_id, ads_url, ads_image, ads_active, ads_date_entered, ads_date_modified) values (".$ad_page.", '".$ad_url."', '".$ad_image."', ".$ad_active.", '".InputDateTime()."', '".InputDateTime()."')";
				
				//echo $sqlProduct;
				
				$sqlProduct = mysql_query("insert into bs_ads (pages_id, ads_url, ads_image, ads_active, ads_date_entered, ads_date_modified) values (".$ad_page.", '".$ad_url."', '".$ad_image."', ".$ad_active.", '".InputDateTime()."', '".InputDateTime()."')");
				
				echo "<script>window.location='index.php'</script>";
				
			}
			
			if( $sbt_value == 'Update ad' ){
				
				if( $_FILES['fil_ad']['name'] != '' ){
					//upload display image
					$file_extn = pathinfo($_FILES['fil_ad']['name'],PATHINFO_EXTENSION);
					$newname = str_replace(' ', '', $_FILES['fil_ad']['name']);
					$newname = str_replace($file_extn, '', $newname);
					$newname = str_replace('.', '', $newname);
					
					$upload_path_display = $file_path.$newname.".".$file_extn;
					move_uploaded_file($_FILES['fil_ad']['tmp_name'], $upload_path_display);
				}else{
					if( $_REQUEST['hid_fil_ad'] != '' ){
						$intro_image = $_REQUEST['hid_fil_ad'];
					}else{
						$intro_image = "";
					}
				}
				
				//$sql_featured = "update bs_ads set ads_image='".$ad_image."', ads_url='".$ad_url."', ads_active=".$ad_active.", ads_date_modified='".InputDateTime()."' where pages_id=".$ad_page;
				
				//echo $sql_featured;
				
				$sql_featured = mysql_query("update bs_ads set pages_id=".$ad_page.", ads_image='".$ad_image."', ads_url='".$ad_url."', ads_active=".$ad_active.", ads_date_modified='".InputDateTime()."' where ads_id=".$pid);
				
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
                <li><a href="../background/addbackground.php">Add / Edit background image</a></li>
            </ul>
            
            <ul>
            	<li class="head">Ad banner management</li>
            	<li><a href="../ads/">Manage ad banners</a></li>
                <li><a href="../ads/addads.php" class="sel">Add / Edit ad banners</a></li>
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
            <h2>Edit intro banner</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']."?pid=".$_REQUEST['pid'];?>" method="post" name="frm_featured" id="frm_featured" enctype="multipart/form-data">
            <?php
				}else{
			?>
            <h2>Add an intro banner</h2>
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
            
            <h3 class="title">Intro banner details</h3>
            
            
                <ul class="form">
                    <li>
                    	<label name="lbl_page" id="lbl_page">Banner page *</label>
                        <select name="sel_pages" id="sel_pages">
                        	<option value="0">Select</option>
                            <?php
                            	$sql_pages = mysql_query("select * from bs_pages");
								if( mysql_num_rows($sql_pages) > 0 ){
									while( $rows = mysql_fetch_array($sql_pages) ){
							?>
                            <option value="<?php echo $rows['pages_id']; ?>" class="<?php if( $error[1] == 1 ){ echo "error"; }else{ echo ""; } ?>" <?php if( $rows['pages_id'] == $ad_page ){ echo "selected='selected'"; }else{ echo ""; } ?>><?php echo ucfirst($rows['pages_name']); ?></option>
                            <?php
									}
								}
							?>
                        </select>
                    </li>
                    <li>
                    	<label name="lbl_ad" id="lbl_ad">Ad image *</label>
                        <input type="file" name="fil_ad" id="fil_ad" value="<?php echo $ad_image;?>" class="<?php if( $error[2] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                        <input type="hidden" name="hid_fil_ad" id="hid_fil_ad" value="<?php echo $ad_image; ?>" />
                        <?php
                        	if( isset($pid) && !empty($ad_image) ){
						?>
                        <img src="<?php echo FILEPATH."images/ads/".$ad_image;?>" class="current" style="width:590px; height:auto;" />
						<?php
							}
						?>
                    </li>
                    <li>
                    	<label name="lbl_url" id="lbl_url">Ad URL *</label>
                        <input type="text" name="txt_url" id="txt_url" value="<?php echo $ad_url;?>" class="<?php if( $error[0] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                    </li>

                    <li>
                    	<input type="checkbox" name="chk_active" id="btn_active" <?php if( $ad_active == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> /> Active?
                    </li>
                </ul>
                
                <ul class="form">
                	<li>
                    	<?php
                        	if( isset($pid) ){
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Update ad" />
                        <?php
							}else{
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Add ad" />
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