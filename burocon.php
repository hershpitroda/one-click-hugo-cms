<?php
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED exmpl. 
 
    $email_to = "aditya@burosys.com";
 
    $email_subject = "Message From Burosys Website";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['name']) ||
       !isset($_POST['email']) ||
	   !isset($_POST['phone']) ||
	   !isset($_POST['zip'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    $first_name = $_POST['name']; // not required
    $email_from = $_POST['email']; // not required
    $contact = $_POST['phone']; // not required
    $zip = $_POST['zip']; // not required
	$ip = $_SERVER['REMOTE_ADDR'];
	$iptolocation = 'http://ipinfo.io/' . $ip;
	$creatorlocation = file_get_contents($iptolocation);
	$url = $_SERVER['HTTP_REFERER'];
	$time = $_SERVER['REQUEST_TIME'];
	$date = date('l, d F Y , H:i:s , e , T , O');
	$agent = $_SERVER['HTTP_USER_AGENT'];
	$globs = $GLOBALS["HTTP_SERVER_VARS"]["REQUEST_URI"];
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'invalid email id.<br />';
	
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'Please enter your real name.<br />';
 
  }
 
  if(strlen($zip) < 2) {
 
    $error_message .= 'Please enter Zip Code.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Name: ".clean_string($first_name)."<br/>";
    $email_message .= "Email: ".clean_string($email_from)."<br/>";
    $email_message .= "Contact No: ".clean_string($contact)."<br/>";
    $email_message .= "Zip: ".clean_string($zip)."<br/>";
	$email_message .="IP Address: ".clean_string($ip)."<br/>";
	$email_message .="IP Location: ".clean_string($iptolocation)."<br/>";
	$email_message .="Location: ".clean_string($creatorlocation)."<br/>";
	$email_message .="URL: ".clean_string($url)."<br/>";
	$email_message .="Time Stamp: ".clean_string($time)."<br/>";
	$email_message .="Date: ".clean_string($date)."<br/>";
	$email_message .="Device & Browser: ".clean_string($agent)."<br/>";
	$email_message .="Mail Processor: ".clean_string($globs)."<br/>";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
			'Reply-To: '.$email_from."\r\n" .
			'X-Mailer: PHP/' . phpversion();

			
// Additional headers
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .= 'Bcc: aadityasudra@gmail.com' . "\r\n";
$headers .= "Sensitivity: Company-Confidential\n";
$headers .= "X-Priority: 1 (Higuest)\n"; 
$headers .= "X-MSMail-Priority: High\n"; 
$headers .= "Importance: High\n";
date_default_timezone_set('Asia/Mumbai');
date("d/m/y : H:i:s", time());
			
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
 
 
<!-- include your own success html here -->
<html>
 <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="111111" style="background-size:cover;">
<div style="text-align:center; vertical-align:middle;">
<p>Processing Your Request...
</p>
<H1> Thank You! </H1>
</div>
</body>
</html>
 
<?php
 
}
 
?>
<meta http-equiv="refresh" content="0; url=http://www.burosys.com" />
