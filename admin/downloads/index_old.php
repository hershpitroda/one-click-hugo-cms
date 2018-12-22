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
	
	$sql_sel_downloads = mysql_query("select * from bs_downloads");
	if( mysql_num_rows($sql_sel_downloads) > 0 ){
		while( $rows = mysql_fetch_array($sql_sel_downloads) ){
			
			$btn_sbt = "fil_download_sbt_".$rows['download_id'];
			$download_file = "fil_download_".$rows['download_id'];
			$hid_category = "hid_category_".$rows['download_id'];
			
			if( isset($_REQUEST[$btn_sbt]) ){
				
				if( ($_FILES[$download_file]['name'] != '') && ($_FILES[$download_file]['error'] <= 0) && ($_FILES[$download_file]['type'] == 'application/pdf') ){
				
					if($_FILES[$download_file]['error'] != UPLOAD_ERR_OK) {
						echo 'Upload file error';
						return;
					}
						
					if(!is_uploaded_file($_FILES[$download_file]['tmp_name'])) {
						echo 'Invalid request';
						return;
					}
					
					$filename = $_FILES[$download_file]['name'];
					if( $_REQUEST[$hid_category] == '0' ){
						$sub_folder = "office/";
					}else{
						$sub_folder = "living/";
					}
					
					//$filepath = "/applications/mamp/htdocs/burosys/downloads/".$sub_folder;
					$filepath = "/home/sagpat2/sagarapatil.com/clients/burosys/downloads/".$sub_folder;
					$upload_path = $filepath.$filename;
					move_uploaded_file($_FILES[$download_file]['tmp_name'], $upload_path);
					
					//echo "update bs_downloads set download_file='".$filename."' where download_id=".$rows['download_id'];
					$sql_update = mysql_query("update bs_downloads set download_file='".$filename."' where download_id=".$rows['download_id']);
					header("Location:".$_SERVER['PHP_SELF']);
				
				}
			
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
                <li><a href="../products/addproduct.php">Add / Edit product</a></li>
            </ul>
            
            <ul>
            	<li class="head">Project options</li>
            	<li><a href="../projects/">Manage projects</a></li>
                <li><a href="../projects/addproject.php">Add / Edit project</a></li>
            </ul>
            
			<ul>
            	<li class="head">Ad banner options</li>
            	<li><a href="../ads/">Manage ad banners</a></li>
                <li><a href="../ads/addads.php">Add / Edit ad banners</a></li>
            </ul>
			
            <ul>
            	<li class="head">Downloads</li>
            	<li><a href="../downloads/" class="sel">Manage downloads</a></li>
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
        	<h2>Manage downloads</h2>
            
            <?php
				$sql_downloads = mysql_query("select bsd.download_file as download_file, bsd.download_active as download_active, bsd.download_id as download_id, bsca.category_name as category_name, bsca.category_type as category_type from bs_downloads as bsd inner join bs_categories as bsca on bsca.category_id = bsd.category_id");
            	//$record_count = mysql_num_rows($sql_downloads);
			?>
             
            <ul class="head plist downloads">
            	<li class="col1">Download ID</li>
                <li class="col2">Category</li>
                <li class="col3">Download file</li>
                <li class="col4">Update file</li>
                <li class="col5">Active</li>
            </ul>
            
            <form name="frm_download" id="frm_download" action="<? echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
           	<?php
            	
				if( mysql_num_rows($sql_downloads) > 0 ){
					while( $rows = mysql_fetch_array($sql_downloads) ){
					
					if( $rows['download_active'] == 1 ){
						$download_active = "Active";
					}else{
						$download_active = "Inactive";
					}
					
					if( $rows['category_type'] == '0' ){
						$category_type = "office";
					}else{
						$category_type = "living";
					}
						
			?>
            <ul class="plist downloads">	
				<li class="col1"><?php echo $rows['download_id']; ?></li>
                <li class="col2"><?php echo ucfirst($rows['category_name']); ?></li>
                <li class="col3"><a href="<?php echo FILEPATH."downloads/".$category_type."/".$rows['download_file']; ?>"><?php echo ucfirst($rows['download_file']); ?></a></li>
                <li class="col4">
					<input type="file" name="<?php echo "fil_download_".$rows['download_id']; ?>" id="<?php echo "fil_download_".$rows['download_id']; ?>" />
					<input type="submit" name="<?php echo "fil_download_sbt_".$rows['download_id']; ?>" id="<?php echo "fil_download_sbt_".$rows['download_id']; ?>" value="Update <?php echo ucfirst($rows['category_name']);?>" />
					<input type="hidden" name="<?php echo "hid_category_".$rows['download_id'];?>" id="<?php echo "hid_category_".$rows['download_id']; ?>" value="<?php echo $rows['category_type'];?>" />
				</li>
                <li class="col5"><?php echo $download_active; ?> <br><br>
					<input type="submit" name="<?php echo "fil_download_sbt_".$rows['download_id']; ?>" id="<?php echo "fil_download_sbt_".$rows['download_id']; ?>" value="Delete <?php echo ucfirst($rows['category_name']);?>" />
					<input type="hidden" name="<?php echo "hid_category_".$rows['download_id'];?>" id="<?php echo "hid_category_".$rows['download_id']; ?>" value="<?php echo $rows['category_type'];?>" />
				</li>
            </ul>
			<?php
					}
				}
			?>
            </form>
            
        </div>
    </div>

<?php
	require "../includes/footer.php";
?>