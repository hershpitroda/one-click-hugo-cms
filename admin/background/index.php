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
            	<li class="head">Featured image management</li>
            	<li><a href="../home/">Manage featured images</a></li>
                <li><a href="addfeatured.php">Add / Edit featured</a></li>
            </ul>
            
            <ul>
            	<li class="head">Background management</li>
            	<li><a href="../background/" class="sel">Manage background images</a></li>
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
                <li><a href="../products/addproduct.php">Add / Edit product</a></li>
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
        	<h2>Manage background images</h2>
             
            <?php
				$sql_background = mysql_query("select bsb.backgrounds_id as backgrounds_id, bsb.background_image as background_image, bsb.background_tilex as background_tilex, bsb.background_tiley as background_tiley, bsb.background_tilexy as background_tilexy, bsb.background_notile as background_notile, bsb.background_active as background_active, bsb.background_fixed as background_fixed, bsp.pages_name as pages_name from bs_backgrounds as bsb inner join bs_pages as bsp on bsb.pages_id = bsp.pages_id order by backgrounds_id");
            	$record_count = mysql_num_rows($sql_background);
			?>
            
            <div class="opt-box">
            	<ul>
                	<li><strong>Total background images: </strong><?php echo $record_count;?></li>
                    <li class="filter" style="margin-top:10px;">
                    	<h3>OPTIONS</h3>
                        <ul id="options">
                        	<li><a href="#" class="enable_sel_bg btn" onClick="return false;">Enable</a></li>
                            <li><a href="#" class="disable_sel_bg btn" onClick="return false;">Disable</a></li>
                            <li><a href="#" class="delete btn" id="backgrounds-del" onClick="return false;">Delete</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
             
            <ul class="head plist backgrounds">
            	<li class="col1"><input type="checkbox" name="chk_box" id="chk_box" /></li>
            	<li class="col2">Background ID</li>
                <li class="col3">Page</li>
                <li class="col4">Background Image</li>
                <li class="col5">Tiling option</li>
                <li class="col6">Fixed</li>
                <li class="col7 last">Status</li>
            </ul>
            
            <div id="listing">
           	<?php
            	
				if( mysql_num_rows($sql_background) > 0 ){
					while( $rows = mysql_fetch_array($sql_background) ){
					
					if( $rows['background_active'] == 1 ){
						$background_active = "Active";
					}else{
						$background_active = "Inactive";
					}
					
					if( $rows['background_fixed'] == 1 ){
						$background_fixed = "Fixed";
					}else{
						$background_fixed = "Scrollable";
					}
						
			?>
            	<ul class="plist backgrounds">
                    <li class="col1"><input type="checkbox" name="chk_box_<?php echo $rows['backgrounds_id']; ?>" id="chk_box_<?php echo $rows['backgrounds_id']; ?>" /></li>
                    <li class="col2"><a href="addbackground.php?pid=<?php echo $rows['backgrounds_id']; ?>"><?php echo $rows['backgrounds_id']; ?></a></li>
                    <li class="col3"><a href="addbackground.php?pid=<?php echo $rows['backgrounds_id']; ?>"><?php echo ucfirst($rows['pages_name']); ?></a></li>
                    <li class="col4"><img src="<?php echo FILEPATH."images/layout/".$rows['background_image']; ?>"  style="width:50px; height:auto;"/></li>
                    <li class="col5">
                    	<?php
                        	if( $rows['background_tilex'] == 1 ){
								echo "Horizontally tiled";
							}elseif( $rows['background_tiley'] == 1 ){
								echo "Vertically tiled";
							}elseif( $rows['background_tilexy'] == 1 ){
								echo "Horizontally and vertically tiled";
							}elseif( $rows['background_notile'] == 1 ){
								echo "No tiling";
							}
						?>
                    </li>
                    <li class="col6"><?php echo $background_fixed; ?></li>
                    <li class="col7 last"><?php echo $background_active; ?></li>
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