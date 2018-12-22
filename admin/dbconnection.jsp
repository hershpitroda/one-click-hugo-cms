<%
response.setHeader( "Pragma", "No-cache" );
response.setDateHeader( "Expires", 0 );
response.setHeader( "Cache-Control", "no-cache" );
%>
<jsp:useBean id="GetConn" scope="request" class="bean.DBConnect" />
<jsp:useBean id="list" scope="request" class="bean.Retrieve" />
<jsp:useBean id="Combo" scope="request" class="bean.SmartCombo" />
<jsp:useBean id="Pagging" scope="request" class="bean.Navigate" />
<%@ page import="java.sql.*"%>
<%
	java.sql.Connection myCon = null;
	try
	{
		myCon = GetConn.getConn("");
	}
	catch(Exception e)
	{
		out.print(e);
	}

	
%>