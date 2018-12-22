<?php
	
	require "../includes/constants.php";
	
	header("Content-type: application/csv");
	header("Content-Disposition: attachment; filename=newsletter_list.csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	$sql_nllist = mysql_query("select * from bs_newsletters");
	
	echo 'Newsletter ID'. "," .'Email address' . "," .'Subscription' ."," .'Active' . "\t";
	echo "\n";
	
	if( mysql_num_rows($sql_nllist) > 0 ){
		
		while( $rows = mysql_fetch_array($sql_nllist) ){
			
			if( $rows['newsletter_subscribe'] == 1 ){
				$nl_subscribe = "Active";
			}else{
				$nl_subscribe = "Inactive";
			}
			
			if( $rows['newsletter_active'] == 1 ){
				$nl_active = "Active";
			}else{
				$nl_active = "Inactive";
			}
			
			echo $rows['newsletter_id'] . "," . $rows['newsletter_email'] . "," . $nl_subscribe . "," . $nl_active . "\t";
			echo "\n";
		}
	}

	
?>