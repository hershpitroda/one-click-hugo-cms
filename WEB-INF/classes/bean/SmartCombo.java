package bean;

import java.sql.*;
import bean.*;
import java.text.*;
import java.io.*;
public class SmartCombo
{
	int i=0;
	Retrieve selbean = new Retrieve();
	String sql;
	String res;
	String tab;
	String col1;
	String col2;
	public SmartCombo()
    {
        try	 
		{
			sql = null;
			res = null;
			tab = null;
			col1 =null;
			col2= null;
		}catch(Exception e){
			System.out.println(e.toString());
		}
    }
	public String getCountry(String s,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + s + " class=dropdown ><option value='0'>--Select--</option>";
		selbean.getCategory("select * from country",myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value=" + selbean.getIntColumn("Countryid") + ">" + selbean.getStringColumn("Countryname") + "</option>";
		}
		res = res + "<option Value='0'>Other</option>";
		res = res + "</select>";
		return res;
	}
	public String getState(String s,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + s + " class=dropdown ><option value='0'>--Select--</option>";
		selbean.getCategory("select * from state",myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value=" + selbean.getIntColumn("Stateid") + ">" + selbean.getStringColumn("Statename") + "</option>";
		}
		res = res + "<option Value='0'>Other</option>";
		res = res + "</select>";
		return res;
	}	
	public String getCity(String s,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + s + " class=dropdown > <option value='0'>--Select--</option>";
		selbean.getCategory("select * from city",myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value=" + selbean.getIntColumn("Cityid") + ">" + selbean.getStringColumn("Cityname") + "</option>";
		}
		res = res + "<option Value='0'>Other</option>";
		res = res + "</select>";
		return res;
	}
	public String getCombo(String sql,String comboName,String optValue,String optText,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + comboName + " class=dropdown > <option value='0'>--Select--</option>";
		selbean.getCategory(sql,myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value=" + selbean.getIntColumn(optValue) + ">" + selbean.getStringColumn(optText) + "</option>";
		}
		res = res + "</select>";
		return res;
	}
	public String getStringValueCombo(String sql,String comboName,String optValue,String optText,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + comboName + " class=dropdown > <option value='0'>--Select--</option>";
		selbean.getCategory(sql,myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value=" + selbean.getStringColumn(optValue) + ">" + selbean.getStringColumn(optText) + "</option>";
		}
		res = res + "</select>";
		return res;
	}
	public String getComboWithFunction(String sql,String comboName,String optValue,String optText,String FunName,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + comboName + " class=dropdown onchange="+FunName+"> <option value='0'>--Select--</option>";
		selbean.getCategory(sql,myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value=" + selbean.getIntColumn(optValue) + ">" + selbean.getStringColumn(optText) + "</option>";
		}
		res = res + "</select>";
		return res;
	}
	public String getComboWithFunction1(String sql,String comboName,String optValue,String optText,String FunName,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + comboName + " class=dropdown onchange="+FunName+">";
		selbean.getCategory(sql,myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value=" + selbean.getIntColumn(optValue) + ">" + selbean.getStringColumn(optText) + "</option>";
		}
		res = res + "</select>";
		return res;
	}
	public String getCombo1(String sql,String comboName,String optValue,String optText,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + comboName + " class=dropdown > <option value='0'>--Select--</option>";
		selbean.getCategory(sql,myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value=" + selbean.getIntColumn(optValue) + ">" + selbean.getStringColumn(optText) + "</option>";
		}
		res = res + "</select>";
		return res;
	}
	public String getComboFirstBlank(String sql,String comboName,String optValue,String optText,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + comboName + " class=dropdown > <option value=''>--Select--</option>";
		selbean.getCategory(sql,myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value=" + selbean.getIntColumn(optValue) + ">" + selbean.getStringColumn(optText) + "</option>";
		}
		res = res + "</select>";
		return res;
	}
	public String getSelectNameCombo(String Select,String sql,String comboName,String optValue,int optSelectValue,String optText,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + comboName + " class=dropdown > <option value='0'>"+Select+"</option>";
		selbean.getCategory(sql,myCon);
		while(selbean.getNextRow())
		{
			if(optSelectValue == selbean.getIntColumn(optValue))
			{
				res = res + "<option value=" + 	selbean.getIntColumn(optValue) + " selected>" + selbean.getStringColumn(optText) + "</option>";
			}
			else
			{
				res = res + "<option value=" + 	selbean.getIntColumn(optValue) + ">" + selbean.getStringColumn(optText) + "</option>";
			}
		}
		res = res + "</select>";
		return res;
	}
	public String getSelectNameComboWithFunction(String Select,String sql,String comboName,String optValue,int optSelectValue,String optText,String functionName,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + comboName + " class=dropdown onchange=" + functionName + "> <option value='0'>"+Select+"</option>";
		selbean.getCategory(sql,myCon);
		while(selbean.getNextRow())
		{
			if(optSelectValue == selbean.getIntColumn(optValue))
			{
				res = res + "<option value=" + 	selbean.getIntColumn(optValue) + " selected>" + selbean.getStringColumn(optText) + "</option>";
			}
			else
			{
				res = res + "<option value=" + 	selbean.getIntColumn(optValue) + ">" + selbean.getStringColumn(optText) + "</option>";
			}
		}
		res = res + "</select>";
		return res;
	}

