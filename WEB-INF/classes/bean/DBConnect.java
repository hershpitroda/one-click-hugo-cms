package bean;
import java.sql.Connection;
import java.sql.DriverManager;


public class DBConnect
{
    Connection myCon;
    public DBConnect()
    {
    }
    public Connection getConn(String abc)
        throws Exception
    {
		Class.forName("net.sourceforge.jtds.jdbc.Driver");
//		myCon = DriverManager.getConnection("jdbc:jtds:sqlserver://localhost/NewBurosys", "tomcat", "puratomcat5");
		myCon = DriverManager.getConnection("jdbc:jtds:sqlserver://74.53.251.162:4433/burosys", "burosys","BuSyj7");
		return myCon;
    }

    public void shutdown()
        throws Exception
    {
        if(myCon != null)
        {
            myCon.close();
        }
    }
}
