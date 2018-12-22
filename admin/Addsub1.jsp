<%@page import="java.util.Random"%>
<%@ include file="dbconnection.jsp"%>
<jsp:useBean id="mySmartUpload" scope="page" class="com.jspsmart.upload.SmartUpload" />
<jsp:useBean id="validationbean" scope="page" class="bean.Validation" />
<jsp:useBean id="addsub1" class="bean.Retrieve" scope="page" />
<%       
   try{      
	int rdm=0;
	String ss="";
	String s1="";
	String s2 = "";		
	String fpath = "";
	int ind = 0;
	Random obj = new Random();
	rdm = obj.nextInt(99999);
		mySmartUpload.initialize(pageContext);
		mySmartUpload.upload();		
		fpath = application.getRealPath(request.getServletPath());
		fpath = fpath.replace('\\','/');
		ind = fpath.lastIndexOf('/');
		fpath = fpath.substring(0,ind);

		for(int i=0;i<mySmartUpload.getFiles().getCount();i++){
		com.jspsmart.upload.File myFile = mySmartUpload.getFiles().getFile(i);
		ss = myFile.getFieldName();
		if(!ss.equals("")){
			if(ss.equals("blfile")){
				mySmartUpload.setAllowedFilesList("gif,jpg,bmp");
				if(!myFile.getFileName().equals("")){
					fpath = fpath +"/upload/";
					myFile.saveAs(fpath + rdm + "_"+ myFile.getFileName().replaceAll(" ",""));
					s1 = rdm+"_"+myFile.getFileName().replaceAll(" ","");				
				}
			}
			}
		}
		String sql = null;
		String Catid[] = mySmartUpload.getRequest().getParameterValues("catid");
		String Catname[] = mySmartUpload.getRequest().getParameterValues("MainCat");

		sql = "insert into category  (CateName,CateImage,ParentCateId,showonweb) values ('" + Catname[0] + "','" +s1 + "','" + Catid[0] + "',0)";   
		String mysql="update category set flag=1 where cateid="+Catid[0]+"";
		out.println(sql);
		list.add(mysql,myCon);
		addsub1.add(sql,myCon);
		response.sendRedirect("Close.jsp");
    }catch (Exception e){%>
	Exception <h1><%=e%></h1>
<%}%>  

