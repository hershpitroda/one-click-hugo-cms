<%@ include file="dbconnection.jsp"%>
<%@ page import="java.io.File"%>
<jsp:useBean id="list1" scope="page" class="bean.Retrieve" />
<%
	String fileName="";
	String para="";
	try
	   {
		out.println(request.getParameter("cateid"));
		int id=Integer.parseInt(request.getParameter("cateid"));
	   	list1.getCategory("select category.cateid, prodid from product,category where category.ParentCateId = "+id+" or product.cateid="+id+"",myCon);
		if(list1.getNextRow())
		{
			list1.cleanup();
			response.sendRedirect("error.jsp?error=<h5>You can not delete this Category.<br>Because This category contain Products.<br>Please Delete All product then after delete Category.</h5>&b=1");

		}
		else
		{
		try{
		String query=" select * from category where cateid='"+request.getParameter("cateid")+"'";
		list.getCategory(query,myCon);
		
		if(list.getNextRow())
		{
			if(list.getStringColumn("cateimage")!=null && !list.getStringColumn("cateimage").equals("null")){
			para=list.getStringColumn("cateimage");
			
			fileName = application.getRealPath("/admin/upload/"+para);
			fileName=fileName.replace('\\','/');

			File f = new File(fileName);
			if (!f.exists())
				throw new IllegalArgumentException("Delete: no such file or directory: " + fileName);
			if (f.isDirectory()) 
				{
					String[] files = f.list();
					if (files.length > 0)
					throw new IllegalArgumentException("Delete: directory not empty: " + fileName);
				}
					boolean success = f.delete();
			if (!success){
					throw new IllegalArgumentException("Delete: deletion failed");
					}
			}
		}
	}catch(Exception Ex){
		out.print("Exception "+Ex);
		}
	finally{
		String sql = "delete from category where cateid='"+request.getParameter("cateid")+"'";
		list.add(sql,myCon);		response.sendRedirect("Addcatsubpro.jsp?categoryid="+request.getParameter("categoryid")+"&supercatid="+request.getParameter("supercatid")+"");
		}
	}
}catch(Exception e)
	{ out.println("Exception" + e); }
%>
<%@ include file="closeconnection.jsp"%>