<?php require "../includes/header 2.php"; ?>

<?php
	$sql_background = mysql_query("select * from bs_backgrounds where pages_id=6 and background_active=1");
	if( mysql_num_rows($sql_background) > 0 ){
		while( $rows = mysql_fetch_array($sql_background) ){
			if( $rows['background_tilex'] == 1 ){
				$tile = "repeat-x";
			}
			
			if( $rows['background_tiley'] == 1 ){
				$tile = "repeat-y";
			}
			
			if( $rows['background_tilexy'] == 1 ){
				$tile = "repeat";
			}
			
			if( $rows['background_notile'] == 1 ){
				$tile = "no-repeat";
			}
			
			$bg_image = $rows['background_image'];
			
			if( $rows['background_fixed'] == 1 ){
				$pos = "fixed";
			}else{
				$pos = "scroll";
			}
		}
	}else{
		$bg_image = "body-bg.gif";
		$tile = "repeat";
		$pos = "scroll";
	}
?>
<style type="text/css">
	body{
		background:url(<?php echo"'" . FILEPATH."images/layout/".$bg_image . "'";?>) <?php echo $tile; ?> 0 0; background-attachment:<?php echo $pos; ?>;
	}
</style>
            <!-- INTRO BODY-->
            <?php
            	$sql_intro = mysql_query("select * from bs_intro where pages_id=6 and intro_active=1");
				if( mysql_num_rows($sql_intro) > 0 ){
					while( $rows = mysql_fetch_array($sql_intro) ){
			?>
            <div id="intro">
                 <div>
                        <h2 class="inner"><?php echo $rows['intro_title']; ?></h2>
                        <img src="<?php echo FILEPATH; ?>images/intro/banners/<?php echo $rows['intro_image'];?>" width="978" height="400" title="<?php echo ucfirst($rows['intro_title']); ?>" alt="<?php echo $rows['intro_title']; ?>" />
                 </div>
            </div> 
            <?php
					}
				}
			?>
            
            <!-- CONTENT BODY -->
            <div id="content">
            	<div id="sidebar">
                	<?php require "../includes/menu.php"; ?>
                    
                    <?php
                    	$sql_ads = mysql_query("select * from bs_ads where pages_id=6 and ads_active=1");
						if( mysql_num_rows($sql_ads) > 0 ){
					?>
                    <div id="ads">
                    <?php
							while( $rows = mysql_fetch_array($sql_ads) ){
								if( $rows['ads_url'] != '' ){
					?>
                    	<a href="<?php echo $rows['ads_url']; ?>"><img src="<?php echo FILEPATH; ?>images/ads/<?php echo $rows['ads_image']; ?>" /></a>
                    <?php
								}else{
					?>
                    	<img src="<?php echo FILEPATH; ?>images/ads/<?php echo $rows['ads_image']; ?>" />
                    <?php
								}
							}
					?>
                    </div>
                    <?php
						}
					?>
                    
                </div>
                <div id="main" class="about">
                	<h2>About</h2>
                    <p>
                        Burosys Furniture is a leading design house and manufacturer of high quality commercial office furniture with its head office in Mumbai.
                    </p>
                    <p>
                        Our experienced team works closely with many leading architect, interior design and building companies. Our client list includes many blue chip companies in finance, insurance, marketing, media, legal and government as well as a large number of smaller businesses.
                    </p>
                    <p>
                        We offer a product range that is continually evolving in collaboration with our clients needs, striving to incorporate the best in international product design. We provide customized office solutions made to local lead times and at local pricing. All stages from briefing, design and space planning, to manufacture, fit-out and after sales support are carefully handled to meet our client needs and expectations.
                    </p>
                    <p>
                    	With a wide and varied product range catering to all budgets, we can provide a high quality and nationally supported level of service.
                    </p>
                    <p>
                    	We welcome you to visit our showroom to view our range and meet our people.
                    </p>
                    <p>
                    <b> THE TEAM: </b>
                    </p>
                    <p>
                    	Burosys Furniture, is a partnership between Mr Vinod Pitroda of Pitroda Furniture Pvt Ltd and Mr Jayant Soni of J.K Furnishers. J.K.Furnishers is a leading name in the Contracting and interior fit-out business and Pitroda Furniture P Ltd is One of India's oldest chair manufacturing companies (Since 1940). With a cumulative experience of over 90 years, the partnership holds incredible value and allows us to take on a project of any size and scale.
                    </p>
                    <p>
                    	With an in house team that offers sales support and sales visits, autocad support and technical assistance, we are very committed to serving our customer base with utmost dedication.
                    </p>
                </div>
            </div>
			
<?php require "../includes/footer.php"; ?>
