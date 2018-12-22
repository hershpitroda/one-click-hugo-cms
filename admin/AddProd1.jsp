<%@page import="java.util.Random"%>
<%@ include file="../jsp/dbconnection.jsp"%>

<jsp:useBean id="list1" scope="page" class="bean.Retrieve"/>
<jsp:useBean id="list2" scope="page" class="bean.Retrieve"/>
<jsp:useBean id="mySmartUpload" scope="page" class="com.jspsmart.upload.SmartUpload" />
<%
int x = 0;
String s1 = "";
String s2 = "";
String ss = "";
String sql = "";
String sql2="";
String sql3="";
int rdm=0;
Random obj = new Random();
rdm = obj.nextInt(99999);

try
{
	mySmartUpload.initialize(pageContext);
	mySmartUpload.upload();
	String fpath = application.getRealPath(request.getServletPath());
	fpath = fpath.replace('\\','/');
	int ind = fpath.lastIndexOf('/');
	fpath = fpath.substring(0,ind);
	fpath = fpath.substring(0,ind)+"/upload/";	
	String val[] = mySmartUpload.getRequest().getParameterValues("name");
	String cid[] = mySmartUpload.getRequest().getParameterValues("categoryid");
	String themessage[] = mySmartUpload.getRequest().getParameterValues("elm");			
	String count = mySmartUpload.getRequest().getParameterValues("countFile")[0];
	int intcount=Integer.parseInt(count);
	sql = "insert into Product (Cateid,prodname,prodlongdesc,showonweb) values("+cid[0]+",'"+val[0]+"','"+themessage[0]+"',0)";
	

	list1.add(sql,myCon);
	sql2="select max(prodid) as maxid from Product";
	list.getCategory(sql2,myCon);
	if(list.getNextRow())
	{
		String photoId=list.getStringColumn("maxid");
		//------------------------stsrt--------------------------------------------------------	
	for(int i=0;i<intcount;i++)
		{
			com.jspsmart.upload.File myFile = mySmartUpload.getFiles().getFile(i);
			ss = myFile.getFieldName();

			if(!ss.equals(""))
				{				
				
				out.print(ss);
					if(ss.equals("smallimage"))
						{
							mySmartUpload.setAllowedFilesList("pdf,txt");					
							if(!myFile.getFileName().equals(""))
								{
									fpath = fpath.substring(0,ind)+"/upload/smallimage/";	
									myFile.saveAs(fpath + rdm + "_"+ myFile.getFileName().replaceAll(" ",""));								
									s1 = rdm+"_"+myFile.getFileName();
									out.print("<br>");
									sql3=" update product set smallimage='"+s1+"' where prodid="+photoId+"";
									/*
									sql3=" insert into ProductImage (prodId,smallimage,CreatedDate,Deleteflag) values("+photoId+",'"+s1+"',getDate(),0)";	*/
									out.print("this is for small image"+sql3);
									out.print("<br>");
									list2.add(sql3,myCon);
								}
						}else if(ss.equals("bigimage")){
							fpath = fpath.substring(0,ind)+"/upload/bigimage/";	
							  myFile.saveAs(fpath + rdm + "_"+ myFile.getFileName().replaceAll(" ",""));								
							  s2 = rdm+"_"+myFile.getFileName();
							  out.print("<br>");
							  sql3="update product set bigimage='"+s2+"' where prodid="+photoId+"";
							  /*
							  sql3=" insert into ProductImage (prodId,smallimage,CreatedDate,Deleteflag) values("+photoId+",'"+s1+"',getDate(),0)";*/	
							  out.print("this is for big image "+sql3);
							  out.print("<br>");
							  list2.add(sql3,myCon);
						
						}
						else{
						mySmartUpload.setAllowedFilesList("gif,jpg,JPG,bmp");			
							if(!myFile.getFileName().equals("")){
							    fpath = fpath.substring(0,ind)+"/upload/moreimage/";	
							    myFile.saveAs(fpath + rdm + "_"+ myFile.getFileName().replaceAll(" ",""));				
							    s1 = rdm+"_"+myFile.getFileName();
							    sql3=" insert into ProductImage (prodId,Bigimage,CreatedDate,Deleteflag) values("+photoId+",'"+s1+"',getDate(),0)";	
							    out.print("this is for Extra IMAGES"+sql3);
							    list2.add(sql3,myCon);
							}
						}
					}			
				}
		//------------------------end--------------------------------------------------
			}
					response.sendRedirect("Addcatsubpro.jsp?post=a");
}
catch(Exception e)
{
	out.print(e);
}
%>
<%@ include file="closeconnection.jsp"%>