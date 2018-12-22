<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />

<title>Burosys.com</title> 

<meta name="keywords" content="Burosys.com" />

<meta name="description" content="Burosys.com" /><?php require "includes/header.php"; ?>

 

<?php

	$sql_background = mysql_query("select * from bs_backgrounds where pages_id=1 and background_active=1");

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

			

			if( $rows['background_fixed'] == 1 ){

				$pos = "fixed";

			}else{

				$pos = "scroll";

			}

			

			$bg_image = $rows['background_image'];

		}

	}else{

		$bg_image = "homepage-bg.gif";

		$tile = "repeat";

		$pos = "fixed";

	}

?>


<style type="text/css">

	body{

		background:url(<?php echo"'". FILEPATH."images/layout/".$bg_image . "'";?>) <?php echo $tile; ?> 0 0 ; background-attachment:<?php echo $pos; ?>;

	}
</style>



           <!-- INTRO BODY -->

            <div id="intro">

            	<?php

                	$sql_featured = mysql_query("select * from bs_home_featured where featured_active=1 order by featured_sequence");

					$sql_count = mysql_num_rows($sql_featured);

					$nav_width = $sql_count * 26;

					echo "<script>$(document).ready(function(){ $('#nav').css('width','".$nav_width."px'); });</script>";

				?>

                <div id="slider">

                	<?php

						if( mysql_num_rows($sql_featured) > 0 ){

							while( $rows = mysql_fetch_array($sql_featured) ){

					?>

                    <div>

                    	<?php

                        	if( $rows['featured_url'] != '' ){

						?>

                        	<a href="<?php echo $rows['featured_url']; ?>"><img src="images/intro/home/<?php echo $rows['featured_img'];?>" width="978" height="400" alt="<?php echo ucfirst($rows['featured_title']);?>" /></a>

                        <?php

							}else{

						?>

                        	<img src="images/intro/home/<?php echo $rows['featured_img'];?>" width="978" height="400" alt="<?php echo $rows['featured_title'];?>" />

                        <?php

							}

						?>

                    </div>

                    <?php

							}

						}

					?>

                </div>

                <a href="#" title="Previous" id="prev" name="prev"></a>

                <a href="#" title="Next" id="next" name="next"></a>

            	<div id="nav"></div>

            </div>

            <script src="https://my.hellobar.com/57ef7ca6a57e836802aa49cba0a3ffcf00e5ae39.js" type="text/javascript" charset="utf-8" async="async"></script>

            <!-- CONTENT BODY -->

            <div id="content">

            	<div id="sidebar">

                	<?php require "includes/menu.php"; ?>

                    

                    <?php

                    	$sql_ads = mysql_query("select * from bs_ads where pages_id=1 and ads_active=1");

						if( mysql_num_rows($sql_ads) > 0 ){

					?>

                    <div id="ads" style="margin-top:30px">

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

                <div id="main">

                	<h2>Featured</h2>

                    <ul class="listing">

                    

                    	<?php

                        	$sqlProducts_str = "select * from bs_products where product_featured=1 and product_active=1";

							$sqlProducts = mysql_query($sqlProducts_str);

							$count = 1;

							$collection = $category = "";

							if( mysql_num_rows($sqlProducts) > 0 ){

								while( $row = mysql_fetch_array($sqlProducts) ){

									

									$sqlCollection = mysql_query("select * from bs_collections where collection_id=".$row['collection_id']." and collection_active=1");

									if( mysql_num_rows($sqlCollection) > 0 ){

										while( $row2 = mysql_fetch_array($sqlCollection) ){

											$collection = $row2['collection_name'];

											$categoryid = $row2['category_id'];

										}

									}

									

									$sqlCategory = mysql_query("select * from bs_categories where category_id=".$categoryid." and category_active=1");

									if( mysql_num_rows($sqlCollection) > 0 ){

										while( $row2 = mysql_fetch_array($sqlCategory) ){

											$category = $row2['category_name'];

										}

									}

									

						?>

                        <li class="<?php if( $count % 3 == 0 ){ echo "last"; }else{ echo ""; }?>">

                        	<a href="<?php echo FILEPATH; ?>collections/product/?pid=<?php echo $row['product_id'];?>"><img src="<?php echo FILEPATH; ?>images/products/<?php echo $row['product_display_img']; ?>" width="210" height="205" alt="" /></a>

                            <div class="info">

                            	<span><a href="<?php echo FILEPATH; ?>office/seating/" title="<?php echo $row['product_name']; ?>"><?php echo $row['product_name']; ?></a></span>

                                <!--<strong><a href="<?php //echo FILEPATH; ?>office/seating/" title="<?php //echo $category." - ".$collection; ?>"><?php //echo $category." - ".$collection; ?></a></strong>-->

                                <strong><a href="<?php echo FILEPATH; ?>office/seating/" title="<?php echo $collection; ?>"><?php echo $collection; ?></a></strong>

                            </div>

                            <div class="details">

                            	<h3><?php echo $row['product_name']; ?></h3>

                                <!--<span><?php //echo $category." - ".$collection; ?></span>-->

                                <span><?php echo $collection; ?></span>

                                <a href="<?php echo FILEPATH; ?>collections/product/?pid=<?php echo $row['product_id'];?>" class="more" title="View details">view details</a>

                                <div class="info first">

                                	<strong>Dimensions</strong>

                                    <p>

                                    	<?php echo ucfirst($row['product_dimensions']); ?>

                                    </p>

                                </div>

                                <div class="info">

                                	<strong>Materials</strong>

                                    <p>

                                    	<?php echo ucfirst($row['product_materials']); ?>

                                    </p>

                                </div>

                                <div class="info last">

                                	<strong>Price</strong>

                                    <p>

                                    	<?php

                                        	if( $row['product_price'] != '' ){

												//echo "INR ".number_format($row['product_price'],2); 

												echo nl2br($row['product_price']); 

											}else{

												echo "Price available on request";

											}

										?>

                                    </p>

                                </div>

                            </div>

                        </li>

                        <?php

								$count++;

								}

							}

						?>

                    </ul>

                    

                    <div class="home-more">

                      <!---  <a href="<?php echo FILEPATH."collections/?cid=5"; ?>" title="View all living tables" class="last">View all living tables</a><!--->

                        <a href="<?php echo FILEPATH."collections/?cid=1"; ?>" title="View all office desking">View all office desking</a>

                    </div>

                    

                    <div id="testimonial" class="box midGrad">

                    	<div class="pad20">

                        	<!--<div class="gallery">

                            	<img src="<?php echo FILEPATH; ?>images/projects/project1/thumb.jpg" width="205" height="150" />

                            </div>

                            <div class="desc">

                            	<h4>Sagar Patil</h4>

                                <span>Interior Designer, India</span>

                                <p>

                                	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidid unt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

                                </p>

                            </div>-->

                          

                            <div class="desc">

                             <a href="http://online.fliphtml5.com/goax/zdcc/">
<img alt="burosys" src="ban.jpg"  style="width:680px;height:158px;border:0">
                            </a>

                            </div>

                        </div>

                    </div>

                    

                   <!---> <h2></h2><!--->

              <!----      

                    

              <!----      <div class="home-more">

                        <a href="<?php echo FILEPATH."collections/?cid=4"; ?>" title="View all living seating" class="last">View all living seating</a>

                        <a href="<?php echo FILEPATH."collections/?cid=2"; ?>" title="View all office seating">View all office seating</a>

                    </div><!------>

</div>

<?php require "includes/footer.php"; ?>