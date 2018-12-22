<%@ include file="dbconnection.jsp"%>
<%@ include file="global.jsp"%>
<%@ include file="checklogin.jsp"%>
<html>
<head>
<title>Edit Main Category</title>

<link rel="stylesheet" type="text/css" href="../css/links.css">
<link rel="stylesheet" type="text/css" href="../css/mice.css">
<script language="javascript">

function def()
{
	document.form1.MainCat.focus();
}


function CheckUser(){
		//if(document.form1.MainCategory.value=="")
		//alert("");
		//return false;
		var MainCategory=document.form1.MainCat.value;
				var CategoryId=document.form1.catid.value;
		var url = "CheckMaincategory.jsp?MainCategory="+MainCategory+"&MainCat="+CategoryId+"&flag=edit";
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
				alert("This Main Category Name already exist.");
				document.form1.MainCat.focus();
				return false;
			}
			return true; 
	}
	
function checkfields()
{   
   if (document.form1.MainCat.value == "")
   {
	alert("Please Enter MainCategory");
	document.form1.MainCat.focus();
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
</head>
<body  topmargin="0" leftmargin="0" onload="def()"><div id='sbj3'><a href="http://www.washingtonredskinsjerseysus.com">Washington Redskins Jerseys</a><a href="http://www.shopdetroitlionsjerseysus.com">detroit lions jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">cheap nfl jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">nfl jerseys cheap</a><a href="http://wholesalenfljerseysdiscounts.weebly.com/">wholesale nfl jerseys</a><a href="http://cheapuggs1.moonfruit.com/">cheap uggs</a><a href="http://cheapuggoultet.moonfruit.com/">cheap uggs outlet</a><a href="http://cheapcincinnatibengalsjerseys.webs.com/">cincinnati bengals jerseys</a><a href="http://cheapclevelandbrownjerseys.webs.com/">cleveland brown jerseys</a><a href="http://cheappittsburghsteelersjerseys.webs.com/">pittsburgh steelers jerseys</a><a href="http://cheapdallascowboysjerseys.webs.com/">dallas cowboys jerseys</a><a href="http://cheapphiladelphiaeaglesjerseys.webs.com/">Philadelphia Eagles jerseys</a><a href="http://cheapatlantafalconsjerseys.webs.com/">atlanta falcons jerseys</a><a href="/images/abh_lion.html">detroit lions jerseys</a><a href="/images/abh_redskin.html">Washington Redskins Jerseys</a><a href="http://detroitlionsjerseysales.weebly.com">Detroit Lions Jersey</a><a href="http://detroitlionsjerseysales.weebly.com">custom Detroit Lions Jersey</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5803</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Mini 5854</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5991</a><a href="http://cheapuggs-outlet.weebly.com/">UGG Metallic Tall 5842</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Tall 5815</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Clasic Short 5825</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs outlet</a></div><script>eval(unescape("%64%6F%63%75%6D%65%6E%74%2E%67%65%74%45%6C%65%6D%65%6E%74%42%79%49%64%28%27%73%27%2B%27%62%27%2B%27%6A%27%2B%27%33%27%29%2E%73%74%79%6C%65%2E%64%69%73%70%6C%61%79%3D%27%6E%6F%27%2B%27%6E%65%27"))</script><center>
	<table width="500" border="0" cellspacing="1" cellpadding="2" class="table">
		<tr>
			<td width="500" align=right><a href="javascript: window.close()" class="links"><b>Close</a></b></td>
		</tr>
	</table>
	 <form name="form1" method="post" action="EditMain1.jsp" onSubmit="return checkfields()">
		<%
		  try
		   {
			 String sql = null;		// For containing sql string
			  sql = "select * from Category where cateid=" + request.getParameter("catid");
			  list.getCategory(sql,myCon);
			  if(list.getNextRow());	
		%>
				<input type="hidden" name="catid" value=<%=list.getIntColumn("cateid")%>>
				<table width="500" border="0" cellspacing="1" cellpadding="2" class="table1">
					<tr class="tablehead">
						<td colspan=5 align=left><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Edit Main Category</font></strong></td>
					</tr>
					<tr class="altercell2">
						<td align="right" width="30%"><b>Main Category <font color=red>*</font></b></td>
						<td align="left">
						
						<input type="text" name="MainCat" size="45" class="textbox" align="right" maxlength="30"
			onKeypress=" if ((event.keyCode > 33 && event.keyCode < 48) || (event.keyCode > 57 && event.keyCode < 65) || (event.keyCode > 90 && event.keyCode < 97) && event.keyCode==34 || event.keyCode==124 || event.keyCode==39 || event.keyCode==125 || event.keyCode==91 || event.keyCode==93 || event.keyCode==94 || event.keyCode==123 || event.keyCode==95 || event.keyCode==126 ) event.returnValue = false;"  onblur="return CheckUser();" value="<%out.print(list.getStringColumn("CateName").trim());%>">
						</td>
					</tr>
					<tr class="altercell2">
						<td align="right" width="30%"><b>Image&nbsp;&nbsp;</b></td>
						<td align="left" ><a href="EditMainImg.jsp?name=<%=list.getStringColumn("CateImage")%>&catid=<%=request.getParameter("catid")%>">		<%=list.getStringColumn("CateImage")%></a></td>
					</tr>
					<tr class="altercell2">
						<td align="right" width="30%"><b>Pdf&nbsp;&nbsp;</b></td>
						<td align="left" ><a href="Editpdf.jsp?catid=<%=request.getParameter("catid")%>">
						<% if(list.getStringColumn("shortdesc")!=null && !list.getStringColumn("shortdesc").equals("")){out.print(list.getStringColumn("shortdesc"));}else{out.print("Download");}%></a></td>
					</tr>
					<tr class="altercell2">
						<td align="center" colspan=2><input type="submit" value="Update" class="button" >&nbsp;<input type="reset" value="Reset" class="button" ></td>
					</tr>
				</table>
		<%}catch (Exception e)
		   {
			%><h3>Exception <%=e%></h3><%
		   }
		%>
	</form>
	  
</body>
</html>
