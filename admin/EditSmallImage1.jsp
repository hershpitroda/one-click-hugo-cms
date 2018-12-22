<%@ include file="dbconnection.jsp"%>
<%@page import="java.util.Random"%>
<jsp:useBean id="list1" scope="page" class="bean.Retrieve"/>
<%@ page language="java" import="com.jspsmart.upload.*"%>
<jsp:useBean id="mySmartUpload" scope="page" class="com.jspsmart.upload.SmartUpload" />
<%
	int rdm=0;
	Random obj = new Random();
	rdm = obj.nextInt(99999);
	String fpath = application.getRealPath(request.getServletPath());
	String fname = null;
	String fldname = null;
	String oldfname = null;
	int pid = 0;
	fpath = fpath.replace('\\','/');
	int x = fpath.lastIndexOf('/');
	fpath = fpath.substring(0,x)+"/upload/smallimage/";
	mySmartUpload.initialize(pageContext);
	mySmartUpload.upload();

	for (int i=0;i<mySmartUpload.getFiles().getCount();i++)
	{
		com.jspsmart.upload.File myFile = mySmartUpload.getFiles().getFile(i);
		fldname = myFile.getFieldName();
		fname = rdm+"_"+myFile.getFileName();
		myFile.saveAs(fpath + rdm + "_"+ myFile.getFileName());
	}

	String val[] = mySmartUpload.getRequest().getParameterValues("id");

	String strchkimg = "select * from product where prodId="+val[0]+"";
	list1.getCategory(strchkimg,myCon);
	if(list1.getNextRow())
	{
		if(list1.getStringColumn("smallimage")!=null && !list1.getStringColumn("smallimage").equals("null"))
		{
			String delfpath = application.getRealPath("/");
			delfpath = delfpath+"admin/upload/smallimage/"+list1.getStringColumn("smallimage");
			delfpath = delfpath.replace('\\','/');
			java.io.File fl = new java.io.File(delfpath);
			fl.delete();
		}
	}
	
	String sql = "update product set smallimage='"+fname+"' where prodId="+ val[0];
	list.add(sql,myCon);
	response.sendRedirect("Close.jsp");
%>