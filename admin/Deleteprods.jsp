<%@ include file="dbconnection.jsp"%>
<%@ page import="java.io.File"%>
<%	
  String str = null;
  String arr[] = request.getParameterValues("delproducts");
  String supid=request.getParameter("supercatid");
  String  delsql="";
  String  delsql2="";
  String fileName="";
  String para="";
  int catid=0;
   try
   {
	 catid= Integer.parseInt(request.getParameter("categoryid"));
	String sql = request.getParameter("Submit");
	if(sql.equals("Delete"))
	{
		

		if(arr.length > 1)
		{
			str = arr[0];
			for(int i=1;i<=arr.length-1;i++)
			{
				str = str + "," +arr[i];
			}
		}
		else
		{
			str = arr[0];
		}
		if(str!=null)
		{
		//-------------------------File delete code start (NILESH)-------------------------
		try{		
			delsql="select * from product where prodid in ("+str+")";
			out.print(delsql);
			list.getCategory(delsql,myCon);
			if(list.getNextRow())
			{
				do{
					if(list.getStringColumn("smallimage")!=null && !list.getStringColumn("smallimage").equals("null")){
					para=list.getStringColumn("smallimage");
					fileName = application.getRealPath("admin/upload/smallimage/"+para);
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
						}else{
							//out.print("smallimage deleted successfully");
						}
					}
					if(list.getStringColumn("bigimage")!=null && !list.getStringColumn("bigimage").equals("null")){
					para=list.getStringColumn("bigimage");

					fileName = application.getRealPath("/admin/upload/bigimage/"+para);
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
						else{
							//out.print("bigimage deleted successfully");
						}
					}

				}while(list.getNextRow());
				delsql2="delete from product where prodid in ("+str+")";
				list.add(delsql2,myCon);
			}
		}catch(Exception Ex){
		out.print("Exception<br>"+Ex);
		}
		//-------------------------File delete code end---------------------------------
		}
	}	
  } 
  catch (Exception ex)
  {
  	out.print("Error in Deleteprods.jsp :"+ex);
  }
	finally{		
		try{
			delsql = "select * from product where prodid in ("+str+")";
			list.getCategory(delsql,myCon);
			if(list.getNextRow())
				{
					
					delsql2="delete from Product where prodid in ("+str+")";
					list.add(delsql2,myCon);
				}	
			response.sendRedirect("Viewproducts.jsp?categoryid="+catid+"&supercatid="+supid+"&post=y&pg="+request.getParameter("pg")+"");
		}catch(Exception e)
		{
		out.print("exception:"+e);
		}	
	}%>  
