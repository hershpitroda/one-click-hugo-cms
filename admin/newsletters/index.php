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
            	<li><a href="../newsletters/" class="sel">View newsletter registrations</a></li>
            </ul>
            
            <ul>
            	<li><strong><a href="<?php echo $_SERVER['PHP_SELF']."?log=t"?>">Logout</a></strong></li>
            </ul>
            
        </div>
        
        <div id="main">
        	<h2>Newsletter registrations</h2>
            
            <?php
				$sqlProducts = mysql_query("select * from bs_newsletters");
            	$record_count = mysql_num_rows($sqlProducts);
			?>
            
            <div class="opt-box">
            	<ul>
                	<li><strong>Total newsletter registrations: </strong><?php echo $record_count;?></li>
                    <li><a href="download_list.php">Download list</a></li>
                    <li class="filter" style="margin-top:20px;">
                    	<h3>OPTIONS</h3>
                        <ul id="options">
                        	<li><a href="#" class="subscribe_nl btn" onClick="return false;">Enable subscription</a></li>
                            <li><a href="#" class="unsubscribe_nl btn" onClick="return false;">Disable subscription</a></li>
                            <li><a href="#" class="active_nl btn" onClick="return false;">Make active</a></li>
                            <li><a href="#" class="inactive_nl btn" onClick="return false;">Make inactive</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
             
            <ul class="head plist">
            	<li class="pcheck"><input type="checkbox" name="chk_box" id="chk_box" /></li>
            	<li class="pid">Newsletter ID</li>
                <li class="pemail_nl">Email address</li>
                <li class="pcat">Subscription</li>
                <li class="pcol">Active</li>
                <!--<li class="pactions">Actions</li>-->
            </ul>
            
            <div id="listing">
           	<?php
            	
				if( mysql_num_rows($sqlProducts) > 0 ){
					while( $rows = mysql_fetch_array($sqlProducts) ){
					
					if( $rows['newsletter_subscribe'] == 1 ){
						$product_subscribe = "Active";
					}else{
						$product_subscribe = "Inactive";
					}
					
					if( $rows['newsletter_active'] == 1 ){
						$product_active = "Active";
					}else{
						$product_active = "Inactive";
					}
						
			?>
            <ul class="plist">
            	<li class="pcheck"><input type="checkbox" name="chk_box_<?php echo $rows['newsletter_id']; ?>" id="chk_box_<?php echo $rows['newsletter_id']; ?>" /></li>
            	<li class="pid"><?php echo $rows['newsletter_id']; ?></li>
                <li class="pemail_nl"><a href="mailto:<?php echo $rows['newsletter_email']; ?>"><?php echo $rows['newsletter_email']; ?></a></li>
                <li class="pcat"><?php echo $product_subscribe; ?></li>
                <li class="pcol"><?php echo $product_active; ?></li>
                <!--<li class="pactions">
                	<ul>
                    	<li><a href="#">Edit</a></li>
                        <li><a href="#">Delete</a></li>
                    </ul>
                </li>-->
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