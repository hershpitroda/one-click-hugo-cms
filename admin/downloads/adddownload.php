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
	
	$download_file = $download_title = "";
	$download_active = 0;
	$count = 0;
	
	if( isset($_REQUEST['pid']) ){
		$pid = $_REQUEST['pid'];
		$sql_download = mysql_query("select * from bs_downloads where download_id=".$pid);
		if( mysql_num_rows($sql_download) > 0 ){
			while( $rows = mysql_fetch_array($sql_download) ){
				$download_file = clean_var($rows['download_file']);
				$download_title = $rows['download_title'];
				$download_active = $rows['download_active'];
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
		
		$download_title = $_REQUEST['txt_title'];
			
		if( isset($pid) ){
			if( $_FILES['fil_download']['name'] != '' ){
				$download_file = clean_var($_FILES['fil_download']['name']);
			}else{
				$download_file = clean_var($_REQUEST['hid_fil_download']);
			}
		}else{
			$download_file = clean_var($_FILES['fil_download']['name']);	
		}
		
		//$file_path = "/Applications/MAMP/htdocs/burosys/images/intro/home/";
		$file_path = UPLOAD_PATH."downloads/";
		
		if( isset($_REQUEST['chk_active']) ){
			$download_active = 1;
		}else{
			$download_active = 0;
		}
		
		if( !empty($download_title) || ($download_title != '') ){
			$error[0] = 0;
		}else{
			$error[0] = 1;
		}
		
		if( !isset($pid) ){
		
			if( (($_FILES['fil_download']['name'] != '') || ($_FILES['fil_download']['error'] <= 0)) && (($_FILES['fil_download']['type'] == 'image/jpg') || ($_FILES['fil_download']['type'] == 'image/jpeg') || ($_FILES['fil_download']['type'] == 'image/png')  || ($_FILES['fil_download']['type'] == 'application/pdf')) ){
				$error[1] = 0;
			}else{
				$error[1] = 1;
			}
		
		}else{
		
			if( ($_FILES['fil_download']['name'] == '') && ($_REQUEST['hid_fil_download'] == '') ){
				$error[1] = 1;
			}else{
				$error[1] = 0;
			}
		
		}
		
		for( $i=0; $i<3; $i++ ){
			$validated += $error[$i];
		}
		
		if( $validated == 0 ){
			
			if( $sbt_value == 'Add download' ){
			
				//upload display image
				$file_extn = pathinfo($_FILES['fil_download']['name'],PATHINFO_EXTENSION);
				$newname = str_replace(' ', '', $_FILES['fil_download']['name']);
				$newname = str_replace($file_extn, '', $newname);
				$newname = str_replace('.', '', $newname);
				
				$new_filename = $newname.".".$file_extn;
				
				$upload_path_display = $file_path.$newname.".".$file_extn;
				move_uploaded_file($_FILES['fil_download']['tmp_name'], $upload_path_display);
			
				//$sqlProduct = "insert into bs_downloads (download_url, download_file, download_active, download_date_entered, download_date_modified) values ('".$download_title."', '".$new_filename."', ".$download_active.", '".InputDateTime()."', '".InputDateTime()."')";
				
				//echo $sqlProduct;
				
				$sqlProduct = mysql_query("insert into bs_downloads (download_title, download_file, download_active, download_entry_date, download_modify_date) values ('".$download_title."', '".$download_file."', ".$download_active.", '".InputDateTime()."', '".InputDateTime()."')");
				
				echo "<script>window.location='index.php'</script>";
				
			}
			
			if( $sbt_value == 'Update download' ){
				
				if( $_FILES['fil_download']['name'] != '' ){
					//upload display image
					$file_extn = pathinfo($_FILES['fil_download']['name'],PATHINFO_EXTENSION);
					$newname = str_replace(' ', '', $_FILES['fil_download']['name']);
					$newname = str_replace($file_extn, '', $newname);
					$newname = str_replace('.', '', $newname);
					
					$new_filename = $newname.".".$file_extn;
					
					$upload_path_display = $file_path.$newname.".".$file_extn;
					move_uploaded_file($_FILES['fil_download']['tmp_name'], $upload_path_display);
				}else{
					if( $_REQUEST['hid_fil_download'] != '' ){
						$intro_image = $_REQUEST['hid_fil_download'];
					}else{
						$intro_image = "";
					}
				}
				
				//$sql_featured = "update bs_downloads set download_title='".$download_title."', download_file='".$download_file."', download_active=".$download_active.", download_modify_date='".InputDateTime()."' where download_id=".$pid;
				
				//echo $sql_featured;
				
				$sql_featured = mysql_query("update bs_downloads set download_title='".$download_title."', download_file='".$download_file."', download_active=".$download_active.", download_modify_date='".InputDateTime()."' where download_id=".$pid);
				
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
                <li><a href="../downloads/adddownload.php" class="sel">Add / Edit downloads</a></li>
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
            <h2>Edit downloads</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']."?pid=".$_REQUEST['pid'];?>" method="post" name="frm_featured" id="frm_featured" enctype="multipart/form-data">
            <?php
				}else{
			?>
            <h2>Add a download</h2>
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
            
            <h3 class="title">Downloads details</h3>
            
            
                <ul class="form">
                	<li>
                    	<label name="lbl_title" id="lbl_title">Download Title *</label>
                        <input type="text" name="txt_title" id="txt_title" value="<?php echo $download_title;?>" class="<?php if( $error[0] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                    </li>
                    <li>
                    	<label name="lbl_download" id="lbl_download">Download file *</label>
                        <input type="file" name="fil_download" id="fil_download" value="<?php echo $download_file;?>" class="<?php if( $error[1] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                        <input type="hidden" name="hid_fil_download" id="hid_fil_download" value="<?php echo $download_file; ?>" />
                        <?php
                        	if( isset($pid) && !empty($download_file) ){
						?>
                        <a href="<?php echo FILEPATH."downloads/".$download_file;?>"><?php echo $download_file; ?></a>
						<?php
							}
						?>
                    </li>
                    <li>
                    	<input type="checkbox" name="chk_active" id="btn_active" <?php if( $download_active == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> /> Active?
                    </li>
                </ul>
                
                <ul class="form">
                	<li>
                    	<?php
                        	if( isset($pid) ){
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Update download" />
                        <?php
							}else{
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Add download" />
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