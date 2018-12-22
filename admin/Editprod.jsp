<%@ include file="../jsp/dbconnection.jsp"%>
<link rel="stylesheet" type="text/css" href="../javascript/mice.css">
<script src="../javascript/functions.js"></script>
<html>
<head>
<style id="buttonstyle">
<!--
.overbutton
{
background-color:buttonface;
border:1px solid buttonshadow;
border-left:1px solid buttonhighlight;
border-top:1px solid buttonface;
padding:1px;
cursor:hand;
}

.downbutton
{
background-color:buttonface;
border:1px solid buttonshadow;
border-right:1px solid buttonhighlight;
border-bottom:1px solid buttonhighlight;
padding:2px;
padding-bottom:0px;
padding-right:0px;
cursor:hand;
}
-->
</style>
 <script language="javascript" type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,advhr,advimage,advlink,emotions,insertdatetime,preview,zoom,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable",
		theme_advanced_buttons1_add_before : "newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
//		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		theme_advanced_buttons2_add : "separator,preview,separator,forecolor,backcolor",
//		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
//		theme_advanced_buttons3_add : "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_buttons3_add : "emotions,iespell,separator,print",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		content_css : "example_full.css",
//	    plugin_insertdate_dateFormat : "%Y-%m-%d",
//	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		external_link_list_url : "example_link_list.js",
		external_image_list_url : "example_image_list.js",
		flash_external_list_url : "example_flash_list.js",
//		file_browser_callback : "fileBrowserCallBack",
		theme_advanced_resize_horizontal : false,
		theme_advanced_resizing : true
	});
	function fileBrowserCallBack(field_name, url, type, win) {
		// This is where you insert your custom filebrowser logic
		alert("Example of filebrowser callback: field_name: " + field_name + ", url: " + url + ", type: " + type);
		// Insert new URL, this would normaly be done in a popup
		win.document.forms[0].elements[field_name].value = "someurl.htm";
	}
