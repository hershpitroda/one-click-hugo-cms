package bean;

import java.util.*;
import javax.mail.*;
import javax.mail.internet.*;
import java.io.IOException;
import java.io.PrintWriter;

public class SendEmail 
{
	String content = "";
	String strLogoPath = "<img src='http://www.smartjobz.com/images/logo.gif'><br>";
	int intReturnValue = 0;
    public SendEmail()
    {
	}
	public void sendMailTo(String strSender,String strReciever,String strSubject,String strMailContent)
        throws IOException 
    {
		try
		{
			content=strMailContent;
			if(content!=null && content.length()>0)
			{
				Properties properties = new Properties();
				properties.put("smtp.host", "localhost");
				Session session1 = Session.getDefaultInstance(properties, null);
				MimeMessage mimemessage = new MimeMessage(session1);
				mimemessage.setFrom(new InternetAddress(strSender));
				mimemessage.setRecipients(javax.mail.Message.RecipientType.TO, InternetAddress.parse(strReciever));
				mimemessage.setSubject(strSubject);
				mimemessage.setContent(content, "text/HTML");
				Transport.send(mimemessage);
			}
		}
		catch(Exception e)
		{
		}
	}
}