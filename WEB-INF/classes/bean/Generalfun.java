package bean;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.*;

public class Generalfun
{

    int x;
    String res;
    SimpleDateFormat formatter;
    Date currentTime_1;
    public Generalfun()
    {
        x = 0;
        res = null;
        formatter = null;
        currentTime_1 = new Date();
    }
	public String getLastUsed(String s, int i, int j)
	{
		res="";
		formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s + " class=tabfld>";
        for(int i1 = x - i; i1 <= x + j; i1++)
        {
            if(x == i1)
            {
                res = res + "<option value=" + i1 + " selected>" + i1 + "</option>";
            } 
			else
            {
                res = res + "<option value=" + i1 + ">" + i1 + "</option>";
            }
        }

        res = res + "</select>";
		return res;
	}
	public String getEdtLastUsed(String s, int i, int j)
	{
		res="";
		formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s + " class=tabfld>";
        for(int i1 = x - i; i1 <= x; i1++)
        {
            if(j == i1)
            {
                res = res + "<option value=" + i1 + " selected>" + i1 + "</option>";
            } 
			else
            {
                res = res + "<option value=" + i1 + ">" + i1 + "</option>";
            }
        }

        res = res + "</select>";
		return res;
	}
	public String getBDate(String s, String s1, String s2, int i)
    {
        Generalfun generalfun = new Generalfun();
        res = "<select name=" + s + " class=smalltext><option value=0>DD</option>";
        for(int j = 1; j <= 31; j++)
        {
            res = res + "<option value=" + j + ">" + j + "</option>";
        }

        res = res + "</select>";
        res = res + "<select name=" + s1 + " class=smalltext><option value=null>MM</option>";
        for(int k = 1; k <= 12; k++)
        {
            res = res + "<option value=" + k + ">" + generalfun.getMth(k) + "</option>";
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext><option value=null>YYYY</option>";
        for(int l = x - i; l <= x; l++)
        {
            if(x == l)
            {
                res = res + "<option value=" + l + ">" + l + "</option>";
            } else
            {
                res = res + "<option value=" + l + ">" + l + "</option>";
            }
        }

        res = res + "</select>";
        return res;
    }
    public String getBackDate(String s, String s1, String s2, int i)
    {
        Generalfun generalfun = new Generalfun();
        res = "<select name=" + s + " class=smalltext><option value=0></option>";
        for(int j = 1; j <= 31; j++)
        {
            res = res + "<option value=" + j + ">" + j + "</option>";
        }

        res = res + "</select>";
        res = res + "<select name=" + s1 + " class=smalltext><option value=null></option>";
        for(int k = 1; k <= 12; k++)
        {
            res = res + "<option value=" + k + ">" + generalfun.getMonth(k) + "</option>";
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int l = x - i; l <= x; l++)
        {
            if(x == l)
            {
                res = res + "<option value=" + l + " selected>" + l + "</option>";
            } else
            {
                res = res + "<option value=" + l + ">" + l + "</option>";
            }
        }

        res = res + "</select>";
        return res;
    }

    public String getBetDate(String s, String s1, String s2, int i, int j)
    {
        Generalfun generalfun = new Generalfun();
        res = "<select name=" + s + " class=smalltext><option value=0></option>";
        for(int k = 1; k <= 31; k++)
        {
            res = res + "<option value=" + k + ">" + k + "</option>";
        }

        res = res + "</select>";
        res = res + "<select name=" + s1 + " class=smalltext><option value=null></option>";
        for(int l = 1; l <= 12; l++)
        {
            res = res + "<option value=" + l + ">" + generalfun.getMth(l) + "</option>";
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int i1 = x - i; i1 <= x + j; i1++)
        {
            if(x == i1)
            {
                res = res + "<option value=" + i1 + " selected>" + i1 + "</option>";
            } else
            {
                res = res + "<option value=" + i1 + ">" + i1 + "</option>";
            }
        }

        res = res + "</select>";
        return res;
    }

    public String getBetweenDate(String s, String s1, String s2, int i, int j)
    {
        Generalfun generalfun = new Generalfun();
        res = "<select name=" + s + " class=smalltext><option value=0></option>";
        for(int k = 1; k <= 31; k++)
        {
            res = res + "<option value=" + k + ">" + k + "</option>";
        }

        res = res + "</select>";
        res = res + "<select name=" + s1 + " class=smalltext><option value=null></option>";
        for(int l = 1; l <= 12; l++)
        {
            res = res + "<option value=" + l + ">" + generalfun.getMonth(l) + "</option>";
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
		x--;
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int i1 = x - i; i1 <= x + j; i1++)
        {
            if(x == i1)
            {
                res = res + "<option value=" + i1 + " selected>" + i1 + "</option>";
            } else
            {
                res = res + "<option value=" + i1 + ">" + i1 + "</option>";
            }
        }

        res = res + "</select>";
        return res;
    }

    public String getCDate(String s, String s1, String s2, int i, int j)
    {
        try{
		Generalfun generalfun = new Generalfun();
        formatter = new SimpleDateFormat("dd");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = "<select name=" + s + " class=smalltext>";
        for(int k = 1; k <= 31; k++)
        {
            if(x == k)
            {
                res = res + "<option value=" + k + " selected>" + k + "</option>";
            } else
            {
                res = res + "<option value=" + k + ">" + k + "</option>";
            }
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("M");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s1 + " class=smalltext>";
        for(int l = 1; l <= 12; l++)
        {
            if(x == l)
            {
                res = res + "<option value=" + l + " selected>" + generalfun.getMth(l) + "</option>";
            } else
            {
                res = res + "<option value=" + l + ">" + generalfun.getMth(l) + "</option>";
            }
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int i1 = x - i; i1 <= x + j; i1++)
        {
            if(x == i1)
            {
                res = res + "<option value=" + i1 + " selected>" + i1 + "</option>";
            } else
            {
                res = res + "<option value=" + i1 + ">" + i1 + "</option>";
            }
        }

        res = res + "</select>";
		}catch(Exception e){System.out.println(e);}
        return res;
		
    }
	public String getCDate1(String s, String s1, String s2, int i, int j)
    {
        try{
		Generalfun generalfun = new Generalfun();
        formatter = new SimpleDateFormat("dd");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = "<select name=" + s + " class=smalltext>";
        for(int k = 1; k <= 31; k++)
        {
			if(k<10)
			{
				if(x == k)
				{
					res = res + "<option value=0" + k + " selected>" + k + "</option>";
				} else
				{
					res = res + "<option value=0" + k + ">" + k + "</option>";
				}
			}
			else
			{
				if(x == k)
				{
					res = res + "<option value=" + k + " selected>" + k + "</option>";
				} else
				{
					res = res + "<option value=" + k + ">" + k + "</option>";
				}
			}
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("M");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s1 + " class=smalltext>";
        for(int l = 1; l <= 12; l++)
        {
			if(l<10)
			{
				if(x == l)
				{
					res = res + "<option value=0" + l + " selected>" + generalfun.getMth(l) + "</option>";
				} else
				{
					res = res + "<option value=0" + l + ">" + generalfun.getMth(l) + "</option>";
				}
			}
			else
			{
				if(x == l)
				{
					res = res + "<option value=" + l + " selected>" + generalfun.getMth(l) + "</option>";
				} else
				{
					res = res + "<option value=" + l + ">" + generalfun.getMth(l) + "</option>";
				}
			}
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int i1 = x - i; i1 <= x + j; i1++)
        {
            if(x == i1)
            {
                res = res + "<option value=" + i1 + " selected>" + i1 + "</option>";
            } else
            {
                res = res + "<option value=" + i1 + ">" + i1 + "</option>";
            }
        }

        res = res + "</select>";
		}catch(Exception e){System.out.println(e);}
        return res;
		
    }

	public String getCDateback(String s, String s1, String s2, int i, int j)
    {
        try{
		Generalfun generalfun = new Generalfun();
        formatter = new SimpleDateFormat("dd");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = "<select name=" + s + " class=smalltext>";
        for(int k = 1; k <= 31; k++)
        {
            if(x == k)
            {
                res = res + "<option value=" + k + " selected>" + k + "</option>";
            } else
            {
                res = res + "<option value=" + k + ">" + k + "</option>";
            }
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("M");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s1 + " class=smalltext>";
        for(int l = 1; l <= 12; l++)
        {
            if(x == l)
            {
                res = res + "<option value=" + l + " selected>" + generalfun.getMthb(l) + "</option>";
            } else
            {
                res = res + "<option value=" + l + ">" + generalfun.getMthb(l) + "</option>";
            }
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int i1 = x - i; i1 <= x + j; i1++)
        {
            if(x == i1)
            {
                res = res + "<option value=" + i1 + " selected>" + i1 + "</option>";
            } else
            {
                res = res + "<option value=" + i1 + ">" + i1 + "</option>";
            }
        }

        res = res + "</select>";
		}catch(Exception e){System.out.println(e);}
        return res;
		
    }


    public String getCountry(int i)
    {
        switch(i)
        {
        case 1: // '\001'
            return "Afghanistan";

        case 2: // '\002'
            return "Albania";

        case 3: // '\003'
            return "Algeria";

        case 4: // '\004'
            return "American Samoa";

        case 5: // '\005'
            return "Andorra";

        case 6: // '\006'
            return "Angola";

        case 7: // '\007'
            return "Anguilla";

        case 8: // '\b'
            return "Antarctica";

        case 9: // '\t'
            return "Argentina";

        case 10: // '\n'
            return "Armenia";

        case 11: // '\013'
            return "Aruba";

        case 12: // '\f'
            return "Australia";

        case 13: // '\r'
            return "Austria";

        case 14: // '\016'
            return "Azerbaijan";

        case 15: // '\017'
            return "Bahamas";

        case 16: // '\020'
            return "Bangladesh";

        case 17: // '\021'
            return "Belarus";

        case 18: // '\022'
            return "Belgium";

        case 19: // '\023'
            return "Belize";

        case 20: // '\024'
            return "Benin";

        case 21: // '\025'
            return "Bermuda";

        case 22: // '\026'
            return "Bhutan";

        case 23: // '\027'
            return "Bolivia";

        case 24: // '\030'
            return "Botswana";

        case 25: // '\031'
            return "Brazil";

        case 26: // '\032'
            return "Bulgaria";

        case 27: // '\033'
            return "Burkina Faso";

        case 28: // '\034'
            return "Cambodia";

        case 29: // '\035'
            return "Cameroon";

        case 30: // '\036'
            return "Canada";

        case 31: // '\037'
            return "Cape Verde";

        case 32: // ' '
            return "Chile";

        case 33: // '!'
            return "China";

        case 34: // '"'
            return "Colombia";

        case 35: // '#'
            return "Cuba";

        case 36: // '$'
            return "Denmark";

        case 37: // '%'
            return "Ecuador";

        case 38: // '&'
            return "Egypt";

        case 39: // '\''
            return "El Salvador";

        case 40: // '('
            return "Ethiopia";

        case 41: // ')'
            return "Fiji";

        case 42: // '*'
            return "Finland";

        case 43: // '+'
            return "France";

        case 44: // ','
            return "Gambia";

        case 45: // '-'
            return "Germany";

        case 46: // '.'
            return "Ghana";

        case 47: // '/'
            return "Gibraltar";

        case 48: // '0'
            return "Greece";

        case 49: // '1'
            return "Hong Kong";

        case 50: // '2'
            return "Hungary";

        case 51: // '3'
            return "Iceland";

        case 52: // '4'
            return "India";

        case 53: // '5'
            return "Indonesia";

        case 54: // '6'
            return "Iran";

        case 55: // '7'
            return "Iraq";

        case 56: // '8'
            return "Ireland";

        case 57: // '9'
            return "Israel";

        case 58: // ':'
            return "Italy";

        case 59: // ';'
            return "Jamaica";

        case 60: // '<'
            return "Japan";

        case 61: // '='
            return "Jordan";

        case 62: // '>'
            return "Malaysia";

        case 63: // '?'
            return "Maldives";

        case 64: // '@'
            return "Nepal";

        case 65: // 'A'
            return "Netherlands";

        case 66: // 'B'
            return "New Zealand";

        case 67: // 'C'
            return "Nigeria";

        case 68: // 'D'
            return "Norway";

        case 69: // 'E'
            return "Oman";

        case 70: // 'F'
            return "Pakistan";

        case 71: // 'G'
            return "Philippines";

        case 72: // 'H'
            return "Portugal";

        case 73: // 'I'
            return "Qatar";

        case 74: // 'J'
            return "Romania";

        case 75: // 'K'
            return "Saudi Arabia";

        case 76: // 'L'
            return "Seychelle";

        case 77: // 'M'
            return "Singapore";

        case 78: // 'N'
            return "South Africa";

        case 79: // 'O'
            return "Spain";

        case 80: // 'P'
            return "Sri Lanka";

        case 81: // 'Q'
            return "Sweden";

        case 82: // 'R'
            return "Switzerland";

        case 83: // 'S'
            return "Taiwan";

        case 84: // 'T'
            return "Tajikistan";

        case 85: // 'U'
            return "Tanzania";

        case 86: // 'V'
            return "Thailand";

        case 87: // 'W'
            return "Trinidad and Tobago";

        case 88: // 'X'
            return "Tunisia";

        case 89: // 'Y'
            return "Turkey";

        case 90: // 'Z'
            return "Uganda";

        case 91: // '['
            return "Ukrain";

        case 92: // '\\'
            return "UAE";

        case 93: // ']'
            return "United Kingdom";

        case 94: // '^'
            return "Uruguay";

        case 95: // '_'
            return "Venezuela";

        case 96: // '`'
            return "Vietnam";

        case 97: // 'a'
            return "Yemen";

        case 98: // 'b'
            return "Yugoslavia";

        case 99: // 'c'
            return "Zambia";

        case 100: // 'd'
            return "Zimbabwe";
        }
        return "In Valied Country";
    }

    public String getCurDate(String s, String s1, String s2, int i, int j)
    {
        Generalfun generalfun = new Generalfun();
        formatter = new SimpleDateFormat("dd");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = "<select name=" + s + " class=smalltext>";
        for(int k = 1; k <= 31; k++)
        {
            if(x == k)
            {
                res = res + "<option value=" + k + " selected>" + k + "</option>";
            } else
            {
                res = res + "<option value=" + k + ">" + k + "</option>";
            }
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("M");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s1 + " class=smalltext>";
        for(int l = 1; l <= 12; l++)
        {
            if(x == l)
            {
                res = res + "<option value=" + l + " selected>" + generalfun.getMonth(l) + "</option>";
            } else
            {
                res = res + "<option value=" + l + ">" + generalfun.getMonth(l) + "</option>";
            }
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int i1 = x - i; i1 <= x + j; i1++)
        {
            if(x == i1)
            {
                res = res + "<option value=" + i1 + " selected>" + i1 + "</option>";
            } else
            {
                res = res + "<option value=" + i1 + ">" + i1 + "</option>";
            }
        }

        res = res + "</select>";
        return res;
    }

    public String getFDate(String s, String s1, String s2, int i)
    {
        Generalfun generalfun = new Generalfun();
        res = "<select name=" + s + " class=smalltext><option value=0></option>";
        for(int j = 1; j <= 31; j++)
        {
            res = res + "<option value=" + j + ">" + j + "</option>";
        }

        res = res + "</select>";
        res = res + "<select name=" + s1 + " class=smalltext><option value=null></option>";
        for(int k = 1; k <= 12; k++)
        {
            res = res + "<option value=" + k + ">" + generalfun.getMth(k) + "</option>";
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int l = x + i; l >= x; l--)
        {
            if(x == l)
            {
                res = res + "<option value=" + l + " selected>" + l + "</option>";
            } else
            {
                res = res + "<option value=" + l + ">" + l + "</option>";
            }
        }

        res = res + "</select>";
        return res;
    }

    public String getFrontDate(String s, String s1, String s2, int i)
    {
        Generalfun generalfun = new Generalfun();
        res = "<select name=" + s + " class=smalltext><option value=0></option>";
        for(int j = 1; j <= 31; j++)
        {
            res = res + "<option value=" + j + ">" + j + "</option>";
        }

        res = res + "</select>";
        res = res + "<select name=" + s1 + " class=smalltext><option value=null></option>";
        for(int k = 1; k <= 12; k++)
        {
            res = res + "<option value=" + k + ">" + generalfun.getMonth(k) + "</option>";
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int l = x + i; l >= x; l--)
        {
            if(x == l)
            {
                res = res + "<option value=" + l + " selected>" + l + "</option>";
            } else
            {
                res = res + "<option value=" + l + ">" + l + "</option>";
            }
        }

        res = res + "</select>";
        return res;
    }

    public String getFullEditDate(String s, String s1, String s2, int i, int j, int k, int l, 
            int i1)
    {
        Generalfun generalfun = new Generalfun();
        res = "<select name=" + s + " class=smalltext>";
        for(int j1 = 1; j1 <= 31; j1++)
        {
            if(j1 == k)
            {
                res = res + "<option value=" + j1 + " selected>" + j1 + "</option>";
            } else
            {
                res = res + "<option value=" + j1 + ">" + j1 + "</option>";
            }
        }

        res = res + "</select>";
        res = res + "<select name=" + s1 + " class=smalltext>";
        for(int k1 = 1; k1 <= 12; k1++)
        {
            if(k1 == l)
            {
                res = res + "<option value=" + k1 + " selected>" + generalfun.getMonth(k1) + "</option>";
            } else
            {
                res = res + "<option value=" + k1 + ">" + generalfun.getMonth(k1) + "</option>";
            }
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int l1 = x - i; l1 <= x + j; l1++)
        {
            if(l1 == i1)
            {
                res = res + "<option value=" + l1 + " selected>" + l1 + "</option>";
            } else
            {
                res = res + "<option value=" + l1 + ">" + l1 + "</option>";
            }
        }

        res = res + "</select>";
        return res;
    }
	public String getFullEditDateback(String s, String s1, String s2, int i, int j, int k, int l, 
            int i1)
    {
        Generalfun generalfun = new Generalfun();
        res = "<select name=" + s + " class=smalltext>";
        for(int j1 = 1; j1 <= 31; j1++)
        {
            if(j1 == k)
            {
                res = res + "<option value=" + j1 + " selected>" + j1 + "</option>";
            } else
            {
                res = res + "<option value=" + j1 + ">" + j1 + "</option>";
            }
        }

        res = res + "</select>";
        res = res + "<select name=" + s1 + " class=smalltext>";
        for(int k1 = 1; k1 <= 12; k1++)
        {
            if(k1 == l)
            {
                res = res + "<option value=" + k1 + " selected>" + generalfun.getMthb(k1) + "</option>";
            } else
            {
                res = res + "<option value=" + k1 + ">" + generalfun.getMonth(k1) + "</option>";
            }
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int l1 = x - i; l1 <= x + j; l1++)
        {
            if(l1 == i1)
            {
                res = res + "<option value=" + l1 + " selected>" + l1 + "</option>";
            } else
            {
                res = res + "<option value=" + l1 + ">" + l1 + "</option>";
            }
        }

        res = res + "</select>";
        return res;
    }


public String getFullEditDate1(String s, String s1, String s2, int i, int j, int k, int l, 
            int i1)
    {
        Generalfun generalfun = new Generalfun();

        res = "<select name=" + s + " class=smalltext>";
        for(int j1 = 1; j1 <= 31; j1++)
        {
	  if(j1 < 10)
           {
            if(j1 == k)
            {
                res = res + "<option value=0" + j1 + " selected>" + j1 + "</option>";
            } else
            {
                res = res + "<option value=0" + j1 + ">" + j1 + "</option>";
            }
           }else
             if(j1 == k)
            {
                res = res + "<option value=" + j1 + " selected>" + j1 + "</option>";
            } else
            {
                res = res + "<option value=" + j1 + ">" + j1 + "</option>";
            }
        }

        res = res + "</select>";
        res = res + "<select name=" + s1 + " class=smalltext>";
        for(int k1 = 1; k1 <= 12; k1++)
        {

	  if(k1 < 10)
           {
            if(k1 == l)
            {
                res = res + "<option value=0" + k1 + " selected>" + generalfun.getMonth(k1) + "</option>";
            } else
            {
                res = res + "<option value=0" + k1 + ">" + generalfun.getMonth(k1) + "</option>";
            }
           }else
              if(k1 == l)
            {
                res = res + "<option value=" + k1 + " selected>" + generalfun.getMonth(k1) + "</option>";
            } else
            {
                res = res + "<option value=" + k1 + ">" + generalfun.getMonth(k1) + "</option>";
            }
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int l1 = x - i; l1 <= x + j; l1++)
        {
            if(l1 == i1)
            {
                res = res + "<option value=" + l1 + " selected>" + l1 + "</option>";
            } else
            {
                res = res + "<option value=" + l1 + ">" + l1 + "</option>";
            }
        }

        res = res + "</select>";
        return res;
    }




























    public String getHalfEditDate(String s, String s1, String s2, int i, int j, int k, int l, 
            int i1)
    {
        Generalfun generalfun = new Generalfun();
        res = "<select name=" + s + " class=smalltext>";
        for(int j1 = 1; j1 <= 31; j1++)
        {
            if(j1 == k)
            {
                res = res + "<option value=" + j1 + " selected>" + j1 + "</option>";
            } else
            {
                res = res + "<option value=" + j1 + ">" + j1 + "</option>";
            }
        }

        res = res + "</select>";
        res = res + "<select name=" + s1 + " class=smalltext>";
        for(int k1 = 1; k1 <= 12; k1++)
        {
            if(k1 == l)
            {
                res = res + "<option value=" + k1 + " selected>" + generalfun.getMth(k1) + "</option>";
            } else
            {
                res = res + "<option value=" + k1 + ">" + generalfun.getMth(k1) + "</option>";
            }
        }

        res = res + "</select>";
        formatter = new SimpleDateFormat("yyyy");
        x = Integer.parseInt(formatter.format(currentTime_1));
        res = res + "<select name=" + s2 + " class=smalltext>";
        for(int l1 = x - i; l1 <= x + j; l1++)
        {
            if(l1 == i1)
            {
                res = res + "<option value=" + l1 + " selected>" + l1 + "</option>";
            } else
            {
                res = res + "<option value=" + l1 + ">" + l1 + "</option>";
            }
        }

        res = res + "</select>";
        return res;
    }

    public String getMonth(int i)
    {
        switch(i)
        {
        case 1: // '\001'
            return "January";

        case 2: // '\002'
            return "February";

        case 3: // '\003'
            return "March";

        case 4: // '\004'
            return "April";

        case 5: // '\005'
            return "May";

        case 6: // '\006'
            return "June";

        case 7: // '\007'
            return "July";

        case 8: // '\b'
            return "August";

        case 9: // '\t'
            return "September";

        case 10: // '\n'
            return "October";

        case 11: // '\013'
            return "November";

        case 12: // '\f'
            return "December";
        }
        return "Error Input";
    }

    public String getMth(int i)
    {
        switch(i)
        {
        case 1: // '\001'
            return "Jan";

        case 2: // '\002'
            return "Feb";

        case 3: // '\003'
            return "Mar";

        case 4: // '\004'
            return "Apr";

        case 5: // '\005'
            return "May";

        case 6: // '\006'
            return "Jun";

        case 7: // '\007'
            return "Jul";

        case 8: // '\b'
            return "Aug";

        case 9: // '\t'
            return "Sep";

        case 10: // '\n'
            return "Oct";

        case 11: // '\013'
            return "Nov";

        case 12: // '\f'
            return "Dec";
        }
        return "Error Input";
    }

	public String getMthb(int i)
    {
        switch(i)
        {
        case 1: // '\001'
            return "Jul";

        case 2: // '\002'
            return "Aug";

        case 3: // '\003'
            return "Sep";

        case 4: // '\004'
            return "Oct";

        case 5: // '\005'
            return "Nov";

        case 6: // '\006'
            return "Dec";

        case 7: // '\007'
            return "Jan";

        case 8: // '\b'
            return "Feb";

        case 9: // '\t'
            return "Mar";

        case 10: // '\n'
            return "Apr";

        case 11: // '\013'
            return "May";

        case 12: // '\f'
            return "Jun";
        }
        return "Error Input";
    }


    public String getRemdays(String s, int i)
    {
        res = "<select name=" + s + " class=smalltext><option value=0></option>";
        for(int j = 1; j <= i; j++)
        {
            res = res + "<option value=" + j + ">" + j + "</option>";
        }

        res = res + "</select>";
        return res;
    }

    public Vector getTokens(String s, String s1)
    {
        Vector vector = new Vector(1, 1);
        for(StringTokenizer stringtokenizer = new StringTokenizer(s, s1); stringtokenizer.hasMoreTokens(); vector.addElement(stringtokenizer.nextToken())) { }
        return vector;
    }

    public String getZeroRemdays(String s, int i)
    {
        res = "<select name=" + s + " class=smalltext>";
        for(int j = 0; j <= i; j++)
        {
            res = res + "<option value=" + j + ">" + j + "</option>";
        }

        res = res + "</select>";
        return res;
    }

    public String geteditRemdays(String s, int i, int j)
    {
        res = "<select name=" + s + " class=smalltext><option value=0></option>";
        for(int k = 1; k <= i; k++)
        {
            if(k == j)
            {
                res = res + "<option value=" + k + " Selected>" + k + "</option>";
            } else
            {
                res = res + "<option value=" + k + ">" + k + "</option>";
            }
        }

        res = res + "</select>";
        return res;
    }
    public int getRandomNumber(int j)
    {
        int rannumber=0;
		java.util.Random ran = new Random();
		rannumber=ran.nextInt(j);
		return rannumber;
    }
	
}
