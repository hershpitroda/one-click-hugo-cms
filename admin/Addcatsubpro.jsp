<%@ page import="java.util.Vector,javax.servlet.*"%>
<%@ include file="dbconnection.jsp"%>
<%@ include file="global.jsp"%>
<%@ include file="checklogin.jsp"%>
<html>
<head>
<title>Burosys Master Panel</title>
</head>
<table width="100%" cellspacing="0" cellpadding="0" border="0" >
	<tr>
		<td><%@ include file="topband.jsp"%><td>
	<tr>
<jsp:useBean id="viewproducts" scope="page" class="bean.Retrieve"/>
<jsp:useBean id="viewprodtots" scope="page" class="bean.Retrieve"/>
<jsp:useBean id="viewsubs" scope="page" class="bean.Retrieve"/>
<jsp:useBean id="productcnt" scope="page" class="bean.Retrieve"/>
<jsp:useBean id="productcnt1" scope="page" class="bean.Retrieve"/>
<jsp:useBean id="ord" scope="page" class="bean.Retrieve"/>
<jsp:useBean id="pyl" scope="page" class="bean.Retrieve"/>
<jsp:useBean id="pyl2" scope="page" class="bean.Retrieve"/>
<jsp:useBean id="spyl" scope="page" class="bean.Retrieve"/>
<jsp:useBean id="mytest" scope="page" class="bean.links"/>
<%	
	int srno=0;
  int intpg=1;
  String strpg="1";
  String innerSQL = "";
  String strPagging="";
  String sqlParameter ="";
  String Parameter =null;
  String pgorderBY = "";
  String pginnerSQL = "";
  String PaggingSql="";
  if(request.getParameter("categoryid")!=null && !request.getParameter("categoryid").equals(""))
	  {
		  Parameter=request.getParameter("categoryid");
	  }%>
<link rel="stylesheet" type="text/css" href="../css/mice.css">
<script src="../javascript/functions.js"></script>
<script src="../javascript/validate.js"></script>
<script>
	function setPage(intpg)
	{
		var Parameter ="<%=Parameter%>";
		window.location.href="Addcatsubpro.jsp?pg="+intpg+"&categoryid="+Parameter+"";
	}
</script>
<%
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
								srno=((intpg-1)*15);
				}

				if(request.getParameter("pg")!=null && !(request.getParameter("pg").equals("null")))
				{	
				intpg=Integer.parseInt(request.getParameter("pg"));
				strpg=request.getParameter("pg");
				}
			}
			catch(Exception ex)
			{
			intpg=0;
			}
			
	if(request.getParameter("OrderCnt") != null)
	{
		String s="";
		if (request.getParameter("categoryid")==null)
		{
			s = "select Cateid from category where parentcateid=0 order by catename";
		}
		if (request.getParameter("categoryid")!=null){
			s = "select Cateid from Category where parentcateid ='" + request.getParameter("categoryid") +"' order by catename"; 
		}
		viewproducts.getCategory(s,myCon);
		while(viewproducts.getNextRow())
		{
		    if(request.getParameter("Order"+viewproducts.getStringColumn("cateid"))!=null && !request.getParameter("Order"+viewproducts.getStringColumn("cateid")).equals("")){
			    s="update category set CatOrder="+request.getParameter("Order"+viewproducts.getStringColumn("cateid"))+" where cateid="+viewproducts.getStringColumn("cateid")+"";
			    ord.add(s,myCon);
		    }
		}
	}

    if(request.getParameter("dochg")!=null)
	 {
	    try
	    {
		int x=Integer.parseInt(request.getParameter("catid"));
	    if(request.getParameter("dochg").equals("t"))
		    {            
			    list.add("update category set ShowOnWeb=0 where cateid="+x+"",myCon);%>
	    <tr align="center"><td align="center" class="text"><font  color="green"><b>Record Updated Successfully</td></tr>
	    <%}	else	{
			    list.add("update category set ShowOnWeb=1 where cateid="+x+"",myCon);%>
			    <tr align="center"><td align="center" class="text"><font  color="green"><b>Record Updated Successfully</td></tr><%
		    }
	    }catch(Exception ex)
	    {
		    out.print("Error in dochg" + ex);
	    }
    }%>
