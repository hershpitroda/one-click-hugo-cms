<%@page import="java.util.Random"%>
<%@ include file="dbconnection.jsp"%>
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
		fpath = fpath.substring(0,x)+"/upload/";
		mySmartUpload.initialize(pageContext);
		mySmartUpload.upload();
		try
		{
			String val[];
			String ids = "";
			val = mySmartUpload.getRequest().getParameterValues("catid");
				for(int i=0;i<=val.length-1;i++)
					{
						ids = ids + val[i];
					}
			pid = Integer.parseInt(ids);
			out.print(fpath);
			ids = "";
			//out.print(pid);
		}
		catch(Exception ex)
		{
			out.print("Error in Addproduct2 second try :"+ex);
		}
		for (int i=0;i<mySmartUpload.getFiles().getCount();i++)
			{
				com.jspsmart.upload.File myFile = mySmartUpload.getFiles().getFile(i);
				fldname = myFile.getFieldName();		
				myFile.saveAs(fpath + rdm + "_"+ myFile.getFileName().replaceAll(" ",""));
				fname = rdm+"_"+myFile.getFileName().replaceAll(" ","");
			}
		String sql = "update category set cateimage='"+fname+"' where cateid="+ pid;
	out.print(sql);

			try
			{
				list.add(sql,myCon);
				response.sendRedirect("EditMain.jsp?catid="+pid+"");	
			}
			catch(Exception ex)
			{
				out.print("Error in Uploadfile1 : "+ex);
			}
	%>