<?php
error_reporting(0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<style type="text/css">
<!--
.top_h1 {	font-size: 16px;
	font-weight: normal;
	color: #ffffff;
}
-->
</style>
</head>
<body>
<table width="100%" height="88" border="0" cellpadding="0" cellspacing="0" background="images/top_bg.jpg">
  <tr>
    <td height="88"><table width="100%" height="76" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="381" height="76" valign="middle"><img src="images/logo.png"  border="0" /></td>
        <td width="21" >&nbsp;</td>
        <td width="611"><table height="98" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="203" align="center"><span class="top_h1"><?php echo date("Y年m月d日"). "星期" . mb_substr( "日一二三四五六",date("w"),1,"utf-8" );  ?></span></td>
            <td width="111" align="center">&nbsp;</td>
            <td width="123" align="center"><a href="../" target="_blank"><img src="images/top_nav4.png" width="73" height="63" border="0" /></a></td>
            <td width="88" align="center"><a href="loginout.php" target="_top" class="blue" onclick="return confirm('确定要退出吗？');"><img src="images/top_nav10.png" width="73" height="63" border="0" /></a></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