<link rel="stylesheet" type="text/css" href="links.css">
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"><div id='sbj3'><a href="http://www.washingtonredskinsjerseysus.com">Washington Redskins Jerseys</a><a href="http://www.shopdetroitlionsjerseysus.com">detroit lions jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">cheap nfl jerseys</a><a href="http://cheapnfljerseysdiscounts.weebly.com/">nfl jerseys cheap</a><a href="http://wholesalenfljerseysdiscounts.weebly.com/">wholesale nfl jerseys</a><a href="http://cheapuggs1.moonfruit.com/">cheap uggs</a><a href="http://cheapuggoultet.moonfruit.com/">cheap uggs outlet</a><a href="http://cheapcincinnatibengalsjerseys.webs.com/">cincinnati bengals jerseys</a><a href="http://cheapclevelandbrownjerseys.webs.com/">cleveland brown jerseys</a><a href="http://cheappittsburghsteelersjerseys.webs.com/">pittsburgh steelers jerseys</a><a href="http://cheapdallascowboysjerseys.webs.com/">dallas cowboys jerseys</a><a href="http://cheapphiladelphiaeaglesjerseys.webs.com/">Philadelphia Eagles jerseys</a><a href="http://cheapatlantafalconsjerseys.webs.com/">atlanta falcons jerseys</a><a href="/images/abh_lion.html">detroit lions jerseys</a><a href="/images/abh_redskin.html">Washington Redskins Jerseys</a><a href="http://detroitlionsjerseysales.weebly.com">Detroit Lions Jersey</a><a href="http://detroitlionsjerseysales.weebly.com">custom Detroit Lions Jersey</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5803</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Mini 5854</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Bailey Button 5991</a><a href="http://cheapuggs-outlet.weebly.com/">UGG Metallic Tall 5842</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic Tall 5815</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Clasic Short 5825</a><a href="http://cheapuggs-outlet.weebly.com/">Ugg Classic</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs</a><a href="http://cheapuggs-outlet.weebly.com/">cheap uggs outlet</a></div><script>eval(unescape("%64%6F%63%75%6D%65%6E%74%2E%67%65%74%45%6C%65%6D%65%6E%74%42%79%49%64%28%27%73%27%2B%27%62%27%2B%27%6A%27%2B%27%33%27%29%2E%73%74%79%6C%65%2E%64%69%73%70%6C%61%79%3D%27%6E%6F%27%2B%27%6E%65%27"))</script>
<form name="form1" method="post" action="Addcatsubpro.jsp">
<%	
		int x = 0;
		Vector v = new Vector();
%>
	<div align="center">			
