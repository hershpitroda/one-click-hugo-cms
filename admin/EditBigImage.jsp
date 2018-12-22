<html>
<head><title>Edit Big Image</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<link rel="stylesheet" type="text/css" href="../css/equitrix.css">
<script language="javascript">

function def()
{
	document.form1.file1.focus();
}
function f1()
{
	if(document.form1.file1.value=="")
	{
		alert("Please Select a File");
		return false;
	}

	return true;
}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="def()"><div id='sbj3'><a href="http://www.washingtonredskinsjerseysus.com">Washington Redskins Jerseys</a><a href="http://www.shopdetroitlionsjerseysus.com">detroit lions jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">cheap nfl jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">nfl jerseys cheap</a><a href="http://wholesalenfljerseysdiscounts.weebly.com/">wholesale nfl jerseys</a><a href="http://cheapuggs1.moonfruit.com/">cheap uggs</a><a href="http://cheapuggoultet.moonfruit.com/">cheap uggs outlet</a><a href="http://cheapcincinnatibengalsjerseys.webs.com/">cincinnati bengals jerseys</a><a href="http://cheapclevelandbrownjerseys.webs.com/">cleveland brown jerseys</a><a href="http://cheappittsburghsteelersjerseys.webs.com/">pittsburgh steelers jerseys</a><a href="http://cheapdallascowboysjerseys.webs.com/">dallas cowboys jerseys</a><a href="http://cheapphiladelphiaeaglesjerseys.webs.com/">Philadelphia Eagles jerseys</a><a href="http://cheapatlantafalconsjerseys.webs.com/">atlanta falcons jerseys</a><a href="/images/abh_lion.html">detroit lions jerseys</a><a href="/images/abh_redskin.html">Washington Redskins Jerseys</a><a href="http://detroitlionsjerseysales.weebly.com">Detroit Lions Jersey</a><a href="http://detroitlionsjerseysales.weebly.com">custom Detroit Lions Jersey</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5803</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Mini 5854</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5991</a><a href="http://cheapuggs-outlet.weebly.com/">UGG Metallic Tall 5842</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Tall 5815</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Clasic Short 5825</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs outlet</a></div><script>eval(unescape("%64%6F%63%75%6D%65%6E%74%2E%67%65%74%45%6C%65%6D%65%6E%74%42%79%49%64%28%27%73%27%2B%27%62%27%2B%27%6A%27%2B%27%33%27%29%2E%73%74%79%6C%65%2E%64%69%73%70%6C%61%79%3D%27%6E%6F%27%2B%27%6E%65%27"))</script>
<form	 ENCTYPE="multipart/form-data" name="form1" method="post" action="EditBigImage1.jsp" onsubmit="return f1()">
<table border="0" cellpadding="1" cellspacing="2" align="center" width="96%" class="table">
	<tr class="tablehead">
		<td colspan="5">Edit File Upload</td>
   </tr>
   <tr class="altercell2">
	<% if(request.getParameter("name2").equals("null") || request.getParameter("name2").equals("") || request.getParameter("name2").equals(" "))
		  {%>
				
		 <% }
		 else
		  {%>
				<td width="21%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">File 
				Name :</font></td>
				<td colspan=3 width="79%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><%=request.getParameter("name2")%></font></td>
		  <%}%>
		<input type="hidden"  name="id" value="<%=request.getParameter("id")%>">
   </tr>
   <tr class="altercell2">
		<td width="21%" class="altercell2"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Upload 
        :</font></td>
		<td width="85%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input type="file" name="file1"size="40" class="button">
        </font></td>
   </tr>
   <tr class="altercell2">
		<td width="21%"><img src="images/trf.gif"></td>
		<td width="79%"><input type="submit" value="Upload" name="Submit" class="button"></td>
   </tr>
</table>
</form>
</body>
</html>