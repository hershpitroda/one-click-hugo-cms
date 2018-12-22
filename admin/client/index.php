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
            	<li><a href="../products/index.php">Manage products</a></li>
                <li><a href="../products/addproduct.php">Add / Edit product</a></li>
            </ul>
            
            <ul>
            	<li class="head">Project options</li>
            	<li><a href="../projects/index.php">Manage projects</a></li>
                <li><a href="../projects/addproject.php">Add / Edit project</a></li>
            </ul>
            
            <ul>
            	<li class="head">Downloads</li>
            	<li><a href="../downloads/">Manage downloads</a></li>
            </ul>
            
            <ul>
            	<li class="head">Client options</li>
            	<li><a href="../client/" class="sel">Manage clients</a></li>
                <li><a href="addclient.php">Add / Edit client</a></li>
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
        	<h2>Manage clients</h2>
            
            <?php
				$sqlClients = mysql_query("select * from bs_clients order by client_id");
            	$record_count = mysql_num_rows($sqlClients);
			?>
            
            <div class="opt-box">
            	<ul>
                	<li><strong>Total clients: </strong><?php echo $record_count;?></li>
                    <li class="filter" style="margin-top:10px;">
                    	<h3>FILTER</h3>
                        <ul>
                        	<li>
                            	Category
                            	<select name="filter_clients" id="filter_clients">
                                	<option value="0">Select</option>
                                    <?php
                                    	$sql_industry = mysql_query("select * from bs_industries");
										if( mysql_num_rows($sql_industry) > 0 ){
											while( $rows = mysql_fetch_array($sql_industry) ){
												
									?>
                                    <option value="<?php echo $rows['industry_id']; ?>"><?php echo ucfirst($rows['industry_title']); ?></option>
                                    <?php
											}
										}
									?>
                                </select>
                            </li>
                         </ul>
                    </li>
                    <li class="filter" style="margin-top:20px;">
                    	<h3>OPTIONS</h3>
                        <ul id="options">
                        	<li><a href="#" class="enable_sel_client btn" onClick="return false;">Enable selected</a></li>
                            <li><a href="#" class="disable_sel_client btn" onClick="return false;">Disable selected</a></li>
                            <li><a href="#" class="featured_sel_client btn" onClick="return false;">Make featured</a></li>
                            <li><a href="#" class="featured_inactive_sel_client btn" onClick="return false;">Disable featured</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
             
            <ul class="head plist clients">
            	<li class="col1"><input type="checkbox" name="chk_box" id="chk_box" /></li>
                <li class="col2">Client</li>
                <li class="col3">Industry</li>
                <li class="col4">Contact</li>
                <li class="col5">Testimonial</li>
                <li class="col6">Featured</li>
                <li class="col7 last">Active</li>
            </ul>
            
            <div id="listing">
            
           	<?php
            	
				if( mysql_num_rows($sqlClients) > 0 ){
					while( $rows = mysql_fetch_array($sqlClients) ){
						
						if( $rows['client_active'] == 1 ){
							$client_active = "Active";
						}else{
							$client_active = "Inactive";
						}
						
						if( $rows['client_featured'] == 1 ){
							$client_featured = "Active";
						}else{
							$client_featured = "Inactive";
						}
						
						$sqlIndustry = mysql_query("select * from bs_industries where industry_id=".$rows['industry_id']);
						if( mysql_num_rows($sqlIndustry) > 0 ){
							while( $rows1 = mysql_fetch_array($sqlIndustry) ){
								$client_industry = $rows1['industry_title'];
							}
						}
						
						
			?>
            <ul class="plist clients">
            	<li class="col1"><input type="checkbox" name="chk_box_<?php echo $rows['client_id']; ?>" id="chk_box_<?php echo $rows['client_id']; ?>" /></li>
                <li class="col2"><a href="addclient.php?cid=<?php echo $rows['client_id']; ?>"><?php echo ucfirst($rows['client_company']); ?></a></li>
                <li class="col3"><?php echo ucfirst($client_industry); ?></li>
                <li class="col4"><?php if( ($rows['client_designation'] != '') || ($rows['client_name'] != '') ){ echo ucfirst($rows['client_name'].",<br />".$rows['client_designation']); }else{ echo "N/A"; } ?></li>
                <li class="col5"><?php if( $rows['client_testimonial'] != '' ){ echo ucfirst($rows['client_testimonial']); }else{ echo "N/A"; } ?></li>
                <li class="col6"><?php echo $client_featured; ?></li>
                <li class="col7 last"><?php echo $client_active; ?></li>
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