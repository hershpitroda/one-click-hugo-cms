<?php 
	require "constants.php";
	require "functions.php";
?>
<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="description" content="Welcome to Burosys. We offer you everything in office furniture." />
<meta http-equiv="keywords" content="burosys, office, furniture, home, chairs, work stations, offers" />
<title>Burosys - Everything in office furniture</title>
<link rel="stylesheet" type="text/css" href="<?php echo FILEPATH; ?>styles/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo FILEPATH; ?>styles/styles.css" />
<script type="text/javascript" src="<?php echo FILEPATH; ?>scripts/jquery.js"></script>
<script type="text/javascript" src="<?php echo FILEPATH; ?>scripts/jquery.watermark/jquery.watermark.min.js"></script>
<script type="text/javascript" src="<?php echo FILEPATH; ?>scripts/jquery.color.js"></script>
<script type="text/javascript" src="<?php echo FILEPATH; ?>scripts/jquery.cycle.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo FILEPATH; ?>scripts/jquery-gmap3/gmap3.min.js"></script>
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
</head>

<?php
/* Obtain the category id */
if( !empty($_REQUEST['cid']) || $_REQUEST['cid'] != '' ){
	$cid = $_REQUEST['cid'];
}

/* Obtain the collection id */
if( !empty($_REQUEST['coid']) || $_REQUEST['coid'] != '' ){
	$coid = $_REQUEST['coid'];
}

/* Check if there is a search term */
if( !empty($_REQUEST['q']) || $_REQUEST['q'] != '' ){
	$q = trim(rtrim(htmlentities($_REQUEST['q'])));
}
?>

<body id="bd-home">
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

	<div class="container">
    	<div class="boxshadow">
        
        	<!-- HEADER BODY -->
        	<div id="header">
            	<h1 title="Burosys Furniture Pvt. Ltd - Everything in office interiors">
                	<a href="<?php echo FILEPATH; ?>" title="Burosys Furniture Pvt. Ltd - Everything in office interiors"></a>
                </h1>
                <div id="searchbar">
                	<!--<form action="<?php echo FILEPATH; ?>collections/" method="post">
                    	<input type="text" name="q" id="q" placeholder="Search for a specific product" />
                        <a href="#" title="Clear search"></a>
                    </form>-->
                </div>
                <!--<ul id="pmenu">
                	<li>
                    	<a href="<?php echo FILEPATH; ?>collections/?cid=1" title="Collections" class="<?php if( strtolower($pagename) == 'collections' ){ echo "sel"; }else{ echo "";} ?>">Products</a>
                    	<ul>
                        	<li class="top"></li>
                            <li class="title" title="Office furniture">Office</li>
                            <?php
                            	$sqlOffice = mysql_query("select * from bs_categories where category_active=1 and category_type='0'");
								if( mysql_num_rows($sqlOffice) > 0 ){
									while( $rows = mysql_fetch_array($sqlOffice) ){
							?>
                            <li><a href="<?php echo FILEPATH; ?>collections/?cid=<?php echo $rows['category_id']; ?>" title="<?php echo ucfirst($rows['category_name']); ?>" class="<?php if( $cid == $rows['category_id'] ){ echo "sel"; }else{ echo ""; } ?>"><?php echo ucfirst($rows['category_name']) ?></a></li>
                            <?php
									}
								}
							?>
                            <li class="title" title="Home furniture">Living</li>
                            <?php
                            	$sqlOffice = mysql_query("select * from bs_categories where category_active=1 and category_type='L'");
								if( mysql_num_rows($sqlOffice) > 0 ){
									while( $rows = mysql_fetch_array($sqlOffice) ){
							?>
                            <li><a href="<?php echo FILEPATH; ?>collections/?cid=<?php echo $rows['category_id']; ?>" title="<?php echo ucfirst($rows['category_name']); ?>" class="<?php if( $cid == $rows['category_id'] ){ echo "sel"; }else{ echo ""; } ?>"><?php echo ucfirst($rows['category_name']) ?></a></li>
                            <?php
									}
								}
							?>
                            <li class="bottom"></li>
                        </ul>
                    </li>
                    <li>
                    	<a href="<?php echo FILEPATH; ?>projects/" title="Projects" class="<?php if( strstr($pagename, 'project') ){ echo "sel"; }else{ echo "";} ?>">Projects</a>
                    	<ul>
                        	<li class="top"></li>
                            <?php
                            	$sqlOffice = mysql_query("select * from bs_projects where project_active=1");
								if( mysql_num_rows($sqlOffice) > 0 ){
									while( $rows = mysql_fetch_array($sqlOffice) ){
							?>
                            <li><a href="<?php echo FILEPATH; ?>projects/project/?poid=<?php echo $rows['project_id']; ?>" title="<?php echo ucfirst($rows['project_title']); ?>" class="<?php if( $poid == $rows['project_id'] ){ echo "sel"; }else{ echo ""; } ?>"><?php echo ucfirst($rows['project_title']) ?></a></li>
                            <?php
									}
								}
							?>
                            <li class="bottom"></li>
                        </ul>
                    </li>
                </ul>-->
            </div>