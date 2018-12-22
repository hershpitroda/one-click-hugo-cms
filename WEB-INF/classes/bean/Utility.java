package bean;
import java.sql.Connection;
import java.sql.Statement;
import java.util.*;
import java.text.*;
import java.util.Date;
import bean.Retrieve;
import java.io.File;

public class Utility{
	Statement stmt;
	Format dateformatter;
	Format dateDDMM;
	Format dateYYYYMMDD;
	Format dateLong1;
	Format dateMMM;
	Format dateMM;
	Format dateDD;
	Format dateYYYY;
	NumberFormat numformatter;
	NumberFormat withoughtSign;
	NumberFormat withoughtPoint;
	NumberFormat numWith1DeciPoint;
	NumberFormat numWith2DeciPoint;
	NumberFormat numWith3DeciPoint;
	NumberFormat numWith4DeciPoint;
	Calendar cal;
	public Utility(){
		dateformatter = new SimpleDateFormat("dd-MM-yyyy");
		dateDDMM = new SimpleDateFormat("dd/MM");
		dateYYYYMMDD = new SimpleDateFormat("yyyy-MM-dd");
		dateLong1 = new SimpleDateFormat("EEEEEEEEE, MMM dd,yyyy");
		dateMMM = new SimpleDateFormat("MMM");
		dateMM = new SimpleDateFormat("MM");
		dateDD = new SimpleDateFormat("dd");
		dateYYYY = new SimpleDateFormat("yyyy");
		numformatter = new DecimalFormat("0.00");
		withoughtSign = new DecimalFormat("'+'#.00;#.00");
		withoughtPoint = new DecimalFormat("##");
		numWith1DeciPoint = new DecimalFormat("0.0");
		numWith2DeciPoint = new DecimalFormat("0.00");
		numWith3DeciPoint = new DecimalFormat("0.000");
		numWith4DeciPoint = new DecimalFormat("0.0000");
		stmt = null;
		cal = Calendar.getInstance();
	}
	//Method to get list of newly uploaded files
	public Vector getNewFiles(String aPath, String aTable)throws Exception{
		Vector newFiles = new Vector();
		//Get all file names from given path
		File vDirectory = new File(aPath);
		String [] strFileArr = vDirectory.list();
		//Check whether there is any newly uploaded file, if there is add in vector
		Retrieve retr = new Retrieve();
//		retr.getConn();
		for (int i=0;i < strFileArr.length; i++){
			//retr.getCategory("SELECT * FROM " + aTable + " WHERE FILENAME = '" + strFileArr[i] + "'");
			//if (!retr.getNextRow())
				newFiles.add(strFileArr[i]);
		}
		vDirectory = null;
		return newFiles;
	}

	public String getDateInFormat(Date dt){
		return dateformatter.format(dt);
	}
	//ABOVE METHOD OVERRIDDEN ACCEPTING STRING ARGUMENT AS A DATE
	public String getDateInFormat(String dt)throws Exception{

		if(dt!=null && !dt.equals(""))	
		{
			StringTokenizer st = new StringTokenizer(dt,"-");
			String yr = st.nextToken().trim();
			String mon = st.nextToken().trim();
			String dy = st.nextToken().trim();
			return mon+"-"+dy+"-"+yr;
		}
		else
		{
			return null ;
		}	

	}
	public String getDateInFormat1(String dt)throws Exception{
		StringTokenizer st = new StringTokenizer(dt,"-");
		String yr = st.nextToken().trim();
		String mon = st.nextToken().trim();
		String dy = st.nextToken().trim();
		return dy+"-"+mon+"-"+yr;
	}

	public String getDateInFormatSql(String dt)throws Exception{
		StringTokenizer st = new StringTokenizer(dt,"-");
		String dy = st.nextToken().trim();
		String mon = st.nextToken().trim();
		String yr = st.nextToken().trim();
		return yr+"-"+mon+"-"+dy;
	}

	public String getFY(String dt)throws Exception{
		//ASSUMPTION: DATE STRING IN YYYY-MM-DD FORMAT
		StringTokenizer st = new StringTokenizer(dt,"-");
		int yr = Integer.parseInt(st.nextToken().trim());
		int mon = Integer.parseInt(st.nextToken().trim());
		String str="";
		if(mon>=4 && mon<=12)
		{
			str = "For F.Y. " + (yr) + " - " + (yr+1);
		}else{
			str = "For F.Y. " + (yr-1) + " - " + (yr);
		}
		return str;
	}
	public int getDateDiff(String ToDate,String FromDate) throws Exception
	{
		 int dateDiff =0; 
		 Date date1=null;
		 Date date2=null;
		    SimpleDateFormat df = new SimpleDateFormat("dd-MM-yyyy");
		    
		    date1 = df.parse(ToDate); 
		    date2 = df.parse(FromDate); 
		    
		    Calendar cal1 = null; 
		    Calendar cal2 = null;
		    cal1=Calendar.getInstance(); 
		    cal2=Calendar.getInstance(); 

		    cal1.setTime(date1);          
		    long ldate1 = date1.getTime() + cal1.get(Calendar.ZONE_OFFSET) + cal1.get(Calendar.DST_OFFSET);
		    
		    cal2.setTime(date2);
		    long ldate2 = date2.getTime() + cal2.get(Calendar.ZONE_OFFSET) + cal2.get(Calendar.DST_OFFSET);
	    
		    // Use integer calculation, truncate the decimals
		    int hr1   = (int)(ldate1/3600000); //60*60*1000
		    int hr2   = (int)(ldate2/3600000);

		    int days1 = (int)hr1/24;
		    int days2 = (int)hr2/24;
		    dateDiff  = days1 - days2;
            /*if(dateDiff>=0)
			{
			  dateDiff++;
			}	
			else
			{
				dateDiff--;	
			}*/
		return dateDiff;
	}
	public double getInterest(int Days,float InterestRate,double Principle)
	{
		double Interest=0;
		Interest=Principle*InterestRate/100*Days/365.0;
		return Interest;
	}
	public String getDateDDMM(Date dt){
		return dateDDMM.format(dt);
	}

	public String getDateYYYYMMDD(Date dt){
		return dateYYYYMMDD.format(dt);
	}

	public String getDateLong1(Date dt){
		return dateLong1.format(dt);
	}

	public String getDateMMM(Date dt){
		return dateMMM.format(dt);
	}

	public String getDateMM(Date dt){
		return dateMM.format(dt);
	}

	public String getDateDD(Date dt){
		return dateDD.format(dt);
	}

	public String getDateYYYY(Date dt){
		return dateYYYY.format(dt);
	}
	
	public String getNumberInFormat(double db){
		return numformatter.format(db);
	}

	public String getNumberWithoutSign(double db){
		return withoughtSign.format(db);
	}

	public String getNumberWithoutDeciPoint(double db){
		return withoughtPoint.format(db);
	}
	
	public String getNumberWithDeciPoint(double db, int n){
		switch(n){
			case 1: return numWith1DeciPoint.format(db);
			case 2: return numWith2DeciPoint.format(db);
			case 3: return numWith3DeciPoint.format(db);
			case 4: return numWith4DeciPoint.format(db);
			default: return numWith2DeciPoint.format(db);
		}
	}

	public void cleanup()throws Exception{
		stmt.close();
	}

}