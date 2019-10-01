<?php

  error_reporting(0);
   header("Content-type:text/html; charset=utf-8");  
  session_start();
  if (!$_SESSION['lh_dluser']) { 
	echo "<br><br><div align='center'>您还没有登录或操作超时请先<a  href=index.php target=_top>登录</a>.</div>";
     exit();
	 }
 
?>
