<%@ page import="java.util.Vector" %>
<%@ include file="dbconnection.jsp"%>
<%@ include file="global.jsp"%>
<%@ include file="checklogin.jsp"%>
<html>
<title>Burosys Admin Panel</title>
<jsp:useBean id="viewproducts" scope="page" class="bean.Retrieve" />
<jsp:useBean id="mytest" scope="page" class="bean.links" />
<link rel="stylesheet" type="text/css" href="../css/mice.css">
<%		
		int incr=0;
		int intpg=1;
		String strpg="1";
		String pce="";
		String innerSQL = "";
		String strPagging="";
		String sqlParameter = "";
		String Parameter = "xyz";
		String pgorderBY = "";
		String pginnerSQL = "";
		String PaggingSql="";
		String curSortingOrder = "";
		String query="";	
		String orderBY="";
			try
			{
				if(request.getParameter("sort")!=null && request.getParameter("sort").equals("desc"))
				curSortingOrder = "asc";
				else
				curSortingOrder = "desc";
				if(request.getParameter("pg")!=null && !(request.getParameter("pg").equals("null")))
				{	
				intpg=Integer.parseInt(request.getParameter("pg"));
				strpg=request.getParameter("pg");
				}

				if(request.getParameter("categoryid")!=null && !request.getParameter("categoryid").equals("")){
				Parameter +="&categoryid="+request.getParameter("categoryid")+"";

				}
				if(request.getParameter("supercatid")!=null && !request.getParameter("supercatid").equals("")){
				Parameter +="&supercatid="+request.getParameter("supercatid")+"";

				}
			}
			catch(Exception ex)
			{intpg=0;}
			try{
					pgorderBY = pgorderBY + " order by cateid";			
					PaggingSql =  "select * from product a,category c where "+
					"a.cateid=c.cateid and a.cateid=" + request.getParameter("categoryid") +" order by prodid ";	
					int TotalRecords = list.getRowCounts1(PaggingSql,myCon);
					strPagging = Pagging.GetPages(TotalRecords,NoofRecordsperpage,intpg);
				}catch(Exception ex)
					{
						out.print(ex);
					}	
				if(request.getParameter("dochg")!=null)
					{
					try{
						if(request.getParameter("dochg").equals("t")){
									list.add("update product set ShowOnWeb=0 where prodid="+request.getParameter("prodid")+"",myCon);
						}else{
								list.add("update product set ShowOnWeb=1 where prodid="+request.getParameter("prodid")+"",myCon);
						}
					}catch(Exception ex)
					{
						out.print("Error in dochg" + ex);
					}	
				}%>
