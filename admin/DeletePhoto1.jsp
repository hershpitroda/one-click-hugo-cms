<%@ include file="dbconnection.jsp"%>

<%
	Object obj=null;
	java.io.File fl=null;
 	String mainid = request.getParameter("mainid");
	int Id = Integer.parseInt(request.getParameter("id"));

	
	//String imgset = request.getParameter("img1");
try
{	
	if(request.getParameter("pr")!=null && !request.getParameter("pr").equals("") && request.getParameter("pr").equals("del")){
	String query=" select * from product where id="+Id+"";
	list.getCategory(query,myCon);
	if(list.getNextRow()){
	 if(list.getStringColumn("bigimage")!=null && !list.getStringColumn("bigimage").equals("") && !list.getStringColumn("image").equals("null")){
	String fpath = application.getRealPath("/");
	String imgname= list.getStringColumn("bigimage");
	fpath = fpath+"/admin/upload/moreimage/"+imgname;
	fpath = fpath.replace('\\','/');
	 fl = new java.io.File(fpath);
	if (!fl.exists())
		throw new IllegalArgumentException("Delete: no such file or directory: " + obj);

		if (fl.isDirectory()) {
		String[] files = fl.list();
		if (files.length > 0)
		throw new IllegalArgumentException(
		"Delete: directory not empty: " +obj);
		}
		boolean success1 = fl.delete();

		if (!success1){
		throw new IllegalArgumentException("Delete: deletion failed");
		}
	}
	}
	String sql = "update  ProductImage set bigimage='' where id="+Id+"";
	out.print(sql);
	list.add(sql,myCon);
	response.sendRedirect("Editprod.jsp?categoryid="+mainid+"&prodid="+request.getParameter("prodid")+"&name="+request.getParameter("image")+"");

	}
}
catch(Exception e)
{
	out.print("exception:"+e);
}
finally{
		String query=" select * from ProductImage where id="+Id+"";
		list.getCategory(query,myCon);
		if(list.getNextRow()){
		if(list.getStringColumn("bigimage")!=null && !list.getStringColumn("bigimage").equals("")){
		String sql = "update  ProductImage set bigimage='' where id="+Id+"";
		out.print(sql);
		list.add(sql,myCon);
response.sendRedirect("Editprod.jsp?categoryid="+mainid+"&prodid="+request.getParameter("prodid")+"&name="+request.getParameter("image")+"");
		}

	}
}
%>