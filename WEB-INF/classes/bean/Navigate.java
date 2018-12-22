package bean;

public class Navigate 
{
    String strRetValue = "";
	public String GetPages(int TotalRecords,int NoofRecordsperpage,int pg,int id) 
	{
		int TotalPage = TotalRecords/NoofRecordsperpage;
		float ftTotalPage = (float) TotalRecords/NoofRecordsperpage;
		if(ftTotalPage > (float) TotalPage)
		{
			TotalPage++;	
		}
		int start = 0;
		int end = 0; 
	
		if(pg>10 && pg%10==1)
		{
			start=pg;
			end = pg+9;
		}
		else
		{
			if(pg>10)
			{
				if(pg%10==0)
					start = (pg-9);
				else
					start = (pg-((pg%10)-1));
				end = start+9;
			}
			else
			{
				start = 1;
				end = 10;
			}
		}
		if(end>TotalPage)
			end = TotalPage;
	
		if(pg>10)
		{
			strRetValue+="<a href=\"javascript: setPage('"+(start-10)+"')\" class=\"asearch\">";
			strRetValue+="["+(start-10) +"-" + (start-1)+"]";
			strRetValue+="</a>";
		}
		strRetValue+="&nbsp;";
		for(int i=start;i<=end;i++)
		{
			if(i==pg)
			{
				strRetValue+="<a class=\"openpage\">"+i+"</a>&nbsp;";
			}
			else
			{
				strRetValue+="<a href=\"Javascript: setPage('"+i+"','"+id+"')\" class=\"asearch\" >"+i+"</a>&nbsp;";
			}	
		}
		strRetValue+="&nbsp;";
		if((end<TotalPage))
		{
			strRetValue+="<a href=\"Javascript: setPage('"+(end+1)+"')\" class=\"asearch\" >";
			if(end+10 <= TotalPage)
				strRetValue+="["+(end+1)  + "-"  + (end+10)+"]";
			else
				strRetValue+="["+(end+1) + "-" + TotalPage+"]";
			strRetValue+="</a>";
		}
		//=====5-5 records code=========

	int sCurPageCnt = 0;	int eCurPageCnt = 0;	int intcurpage = pg;
	String recStr = "";
	if(TotalRecords>0)
	{
		try
		{
			if(intcurpage==1)
				sCurPageCnt = 1;
			else
			{
				if(intcurpage==1)
					sCurPageCnt = ((1-1) * NoofRecordsperpage)+1;
				else
					sCurPageCnt = ((intcurpage-1) * NoofRecordsperpage)+1;
			}
			eCurPageCnt = intcurpage * NoofRecordsperpage;
			if(eCurPageCnt >= TotalRecords)
				eCurPageCnt = TotalRecords;
			recStr = "&nbsp;&nbsp;&nbsp;"+new Integer(sCurPageCnt).toString() +"-"+ new Integer(eCurPageCnt).toString() +" of " + TotalRecords+" Records";
		}
		catch(Exception e){

		}
	}
	//==========
		
		return "Page:"+strRetValue+recStr;
	}
}