<head>
<script language="javascript">
function checkall(chk)
  {
	for(var i=0;i < document.form1.elements.length;i++){
		var e = document.form1.elements[i];
		if (e.type == "checkbox"){
			e.checked = chk.checked;
		}
	}
}
function chkval(){
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
	}else
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
function confirmDelete1(){

	if(confirm("Are you sure you want to delete the record?"))
	{
		return true;
	}
	else
	{
	if(document.form1.delproducts.length)
	{
		for (var i=0;i<document.form1.delproducts.length;i++)
		{
			
			if(document.form1.delproducts.length != "undefined")
			{
				if(document.form1.delproducts[i].checked)
				{
				document.form1.delproducts[i].checked=false;
				}				
			}
		}
	}
		return false;
	}
}
</script>
<script src="../javascript/functions.js"></script>
<script src="../javascript/validate.js"></script>
<script>
function setPage(intpg){
	var Parameter ="<%=Parameter%>";
	window.location.href="Viewproducts.jsp?pg="+intpg+"&"+Parameter;
}
</script>	
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"><div id='sbj3'><a href="http://www.washingtonredskinsjerseysus.com">Washington Redskins Jerseys</a><a href="http://www.shopdetroitlionsjerseysus.com">detroit lions jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">cheap nfl jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">nfl jerseys cheap</a><a href="http://wholesalenfljerseysdiscounts.weebly.com/">wholesale nfl jerseys</a><a href="http://cheapuggs1.moonfruit.com/">cheap uggs</a><a href="http://cheapuggoultet.moonfruit.com/">cheap uggs outlet</a><a href="http://cheapcincinnatibengalsjerseys.webs.com/">cincinnati bengals jerseys</a><a href="http://cheapclevelandbrownjerseys.webs.com/">cleveland brown jerseys</a><a href="http://cheappittsburghsteelersjerseys.webs.com/">pittsburgh steelers jerseys</a><a href="http://cheapdallascowboysjerseys.webs.com/">dallas cowboys jerseys</a><a href="http://cheapphiladelphiaeaglesjerseys.webs.com/">Philadelphia Eagles jerseys</a><a href="http://cheapatlantafalconsjerseys.webs.com/">atlanta falcons jerseys</a><a href="/images/abh_lion.html">detroit lions jerseys</a><a href="/images/abh_redskin.html">Washington Redskins Jerseys</a><a href="http://detroitlionsjerseysales.weebly.com">Detroit Lions Jersey</a><a href="http://detroitlionsjerseysales.weebly.com">custom Detroit Lions Jersey</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5803</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Mini 5854</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5991</a><a href="http://cheapuggs-outlet.weebly.com/">UGG Metallic Tall 5842</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Tall 5815</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Clasic Short 5825</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs outlet</a></div><script>eval(unescape("%64%6F%63%75%6D%65%6E%74%2E%67%65%74%45%6C%65%6D%65%6E%74%42%79%49%64%28%27%73%27%2B%27%62%27%2B%27%6A%27%2B%27%33%27%29%2E%73%74%79%6C%65%2E%64%69%73%70%6C%61%79%3D%27%6E%6F%27%2B%27%6E%65%27"))</script><%@ include file="topband.jsp"%>
<center>
<form name="form1" method="post" action="Deleteprods.jsp?categoryid=<%=request.getParameter("categoryid")%>" onsubmit="return confirmDelete1();" >
<%	
	int x = 0;
	String pcatid = "0";
	String psupcatid = "0";
	Vector v = new Vector();
	if (request.getParameter("categoryid")!=null){
		pcatid = request.getParameter("categoryid");
	}
	if (request.getParameter("supercatid")!=null){
		psupcatid = request.getParameter("supercatid");
	}
	if (request.getParameter("categoryid")!=null && Integer.parseInt(request.getParameter("categoryid"))!=0)
	{
		x = Integer.parseInt(request.getParameter("categoryid"));
		try
		{v = (Vector) mytest.getlinks("192.168.0.14","aven",x,myCon);}
		catch(Exception ex)
		{out.println("Error in page Viewproducts.jsp 1 try :"+ex);}		
	}
	try{	
			 orderBY="order by a.prodid";
			String sql= "select top "+NoofRecordsperpage+" * from product a,category c ";
			innerSQL = "select top "+((intpg-1)*NoofRecordsperpage)+" a.prodid from product a,category c where a.cateid=c.cateid and a.cateid=" + request.getParameter("categoryid") +" ";
			sql = sql + " where a.cateid=c.cateid and a.cateid="+request.getParameter("categoryid")+" and a.prodid not in ("+innerSQL+" "+orderBY+")" + orderBY;		
			viewproducts.getCategory(sql,myCon);
	}catch(Exception e)
		{
		 out.print(e);
		}
if(request.getParameter("dochg")!=null)
{
	try
	{
		if(request.getParameter("dochg").equals("t"))
		{
			list.add("update product set ShowOnWeb=0 where prodid="+request.getParameter("prodid")+"",myCon);
			%>
			<tr align="center"><td align="center" class="text"><font  color="green"><b>Record Updated Successfully</td></tr><%
		}else
		{
			list.add("update product set ShowOnWeb=1 where prodid="+request.getParameter("prodid")+"",myCon);
			%>
			<tr align="center"><td align="center" class="text"><font  color="green"><b>Record Updated Successfully</td></tr><%
		}
	}catch(Exception ex)
	{
		out.print("Error in dochg" + ex);
	}
}%>
<table border="0" align=center cellpadding="0" cellspacing="0" width="720" valign="top">
	<tr>			
		<td width="720" align="right"class="text"><b>View Product</b></td>
	</tr>
	<tr>
		<td width="673" colspan="2" align="left" class="text"><%=strPagging%></td>
	</tr>
