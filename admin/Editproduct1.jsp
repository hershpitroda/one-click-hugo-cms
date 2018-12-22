<%@page import="java.util.Random"%>
<%@ include file="../jsp/dbconnection.jsp"%>
<%@ include file="checklogin.jsp"%>
<jsp:useBean id="insertdata" scope="page" class="bean.Retrieve" />
<jsp:useBean id="list2" scope="page" class="bean.Retrieve" />
<jsp:useBean id="mySmartUpload" scope="page" class="com.jspsmart.upload.SmartUpload" />
<%
    int x = 0;
    String s1 = "";
    String s2 = "";
    String s3 = "";
    String ss = "";
    String sql = "";
    String sql3="";

    int rdm=0;
    Random obj = new Random();
    rdm = obj.nextInt(99999);
	try{
	   mySmartUpload.initialize(pageContext);
	   mySmartUpload.upload();
	   String fpath = application.getRealPath(request.getServletPath());
	   fpath = fpath.replace('\\','/');
	   int ind = fpath.lastIndexOf('/');
	   fpath = fpath.substring(0,ind);
	   fpath = fpath.substring(0,ind)+"/upload/smallimage/";
	   String pid[] = mySmartUpload.getRequest().getParameterValues("prodid");

		for(int i=0;i<mySmartUpload.getFiles().getCount();i++){
			com.jspsmart.upload.File myFile = mySmartUpload.getFiles().getFile(i);
			ss = myFile.getFieldName();
			if(!ss.equals(""))
				{
				if(ss.equals("smallimage"))
					{
						mySmartUpload.setAllowedFilesList("gif,jpg,bmp");
						if(!myFile.getFileName().equals(""))
						{
							myFile.saveAs(fpath + rdm + "_"+ myFile.getFileName());
							s1 = rdm+"_"+myFile.getFileName();
						}
					}
				else if(ss.equals("bigimage"))
					{
						mySmartUpload.setAllowedFilesList("gif,jpg,bmp");
						fpath = fpath.substring(0,ind)+"/upload/bigimage/";
						if(!myFile.getFileName().equals(""))
						{
							myFile.saveAs(fpath + rdm + "_"+ myFile.getFileName());
							s2 = rdm+"_"+myFile.getFileName();
						}
					}else{

						mySmartUpload.setAllowedFilesList("gif,jpg,bmp");
						fpath = fpath.substring(0,ind)+"/upload/moreimage/";
						if(!myFile.getFileName().equals(""))
						{
							myFile.saveAs(fpath + rdm + "_"+ myFile.getFileName());
							s3 = rdm+"_"+myFile.getFileName();
							sql3="insert into ProductImage (prodId,Bigimage,CreatedDate,Deleteflag) values("+pid[0]+",'"+s3+"',getDate(),0)";	
							out.print("this is for Extra IMAGES"+sql3);
							list2.add(sql3,myCon);
						}
					
					
					}
				}
			}
	
			String val[] = mySmartUpload.getRequest().getParameterValues("name");
			 String sup[] = mySmartUpload.getRequest().getParameterValues("superid");

			 String cid[] = mySmartUpload.getRequest().getParameterValues("categoryid");
			 String sid[] = mySmartUpload.getRequest().getParameterValues("subcatid");
			 String themessage[] = mySmartUpload.getRequest().getParameterValues("elm");

			sql="update Product set prodname='"+val[0]+"',prodlongdesc='"+themessage[0]+"'";
			if(s1!=null && s1!=""){
				sql= sql+",smallimage='"+s1+"'";
				}
			if(s2!=null && s2!=""){
				sql= sql+",bigimage='"+s2+"'";
				}
				sql= sql+"where prodid="+pid[0]+"";			
				insertdata.add(sql,myCon);
				response.sendRedirect("Viewproducts.jsp?categoryid="+cid[0]+"&supercatid="+sup[0]+"");
				out.print(sql);
				//list.add(sql,myCon);				
				//response.sendRedirect("Addcatsubpro.jsp?post=a");
}
catch(Exception e)
{
out.print(e);
}
%>
<%@ include file="closeconnection.jsp"%>