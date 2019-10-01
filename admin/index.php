<!--#include file="../include/pagecode.php"-->
<!--#include file="../include/lh_SqlIn.php"-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>后台登录</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<STYLE type=text/css>BODY {
	MARGIN: 0px; BACKGROUND-COLOR: #ffffff
}
.dndn {
	BORDER-RIGHT: #d6d3ce 0px outset; BORDER-TOP: #d6d3ce 0px outset; FONT-SIZE: 13pt; BACKGROUND: #d6d3ce; BORDER-LEFT: #d6d3ce 0px outset; BORDER-BOTTOM: #d6d3ce 0px outset
}
BODY {
	FONT-SIZE: 13px; COLOR: #333333
}
TD {
	FONT-SIZE: 13px; COLOR: #333333
}
TH {
	FONT-SIZE: 13px; COLOR: #333333
}
.button_c {
	BORDER-RIGHT: #ffffff 1px solid; BORDER-TOP: #f1f1f1 1px solid; FONT-SIZE: 10pt; BORDER-LEFT: #ffffff 1px solid; CURSOR: hand; COLOR: #ffffff; PADDING-TOP: 3px; BORDER-BOTTOM: #f1f1f1 1px solid; BACKGROUND-COLOR: #488bd0
}
</STYLE>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.5583" name=GENERATOR></HEAD>
<BODY bgColor=#f3f3f3 scroll=no>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD background=images/logoin_02.jpg height=71>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD><IMG height=71 src="images/logoin_01.jpg" width=212></TD>
          <TD align=right><IMG height=71 src="images/logoin_03.jpg" 
            width=161></TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD width="30%" background=images/logoin_04.jpg height=389>
      <TABLE cellSpacing=0 cellPadding=0 width=740 align=center border=0>
        <TBODY>
        <TR>
          <TD vAlign=top background=images/logoin_05.jpg height=389>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR>
                <TD height=119>&nbsp;</TD></TR>
              <TR>
                <TD>
                  <TABLE height=79 cellSpacing=0 cellPadding=3 width=326 
                  align=center border=0>
                    <form action="checklogin.php" method="post" name="admininfo">
                    <TBODY>
                    <TR>
                      <TD colspan="3" vAlign=top>
                        <TABLE width="293" border=0 
                        align=center cellPadding=3 cellSpacing=1 id=Table8>
                          <TBODY>
                          <TR>
                            <TD width="65" noWrap>
                              <DIV align=center><FONT color=#000000>用户名：</FONT></DIV></TD>
                            <TD width="213"><input type=text 
                              name="user" style="width:150px;"></TD>
                          </TR>
                          <TR>
                            <TD>
                              <DIV align=center><FONT color=#000000>密&nbsp;码：</FONT></DIV></TD>
                            <TD><input 
                              name="password" type=password  id="password"  style="width:150px;"></TD></TR>
                          <TR>
                            <TD><DIV align=center><FONT color=#000000>验证码：</FONT></DIV></TD>
                            <TD><input type=password  name="yzm" size=6">
                              <div style=" float:right;padding-bottom:0px;">
                              <img src="../include/yzt.php" id="codeimg" style="cursor:pointer;" title="点击更换图片" onClick="this.src = this.src+'?'+Math.random();" >&nbsp;<span onClick="document.getElementById('codeimg').src+='?'+Math.random()" style="cursor:pointer; color:#3F79CB; text-decoration:underline;"><span >看不清</span>？</span></div>
                              
                              </TD>
                          </TR>
                          </TBODY></TABLE>
                        <BR></TD></TR>
                    <TR>
                      <TD width="49" height=20 align=middle>&nbsp;</TD>
                      <TD width="105" align=middle><input class="btn btn-primary btn3 mr10" type=submit value=" 登 录" name=Submit onClick="return check();"></TD>
                      <TD width="154" align=middle><input name="Submit2" type="reset" class="btn btn3" value=" 重 置 "></TD>
                    </TR><INPUT 
                    type=hidden value=yes name=islogin> 
              </FORM><tr><td colspan="3"></TABLE></TD></TR>
              <TR>
                <TD>&nbsp;</TD></TR></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></BODY></HTML>
<script LANGUAGE="javascript">
<!--
function checkspace(checkstr) {
  var str = '';
  for(i = 0; i < checkstr.length; i++) {
    str = str + ' ';
  }
  return (str == checkstr);
}
function check()
{
  if(checkspace(document.admininfo.user.value)) {
	document.admininfo.user.focus();
    alert("管理员用户名不能为空！");
	return false;
  }
  if(checkspace(document.admininfo.password.value)) {
	document.admininfo.password.focus();
    alert("密码不能为空！");
	return false;
  }
    if(checkspace(document.admininfo.yzm.value)) {
	document.admininfo.yzm.focus();
    alert("验证码不能为空！");
	return false;
  }
	document.admininfo.submit();
  }
//-->
</script> 
