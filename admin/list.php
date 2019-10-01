
<?php

error_reporting(0);
?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改信息列表</title>

<style type="text/css">
<!--
.STYLE1 {
	font-size: 14px;
	color: #0000FF;
	font-weight: bold;
}
-->
</style>
</head>


<body>
<div align="center">
  
  <table  width="70%" align="center" class="table-list">
    <tr>
      <th colspan="2"><div align="center" >服务器信息</div></th>
    </tr>

    <tr>
      <td >&nbsp;操作系统</td>
      <td >&nbsp;<?php echo strtoupper(substr(PHP_OS,0,3)) === "WIN" ? "window操作系统" : "linux操作系统" ?></td>
    </tr>
    <tr>
      <td >&nbsp;web 服务器</td>
      <td >&nbsp;<?php echo $_SERVER['SERVER_SOFTWARE'] ?></td>
    </tr>
    <tr>
      <td >&nbsp;服务器IP</td>
      <td >&nbsp;<?php echo $_SERVER['SERVER_ADDR'] ; ?></td>
    </tr>
    <tr>
      <td >&nbsp;服务器端口</td>
      <td >&nbsp;<?php echo $_SERVER['SERVER_PORT'] ; ?></td>
    </tr>
    <tr>
      <td >&nbsp;服务器时间</td>
      <td >&nbsp;<?php date_default_timezone_set('PRC'); echo date('Y-m-d H:i:s'); ?></td>
    </tr>
    <tr>
      <td >&nbsp;php 版本</td>
      <td >&nbsp;<?php echo phpversion() ?></td>
    </tr>
    <tr>
      <td >&nbsp;支持 mysql</td>
      <td >&nbsp;<?php echo extension_loaded('mysql') &&function_exists('mysql_connect')?'√支持Mysql':'×不支持Mysql'; ?></td>
    </tr>
    
    <tr>
      <td >&nbsp;程序制作</td>
      <td > 版权所有：<a href="http://www.strongfire.cn" target="_blank">烈火工作室</a> <STRONG>QQ</STRONG>:839225572<span class="table_td2">(火烈鸟)</span><br></td>
    </tr>
    
    <tr>
      <td colspan="2" ><div align="center"></div>        
      <div align="center"></div></td>
    </tr>
  </table>
  <p><br>
  </p>
</div>
</body>

</html>

