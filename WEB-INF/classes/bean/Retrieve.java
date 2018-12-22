package bean;

import java.sql.*;
import java.math.*;
public class Retrieve
{
    ResultSet rs;
    Statement stmt;
	Statement stmtAdd;
	ResultSetMetaData rsmd;
	CallableStatement cs;
    Utility uFormat = new Utility();
	public Retrieve()
	{
        rs = null;
        stmt = null;
		rsmd=null;
		stmtAdd=null;
    }

	public void getProcedure(String ProcedureName,java.sql.Connection myCon) throws Exception
	{
		cs = myCon.prepareCall("{"+ProcedureName+"}");
		rs = cs.executeQuery();
	}

	public void goBeforeFirst()throws Exception
	{
		rs.beforeFirst();
	}
	public void goAfterLast()throws Exception{
		rs.afterLast();
	}

    public boolean getNextRow()throws Exception{
        return rs.next();
    }

	public boolean getPrevRow()throws Exception{
        return rs.previous();
    }

	public void setPosition(int i) throws Exception{
		rs.absolute(i);
	}

	public String getStringColumn(String s)throws Exception{
        return rs.getString(s);
    }

	public String getStringColumn(int i)throws Exception{
        return rs.getString(i);
    }

	public String getByInt(int i)throws Exception{
        return rs.getString(i);
    }

	public int getIntColumn(String s)throws Exception{
        return rs.getInt(s);
    }

	public int getIntColumn(int i)throws Exception{
        return rs.getInt(i);
    }

    public long getLongColumn(String s)throws Exception{
        return rs.getLong(s);
    }
	public long getLongColumn(int i)throws Exception{
        return rs.getLong(i);
    }

    public double getDoubleColumn(String s)throws Exception{
		return rs.getDouble(s);
    }
	public double getDoubleColumn(int i)throws Exception{
		return rs.getDouble(i);
    }
	public float getFloatColumn(String s)throws Exception{
        
		return rs.getFloat(s);
    }
	public float getFloatColumn(int i)throws Exception{
        return rs.getFloat(i);
    }

    public Date getDateColumn(String s)throws Exception{
        return rs.getDate(s);
    }

	public Date getDateColumn(int i)throws Exception{
        return rs.getDate(i);
    }

	public Time getTimeColumn(String s)throws Exception{
		return rs.getTime(s);
	}
	public String getCatName(int i,java.sql.Connection myCon) throws Exception{
		getCategory("select CAT_NAME from USER_CAT where CAT_CD=" + i,myCon);
		if(getNextRow()){
			return getStringColumn(1);
		}else{
			return "";
		}
    }

    public void getCategory(String s,java.sql.Connection myCon)throws Exception{
        if(stmt==null)
		{
			stmt = myCon.createStatement();
		}
        rs = stmt.executeQuery(s);
		//return rs;
	}

    public ResultSet getCategory(String s,int x,java.sql.Connection myCon)throws Exception{
		switch(x){
			case 1 :
				stmt = myCon.createStatement(
                     ResultSet.TYPE_SCROLL_INSENSITIVE,
                     ResultSet.CONCUR_UPDATABLE);
				break;
			case 2 :
				stmt = myCon.createStatement(
                     ResultSet.TYPE_SCROLL_SENSITIVE,
                     ResultSet.CONCUR_UPDATABLE);
				break;
			default :
				stmt = myCon.createStatement();
		}
        rs = stmt.executeQuery(s);
        return rs;
    }

	public String getColName(int i) throws Exception{
		rsmd=rs.getMetaData();
		return rsmd.getColumnName(i);
	}

	public int getColumnCnt() throws Exception{
		rsmd=rs.getMetaData();
		return rsmd.getColumnCount();
	}

	public int getRowNum()throws Exception{
		return rs.getRow();
	}

    public int getRowCounts1(String s,java.sql.Connection myCon)throws Exception{
        int i = 0;
		try{
		if(stmt==null){
	        stmt = myCon.createStatement();
		}
		for(rs = stmt.executeQuery(s); rs.next();)
        {	
            i++;
        }
		}catch(Exception e){
			
		}
        return i;
    }


    public int getRowCounts(String s,java.sql.Connection myCon)throws Exception{
        int i = 0;
		try{
		if(stmt==null){
	        stmt = myCon.createStatement();
		}
		rs = stmt.executeQuery(s);
		if(rs.next())
			i = rs.getInt("cnt");
		else
			i = 0;
		/*for(rs = stmt.executeQuery(s); rs.next();)
        {	
            i++;
        }*/
		}catch(Exception e){
			
		}
        return i;
    }

    public int getID(String s, String s1,java.sql.Connection myCon)throws Exception{
        int i = 0;
        if(stmt==null){
			stmt = myCon.createStatement();
		}
        String s2 = "select max(" + s + ") as lnum from " + s1 + "";
        for(rs = stmt.executeQuery(s2); rs.next();)
        {
            i = rs.getInt("lnum");
        }

        i++;
        return i;
    }

    public boolean rowsplus()throws Exception{
        return rs.relative(1);
    }

    public void cleanup()throws Exception{
        if(rs!=null){
			rs.close();
		}
		if(stmt!=null){
			stmt.close();
		}
    }
	//=====TO UPDATE,DELETE,INSERT=======
	public void add(String sql,java.sql.Connection myCon) throws Exception
	{
			stmtAdd = myCon.createStatement();
			stmtAdd.executeUpdate(sql);
			if(stmtAdd!=null)
				stmtAdd.close();
	}
}