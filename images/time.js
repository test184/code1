
function GetBit(m,n) {  return (m>>n)&1; }
function e2c()
{  
TheDate= (arguments.length!=3) ? new Date() : new Date(arguments[0],arguments[1],arguments[2]);  
var total,m,n,k;  
var isEnd=false;  
var tmp=TheDate.getFullYear();  
 total=(tmp-1921)*365+Math.floor((tmp-1921)/4)+madd[TheDate.getMonth()]+TheDate.getDate()-38;  if (TheDate.getYear()%4==0&&TheDate.getMonth()>1) { total++;}  for(m=0;;m++)  {    k=(CalendarData[m]<0xfff)?11:12;    for(n=k;n>=0;n--)    {      if(total<=29+GetBit(CalendarData[m],n))      {        isEnd=true; break;      }      total=total-29-GetBit(CalendarData[m],n);    }    if(isEnd) break;  }  cYear=1921 + m; cMonth=k-n+1; cDay=total;  if(k==12)   {    if(cMonth==Math.floor(CalendarData[m]/0x10000)+1) { cMonth=1-cMonth; }    if(cMonth>Math.floor(CalendarData[m]/0x10000)+1)  { cMonth--; }   }}
function GetcDateString(){ var tmp="";  tmp+=tgString.charAt((cYear-4)%10); 
tmp+=dzString.charAt((cYear-4)%12);  
tmp+="年 "; 
if(cMonth<1) { tmp+="(闰)"; tmp+=monString.charAt(-cMonth-1); } else {tmp+=monString.charAt(cMonth-1);}  tmp+="月";  tmp+=(cDay<11)?"初":((cDay<20)?"十":((cDay<30)?"廿":"三十")); 
if (cDay%10!=0||cDay==10) { tmp+=numString.charAt((cDay-1)%10); }  return tmp;}

function GetLunarDay(solarYear,solarMonth,solarDay)
{
 if (solarYear<1921 || solarYear>2020)  {          return ""; 
  }        else        {          solarMonth = (parseInt(solarMonth)>0) ? (solarMonth-1) : 11;          e2c(solarYear,solarMonth,solarDay); return GetcDateString();        }}

var D=new Date(); 
var yy=D.getFullYear(); 
var mm=D.getMonth()+1; 
var dd=D.getDate(); 
var ww=D.getDay(); 
var ss=parseInt(D.getTime() / 1000); 

 
function CAL(){

 

document.write(GetLunarDay(yy,mm,dd)); 

} 



var day="";
var month="";
var ampm="";
var ampmhour="";
var myweekday="";
var year="";
mydate=new Date();
myweekday=mydate.getDay();
mymonth=mydate.getMonth()+1;
myday= mydate.getDate();
myyear= mydate.getYear();
year=(myyear > 200) ? myyear : 1900 + myyear;
if(myweekday == 0)
weekday=" 星期日 ";
else if(myweekday == 1)
weekday=" 星期一 ";
else if(myweekday == 2)
weekday=" 星期二 ";
else if(myweekday == 3)
weekday=" 星期三 ";
else if(myweekday == 4)
weekday=" 星期四 ";
else if(myweekday == 5)
weekday=" 星期五 ";
else if(myweekday == 6)
weekday=" 星期六 ";
document.write("&nbsp;&nbsp;<font color=#CC6600>"+year+"年"+mymonth+"月"+myday+"日 "+weekday+"</font>");


