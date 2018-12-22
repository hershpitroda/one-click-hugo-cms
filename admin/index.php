<?php
session_start();
ob_start();
require "includes/header.php";
if( isset($_REQUEST['sbt_lgn']) ){
	
	$validated = 0;
	$error[] = 0;
	
	$username = clean_var($_POST['lgn_username']);
	$password = clean_var($_POST['lgn_password']);
	
	if( ($username != 'burosys_admin') || empty($username) ){
		$error[0] = 1;
	}else{
		$error[0] = 0;
	}
	
	if( $password != '8ur05y5' || empty($password) ){
		$error[1] = 1;
	}else{
		$error[1] = 0;
	}
	
	for( $i=0; $i<sizeof($error); $i++ ){
		$validated += $error[$i];
	}
	
	if( $validated == 0 ){
		$_SESSION['username'] = "burosys_admin";
		header("Location: home/");
	}
}

?>

	<div id="content" class="admin">
    	<div id="sidebar">
            &nbsp;
        </div>
        
        <div id="main">
        	<h2>Log in - Admin Panel</h2>
            
            <?php
            	if( $validated != 0 ){
			?>
            	<div class="alert">
            		Please correct the errors in the login form.
            	</div>
            <?php
				}
			?>
            
            
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="frm_admin_lgn" id="frm_admin_lgn" enctype="multipart/form-data" >
            	<ul class="form" id="admin-login">
                	<li>
                    	<label for="lgn_username" id="lbl_username" name="lbl_username">Username</label>
                        <input type="text" name="lgn_username" id="lgn_username" value="<?php echo $username; ?>" />
                    </li>
                    <li>
                    	<label for="lgn_password" id="lbl_password" name="lbl_password">Password</label>
                        <input type="password" name="lgn_password" id="lgn_password" />
                    </li>
                    <li>
                    	<input type="submit" name="sbt_lgn" id="sbt_lgn" value="Login" />
                    </li>
                </ul>
            </form>
        </div>
    </div>


<?php require "includes/footer.php"; ?>