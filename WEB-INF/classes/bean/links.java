package bean;
import java.sql.*;
import java.util.Vector;

public class links
{
	Vector v;
	int catid;
	int p;
	String sql;
	Retrieve selbean;
	public links(){
		try{
			v = new Vector();
			catid = 0;
			p = 0;
			sql = null;
			selbean = new Retrieve();
		}catch(Exception e){
			System.out.println(e.toString());
		}
	}
	public Vector getlinks(String s, String s1, int i,Connection myCon)throws Exception{
		catid = i;
		for(; catid != 0; catid = selbean.getIntColumn("parentcateid")) {
			sql = "select Cateid,catename,parentcateid from category where cateid=" + catid + "";
			selbean.getCategory(sql,myCon);
	          if(selbean.getNextRow())	{
				p = selbean.getIntColumn("parentcateid");
				v.addElement(selbean.getStringColumn("catename"));
				v.addElement(new Integer(p));
			}
		}

		return v;
    }
}
