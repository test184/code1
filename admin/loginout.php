
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 

  echo "<script language='javascript'>alert('您已成功注销登录')</script>";
  session_start();
  session_destroy();
  header("location:index.php");

?>
