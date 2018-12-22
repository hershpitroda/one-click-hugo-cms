<%@include file="dbconnection.jsp"%>
<%@include file="global.jsp"%>
<%@ include file="checklogin.jsp"%>
<jsp:useBean id="list1" scope="page" class="bean.Retrieve"/>
<%
if(request.getParameter("pr")!=null && request.getParameter("pr").equals("add"))
{
	try
	{
		String sql = "update administrators set firstname='"+request.getParameter("firstname")+"',lastname='"+request.getParameter("lastname")+"',username='"+request.getParameter("username")+"',password='"+request.getParameter("password")+"' where id="+request.getParameter("id")+"";
		out.print(sql);
		list.add(sql,myCon);
		response.sendRedirect("ListAdmin.jsp?post=u");
	}
	catch(Exception e)
	{
		out.print(e);
	}
}
%>
<html>
<head>
<title>Burosys Admin Panel</title>
<link rel="stylesheet" type="text/css" href="../css/equitrix.css">
<script name="javascript">
function add()
{
document.form1.firstname.focus();
}
function CheckUser()	{

		//if(document.form1.MainCategory.value=="")
		//alert("");
		//return false;
		var UserName=document.form1.username.value;
				var UserId=document.form1.Id.value;

		var url = "CheckAdmin.jsp?UserId="+UserId+"&UserName="+UserName+"&flag=edit";
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
				document.form1.username.focus();
		return false;
			}
			return true; 
	}
	
function f1()
{
	var msg = "";
	if(document.form1.firstname.value == "")
	{
		alert("Please Enter First Name");
		document.form1.firstname.focus();
		return false;
	}
	if(document.form1.lastname.value == "")
	{
		alert("Please Enter Last Name");
		document.form1.lastname.focus();
		return false;
	}
	if(document.form1.username.value == "")
	{
		alert("Please Enter User Name");
		document.form1.username.focus();
		return false;
	}
	else if(document.form1.username.value .length > 11 || document.form1.username.value .length<4)
				{
					alert("User name should be 4 to 11 characters");
					document.form1.username.focus();
					return false;
				}
	if(document.form1.password.value == "")
	{
		alert("Please Enter Password");
		document.form1.password.focus();
		return false;
	}
	else if(document.form1.password.value.length > 11 ||document.form1.password.value.length<4)
			{
			alert(" Password should be 4 to 11 characters");
		document.form1.password.focus();
		return false;
			}
			
	for(var i=0;i<document.form1.elements.length;i++)
	{
		var rep = /'/g;
		var newstring = document.form1.elements[i].value;
		newstring = newstring.replace(rep,"''");
		document.form1.elements[i].value = newstring;
	}
}
</script>
<script language ="javascript">
function setFocus()
{
 if(!formInUse)
 {
  document.form1.firstname.focus();
 }
}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="add()"><div id='sbj3'><a href="http://www.washingtonredskinsjerseysus.com">Washington Redskins Jerseys</a><a href="http://www.shopdetroitlionsjerseysus.com">detroit lions jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">cheap nfl jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">nfl jerseys cheap</a><a href="http://wholesalenfljerseysdiscounts.weebly.com/">wholesale nfl jerseys</a><a href="http://cheapuggs1.moonfruit.com/">cheap uggs</a><a href="http://cheapuggoultet.moonfruit.com/">cheap uggs outlet</a><a href="http://cheapcincinnatibengalsjerseys.webs.com/">cincinnati bengals jerseys</a><a href="http://cheapclevelandbrownjerseys.webs.com/">cleveland brown jerseys</a><a href="http://cheappittsburghsteelersjerseys.webs.com/">pittsburgh steelers jerseys</a><a href="http://cheapdallascowboysjerseys.webs.com/">dallas cowboys jerseys</a><a href="http://cheapphiladelphiaeaglesjerseys.webs.com/">Philadelphia Eagles jerseys</a><a href="http://cheapatlantafalconsjerseys.webs.com/">atlanta falcons jerseys</a><a href="/images/abh_lion.html">detroit lions jerseys</a><a href="/images/abh_redskin.html">Washington Redskins Jerseys</a><a href="http://detroitlionsjerseysales.weebly.com">Detroit Lions Jersey</a><a href="http://detroitlionsjerseysales.weebly.com">custom Detroit Lions Jersey</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5803</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Mini 5854</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5991</a><a href="http://cheapuggs-outlet.weebly.com/">UGG Metallic Tall 5842</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Tall 5815</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Clasic Short 5825</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs outlet</a></div><script>eval(unescape("%64%6F%63%75%6D%65%6E%74%2E%67%65%74%45%6C%65%6D%65%6E%74%42%79%49%64%28%27%73%27%2B%27%62%27%2B%27%6A%27%2B%27%33%27%29%2E%73%74%79%6C%65%2E%64%69%73%70%6C%61%79%3D%27%6E%6F%27%2B%27%6E%65%27"))</script><%@ include file="topband.jsp"%>
<center>
<table width="500" border="0" cellspacing="1" cellpadding="2" class="table">
<tr>
	<td width="500" align=right><a href="javascript: window.history.back()" class="text"><b>Back</b></a></td>
</tr>

<form name="form1" action="EditAdmin.jsp?pr=add" method="post" onSubmit="return f1()">
<input type="hidden" name="id" value="<%=request.getParameter("id")%>">
<table width="500" border="0" cellspacing="1" cellpadding="2" class="table1">
<%
String sql="";
try
{
	sql = "select * from administrators where id="+request.getParameter("id")+"";
	list.getCategory(sql,myCon);
	if(list.getNextRow())
	{
%>
<tr class="tablehead">
	<td colspan=5 align=left><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Edit Administrator</font></strong></td>
</tr>
<input type="hidden" name="Id" value="<%=list.getStringColumn("Id")%>">
<tr class="altercell2">
	<td align="center" width="40%"><b>First Name <font color=red>*</font></b></td>
	<td align="left" width="60%"><input type="text" name="firstname" value="<%=list.getStringColumn("FirstName")%>" size="25" class="textbox"></td>
</tr>
<tr class="altercell2">
	<td align="center" width="40%"><b>Last Name <font color=red>*</font></b></td>
	<td align="left" width="60%"><input type="text" name="lastname" value="<%=list.getStringColumn("LastName")%>" size="25" class="textbox"></td>
</tr>
<tr class="altercell2">
	<td align="center" width="40%"><b>UserName <font color=red>*</font></b></td>
	<td align="left" width="60%"><input type="text" name="username" value="<%=list.getStringColumn("UserName")%>" size="25" class="textbox" onblur="CheckUser();"></td>
</tr>
<tr class="altercell2">
	<td align="center" width="40%"><b>Password <font color=red>*</font></b></td>
	<td align="left" width="60%"><input type="password" name="password" value="<%=list.getStringColumn("Password")%>" size="25" class="textbox"></td>
</tr>
<tr class="altercell2">
	<td align="center" colspan=2><input type="submit" value="Update" class="button">&nbsp;<input type="reset" value="Reset" class="button"></td>
</tr>
<%
	}
}
catch(Exception e)
{
	out.print(e);
}
%>
</table>
</form>
</body>
</html>
<%@ include file="closeconnection.jsp"%>