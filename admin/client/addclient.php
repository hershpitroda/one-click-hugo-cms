<?php
	session_start();
	if( !isset($_SESSION['username']) ){
		header("Location:../index.php");
	}
	ob_start();
	
	if( isset($_REQUEST['log']) ){
		session_unset();
		header("Location:../index.php");
	}
	
	require "../includes/header.php";
	
	
	
	$client_company = $client_name = $client_designation = $client_testimonial = $client_logo = "";
	$client_industry = 0;
	$count = 0;
	
	if( isset($_REQUEST['cid']) ){
		
		$cid = $_REQUEST['cid'];
		$sqlClient = mysql_query("select * from bs_clients where client_id=".$cid);
		if( mysql_num_rows($sqlClient) > 0 ){
			while( $rows = mysql_fetch_array($sqlClient) ){
				$client_industry = clean_var($rows['industry_id']);
				$client_company = clean_var($rows['client_company']);
				$client_name = clean_var($rows['client_name']);
				$client_designation = clean_var($rows['client_designation']);
				$client_testimonial = clean_var($rows['client_testimonial']);
				$client_logo = clean_var($rows['client_logo']);
				
				$sqlCategory = mysql_query("select * from bs_industries where industry_id=".$client_industry);
				if( mysql_num_rows($sqlCategory) > 0 ){
					while( $rows1 = mysql_fetch_array($sqlCategory) ){
						$industry_title = $rows1['industry_title'];
					}
				}
				$client_active = $rows['client_active'];
				$client_featured = $rows['client_featured'];
			}
		}
	}
	
	if( isset($_REQUEST['sbt_btn']) ){
		
		$validated = 0;
		$error[] = 0;
		
		if( isset($_POST['cid']) ){
			$cid = $_POST['cid'];
		}
		
		$sbt_result = $_REQUEST['sbt_btn'];
		
		$client_industry = clean_var($_REQUEST['sel_industry']);
		$client_company = clean_var($_REQUEST['txt_company']);
		$client_name = clean_var($_REQUEST['txt_name']);
		$client_designation = clean_var($_REQUEST['txt_designation']);
		$client_testimonial = clean_var($_REQUEST['txt_testimonial']);
		
		if( $sbt_result == 'Add client' ){
			$client_logo = clean_var($_FILES['fil_logo']['name']);
		}else{
			if( $_FILES['fil_logo']['name'] != '' ){
				$client_logo = clean_var($_FILES['fil_logo']['name']);
			}else{
				$client_logo = clean_var($_REQUEST['hid_fil']);
			}
		}
		
		if( isset($_REQUEST['chk_featured']) ){
			$client_featured = 1;
		}else{
			$client_featured = 0;
		}
		
		if( isset($_REQUEST['chk_active']) ){
			$client_active = 1;
		}else{
			$client_active = 0;
		}
		
		if( $client_industry != 0 ){
			$error[0] = 0;
		}else{
			$error[0] = 1;
		}
		$error[1] = validName($client_company);
		
		for( $i=0; $i<2; $i++ ){
			$validated += $error[$i];
		}
		
		if( $validated == 0 ){
			
			if( $_FILES['fil_logo']['name'] != '' ){
				
				if($_FILES['fil_logo']['error'] != UPLOAD_ERR_OK) {
					echo 'Upload file error';
					return;
				}
				
				if(!is_uploaded_file($_FILES['fil_logo']['tmp_name'])) {
					echo 'Invalid request';
					return;
				}
				$remove_these = array(' ','`','"','\'','\\','/');
				$newname = str_replace(' ', '', $_FILES['fil_logo']['name']);
				
				//$upload_path = "/Applications/MAMP/htdocs/burosys/images/clients/".$newname;
				$upload_path = "/home/sagpat2/sagarapatil.com/clients/burosys/images/clients/".$newname;
				move_uploaded_file($_FILES['fil_logo']['tmp_name'], $upload_path);
			
			}
			
			if( $sbt_result == "Add client" ){
				
				//$sqlClient = "insert into bs_clients (industry_id, client_company, client_name, client_designation, client_testimonial, client_logo, client_featured,  client_active) values (".$client_industry.", '".$client_company."', '".$client_name."', '".$client_designation."', '".$client_tesimonial."', '".$client_logo."', ".$client_featured." ,".$client_active.")";
				
				//echo $sqlClient;
				
				$sqlClient = mysql_query("insert into bs_clients (industry_id, client_company, client_name, client_designation, client_testimonial, client_logo, client_featured,  client_active) values (".$client_industry.", '".$client_company."', '".$client_name."', '".$client_designation."', '".$client_testimonial."', '".$client_logo."', ".$client_featured." ,".$client_active.")");
			
			}
			
			if( $sbt_result == "Update client" ){
				
				//$sqlClient = "update bs_clients set industry_id=".$industry_id.", client_company='".$client_company."', client_name='".$client_name."', client_designation = '".$client_designation."', client_testimonial = '".$client_testimonial."', client_logo='".$client_logo."', client_featured=".$client_featured.",  client_active=".$client_active." where client_id=".$cid;
				
				//echo $sqlClient;
				
				$sqlClient = mysql_query("update bs_clients set industry_id=".$client_industry.", client_company='".$client_company."', client_name='".$client_name."', client_designation = '".$client_designation."', client_testimonial = '".$client_testimonial."', client_logo='".$client_logo."', client_featured=".$client_featured.",  client_active=".$client_active." where client_id=".$cid);
				
			}
			
			header("Location:index.php");
			
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
            	<li class="head">Downloads</li>
            	<li><a href="../downloads/">Manage downloads</a></li>
            </ul>
            
            <ul>
            	<li class="head">Client options</li>
            	<li><a href="../client/">Manage clients</a></li>
                <li><a href="addclient.php" class="sel">Add / Edit client</a></li>
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
            	if( isset($_REQUEST['cid']) ){
			?>
            	<h2>Edit client details</h2>
            	<form action="<?php echo $_SERVER['PHP_SELF']."?cid=".$_REQUEST['cid'];?>" method="post" name="frm_client" id="frm_client" enctype="multipart/form-data">
            <?php
				}else{
			?>
            	<h2>Add a new client</h2>
            	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="frm_client" id="frm_client" enctype="multipart/form-data">
            <?php
				}
				
            	if( $validated != 0 ){
			?>
                <div class="alert">
                    Please correct the errors in the fields beow.
                </div>
            <?php
				}elseif( $validated == 0 && isset($_REQUEST['sbt_btn']) ){
			?>
            	<div class="alert">
                    The client has been added to the database.
                </div>
            <?php
				}
			?>
            
            <h3 class="title">Client details</h3>
            
            
                <ul class="form">
                    <li>
                    	<label name="lbl_industry" id="lbl_industry">Industry *</label>
                        <select id="sel_industry" name="sel_industry" class="<?php if( $error[0] == 1 ){ echo "error"; }else{ echo ""; } ?>">
                        	<option value="0">Select</option>
                            <?php
                            	$sql_industry = mysql_query("select * from bs_industries");
								if( mysql_num_rows($sql_industry) > 0 ){
									while( $rows = mysql_fetch_array($sql_industry) ){
										
							?>
                            	<option value="<?php echo $rows['industry_id']; ?>" <?php if( $client_industry == $rows['industry_id'] ){ echo "selected='selected'"; }else{ echo ""; } ?>><?php echo ucfirst($rows['industry_title']); ?></option>
                            <?php
									}
								}
							?>
                        </select>
                    </li>
                    <li>
                    	<label name="lbl_company" id="lbl_company">Company name *</label>
                        <input type="text" name="txt_company" id="txt_company" value="<?php echo $client_company;?>" class="<?php if( $error[1] == 1 ){ echo "error"; }else{ echo ""; } ?>" />
                    </li>
                    <li>
                    	<label name="lbl_name" id="lbl_name">Contact name</label>
                        <input type="text" name="txt_name" id="txt_name" value="<?php echo $client_name;?>" />
                    </li>
                    <li>
                    	<label name="lbl_designation" id="lbl_designation">Contact designation</label>
                        <input type="text" name="txt_designation" id="txt_designation" value="<?php echo $client_designation;?>" />
                    </li>
                    <li>
                    	<label name="lbl_testimonial" id="lbl_testimonial">Testimonial</label>
                        <textarea name="txt_testimonial" id="txt_testimonial"><?php echo $client_testimonial;?></textarea>
                    </li>
                    <li>
                    	<label name="lbl_logo" id="lbl_logo">Client logo</label>
                        <input type="file" name="fil_logo" id="fil_logo" value="<?php echo $client_logo;?>" />
                        <input type="hidden" name="hid_fil" id="hid_fil" value="<?php echo $client_logo; ?>" />
                        <?php
                        	if( isset($cid) && ($client_logo != '') ){
						?>
                        <img src="<?php echo FILEPATH."images/clients/".$client_logo;?>" title="<?php echo $client_company;?>" class="current" />
						<?php
							}
						?>
                    </li>
                    <li>
                    	<input type="checkbox" name="chk_featured" id="chk_featured" <?php if( $client_featured == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> /> Featured?
                    </li>
                    <li>
                    	<input type="checkbox" name="chk_active" id="chk_active" <?php if( $client_active == 1 ){ echo "checked='checked'"; }else{ echo ""; } ?> /> Active?
                    </li>
                </ul>
                
                
                <ul class="form">
                	<li>
                    	<?php
                        	if( isset($cid) ){
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Update client" />
                        <?php
							}else{
						?>
                        	<input type="submit" name="sbt_btn" id="sbt_btn" value="Add client" />
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