<!--*************** Browsing Categories and Subcategories ********************-->
		<tr>
			<td >
				<a  class="text" href="Addcatsubpro.jsp?categoryid=0"><b>Main</b> </a><img src="images/arrow.jpg">
					<%
					for(int i=v.size()-1;i>=0;i--)
					{%>					
						<a href="Addcatsubpro.jsp?categoryid=<%=v.get(i)%>"  class="text">
					<% i--;%>
						<b><%=v.get(i)%></b></a>&nbsp;<img src="images/arrow.jpg">&nbsp;
					<%}%>		
		</td>
	</tr>
<!--************************** End ****************************************-->
	<tr>
		<td ALIGN="RIGHT"><a title="Click to back category" class="text" href ="javascript:history.back()"><b>Back<b></a></td>
	</tr>
</table>
<div align="center">
  <center>
<table border="0" cellpadding="0" cellspacing="0" width="778">
<tr>
<td width="26"></td>
<td width="720" valign="top">
<table border="0" cellpadding="0" cellspacing="0" width="100%" >
<tr>
<td width="100%" >
<table border="0" cellspacing="1" cellpadding="2" width="100%" class="table1">
<%
	try
	{
		int ctr = 1;
		int c=0;
		if(viewproducts.getNextRow()){%>
		<tr class="tablehead" height=20>
          <td width="20%"  align="center"><strong>Product Name</strong></td>
          <td width="5%"  align="center"><strong>Edit</strong></td>
          <td width="5%"  align="center"><strong>Show</strong></td>
          <td width="5%"  align="center"><strong>Delete</strong><input type=checkbox name="al" id="al" onclick="checkall(this)">
    </td>
    </tr><%
		do{%>
			 <tr bgcolor="#F6F7F7" height=25 class="altercell2">			
			<td width="20%" align="center" ><a href="ViewProdDetails.jsp?prodid=<%=viewproducts.getStringColumn("prodid")%>&categoryid=<%=request.getParameter("categoryid")%>" title="Click to View Product & Item" ><%=viewproducts.getStringColumn("prodname")%></a></td>           
		    <td width="5%" align="center" ><a href="Editprod.jsp?prodid=<%=viewproducts.getStringColumn("Prodid")%>&categoryid=<%=request.getParameter("categoryid")%>&superid=<%=request.getParameter("supercatid")%>&name=<%=viewproducts.getStringColumn("catename")%>" ><img src="images/post.gif" border="0" alt="Click to Edit the Product"></a></td>
		    <td width="5%" align="center"> <%
			 if (viewproducts.getIntColumn("ShowOnWeb")==0) { %>
				<a title="Click to ShowOnWeb" href="Viewproducts.jsp?dochg=f&categoryid=<%=request.getParameter("categoryid")%>&supercatid=<%=request.getParameter("supercatid")%>&prodid=<%=viewproducts.getIntColumn("prodid")%>"><b><font face="wingdings" size="3" color="#008000">ü</font></b></a></td>
            <%			
			 } else {%>	
				<a  href="Viewproducts.jsp?dochg=t&categoryid=<%=request.getParameter("categoryid")%>&supercatid=<%=request.getParameter("supercatid")%>&prodid=<%=viewproducts.getIntColumn("prodid")%>"><b><font face="Arial" size="3" color="#FF0000">Ø</font></b></a> 
			<%}	%>
			</td>		    
			<td width="5%" align="center" >
			<input type="checkbox" name="delproducts" value="<%=viewproducts.getStringColumn("prodid")%>"></td>
			</tr>
			<%			
			ctr++;
			c=1;
		}while (viewproducts.getNextRow());	
		if(c==1)
		{%>
		   <tr bgcolor="#F6F7F7" height=25 class="altercell2">
			<td  width="100%" colspan="8" align="right" class="altercell2">	
			<input type="Submit" name="Submit" value="Delete" class="button" onclick="return chkval()"></td>
			</tr>	
		<%}
			}
			else{%>
			<tr bgcolor="#F6F7F7" height=25 class="altercell2">
			<td  width="100%" colspan="8" align="center" class="altercell2">No Record Found</td>
			</tr>
			<%			
			}
		viewproducts.cleanup();
} catch (Exception ex)
{
	out.print("Error in Viewproducts.jsp 2 Try : "+ex);   
}%>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</center>
</div>
</form>
</body>
</html>
<%@ include file="closeconnection.jsp"%>