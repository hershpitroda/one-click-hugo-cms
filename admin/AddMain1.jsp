<%@page import="java.util.Random"%>
<%@ include file="dbconnection.jsp"%>
<jsp:useBean id="mySmartUpload" scope="page" class="com.jspsmart.upload.SmartUpload" />
<jsp:useBean id="addmain1" class="bean.Retrieve" scope="page" />
<%	
   try{   
		  int rdm=0;
		  Random obj = new Random();
		  rdm = obj.nextInt(99999);
		mySmartUpload.initialize(pageContext);
		mySmartUpload.upload();
		String filename = "";
		String fpath = "";
		int ind = 0;
		String ss="";
		String s1="";
		String s2 = "";
		fpath = application.getRealPath(request.getServletPath());
		fpath = fpath.replace('\\','/');
		ind = fpath.lastIndexOf('/');
		fpath = fpath.substring(0,ind);		

		for(int i=0;i<mySmartUpload.getFiles().getCount();i++){
		com.jspsmart.upload.File myFile = mySmartUpload.getFiles().getFile(i);
		ss = myFile.getFieldName();
		if(!ss.equals(""))
		{
			if(ss.equals("blfile"))
			{
				mySmartUpload.setAllowedFilesList("gif,jpg,bmp");
				if(!myFile.getFileName().equals(""))
				{
					fpath = fpath.substring(0,ind)+"/upload/";
					myFile.saveAs(fpath + rdm + "_"+ myFile.getFileName().replaceAll(" ",""));
					s1 = rdm+"_"+myFile.getFileName().replaceAll(" ","");					
				}
			}	
			if(ss.equals("pdf"))
			{
				mySmartUpload.setAllowedFilesList("pdf,doc,txt,xls");
				if(!myFile.getFileName().equals(""))
				{
					fpath = fpath.substring(0,ind)+"/upload/pdf/";
					myFile.saveAs(fpath + rdm + "_"+ myFile.getFileName().replaceAll(" ",""));
					s2 = rdm+"_"+myFile.getFileName().replaceAll(" ","");					
				}
			}

			}
		}

		String Cat[] = mySmartUpload.getRequest().getParameterValues("MainCategory");
		String sql = null;
		String ordersql="";
		int incrorder=0;
		ordersql="select max(CatOrder) as maxid  from Category";
		list.getCategory(ordersql,myCon);
		if(list.getNextRow()){
				if(list.getStringColumn("maxid")!=null && !list.getStringColumn("maxid").equals(""))
				{
					incrorder=list.getIntColumn("maxid")+1;
				}
		}
		sql = "insert into Category (CateName,CateImage,shortdesc,ParentCateId,showonweb,CatOrder)  values('"+Cat[0]+"','"+s1+"','"+s2+"',0,0,"+incrorder+")"; 
		out.print(sql);
		list.add(sql,myCon);
	   response.sendRedirect("Close.jsp");
    }
   catch (Exception ex)
  {
	out.print("[]");
	out.print("Error in AddMain1.jsp :"+ex);
  }  
%>  
	<%@ include file="closeconnection.jsp"%>