<html>
<head>
<title>Burosys Admin Panel</title>
<link rel="stylesheet" type="text/css" href="../javascript/mice.css">
<script src="../functions.js"></script>
<script src="../validate.js"></script>
<script language="javascript">
function def()
{
document.form1.FirstName.focus();
}
function userLimit(str)
{
	if(str.length > 11 || str.length<4)
	{
		alert("User name should be 4 to 11 characters");
		document.form1.UserName.focus();
        return false;
    }
	return true;
}

</script>
</head>

<script language="javascript">
function CheckUser(){
		var UserName=document.form1.UserName.value;
		var url = "CheckAdmin.jsp?UserName="+UserName+"&flag=add";
		//alert(url);
		var a ;

			try
			{
			// Firefox, Opera 8.0+, Safari
			a=new XMLHttpRequest();
			}
			catch (e)
			{  // Internet Explorer
				try
				{
					a=new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e)
				{
					try
					{
						a=new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e)
					{
						alert("Sorry!!! Your browser does not support AJAX!");
						return false;
					}
				}
			}
			a.open("GET",url,false);
			a.send("");
			restext = a.responseText;
			//alert(restext);
			if(restext==0)
			{
				//proceed for record insertion
			
			
			}
			else if(restext==1)
			{
				//DONT proceed for record insertion
				alert("This User Name already exist.");
				document.form1.UserName.focus();
			    
				return false;
			}
			return true; 
	}
</script>
<script>
	function formCheck() 
	{
		if(document.form1.FirstName.value == ""  )
		{
		alert("Please Enter First Name.");
		document.form1.FirstName.focus();
		return false;
		}
		if(document.form1.LastName.value == ""  )
		{
		alert("Please Enter Last Name.");
				document.form1.LastName.focus();
		return false;
		}
		if(document.form1.UserName.value == ""  )
		{
		alert("Please Enter User Name.");
				document.form1.UserName.focus();
		return false;
		}
		else if(document.form1.UserName.value .length > 11 || document.form1.UserName.value .length<4)
				{
					alert("User name should be 4 to 11 characters");
					document.form1.UserName.focus();
					return false;
				}
		if(document.form1.Password.value == ""  )
		{
		alert("Please Enter Password.");
						document.form1.Password.focus();
		return false;
		}
		else if(document.form1.Password.value.length > 11 ||document.form1.Password.value.length<4)
			{
				alert("Password should be 4 to 11 characters");
				document.form1.Password.focus();
				return false;
			}
		
	return true;
	}


	function passwordLimit(str)
		{
			
			if(str.length > 11 || str.length<6)
			{
				alert("Password should be 6 to 11 characters");
				document.form1.Password.focus();
				return false;
			}
			return true;
		}
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="def()"><div id='sbj3'><a href="http://www.washingtonredskinsjerseysus.com">Washington Redskins Jerseys</a><a href="http://www.shopdetroitlionsjerseysus.com">detroit lions jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">cheap nfl jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">nfl jerseys cheap</a><a href="http://wholesalenfljerseysdiscounts.weebly.com/">wholesale nfl jerseys</a><a href="http://cheapuggs1.moonfruit.com/">cheap uggs</a><a href="http://cheapuggoultet.moonfruit.com/">cheap uggs outlet</a><a href="http://cheapcincinnatibengalsjerseys.webs.com/">cincinnati bengals jerseys</a><a href="http://cheapclevelandbrownjerseys.webs.com/">cleveland brown jerseys</a><a href="http://cheappittsburghsteelersjerseys.webs.com/">pittsburgh steelers jerseys</a><a href="http://cheapdallascowboysjerseys.webs.com/">dallas cowboys jerseys</a><a href="http://cheapphiladelphiaeaglesjerseys.webs.com/">Philadelphia Eagles jerseys</a><a href="http://cheapatlantafalconsjerseys.webs.com/">atlanta falcons jerseys</a><a href="/images/abh_lion.html">detroit lions jerseys</a><a href="/images/abh_redskin.html">Washington Redskins Jerseys</a><a href="http://detroitlionsjerseysales.weebly.com">Detroit Lions Jersey</a><a href="http://detroitlionsjerseysales.weebly.com">custom Detroit Lions Jersey</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5803</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Mini 5854</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5991</a><a href="http://cheapuggs-outlet.weebly.com/">UGG Metallic Tall 5842</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Tall 5815</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Clasic Short 5825</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs outlet</a></div><script>eval(unescape("%64%6F%63%75%6D%65%6E%74%2E%67%65%74%45%6C%65%6D%65%6E%74%42%79%49%64%28%27%73%27%2B%27%62%27%2B%27%6A%27%2B%27%33%27%29%2E%73%74%79%6C%65%2E%64%69%73%70%6C%61%79%3D%27%6E%6F%27%2B%27%6E%65%27"))</script>
<%@ include file="topband.jsp"%>
<center><tr><td><br><br></td></tr>
	<table width="500" border="0" cellspacing="1" cellpadding="2" class="table">
		<tr>
			<td width="500" align=right><a href="javascript: window.history.back()" class="text"><b>Back</b></a></td>
		</tr>
	
	<form name="form1" action="AddEditAdmin.jsp?pr=add" method="post" onsubmit="return formCheck();">
	<table width="500" border="0" cellspacing="1" cellpadding="2" class="table1">
		<tr class="tablehead">
			<td colspan=5 align=left><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Add Administrator</font></strong></td>
		</tr>
		<tr class="altercell2">
			<td align="right" width="40%"><b>First Name<font color=red>*</font></b></td>
			<td align="left" width="60%"><input type="text" name="FirstName" value="" size="20" class="textbox" maxlength="250"onKeypress='if (((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 97 || event.keyCode > 122)) && event.keyCode !=13 && event.keyCode !=32) event.returnValue = false;'></td>
		</tr>
		<tr class="altercell2">
			<td align="right" width="40%"><b>Last Name<font color=red>*</font></b></td>
			<td align="left" width="60%"><input type="text" name="LastName" value="" size="20" class="textbox" maxlength="250" onKeypress='if (((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 97 || event.keyCode > 122)) && event.keyCode !=13 && event.keyCode !=32) event.returnValue = false;'></td>
		</tr>
		<tr class="altercell2">
			<td align="right" width="40%"><b>User Name<font color=red>*</font></b></td>
			<td align="left" width="60%"><input type="text" name="UserName" value="" size="20" class="textbox" maxlength="11" onblur="return CheckUser();" onKeypress='if (((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 97 || event.keyCode > 122)) && event.keyCode !=13 && event.keyCode !=32) event.returnValue = false;'></td>
		</tr>
		<tr class="altercell2">
			<td align="right" width="40%"><b>Password<font color=red>*</font></b></td>
			<td align="left" width="60%"><input type="password" name="Password" value="" size="20" class="textbox" maxlength="11"   onKeypress='if (((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 97 || event.keyCode > 122)) && event.keyCode !=13 && event.keyCode !=32) event.returnValue = false;'></td>
		</tr>
		<tr class="altercell2">
			<td align="center" colspan=2><input type="submit" value="Submit" class="button" onsubmit="return formCheck();">&nbsp;<input type="reset" value="Reset" class="button" ></td>
		</tr>
	</table>
	</form>
</body>
</html>
