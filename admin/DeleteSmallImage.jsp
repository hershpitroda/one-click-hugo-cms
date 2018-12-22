<%@ include file="dbconnection.jsp"%>
<%
try
{
	int prodid = Integer.parseInt(request.getParameter("id"));
	String imgset = request.getParameter("img1");
	String imgname= request.getParameter("name1"); 
	String sql = "update product set "+imgset+"='' where prodid="+prodid;
	out.print(sql);
	String fpath = application.getRealPath("/");
	fpath = fpath+"admin/upload/smallimage/"+imgname;
	fpath = fpath.replace('\\','/');
	java.io.File fl = new java.io.File(fpath);
	fl.delete();

	list.add(sql,myCon);
	response.sendRedirect("Editprod.jsp?categoryid="+request.getParameter("catid")+"&prodid="+request.getParameter("id")+"");
}
catch(Exception e)
{
	out.print("exception:"+e);
}
%>