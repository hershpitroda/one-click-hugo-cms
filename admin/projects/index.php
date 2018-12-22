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
            	<li><a href="../products/">Manage products</a></li>
                <li><a href="../products/addproduct.php">Add / Edit product</a></li>
            </ul>
            
            <ul>
            	<li class="head">Project options</li>
            	<li><a href="../projects/" class="sel">Manage projects</a></li>
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
        	<h2>Manage projects</h2>
             
            <?php
				$sql_projects = mysql_query("select * from bs_projects order by project_id");
            	$record_count = mysql_num_rows($sql_projects);
			?>
            
            <div class="opt-box">
            	<ul>
                	<li><strong>Total products: </strong><?php echo $record_count;?></li>
                    <li class="filter" style="margin-top:20px;">
                    	<h3>OPTIONS</h3>
                        <ul id="options">
                        	<li><a href="#" class="enable_sel_project btn" onClick="return false;">Enable selected</a></li>
                            <li><a href="#" class="disable_sel_project btn" onClick="return false;">Disable selected</a></li>
                            <li><a href="#" class="featured_sel_project btn" onClick="return false;">Make featured</a></li>
                            <li><a href="#" class="featured_inactive_sel_project btn" onClick="return false;">Disable featured</a></li>
                            <li><a href="#" class="delete btn" id="project-del" onClick="return false;">Delete</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
             
            <ul class="head plist projects">
            	<li class="col1"><input type="checkbox" name="chk_box" id="chk_box" /></li>
            	<li class="col2">Project ID</li>
                <li class="col3">Project Name</li>
                <li class="col4">Project Company</li>
                <li class="col5">Project Designer</li>
                <li class="col6">Project location</li>
                <li class="col7">Featured</li>
                <li class="col8 last">Active</li>
            </ul>
            
            <div id="listing">
           	<?php
            	
				if( mysql_num_rows($sql_projects) > 0 ){
					while( $rows = mysql_fetch_array($sql_projects) ){
					
					$sql_image = mysql_query("select * from bs_project_gallery where project_gallery_id=".$rows['project_id']." and project_gallery_active=1 order by project_gallery_sequence LIMIT 1");
					if( mysql_num_rows($sql_image) > 0 ){
						while( $rows1 = mysql_fetch_array($sql_image) ){
							$project_image = $rows1['project_gallery_thumb'];
						}
					}
					
					if( $rows['project_featured'] == 1 ){
						$project_featured = "Active";
					}else{
						$project_featured = "Inactive";
					}
					
					if( $rows['project_active'] == 1 ){
						$project_active = "Active";
					}else{
						$project_active = "Inactive";
					}
						
			?>
            
            
            	<ul class="plist projects">
                    <li class="col1"><input type="checkbox" name="chk_box_<?php echo $rows['project_id']; ?>" id="chk_box_<?php echo $rows['project_id']; ?>" /></li>
                    <li class="col2"><a href="addproject.php?pid=<?php echo $rows['project_id']; ?>"><?php echo $rows['project_id']; ?></a></li>
                    <li class="col3"><a href="addproject.php?pid=<?php echo $rows['project_id']; ?>"><?php echo $rows['project_title']; ?></a></li>
                    <li class="col4">
						<?php 
							if( $rows['project_company'] != '' ){
								echo ucfirst($rows['project_company']); 
							}else{
								echo "&nbsp;";
							}
							
						?>
                    </li>
                    <li class="col5">
						<?php
							if( $rows['project_designer'] != '' ){
								echo ucfirst($rows['project_designer']); 
							}else{
								echo "&nbsp;";
							}
							
						?>
                    </li>
                    <li class="col6">
						<?php
							if( $rows['project_location'] != '' ){
								echo ucfirst($rows['project_location']); 
							}else{
								echo "&nbsp;";
							}
							
						?>
                    </li>
                    <li class="col7"><?php echo $project_featured; ?></li>
                    <li class="col8 last"><?php echo $project_active; ?></li>
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