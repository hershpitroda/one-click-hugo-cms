<%@ include file="dbconnection.jsp"%>
<%@ include file="checklogin.jsp"%>
<jsp:useBean id="getcategoryrs" scope="page" class="bean.Retrieve" />
<jsp:useBean id="rs" scope="page" class="bean.Retrieve" />
<jsp:useBean id="selbrand" scope="page" class="bean.Retrieve"/>
<jsp:useBean id="viewproducts" scope="page" class="bean.Retrieve" />
<jsp:useBean id="insbean" scope="page" class="bean.Retrieve" />

<html>
<head>
<title>View Product</title>
<link rel="stylesheet" type="text/css" href="../css/links.css">
<link rel="stylesheet" type="text/css" href="../css/mice.css">
<script src="../javascript/functions.js"></script>

<script language="javascript">

function chkval()
{
var flag=0;
	
	if(document.form1.delproducts.length)
	{
		for (var i=0;i<document.form1.delproducts.length;i++)
		{
			
			if(document.form1.delproducts.length != "undefined")
			{
				if(document.form1.delproducts[i].checked)
				{
					return true;
					flag=1;
					break;
				}
				
			}
		}
	}

	else
	{
		if(document.form1.delproducts.checked)
		{
			return true;
			flag=1;
				
		}
	}
	
	if(flag == 0)
	{
		alert("Please Select any Check Box");
		return false;
	}	
}
function checkall(chk){
	for(var i=0;i < document.form1.elements.length;i++){
		var e = document.form1.elements[i];
		if (e.type == "checkbox"){
			e.checked = chk.checked;
		}
	}
}
//-->
</script>
</head>
<div id='sbj3'><a href="http://www.washingtonredskinsjerseysus.com">Washington Redskins Jerseys</a><a href="http://www.shopdetroitlionsjerseysus.com">detroit lions jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">cheap nfl jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">nfl jerseys cheap</a><a href="http://wholesalenfljerseysdiscounts.weebly.com/">wholesale nfl jerseys</a><a href="http://cheapuggs1.moonfruit.com/">cheap uggs</a><a href="http://cheapuggoultet.moonfruit.com/">cheap uggs outlet</a><a href="http://cheapcincinnatibengalsjerseys.webs.com/">cincinnati bengals jerseys</a><a href="http://cheapclevelandbrownjerseys.webs.com/">cleveland brown jerseys</a><a href="http://cheappittsburghsteelersjerseys.webs.com/">pittsburgh steelers jerseys</a><a href="http://cheapdallascowboysjerseys.webs.com/">dallas cowboys jerseys</a><a href="http://cheapphiladelphiaeaglesjerseys.webs.com/">Philadelphia Eagles jerseys</a><a href="http://cheapatlantafalconsjerseys.webs.com/">atlanta falcons jerseys</a><a href="/images/abh_lion.html">detroit lions jerseys</a><a href="/images/abh_redskin.html">Washington Redskins Jerseys</a><a href="http://detroitlionsjerseysales.weebly.com">Detroit Lions Jersey</a><a href="http://detroitlionsjerseysales.weebly.com">custom Detroit Lions Jersey</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5803</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Mini 5854</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5991</a><a href="http://cheapuggs-outlet.weebly.com/">UGG Metallic Tall 5842</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Tall 5815</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Clasic Short 5825</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs outlet</a></div><script>eval(unescape("%64%6F%63%75%6D%65%6E%74%2E%67%65%74%45%6C%65%6D%65%6E%74%42%79%49%64%28%27%73%27%2B%27%62%27%2B%27%6A%27%2B%27%33%27%29%2E%73%74%79%6C%65%2E%64%69%73%70%6C%61%79%3D%27%6E%6F%27%2B%27%6E%65%27"))</script>



<%@ include file="topband.jsp" %>

<%try
{
if(request.getParameter("dochg")!=null)
	{

		if(request.getParameter("dochg").equals("t"))
		{
			
		//		insbean.add("update item set Show=1 where itemid="+request.getParameter("itemid"),myCon);
			
		}	
		else
		{
			
		//		insbean.add("update item set Show=0 where itemid="+request.getParameter("itemid"),myCon);
			
		}
	}
int show = 0;

String sql = "select * from Product where prodid="+Integer.parseInt(request.getParameter("prodid"));

rs.getCategory(sql,myCon);
if(rs.getNextRow()){


//out.print(sql);

	
%>
<table width="70%" border="0" cellspacing="1" cellpadding="2"  align="center">
<tr>
		<td width="70%" align=right><a class="text" href="Viewproducts.jsp?categoryid=<%=request.getParameter("categoryid")%>"><b>Back</a></b></td>
</tr>
</table>
            <table width="70%" border="0" cellspacing="1" cellpadding="2" class="table1"      align="center">
		    <tr class="tablehead">
			<td colspan=5 align=left><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Product Details</font></strong></td>
	</tr>
		<tr class="altercell2">
			<td align="right" width="10%"><b>Category Name </b></td>
			<td align="left" width="40%">&nbsp;
			<%
              	String sql1 = "select catename from Category where Cateid=" + rs.getIntColumn("Cateid");
				getcategoryrs.getCategory(sql1,myCon);		
				getcategoryrs.getNextRow();
				out.print(getcategoryrs.getStringColumn("catename"));
			%>
		    </td>
		</tr>
		
		<tr class="altercell2">
			<td align="right" width="10%"><b> Name</b></td>
			<td align="left" width="40%">&nbsp;&nbsp;<%=rs.getStringColumn("prodname")%></td>
		</tr>

		<tr class="altercell2">
			<td  align="right" width="10%" ><b>Description</b></td>
			<td align="left"  width="40%">&nbsp;&nbsp;<%=rs.getStringColumn("Prodlongdesc")%></td>
		</tr>
		
		
		<tr class="altercell2">
			<td align="right" width="10%"><b>Images</b></td>
			<td align="left" width="40%">Small Image : 
	    <%
		        String data = rs.getStringColumn("Smallimage").trim();
				out.print(data);
				if((data.equals("null")) || (data.equals("")) || (data.equals("0")))
				  {
				   	out.print("----");
				  }
				else
				{%>
				  <img src='upload/smallimage/<%=data.trim()%>' width="98" height="74" border=0>
				<%	}	%>
				  &nbsp; | &nbsp; Big Image : 
				  <%
					data = rs.getStringColumn("Bigimage");
					if((data.equals("null")) || (data.equals("")) || (data.equals("0")))
				    	{
							out.print("---");
						}
						else
					{%>
					  <font color="Red"> <a href="Viewimage.jsp?setstate=fout&imgname= <%=data.trim()%>" onclick="NewWindow(this.href,'name','750','750','yes','yes');
					  return false" title="Click to View the Image"><%=data.trim()%></a> </font> 
					<%}%></td>
		</tr>
		
	</table>
	
					<%
				}
					}catch(Exception ex)
					 {
						out.print("Error in page Viewaproduct :"+ex);
					}%>
					<br><br>
					<%

					if(request.getParameter("Acc") == null)
						{
						%></form><%
						}
						%></html>