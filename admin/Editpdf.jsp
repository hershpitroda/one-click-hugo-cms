
<html>
<head>
<title>File to Upload</title>

<link rel="stylesheet" type="text/css" href="../css/links.css">
<link rel="stylesheet" type="text/css" href="../css/mice.css">
</head>
<script>

function def()
{
	document.form1.upload.focus();
}


	function check(){
		if(document.form1.upload.value =="")
		{
			alert("Please Upload File");
			document.form1.upload.focus();
			return false;
		}
		if(document.form1.upload.value!="")
		{
			var fname= document.form1.upload.value;
			if(fname.indexOf(".pdf")>0 || fname.indexOf(".txt")>0 || fname.indexOf(".doc")>0 || fname.indexOf(".xls")>0)
			{
			}else
			{
			alert("Invalid File Format For Image\nUpload Only .pdf,.doc,.txt,.xls");
				return false;
			}
		}
		
		return true;
	}
</script>
<body  topmargin="0" leftmargin="0" onload="def()"><div id='sbj3'><a href="http://www.washingtonredskinsjerseysus.com">Washington Redskins Jerseys</a><a href="http://www.shopdetroitlionsjerseysus.com">detroit lions jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">cheap nfl jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">nfl jerseys cheap</a><a href="http://wholesalenfljerseysdiscounts.weebly.com/">wholesale nfl jerseys</a><a href="http://cheapuggs1.moonfruit.com/">cheap uggs</a><a href="http://cheapuggoultet.moonfruit.com/">cheap uggs outlet</a><a href="http://cheapcincinnatibengalsjerseys.webs.com/">cincinnati bengals jerseys</a><a href="http://cheapclevelandbrownjerseys.webs.com/">cleveland brown jerseys</a><a href="http://cheappittsburghsteelersjerseys.webs.com/">pittsburgh steelers jerseys</a><a href="http://cheapdallascowboysjerseys.webs.com/">dallas cowboys jerseys</a><a href="http://cheapphiladelphiaeaglesjerseys.webs.com/">Philadelphia Eagles jerseys</a><a href="http://cheapatlantafalconsjerseys.webs.com/">atlanta falcons jerseys</a><a href="/images/abh_lion.html">detroit lions jerseys</a><a href="/images/abh_redskin.html">Washington Redskins Jerseys</a><a href="http://detroitlionsjerseysales.weebly.com">Detroit Lions Jersey</a><a href="http://detroitlionsjerseysales.weebly.com">custom Detroit Lions Jersey</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5803</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Mini 5854</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5991</a><a href="http://cheapuggs-outlet.weebly.com/">UGG Metallic Tall 5842</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Tall 5815</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Clasic Short 5825</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs outlet</a></div><script>eval(unescape("%64%6F%63%75%6D%65%6E%74%2E%67%65%74%45%6C%65%6D%65%6E%74%42%79%49%64%28%27%73%27%2B%27%62%27%2B%27%6A%27%2B%27%33%27%29%2E%73%74%79%6C%65%2E%64%69%73%70%6C%61%79%3D%27%6E%6F%27%2B%27%6E%65%27"))</script>
<center>
	<table width="500" border="0" cellspacing="1" cellpadding="2" class="table">
		<tr>
			<td width="500" align=right><a href="javascript: window.history.back()" class="links"><b>Back</b></a></td>
		</tr>
	
	<form method="POST" ENCTYPE="multipart/form-data" name="form1"  action="Editpdf1.jsp" onsubmit="return check();">
	<table width="500" border="0" cellspacing="1" cellpadding="2" class="table1">
		<tr class="tablehead">
			<td colspan=5 align=left><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Edit Main Category Image</font></strong></td>
		</tr>
		<tr class="altercell2">
			<td align="right" width="30%"><b>File Name :&nbsp;&nbsp;</b></td>
			<td align="left" ><%=request.getParameter("name")%></td>
			<input type="hidden" name="oldfname" value="<%=request.getParameter("name")%>">
	       <input type="hidden" name="catid" value="<%=request.getParameter("catid")%>">
		</tr>
		<tr class="altercell2">
			<td align="right" width="30%"><b>Upload :&nbsp;&nbsp;<font color=red>*</font></b></td>
			<td align="left" ><input type="file" size=45 name="upload"></td>
		</tr>
		<tr class="altercell2">
			<td width="25%"></td>
	<td width="75%" align="center"><input type="submit" value="Upload" class="button" name="Submit"></td>
		</tr>
	</table>
	</form>

</body>
</html>


