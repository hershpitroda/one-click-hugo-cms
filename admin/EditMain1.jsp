<%@ include file="dbconnection.jsp"%>
<% 
	String catid = request.getParameter("catid");
	String maincat = request.getParameter("MainCat");  // storing the parameter
	try
	{
		String sql = null;
		sql = "update category  set CateName = '" + maincat + "' where cateid= '" + catid + "'";  
		//out.println(sql);
		list.add(sql,myCon);
		response.sendRedirect("Close.jsp");
	}catch (Exception e)
	{
	%>Exception <h1><%=e%></h1><%
	}

%>  
