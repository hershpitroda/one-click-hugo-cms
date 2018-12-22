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
	
	$featured_img = $featured_title = "";
	$featured_sequence = $featured_active = 0;
	$count = 0;
	
	if( isset($_REQUEST['pid']) ){
		$pid = $_REQUEST['pid'];
		$sql_featured = mysql_query("select * from bs_home_featured where featured_id=".$pid);
		if( mysql_num_rows($sql_featured) > 0 ){
			while( $rows = mysql_fetch_array($sql_featured) ){
				$featured_img = clean_var($rows['featured_img']);
				$featured_title = clean_var($rows['featured_title']);
				$featured_sequence = clean_var($rows['featured_sequence']);
				$featured_active = $rows['featured_active'];
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
		
		$featured_title = clean_var($_REQUEST['txt_title']);
		$featured_sequence = clean_var($_REQUEST['txt_sequence']);
			
		if( isset($pid) ){
			if( $_FILES['fil_featured']['name'] != '' ){
				$featured_img = clean_var($_FILES['fil_featured']['name']);
			}else{
				$featured_img = clean_var($_REQUEST['hid_fil_featured']);
			}
		}else{
			$featured_img = clean_var($_FILES['fil_featured']['name']);	
		}
		
		$file_path = "/home/sagpat2/sagarapatil.com/clients/burosys/images/intro/home/";
		
		if( isset($_REQUEST['chk_active']) ){
			$featured_active = 1;
		}else{
			$featured_active = 0;
		}
		
		$error[0] = validName($featured_title);
		$error[1] = validName($featured_sequence);
		if( !isset($pid) ){
		
			if( (($_FILES['fil_featured']['name'] != '') || ($_FILES['fil_featured']['error'] <= 0)) && (($_FILES['fil_featured']['type'] == 'image/jpg') || ($_FILES['fil_featured']['type'] == 'image/jpeg') || ($_FILES['fil_featured']['type'] == 'image/png')) ){
				$error[2] = 0;
			}else{
				$error[2] = 1;
			}
		
		}else{
		
			if( ($_FILES['fil_featured']['name'] == '') && ($_REQUEST['hid_fil_featured'] == '') ){
				$error[2] = 1;
			}else{
				$error[2] = 0;
			}
		
		}
		
		for( $i=0; $i<3; $i++ ){
			$validated += $error[$i];
		}
		
		if( $validated == 0 ){
			
			if( $sbt_value == 'Add featured' ){
			
				//upload display image
				$file_extn = pathinfo($_FILES['fil_featured']['name'],PATHINFO_EXTENSION);
				$newname = str_replace(' ', '', $_FILES['fil_featured']['name']);
				$newname = str_replace($file_extn, '', $newname);
				$newname = str_replace('.', '', $newname);
				
				$upload_path_display = $file_path.$newname.".".$file_extn;
				move_uploaded_file($_FILES['fil_featured']['tmp_name'], $upload_path_display);
			
				//$sqlProduct = "insert into bs_home_featured (featured_img, featured_title, featured_sequence, featured_active) values ('".$featured_img."', '".$featured_title."', ".$featured_sequence.", ".$featured_active.")";
				
				//echo $sqlProduct;
				
				$sqlProduct = mysql_query("insert into bs_home_featured (featured_img, featured_title, featured_sequence, featured_active) values ('".$featured_img."', '".$featured_title."', ".$featured_sequence.", ".$featured_active.")");
				
				echo "<script>window.location='index.php'</script>";
				
			}
			
			if( $sbt_value == 'Update featured' ){
				
				if( $_FILES['fil_featured']['name'] != '' ){
					//upload display image
					$file_extn = pathinfo($_FILES['fil_featured']['name'],PATHINFO_EXTENSION);
					$newname = str_replace(' ', '', $_FILES['fil_featured']['name']);
					$newname = str_replace($file_extn, '', $newname);
					$newname = str_replace('.', '', $newname);
					
					$upload_path_display = $file_path.$newname.".".$file_extn;
					move_uploaded_file($_FILES['fil_featured']['tmp_name'], $upload_path_display);
				}else{
					if( $_REQUEST['hid_fil_featured'] != '' ){
						$featured_img = $_REQUEST['hid_fil_featured'];
					}else{
						$featured_img = "";
					}
				}
				
				//$sql_featured = "update bs_home_featured set featured_img='".$featured_img."', featured_title='".$featured_title."', featured_sequence=".$featured_sequence.", featured_active=".$featured_active." where featured_id=".$pid;
				
				//echo $sql_featured;
				
				$sql_featured = mysql_query("update bs_home_featured set featured_img='".$featured_img."', featured_title='".$featured_title."', featured_sequence=".$featured_sequence.", featured_active=".$featured_active." where featured_id=".$pid);
				
				echo "<script>window.location='index.php'</script>";
				
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
                <li><a href="../home/addfeatured.php" class="sel">Add / Edit featured</a></li>
            </ul>
            
            <ul>
            	<li class="head">Product options</li>
            	<li><a href="../products/">Manage products</a></li>
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
            
            <h3 class="title">Featured image details</h3>
            
            
                <ul class="form">
                    <li>
                    	<label name="lbl_title" id="lbl_title">Featured image title *</label>
                        <input type="text" name="txt_title" id="txt_title" value="<?php echo $featured_title;?>" class="<?php if( $error[0] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                    </li>
                    <li>
                    	<label name="lbl_sequence" id="lbl_sequence">Featured sequence *</label>
                        <input type="text" name="txt_sequence" id="txt_sequence" class="<?php if( $error[1] == 1 ){ echo "error"; }else{ echo ""; } ?>" value="<?php echo $featured_sequence;?>" />
                    </li>
                    <li>
                    	<label name="lbl_featured" id="lbl_featured">Display image *</label>
                        <input type="file" name="fil_featured" id="fil_featured" value="<?php echo $featured_img;?>" class="<?php if( $error[2] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                        <input type="hidden" name="hid_fil_featured" id="hid_fil_featured" value="<?php echo $featured_img; ?>" />
                        <?php
                        	if( isset($pid) && !empty($featured_img) ){
						?>
                        <img src="<?php echo FILEPATH."images/intro/home/".$featured_img;?>" title="<?php echo $featured_title;?>" class="current" style="width:590px; height:auto;" />
						<?php
							}
						?>
                    </li>
                    <li>
                    	<input type="checkbox" name="chk_active" id="btn_active" <?php if( $featured_active == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> /> Active?
                    </li>
                </ul>
                
                <ul class="form">
                	<li>
                    	<?php
                        	if( isset($pid) ){
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Update featured" />
                        <?php
							}else{
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Add featured" />
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