<?php
	require "../includes/constants.php";

	$industry_id = $_REQUEST['industry_id'];
	$list = "";
	
	$sql_clients = mysql_query("select * from bs_clients where industry_id=".$industry_id);
	if( mysql_num_rows($sql_clients) > 0 ){
		while( $rows = mysql_fetch_array($sql_clients) ){
			
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
			
			$sql_industry = mysql_query("select * from bs_industries where industry_id=".$rows['industry_id']);
			if( mysql_num_rows($sql_industry) > 0 ){
				while( $rows1 = mysql_fetch_array($sql_industry) ){
					$client_industry = $rows1['industry_title'];
				}
			}
			
			if( $rows['client_testimonial'] != '' ){ 
				$client_testimonial = ucfirst($rows['client_testimonial']); 
			}else{ 
				$client_testimonial = "N/A"; 
			}
			
			if( $rows['client_designation'] != '' ){ 
				$client_designation = ucfirst($rows['client_designation']); 
			}else{ 
				$client_designation = "N/A"; 
			}
			
			
			$list = "<ul class='plist'>";
			$list .= "<li class='pcheck'><input type='checkbox' name='chk_box_".$rows['client_id']."' id='chk_box_".$rows['client_id']."' /></li>";
			$list .= "<li class='pname'><a href='addclient.php?cid=".$rows['client_id']."'>".$rows['client_company']."</a></li>";
			$list .= "<li class='pname'>".ucfirst($client_industry)."</li>";
			$list .= "<li class='pcat'>".$client_designation."</a></li>";
			$list .= "<li class='pcol'>".$client_testimonial."</li>";
			$list .= "<li class='pactive'>".$client_active."</li>";
			$list .= "<li class='pactive'>".$client_featured."</li>";
			$list .= "</ul>";
			
			echo $list;
	
		}
	}
?>