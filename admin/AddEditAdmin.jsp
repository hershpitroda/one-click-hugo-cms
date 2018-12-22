<%@include file="dbconnection.jsp"%>
<%@include file="global.jsp"%>
<%@ include file="checklogin.jsp"%>
<jsp:useBean id="list1" scope="page" class="bean.Retrieve"/>
	<%
	if(request.getParameter("pr")!=null && request.getParameter("pr").equals("add"))
		{
			try
			{
				String addsql = "insert into administrators(FirstName,LastName,UserName,Password) values('"+request.getParameter("FirstName")+"','"+request.getParameter("LastName")+"','"+request.getParameter("UserName")+"','"+request.getParameter("Password")+"')";
				list.add(addsql,myCon);
				response.sendRedirect("ListAdmin.jsp?post=a");
			}
			catch(Exception e)
			{out.print(e);}
		}	
	else if(request.getParameter("pr")!=null && request.getParameter("pr").equals("edit"))
		{
			try
			{
				String sql = "update administrators set FirstName='"+request.getParameter("FirstName")+"',LastName='"+request.getParameter("LastName")+"',UserName='"+request.getParameter("UserName")+"',Password='"+request.getParameter("Password")+"' where UserId="+request.getParameter("Id")+"";
				out.print(sql);
				list.add(sql,myCon);
				response.sendRedirect("ListAdmin.jsp?post=u");
			}
			catch(Exception e)
			{out.print(e);
				e.getMessage();
			}
		}
	%>