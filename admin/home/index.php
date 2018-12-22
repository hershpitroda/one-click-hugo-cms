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
            	<li><a href="../home/" class="sel">Manage featured images</a></li>
                <li><a href="addfeatured.php">Add / Edit featured</a></li>
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
        	<h2>Manage home page featured images</h2>
             
            <?php
				$sql_featured = mysql_query("select * from bs_home_featured order by featured_id");
            	$record_count = mysql_num_rows($sql_featured);
			?>
            
            <div class="opt-box">
            	<ul>
                	<li><strong>Total products: </strong><?php echo $record_count;?></li>
                    <li class="filter" style="margin-top:20px;">
                    	<h3>OPTIONS</h3>
                        <ul id="options">
                        	<li><a href="#" class="enable_sel_home btn" onClick="return false;">Enable selected</a></li>
                            <li><a href="#" class="disable_sel_home btn" onClick="return false;">Disable selected</a></li>
                            <li><a href="#" class="delete btn" id="home-del" onClick="return false;">Delete selected</a></li>
                      
                            
                        </ul>
                    </li>
                </ul>
            </div>
             
            <ul class="head plist home">
            	<li class="col1"><input type="checkbox" name="chk_box" id="chk_box" /></li>
            	<li class="col2">Featured ID</li>
                <li class="col3">Featured Title</li>
                <li class="col4">Featured Image</li>
                <li class="col5">Sequence</li>
                <li class="col6 last">Active</li>
            </ul>
            
            <div id="listing">
           	<?php
            	
				if( mysql_num_rows($sql_featured) > 0 ){
					while( $rows = mysql_fetch_array($sql_featured) ){
					
					if( $rows['featured_active'] == 1 ){
						$featured_active = "Active";
					}else{
						$featured_active = "Inactive";
					}
						
			?>
            	<ul class="plist home">
                    <li class="col1"><input type="checkbox" name="chk_box_<?php echo $rows['featured_id']; ?>" id="chk_box_<?php echo $rows['featured_id']; ?>" /></li>
                    <li class="col2"><a href="addfeatured.php?pid=<?php echo $rows['featured_id']; ?>"><?php echo $rows['featured_id']; ?></a></li>
                    <li class="col3"><a href="addfeatured.php?pid=<?php echo $rows['featured_id']; ?>"><?php echo ucfirst($rows['featured_title']); ?></a></li>
                    <li class="col4 home-img"><img src="<?php echo FILEPATH."images/intro/home/".$rows['featured_img']; ?>" /></li>
                    <li class="col5"><?php echo $rows['featured_sequence']; ?></li>
                    <li class="col6 last"><?php echo $featured_active; ?></li>
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