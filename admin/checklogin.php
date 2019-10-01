<?php
 include_once "../include/db.php";
 include_once "../include/function.php";
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
$login_name=make_safe($_POST["user"]);
$login_pass=md5($_POST["password"]);
$yzm = $_POST["yzm"];
session_start();
if($yzm!=$_SESSION["Checknum"])
{
ok_info(0,"验证码错误！");
}

	$sql="select * from lhadmin where lhuser = :login_name and lhpassword = :login_pass";
	$mypdo = new DBPDO; ;
	$rs = $mypdo->select($sql,array(':login_name' => $login_name,':login_pass'=>$login_pass));
    if (count($rs)==0){ok_info(0,"用户名或密码错误！");}
	else
	{
	session_start();
	$_SESSION['lh_dluser']=$login_name;
	header("location:manage.php");	
	
		}
	$mypdo = null;
?>

