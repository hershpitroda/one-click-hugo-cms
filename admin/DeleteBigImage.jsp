<%@ include file="dbconnection.jsp"%>
<%
try
{
    int prodid = Integer.parseInt(request.getParameter("id"));
    String cats=	request.getParameter("catid");
    String imgset = request.getParameter("img2");
    String imgname= request.getParameter("name2"); 
    String sql = "update product set "+imgset+"='' where prodid="+prodid;
    out.print(sql);
    String fpath = application.getRealPath("/");
    fpath = fpath+"admin/upload/bigimage/"+imgname;
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