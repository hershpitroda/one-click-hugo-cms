package bean;

import java.io.File;
import java.io.IOException;
import java.util.*;
import javax.activation.DataHandler;
import javax.activation.FileDataSource;
import javax.mail.*;
import javax.mail.internet.*;

import java.io.IOException;
import java.io.PrintWriter;

public class email
{
    Session session;
    Store store;
    Folder folder;
    public Message[] login(String s, String s1, String s2, String s3)
        throws MessagingException
    {
        String s4 = s2 + "@" + s1;
        Properties properties = System.getProperties();
        properties.put("mail.smtp.host", s);
        session = Session.getInstance(properties, null);
        store = session.getStore("pop3");
        store.connect(s1, s2, s3);
        folder = store.getFolder("Mailbox");
        folder.open(1);
        Message amessage[] = null;
        amessage = folder.getMessages();
        return amessage;
    }

    public static Message prepareHeader(String s, String s1, String s2, String s3)
        throws IOException, AddressException, MessagingException
    {
        Properties properties = new Properties();
        properties.put("mail.smtp.host", s);
        Session session1 = Session.getDefaultInstance(properties, null);
        MimeMessage mimemessage = new MimeMessage(session1);
        InternetAddress internetaddress = new InternetAddress(s2);
        mimemessage.setRecipients(javax.mail.Message.RecipientType.TO, new InternetAddress[] {
            internetaddress
        });
        InternetAddress internetaddress1 = new InternetAddress(s1);
        mimemessage.setFrom(internetaddress1);
        mimemessage.setSubject(s3);
        return mimemessage;
    }

    public static void sendMail(String s, String s1, String s2, String s3, String s4)
        throws IOException, AddressException, MessagingException
    {
        Message message = prepareHeader(s, s1, s2, s3);
        message.setContent(s4, "text/HTML");
        Transport.send(message);
    }

    public static void sendMultipleMails(String s, String s1, String s2, String s3, String s4, String s5, String s6)
        throws IOException, AddressException, MessagingException
    {
        Properties properties = new Properties();
        properties.put("smtp.host", s);
        Session session1 = Session.getDefaultInstance(properties, null);
        MimeMessage mimemessage = new MimeMessage(session1);
        mimemessage.setFrom(new InternetAddress(s1));
        mimemessage.setRecipients(javax.mail.Message.RecipientType.TO, InternetAddress.parse(s2));
        mimemessage.setRecipients(javax.mail.Message.RecipientType.CC, InternetAddress.parse(s3));
        mimemessage.setRecipients(javax.mail.Message.RecipientType.BCC, InternetAddress.parse(s4));
        mimemessage.setSubject(s5);
        mimemessage.setContent(s6, "text/HTML");
        Transport.send(mimemessage);
    }

public static void sendMailCC(String s, String s1, String s2, String s3, String s4, String s5)
        throws IOException, AddressException, MessagingException
    {
        Properties properties = new Properties();
        properties.put("smtp.host", s);
        Session session1 = Session.getDefaultInstance(properties, null);
        MimeMessage mimemessage = new MimeMessage(session1);
        mimemessage.setFrom(new InternetAddress(s1));
        mimemessage.setRecipients(javax.mail.Message.RecipientType.TO, InternetAddress.parse(s2));
        mimemessage.setRecipients(javax.mail.Message.RecipientType.CC, InternetAddress.parse(s3));
        mimemessage.setSubject(s4);
        mimemessage.setContent(s5, "text/HTML");
        Transport.send(mimemessage);
    }

	public static void sendMailBCC(String s, String s1, String s3, String s4, String s5)
        throws IOException, AddressException, MessagingException
    {
        Properties properties = new Properties();
        properties.put("smtp.host", s);
        Session session1 = Session.getDefaultInstance(properties, null);
        MimeMessage mimemessage = new MimeMessage(session1);
        mimemessage.setFrom(new InternetAddress(s1));

        mimemessage.setRecipients(javax.mail.Message.RecipientType.BCC, InternetAddress.parse(s3));
        mimemessage.setSubject(s4);
        mimemessage.setContent(s5, "text/HTML");

        Transport.send(mimemessage);
    }

public static void sendWithAttachments(String smtp_host, String from,
		String to, String subject, String message, String attach)
			throws IOException, AddressException,
			MessagingException
	{
	Message msg = prepareHeader(smtp_host, from, to, subject);

	MimeMultipart mp = new MimeMultipart();

	MimeBodyPart text = new MimeBodyPart();
	text.setDisposition(Part.INLINE);
	text.setContent(message, "text/HTML");
	mp.addBodyPart(text);

	for (int i = 0; i < 1; i++)
	{
		MimeBodyPart file_part = new MimeBodyPart();
		File file = new File(attach);
		FileDataSource fds = new FileDataSource(file);
		DataHandler dh = new DataHandler(fds);
		file_part.setFileName(file.getName());
		file_part.setDisposition(Part.ATTACHMENT);
		file_part.setDescription("Attached file: " + file.getName());
		file_part.setDataHandler(dh);
		mp.addBodyPart(file_part);
	}

	msg.setContent(mp);
	Transport.send(msg);
	}


}