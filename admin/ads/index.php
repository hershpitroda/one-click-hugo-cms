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
            	<li><a href="../background/">Manage background images</a></li>
                <li><a href="../background/addbackground.php">Add / Edit background image</a></li>
            </ul>
            
            <ul>
            	<li class="head">Ad banner management</li>
            	<li><a href="../ads/" class="sel">Manage ad banners</a></li>
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
        	<h2>Manage ads</h2>
             
            <?php
				$sql_ads = mysql_query("select bsa.ads_id as ads_id, bsa.ads_url as ads_url, bsp.pages_name as pages_name, bsp.pages_id as pages_id, bsa.ads_image as ads_image, bsa.ads_active as ads_active from bs_ads as bsa inner join bs_pages as bsp on bsa.pages_id = bsp.pages_id order by bsa.ads_id");
            	$record_count = mysql_num_rows($sql_ads);
			?>
            
            <div class="opt-box">
            	<ul>
                	<li><strong>Total ads: </strong><?php echo $record_count;?></li>
                    <li class="filter" style="margin-top:20px;">
                    	<h3>OPTIONS</h3>
                        <ul id="options">
                        	<li><a href="#" class="enable_sel_ads btn" onClick="return false;">Enable</a></li>
                            <li><a href="#" class="disable_sel_ads btn" onClick="return false;">Disable</a></li>
                            <li><a href="#" class="delete btn" id="ads-del" onClick="return false;">Delete</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
             
            <ul class="head plist intro">
            	<li class="col1"><input type="checkbox" name="chk_box" id="chk_box" /></li>
            	<li class="col2">Ad ID</li>
                <li class="col3">Page</li>
                <li class="col4">Image</li>
                <li class="col5">URL</li>
                <li class="col6 last">Status</li>
            </ul>
            
            <div id="listing">
           	<?php
            	
				if( mysql_num_rows($sql_ads) > 0 ){
					while( $rows = mysql_fetch_array($sql_ads) ){
					
					if( $rows['ads_active'] == 1 ){
						$ads_active = "Active";
					}else{
						$ads_active = "Inactive";
					}
						
			?>
            	<ul class="plist intro">
                    <li class="col1"><input type="checkbox" name="chk_box_<?php echo $rows['ads_id']; ?>" id="chk_box_<?php echo $rows['ads_id']; ?>" /></li>
                    <li class="col2"><a href="addads.php?pid=<?php echo $rows['ads_id']; ?>"><?php echo $rows['ads_id']; ?></a></li>
                    <li class="col3"><a href="addads.php?pid=<?php echo $rows['ads_id']; ?>"><?php echo ucfirst($rows['pages_name']); ?></a></li>
                    <li class="col4"><img src="<?php echo FILEPATH."images/ads/".$rows['ads_image']; ?>" style="width:100px; height:auto;" /></li>
                    <li class="col5"><?php echo $rows['ads_url']; ?></li>
                    <li class="col6 last"><?php echo $ads_active; ?></li>
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