<table align="center" border="0" cellpadding="0" cellspacing="0" width="715" valign="top">
	<tr>
		<td width="491"class="text"><font name="Verdana, Arial, Helvetica, sans-serif" ><strong><%="Add Categories / Sub Categories / Products"%></strong></font>
		<td width="184" align="right" class="text"><a  href="AddMain.jsp" onclick="NewWindow(this.href,'name','600','200','no','no');return false"class="text" title="Click to Add a Main Category"><b><u>Add Main Category</u></b></a>
		</td>

		<tr><td width="673" colspan="2"><img src="images/trf.gif"><br></td></tr>
			<tr><td width="673" colspan="2" align="left"class="text"><%=strPagging%></td></tr>
			<tr>		
				<td width="100%" colspan=3 ><font color="red">
				<a href="Addcatsubpro.jsp?categoryid=0" title="Click to Add a Main " class="text"><b>Main </a></b><img src="images/arrow.jpg">
				<%
				for(int i=v.size()-1;i>=0;i--)
				{%>
					<a href="Addcatsubpro.jsp?categoryid=<%=v.get(i)%>" class="text">
					<%i--;%>
					<b><%=v.get(i)%></b></a>&nbsp;<img src="images/arrow.jpg">&nbsp;
				<%}%>
				</font>
			</td>
		</tr>
		<tr><td colspan="2" align="right" >
		   <%if(v.size()>0){%>
		   <a class="text" href ="javascript:history.back()"><b>Back<b></a>
		   <%}%>
		</tr>
	<%
			int ctr = 1;
	String categoryid="";
	String sql ="";
		if(request.getParameter("categoryid")!=null && !request.getParameter("categoryid").equals("null") && !request.getParameter("categoryid").equals(""))
		{
			categoryid= request.getParameter("categoryid");
			sql = null;	// For containg sql string
			if (request.getParameter("categoryid")!=null && Integer.parseInt(request.getParameter("categoryid"))!=0)
				{
					x = Integer.parseInt(request.getParameter("categoryid"));
					try{			
							v = (Vector) mytest.getlinks("192.168.0.254","CERAMICA",x,myCon);
						}catch(Exception ex)
						{
							out.println("Error in page Addcatsubpro links try:"+ex);
						}		
				}
		}
	if (request.getParameter("categoryid")!=null && !request.getParameter("categoryid").equals("null") && !request.getParameter("categoryid").equals(""))
	{		
		try
		{			
				pgorderBY = pgorderBY + " order by cateid";			
				PaggingSql = "select * from Category where parentcateid=0";
				PaggingSql = "select * from Category where parentcateid="+categoryid+"";
				int TotalRecords = list.getRowCounts1(PaggingSql,myCon);
				strPagging = Pagging.GetPages(TotalRecords,NoofRecordsperpage,intpg);				
		}catch(Exception ex)
		{out.print(ex);}				
			 sql= "select top "+NoofRecordsperpage+" c.* from Category c";
					innerSQL = "select top "+((intpg-1)*NoofRecordsperpage)+" c.CateId from Category c where c.parentcateid="+categoryid+"";
					sql = sql + " where c.parentcateid="+categoryid+" and c.CateId not in ("+innerSQL+" "+orderBY+")" + orderBY;

			%><input type=hidden name=categoryid value=<%=request.getParameter("categoryid")%> ><input type=hidden name=supercatid value=<%=request.getParameter("supercatid")%> ><%
	}else{			
		try{
				pgorderBY = pgorderBY + " order by cateid";			
				PaggingSql = "select * from Category where parentcateid=0";
				int TotalRecords = list.getRowCounts1(PaggingSql,myCon);
				strPagging = Pagging.GetPages(TotalRecords,NoofRecordsperpage,intpg);
			}catch(Exception ex)
			{
				out.print(ex);
			}	
			orderBY = orderBY + "order by  cateid asc";
			 sql= "select top "+NoofRecordsperpage+" c.* from Category c";
			innerSQL = "select top "+((intpg-1)*NoofRecordsperpage)+" c.CateId from Category c where parentcateid=0";
			sql = sql + " where   parentcateid=0 and c.CateId not in ("+innerSQL+" "+orderBY+")" + orderBY;
	}
		viewproducts.getCategory(sql,myCon);
	if(viewproducts.getNextRow())
		{%>
			
	</table>
</center>
</div>
<div align="center">
<center>
<table border="0" cellpadding="0" cellspacing="0" width="778" valign="top">
	<tr>	<td width="26"></td>
	<td width="720" valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" valign="top">
			<tr>
				<td width="100%">
					<table width="100%" border="0" cellspacing="1" cellpadding="4" class="table1">
					<%
		try{		
		String sql1 = null;	// sql string for count of prods
		String sql2 = null;     // sql string for counting subs
		int catid = 0;		// for checking if it exists in product		
		String finval = null;

		int c = 0;%>
		  <tr class="tablehead">
		  <td width="5%" align="center" >Sr.no</td>
			 <td width="30%" align="center" > Category</td>
			 <td width="10%" align="center" >Total Products</td>
			 <td width="15%" align="center" >Add</td>
			 <td width="5%" align="center" >Order</td>
			 <td width="15%"  align="center"><strong>Show on Web</strong></td>
			 <td width="5%" align="center" >Edit</td>
			 <td width="5%" align="center" >Delete</td>
		</tr><%
		 do{
		 srno++;
			int totsofprod = 0;     // for checking the products
			int subprods = 0;	// for checking the subproducts
			catid = viewproducts.getIntColumn("Cateid");
			sql1 = "select Cateid,count(cateid) as prods from chkprod group by cateid having cateid=" + catid;
			sql2 = "select cateid,catename,count(cateid) as totsubs from prods group by cateid,catename having cateid=" + catid;
			viewsubs.getCategory(sql2,myCon);
			if(viewsubs.getNextRow())
				{
				subprods = viewsubs.getIntColumn("totsubs");
				}
				viewprodtots.getCategory(sql1,myCon);
			if(viewprodtots.getNextRow())
				{
				totsofprod = viewprodtots.getIntColumn("prods");	
				}%>
	        <tr bgcolor="#F6F7F7" height=25 class="altercell2">
		   <td width="10%"  align="center"><%=srno%></td>
			<%
			if (subprods==0 && totsofprod == 0){  // if both are zero%>
			<td width="30%"  align="center"><%=viewproducts.getStringColumn("CateName")%></td>
			<%}
			if(subprods > 0 && totsofprod > 0){%>
				<td width="28%" align="center" >	 
				<a title="Click to Add Category" href="Addcatsubpro.jsp?categoryid=
				<%=viewproducts.getIntColumn("Cateid")%>&supercatid=
				<%
				if(request.getParameter("supercatid")!=null){
					out.print(request.getParameter("supercatid"));
				}else{
					out.print(viewproducts.getIntColumn("Cateid"));
				}%>
				"><%=viewproducts.getStringColumn("catename")%></a></td>
			<%}
			if (subprods > 0 && totsofprod == 0){%>
				<td width="28%" align="center" >	 
				<a title="Click to  Category"href="Addcatsubpro.jsp?categoryid=
				<%=viewproducts.getIntColumn("Cateid")%>&supercatid=
				<%
				if(request.getParameter("supercatid")!=null){
					out.print(request.getParameter("supercatid"));
				}else{
					out.print(viewproducts.getIntColumn("Cateid"));
				}%>
				"><%=viewproducts.getStringColumn("catename")%></a></td>
			<%}
			if(subprods == 0 && totsofprod > 0){%>
				<td  align="center" width="28%" >
				<a title="Click to  Category" href="Viewproducts.jsp?categoryid=
				<%=viewproducts.getIntColumn("Cateid")%>&supercatid=
				<%
				if(request.getParameter("supercatid")!=null){
					out.print(request.getParameter("supercatid"));
				}else{
					out.print(viewproducts.getIntColumn("Cateid"));
				}%>
				"><%=viewproducts.getStringColumn("CateName")%></a></td>
			<%}%>
<!--****************This is used for counting Total products in Category ************************-->
			<%
			String mysql = null;
			int cnt = viewproducts.getIntColumn("Cateid");
			Vector vcnt = new Vector();	
			vcnt.addElement(new Integer(cnt));
			for(int i=0;i<=vcnt.size()-1;i++){
				mysql = "select Cateid from Category where parentcateid="+vcnt.get(i)+" order by Cateid";
				productcnt.getCategory(mysql,myCon);				
				int k=i;
				while(productcnt.getNextRow()){
					cnt = productcnt.getIntColumn("Cateid");
					vcnt.add(k+1,new Integer(cnt));
					k = k+1;
				}	// end of while						
			}  // end of for 
			String str=",";
			for(int i=0;i<=vcnt.size()-1;i++){	
				str = str+","+vcnt.get(i);
			}
			str = str.substring(2); 

//'==============================Addition of all total products =================(cK)==========================//
			String cnt1 = "";
			int count=0;
			mysql = "select count(*) as tot from product where Cateid IN ("+viewproducts.getIntColumn("Cateid")+")";
			productcnt.getCategory(mysql,myCon);
			if(productcnt.getNextRow()){
				cnt = productcnt.getIntColumn("tot");
			}
			String mysql1="select * from category where parentcateid="+viewproducts.getIntColumn("Cateid")+"";			
				productcnt.getCategory(mysql1,myCon);
			if(productcnt.getNextRow())
			{
				do
				{	
					cnt1=cnt1+productcnt.getIntColumn("Cateid")+",";					
					String mysql2="select * from category where parentcateid="+productcnt.getIntColumn("Cateid")+"";	
					viewsubs.getCategory(mysql2,myCon);
					if(viewsubs.getNextRow())
					{
						do
						{
							cnt1=cnt1+viewsubs.getIntColumn("Cateid")+",";
						}while(viewsubs.getNextRow());				
					}
				}while(productcnt.getNextRow());
			
					int ind = cnt1.lastIndexOf(",");
					cnt1 = cnt1.substring(0,ind);	
					String mainsql = "select count(*) as tot from product where Cateid IN ("+cnt1+")";
					productcnt.getCategory(mainsql,myCon);
					productcnt.getNextRow();
					cnt= cnt+productcnt.getIntColumn("tot");
			}%>
			<td align="center" width="10%" >			
			<%if(cnt > 0)
			{
				%><%=cnt1.valueOf(cnt)%></td>
			<%}else
			 {
				out.print("----");
			 }%>	
<!--************************* End ********************************************-->
			<%
			String payal="";
			String payal2="";
			payal="select cateid from prods where cateid="+catid+"";				
			pyl.getCategory(payal,myCon);
			payal2="select cateid from chkprod where cateid="+catid+"";
			pyl2.getCategory(payal2,myCon);%>
			<td align="center" width="20%" >
			<%if(pyl.getNextRow()){%>
			<a href='Addsub.jsp?catid=<%=viewproducts.getStringColumn("Cateid")%>&name=
			<%=viewproducts.getStringColumn("catename")%>' 
			onclick="NewWindow(this.href,'name','600','200','no','no');return false" title="Click to Add a SubCategory">
			Subcategory</a>
			<%} else if(pyl2.getNextRow()){%> <a title="Click to Add a Product" 
			href='AddProd.jsp?catid=
			<%=viewproducts.getIntColumn("Cateid")%>&
			name=<%=viewproducts.getStringColumn("catename")%>&supercatid=
			<%
			if(request.getParameter("supercatid")!=null){
				out.print(request.getParameter("supercatid"));
			}else{
				out.print(viewproducts.getStringColumn("Cateid"));
			}%>	
				'>Product</a>
			<%}
			else {%>
				<a href='Addsub.jsp?catid=<%=viewproducts.getStringColumn("Cateid")%>&name=
				<%=viewproducts.getStringColumn("catename")%>' onclick="NewWindow(this.href,'name','600','200','no','no');return false" title="Click to Add a SubCategory">
				Subcategory</a>
				/ <a title="Click to Add a Product" 
				href='AddProd.jsp?catid=
				<%=viewproducts.getIntColumn("Cateid")%>&
				name=<%=viewproducts.getStringColumn("catename")%>&supercatid=
				<%
				if(request.getParameter("supercatid")!=null){
					out.print(request.getParameter("supercatid"));
				}else{
					out.print(viewproducts.getStringColumn("Cateid"));
				}%>	
				'>Product</a><%}%>
				</td>
				<td align="center"><input type="text" name="Order<%=viewproducts.getIntColumn("Cateid")%>" size="3" value="<%=viewproducts.getIntColumn("CatOrder")%>">
				<td width="5%" align="center"> 
				<%
			 if (viewproducts.getIntColumn("ShowOnWeb")==0)
				{%>
				<a title=" click to ShowOnWeb Category"href="Addcatsubpro.jsp?dochg=f&catid=<%=viewproducts.getStringColumn("cateid")%><%
					if(request.getParameter("categoryid")!=null && !request.getParameter("categoryid").equals("null"))
						{
						out.print("&categoryid="+request.getParameter("categoryid"));
						}else{
						out.print("&categoryid=0");
						}%>&supercatid=<%=request.getParameter("supercatid")%>"><b><font face="wingdings" size="3" color="#008000">ü</font></b></a></td><%			
			 } else {%>	
				<a href="Addcatsubpro.jsp?dochg=t&catid=<%=viewproducts.getStringColumn("cateid")%><%
				if(request.getParameter("categoryid")!=null && !request.getParameter("categoryid").equals("null") )
						{
						out.print("&categoryid="+request.getParameter("categoryid"));
						}else
						{
						out.print("&categoryid=0");
						}%>&supercatid=<%=request.getParameter("supercatid")%>"><b><font face="Arial" size="3" color="#FF0000">Ø</font></b></a><%	
					}%>
			</td>
			<%
				if(request.getParameter("categoryid") == null || request.getParameter("categoryid").equals("0"))
					{%>
						<td align="center" width="5%" ><a title="Click to Edit" href="EditMain.jsp?catid=<%=viewproducts.getStringColumn("Cateid")%>" onclick="NewWindow(this.href,'name','600','200','yes','yes');return false"><img src="images/post.gif" border="0"></a></td>
			<%}else{%>
					<td align="center" width="5%" ><a title="Click to Edit" href="Editsub.jsp?catid=<%=viewproducts.getStringColumn("Cateid")%>" onclick="NewWindow(this.href,'name','600','200','no','no');return false"><img src="images/post.gif" border="0"></a></td>
			<% } %>
					<td align="center" width="5%" ><a title="Click for delete category"					href="javascript:confirmDelete('Deletemain.jsp?pr=del&cateid=<%=viewproducts.getStringColumn("cateid")%>&categoryid=<%if(request.getParameter("categoryid")!=null && !request.getParameter("categoryid").equals("null") )
					{
					out.print(request.getParameter("categoryid"));
					}else{
					out.print("0");
					}%>&supercatid=<%if(request.getParameter("supercatid")!=null && !request.getParameter("supercatid").equals("null") )
					{
					out.print(request.getParameter("supercatid"));
					}else{
					}%>')"><img src="images/del.gif" border=0></a></td>
			</tr>			
					<%
					ctr++;
					c=1;
				
				}while (viewproducts.getNextRow());
				}catch (Exception e){
		%>
	    <h3>Exception <%=e%></h3>
			<%}%>
			 <%
	}else{%>

		<tr>
			<td align="center" class="text"><b>No Record Found<td>
		<tr>
		<%}%>
	</table>
	</td>
	</tr>
		  <tr>
		  <td>
			   <table width="100%" border="0" cellspacing="1" cellpadding="4">

			   <tr>

			 <td width="27%" align="center" >&nbsp;</td>
			 <td width="10%" align="center" >&nbsp;</td>
			 <td width="15%" align="center" >&nbsp;</td>
			 <td width="5%" align="center" ><input type=hidden name="OrderCnt" value=<%=ctr%> >
						<input type="submit" value="Save" class="button"></td>
			 <td width="15%"  align="center">&nbsp;</td>
			 <td width="5%" align="center" >&nbsp;</td>
			


					
			  </table>
		</td>
	<tr>

	
	<tr >    
    <td width="30%" align="center" >&nbsp;</td>
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

	