	public String getEdtCombo(String objName,String strIdColName,int strPageDbId,String strTextColName,String strQuery,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + objName + " class=dropdown><option value='0'>--Select--</option>";
		selbean.getCategory(strQuery,myCon);
		while(selbean.getNextRow())
		{
			if(strPageDbId == selbean.getIntColumn(strIdColName))
			{
				res = res + "<option value=" + selbean.getIntColumn(strIdColName) + " selected>" + selbean.getStringColumn(strTextColName) + "</option>";
			}
			else
			{
				res = res + "<option value=" + selbean.getIntColumn(strIdColName) + ">" + selbean.getStringColumn(strTextColName) + "</option>";
			}
		}
		res = res + "</select>";
		return res;
	}
	public String getEdtComboWithFunction(String objName,String strIdColName,int strPageDbId,String strTextColName,String strQuery,String FunName,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + objName + " class=dropdown onchange="+FunName+"><option value='0'>--Select--</option>";
		selbean.getCategory(strQuery,myCon);
		while(selbean.getNextRow())
		{
			if(strPageDbId == selbean.getIntColumn(strIdColName))
			{
				res = res + "<option value=" + selbean.getIntColumn(strIdColName) + " selected>" + selbean.getStringColumn(strTextColName) + "</option>";
			}
			else
			{
				res = res + "<option value=" + selbean.getIntColumn(strIdColName) + ">" + selbean.getStringColumn(strTextColName) + "</option>";
			}
		}
		res = res + "</select>";
		return res;
	}
	public String getEdtComboWithFunction1(String objName,String strIdColName,int strPageDbId,String strTextColName,String strQuery,String FunName,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + objName + " class=dropdown onchange="+FunName+">";
		selbean.getCategory(strQuery,myCon);
		while(selbean.getNextRow())
		{
			if(strPageDbId == selbean.getIntColumn(strIdColName))
			{
				res = res + "<option value=" + selbean.getIntColumn(strIdColName) + " selected>" + selbean.getStringColumn(strTextColName) + "</option>";
			}
			else
			{
				res = res + "<option value=" + selbean.getIntColumn(strIdColName) + ">" + selbean.getStringColumn(strTextColName) + "</option>";
			}
		}
		res = res + "</select>";
		return res;
	}
	public String getEdtComboSelect(String objName,String strIdColName,int strPageDbId,String strTextColName,String strQuery,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + objName + " class=dropdown><option value=''>--Select--</option>";
		selbean.getCategory(strQuery,myCon);
		while(selbean.getNextRow())
		{
			if(strPageDbId == selbean.getIntColumn(strIdColName))
			{
				res = res + "<option value=" + selbean.getIntColumn(strIdColName) + " selected>" + selbean.getStringColumn(strTextColName) + "</option>";
			}
			else
			{
				res = res + "<option value=" + selbean.getIntColumn(strIdColName) + ">" + selbean.getStringColumn(strTextColName) + "</option>";
			}
		}
		res = res + "</select>";
		return res;
	}
	public String getEdtCombo1(String objName,String strIdColName,int strPageDbId,String strTextColName,String strQuery,java.sql.Connection myCon) throws Exception
	{
		res = "<select name=" + objName + " class=dropdown>";
		selbean.getCategory(strQuery,myCon);
		while(selbean.getNextRow())
		{
			if(strPageDbId == selbean.getIntColumn(strIdColName))
			{
				res = res + "<option value=" + selbean.getIntColumn(strIdColName) + " selected>" + selbean.getStringColumn(strTextColName) + "</option>";
			}
			else
			{
				res = res + "<option value=" + selbean.getIntColumn(strIdColName) + ">" + selbean.getStringColumn(strTextColName) + "</option>";
			}
		}
		res = res + "</select>";
		return res;
	}