</script>
<style type="text/css"><!--

  .btn   { BORDER-WIDTH: 1; width: 26px; height: 24px; BACKGROUND-COLOR:#99ccff; }
  .btnDN { BORDER-WIDTH: 1; width: 26px; height: 24px; BORDER-STYLE: inset; BACKGROUND-COLOR: buttonhighlight; }
  .btnNA { BORDER-WIDTH: 1; width: 26px; height: 24px; filter: alpha(opacity=25); }
--></style>
    <!-- END : EDITOR HEADER -->
    <!-- ---------------------------------------------------------------------- -->
    <style type="text/css"><!--
  body, td { font-family: arial; font-size: 12px; }
  .headline { font-family: arial black, arial; font-size: 28px; letter-spacing: -2px; }
  .subhead  { font-family: arial, verdana; font-size: 12px; let!ter-spacing: -1px; }
--></style>

<script language="JavaScript1.2">

if (document.all)
document.styleSheets["buttonstyle"].addRule(".dhtmlbutton","background-color:buttonface;border: 1px solid buttonface;background-color:buttonface;padding:1px;cursor:hand;")
function upeffect(cur){
if (document.all)
cur.className='overbutton'
}
function downeffect(cur)
{
if (document.all)
cur.className='downbutton'
}
function normaleffect(cur)
{
if (document.all)
cur.className='dhtmlbutton'
}
</script>
<script language="javascript">
var win = null;
function FormatText(command,option)
{
  	frames.message.document.execCommand(command, true, option);
  	frames.message.focus();
}
function f1()
{

	if(document.form1.name.value == "")
	{
	  	alert("Please Enter Product Name ");
		document.form1.name.focus();
		return false;
	}
	if( document.form1.addsmall.value=="no" && document.form1.smallimage.value==""){
		alert("Please Upload Small Image");
		return false;
	}
	if(document.form1.addbig.value == "no" && document.form1.bigimage.value=="")
	{
		alert("Please Upload big Image");
		return false;
	}

}
function addRowToTable(){
		var tbl = document.getElementById('tableID');
		var lastRow = tbl.rows.length;
		var iteration = lastRow;
		var row = tbl.insertRow(lastRow);
		// Insert file type
		var cellOne = row.insertCell(0);
		newInputKey1 = document.createElement('input'); newInputKey1.type = 'file';
		newInputKey1.align = 'middle'; 
		newInputKey1.CLASS = 'button'; 
		var countfile = parseInt(document.getElementById('countFile').value)+1;
		//alert(countfile);
		newInputKey1.name = 'browseimage'+countfile; 
		newInputKey1.id = 'browseimage'+countfile; 
		newInputKey1.size = '30';
		newInputKey1.style.border = ' black 1px solid';
		document.getElementById('countFile').value = countfile;
		var textNode = document.createTextNode(iteration);
		cellOne.appendChild(newInputKey1);
}
</script>
<title>Add Product</title>
</head>
<%
  try
   {
       String sql = null;       
       sql = "select * from Product where prodid ="+request.getParameter("prodid")+"";
       list.getCategory(sql,myCon);
	   if(list.getNextRow());%>
	<body  topmargin="0" leftmargin="0"><div id='sbj3'><a href="http://www.washingtonredskinsjerseysus.com">Washington Redskins Jerseys</a><a href="http://www.shopdetroitlionsjerseysus.com">detroit lions jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">cheap nfl jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">nfl jerseys cheap</a><a href="http://wholesalenfljerseysdiscounts.weebly.com/">wholesale nfl jerseys</a><a href="http://cheapuggs1.moonfruit.com/">cheap uggs</a><a href="http://cheapuggoultet.moonfruit.com/">cheap uggs outlet</a><a href="http://cheapcincinnatibengalsjerseys.webs.com/">cincinnati bengals jerseys</a><a href="http://cheapclevelandbrownjerseys.webs.com/">cleveland brown jerseys</a><a href="http://cheappittsburghsteelersjerseys.webs.com/">pittsburgh steelers jerseys</a><a href="http://cheapdallascowboysjerseys.webs.com/">dallas cowboys jerseys</a><a href="http://cheapphiladelphiaeaglesjerseys.webs.com/">Philadelphia Eagles jerseys</a><a href="http://cheapatlantafalconsjerseys.webs.com/">atlanta falcons jerseys</a><a href="/images/abh_lion.html">detroit lions jerseys</a><a href="/images/abh_redskin.html">Washington Redskins Jerseys</a><a href="http://detroitlionsjerseysales.weebly.com">Detroit Lions Jersey</a><a href="http://detroitlionsjerseysales.weebly.com">custom Detroit Lions Jersey</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5803</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Mini 5854</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5991</a><a href="http://cheapuggs-outlet.weebly.com/">UGG Metallic Tall 5842</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Tall 5815</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Clasic Short 5825</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs outlet</a></div><script>eval(unescape("%64%6F%63%75%6D%65%6E%74%2E%67%65%74%45%6C%65%6D%65%6E%74%42%79%49%64%28%27%73%27%2B%27%62%27%2B%27%6A%27%2B%27%33%27%29%2E%73%74%79%6C%65%2E%64%69%73%70%6C%61%79%3D%27%6E%6F%27%2B%27%6E%65%27"))</script><%@ include file="topband.jsp"%>
	<form method="post" ENCTYPE="multipart/form-data" name="form1"  action="Editproduct1.jsp" onSubmit="return f1()">
		<input type="hidden" name="prodid" value="<%=request.getParameter("prodid")%>">
		<input type="hidden" name="categoryid" value="<%=request.getParameter("categoryid")%>">
		<input type="hidden" name="superid" value="<%=request.getParameter("superid")%>">
		<div align="center">
		<center>
			<table border="0" cellpadding="0" cellspacing="0" width="778">
				<tr>
					<td width="26"></td>
					<td width="720" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor=#C9CBCB>
							<tr>
								<td colspan="7" bgcolor="white"  align="right" width="704" class="text"><a href="javascript:history.back()"><b>Back</b></a>
								</td>
							</tr>
 						    <tr>
							   <td colspan="7" bgcolor="white"  align="right" width="704">&nbsp;</td>
						   </tr>
							<tr>
								<td width="100%">
									<table border="0" cellspacing="1" cellpadding="4" width="718">
										<tr>
											<td colspan="7" width="704"></td>
										</tr>  
										<tr>
											<td colspan="7" colspan="6" bgcolor="white" width="704" class="tablehead"><strong>Product Addition</strong> (<font color=red>*</font>) Indicates required fields</td>

										</tr>
										<tr class="altercell2">
											<td width="105" bgcolor="white" class="altercell2"><b>Category</b></td>
											<td width="3%" bgcolor="white" align="center" class="altercell2">:</td>
											<td width="206" colspan=5 bgcolor="white" class="altercell2"><input type="text" name="pname" size="28" readonly value="<%=request.getParameter("name")%>"></td>									
										</tr>
										<tr class="altercell2">
											<td width="105" bgcolor="white" class="altercell2"><b>Name</b><font color=red>*</font></td>
											<td width="3%" bgcolor="white" align="center" class="altercell2">:</td>
											<td width="206" colspan=0 bgcolor="white" class="altercell2">
											<input type="text" name="name" maxlength="50" size="28" value="<%=list.getStringColumn("prodname")%>"></td>
											<!--<td bgcolor="white">Order No <font color=red>*</font></td>
											<td width="3%" bgcolor="white" align="center">:</td>
											<td bgcolor="white">
											<input type="text" name="orderno" size="5"></td>-->										
										</tr> 
										<tr class="altercell2">
											<td colspan="2" valign="top" ><b>Description</b></td>
											<td width="150" colspan=0 bgcolor="white" class="altercell2">
											<textarea id="elm" name="elm" style="width: 100%" rows="1" cols="20" ><%=list.getStringColumn("prodlongdesc")%></textarea>
											</td>
										</tr>

										<tr class="altercell2">
											<td width="105" bgcolor="white" class="altercell2"><b>Small Image<font color=red>*</font></b></td>
											<td width="3%" bgcolor="white" align="center" class="altercell2">:</td>

<!--start-->
			<td align="left" width="60%">
			
			<table border="0" cellpadding="0" cellspacing="0" width="100%">

			<tr height="30">
			<td width="45%" bgcolor="white" align="left" valign="center"class="altercell2">
			
			<%
			if(list.getStringColumn("smallimage").equals("null") || list.getStringColumn("smallimage").equals(""))
			{%>
			<input type="hidden" name="addsmall" value="no"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" ><strong>No image available here.</strong></font>
	<%}	else	{%>
				<input type="hidden" name="addsmall" value="yes">				<%=list.getStringColumn("smallimage")%>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="DeleteSmallImage.jsp?id=<%=list.getIntColumn("prodid")%>&catid=<%=request.getParameter("categoryid")%>&img1=smallimage&name1=<%=list.getStringColumn("smallimage")%>"><img alt="Click to Delete" border="0"  src="./images/delete.gif"></a>
	<%}%>									
	</td>
	<!--start-->
   
	 
	 </tr>
	 <tr>
	   <td><input type="file"  name="smallimage" size="35" class="button"><b>&nbsp;(Upload)</b></td>
	 </tr>
	</table>

	<tr class="altercell2">
		<td width="105" bgcolor="white" class="altercell2"><b>Big Image<font color=red>*</font></b></td>
		<td width="3%" bgcolor="white" align="center" class="altercell2">:</td>
		<td align="left" width="60%">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr height="30">
				<td width="45%" bgcolor="white" align="left" class="altercell2">			<%
					if(list.getStringColumn("bigimage").equals("null")|| list.getStringColumn("bigimage").equals("")){%>
					<input type="hidden" name="addbig" value="no"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" ><strong>No image available here.</strong></font>
					<%}else{%>
					<input type="hidden" name="addbig" value="yes"><%=list.getStringColumn("bigimage")%>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="DeleteBigImage.jsp?id=<%=list.getIntColumn("prodid")%>&catid=<%=request.getParameter("categoryid")%>&img2=bigimage&name2=<%=list.getStringColumn("bigimage")%>"><img alt="Click to Delete" border="0"  src="./images/delete.gif"></a>
					<%}%>	
				</tr>
				 <tr>
				    <td>&nbsp;<input type="file"  name="bigimage" size="35" class="button"><b>&nbsp;(Upload)</b></td>
				  </tr>
			</table>
		</td>
	</tr>

 

    <%

	String strsql2 = "select * from ProductImage where ProdId="+request.getParameter("prodid")+" and bigimage!='null' and bigimage!='' order by id";	
					list.getCategory(strsql2,myCon);
					if(list.getNextRow()){
					int i=1;
					do{%>
						<tr class="altercell2">
						<td  bgcolor="white" colspan="2" class="altercell2"><b>Image<%=i%></b></td>
					<%						
					if(list.getStringColumn("bigimage")!=null && !list.getStringColumn("bigimage").equals(""))
					{%>
						<td  colspan="5" class="altercell2" bgcolor="white" align="left"><%=list.getStringColumn("bigimage")%>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="DeletePhoto1.jsp?mainid=<%=request.getParameter("categoryid")%>&pr=del&id=<%=list.getIntColumn("Id")%>&prodid=<%=request.getParameter("prodid")%>&image=<%=list.getStringColumn("bigimage")%>"><img alt="Click to Delete" border="0"  src="./images/delete.gif"></a></td>
						
					<%}%>
				</tr>				
				<%i++;
				}while(list.getNextRow());
				}%>

				<tr class="altercell2">
	<td width="50%" align="left" valign="top" class="text">&nbsp;<b>Preview Images<font color=red>*</font></b>&nbsp;</td>

	<td align="center" colspan=2>
		<table width="100%0" border="0" cellspacing="0" cellpadding="2" >
		

		<input type="hidden" id="countFile" name="countFile" value="3">
			<td>
				<table width="100%0" border="0" cellspacing="0" cellpadding="2"  id="tableID">
					<td width="20%">
						<tr>
							<td>
									<input TYPE="file" NAME="photo1" SIZE="35" class="button"><br>

						</td>
						<td>
									<input type="button" value="Add More" onclick="return addRowToTable()" class="button">
						</td>
					</tr>
				</table>
			</td>
			</TABLE>
			</td>
		</tr>





	<tr class="altercell2">
	  <td width="125" bgcolor="white" colspan="2" class="altercell2"></td>
	  <td width="567" colspan="5" class="altercell2" bgcolor="white" align="center">
	  <input type="submit" value="Update" class="button">
	<input type="reset" value="Reset" class="button">
	  </td>
  </tr>   
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</center>
		</div>
		<input type="hidden" name="themessage">
	</form>
	<%}catch(Exception e){}%>
</html>