	public String getEdtMultiCombo(String objName,String strIdColName,String strPageDbId,String strTextColName,String strQuery,java.sql.Connection myCon) throws Exception
	{
		String strDbIds[] = strPageDbId.split(",");
		res = "<select name=" + objName + " multiple class=dropdown>";
		selbean.getCategory(strQuery,myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value='" + selbean.getIntColumn(strIdColName) +"'";  
			if(strDbIds!=null)
			{
				int iSelected = 0;
				for(int i=0;i<strDbIds.length;i++)
				{
					if(strDbIds[i].equalsIgnoreCase(selbean.getStringColumn(strIdColName)))
						iSelected = 1;
				}
				if(iSelected == 1)
					res = res + " selected";
			}
			res = res + ">"+ selbean.getStringColumn(strTextColName) + "</option>";
		}
		res = res + "</select>";
		return res;
	}
	public String getEdtMultiComboWithSize(String objName,String strIdColName,String strPageDbId,String strTextColName,int Size,String strQuery,java.sql.Connection myCon) throws Exception
	{
		String strDbIds[] = strPageDbId.split(",");
		res = "<select name=" + objName + " multiple size="+Size+" class=dropdown>";
		selbean.getCategory(strQuery,myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value='" + selbean.getIntColumn(strIdColName) +"'";  
			if(strDbIds!=null)
			{
				int iSelected = 0;
				for(int i=0;i<strDbIds.length;i++)
				{
					if(strDbIds[i].equalsIgnoreCase(selbean.getStringColumn(strIdColName)))
						iSelected = 1;
				}
				if(iSelected == 1)
					res = res + " selected";
			}
			res = res + ">"+ selbean.getStringColumn(strTextColName) + "</option>";
		}
		res = res + "</select>";
		return res;
	}
	public String getEdtMultiComboFunName(String objName,String strIdColName,String strPageDbId,String strTextColName,String FunName,String strQuery,java.sql.Connection myCon) throws Exception
	{
		String strDbIds[] = strPageDbId.split(",");
		res = "<select name=" + objName + " multiple onchange='javascript:"+FunName+";' class=dropdown>";
		selbean.getCategory(strQuery,myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value='" + selbean.getIntColumn(strIdColName) +"'";  
			if(strDbIds!=null)
			{
				int iSelected = 0;
				for(int i=0;i<strDbIds.length;i++)
				{
					if(strDbIds[i].equalsIgnoreCase(selbean.getStringColumn(strIdColName)))
						iSelected = 1;
				}
				if(iSelected == 1)
					res = res + " selected";
			}
			res = res + ">"+ selbean.getStringColumn(strTextColName) + "</option>";
		}
		res = res + "</select>";
		return res;
	}
	public String getEdtMultiCombo1(String objName,String strIdColName,String strPageDbId,String strTextColName1,String strTextColName2,String strQuery,java.sql.Connection myCon) throws Exception
	{
		String strDbIds[] = strPageDbId.split(",");
		res = "<select name=" + objName + " multiple class=dropdown>";
		selbean.getCategory(strQuery,myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value='" + selbean.getIntColumn(strIdColName) +"'";  
			if(strDbIds!=null)
			{
				int iSelected = 0;
				for(int i=0;i<strDbIds.length;i++)
				{
					if(strDbIds[i].equalsIgnoreCase(selbean.getStringColumn(strIdColName)))
						iSelected = 1;
				}
				if(iSelected == 1)
					res = res + " selected";
			}
			res = res + ">"+ selbean.getStringColumn(strTextColName1)+" "+selbean.getStringColumn(strTextColName2) + "</option>";
		}
		res = res + "</select>";
		return res;
	}
	public String getEdtMultiCombo1WithSize(String objName,String strIdColName,String strPageDbId,String strTextColName1,String strTextColName2,int size,String strQuery,java.sql.Connection myCon) throws Exception
	{
		String strDbIds[] = strPageDbId.split(",");
		res = "<select name=" + objName + " multiple class=dropdown size="+size+">";
		selbean.getCategory(strQuery,myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value='" + selbean.getIntColumn(strIdColName) +"'";  
			if(strDbIds!=null)
			{
				int iSelected = 0;
				for(int i=0;i<strDbIds.length;i++)
				{
					if(strDbIds[i].equalsIgnoreCase(selbean.getStringColumn(strIdColName)))
						iSelected = 1;
				}
				if(iSelected == 1)
					res = res + " selected";
			}
			res = res + ">"+ selbean.getStringColumn(strTextColName1)+" "+selbean.getStringColumn(strTextColName2) + "</option>";
		}
		res = res + "</select>";
		return res;
	}
	public String getEdtMultiCombo1WithRoleFunName(String objName,String strIdColName,String strPageDbId,String strTextColName1,String strTextColName2,String strTextColName3,String FunName,int size,String strQuery,java.sql.Connection myCon) throws Exception
	{
		String strDbIds[] = strPageDbId.split(",");
		res = "<select name=" + objName + " multiple class=dropdown onchange="+FunName+" size="+size+">";
		selbean.getCategory(strQuery,myCon);
		while(selbean.getNextRow())
		{
			res = res + "<option value='" + selbean.getIntColumn(strIdColName) +"'";  
			if(strDbIds!=null)
			{
				int iSelected = 0;
				for(int i=0;i<strDbIds.length;i++)
				{
					if(strDbIds[i].equalsIgnoreCase(selbean.getStringColumn(strIdColName)))
						iSelected = 1;
				}
				if(iSelected == 1)
					res = res + " selected";
			}
			res = res + ">"+ selbean.getStringColumn(strTextColName1)+" "+selbean.getStringColumn(strTextColName2)+" ("+selbean.getStringColumn(strTextColName3)+")" + "</option>";
		}
		res = res + "</select>";
		return res;
	}
}
