<?php
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";

  
$action=make_safe($_GET['action']);

if ($action=="modify")
{
	$id=make_safe($_POST['id']);
	$password=make_safe($_POST['password']);
	$sql = "update lhadmin set lhpassword=:lhpassword where id=:id"; 
	$arr = array(
	':lhpassword'=>md5($password),
	':id'=>$id
	);

    $result = setsql("update",$sql,$arr);
	
	ok_info(0,"修改成功");
	exit();

} 

?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改</title>
<script language="JavaScript" type="text/javascript">
function check_input()  
{  
	
	if (form1.password.value==""){
		alert ("\n请填写密码！");
		document.form1.password.focus();
		return false;
	}
		return true;
}

</script>
<style type="text/css">
<!--
.STYLE1 {
	font-size: 14px;
	color: #0000FF;
	font-weight: bold;
}
.textstype {
	height: 20px;
	width: 100%;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}

-->
</style>
</head>


<body>
<div class="crumb-wrap">
<div class="crumb-list">密码管理<span class="crumb-step">&gt;</span><span class="crumb-name">更改密码</span></div>
</div>
<div align="center">
  
  <?php 
  $sql="select * from lhAdmin where lhuser=:lhuser";
  $rsuser=setsql("select",$sql,array(':lhuser' => $_SESSION['lh_dluser']));

?>
  <form name="form1" method="post" onSubmit="return check_input()" action="?action=modify">
  <input name="id" type="hidden" value="<?php echo $rsuser[0]['id']; ?>">
  
    <table  width="60%" border=0 align=center cellspacing=1 class="table-list"  >
      <tr>
        <th colspan="2" ><div align="center">更改密码</div>
            <div align="center"></div></td>
      </th>
      <tr>
        <td width="78" ><div align="center">用户名：</div></td>
        <td width="146"><?php echo $rsuser[0]['lhuser']; ?></td>
      </tr>
      <tr>
        <td ><div align="center">新密码：</div></td>
        <td ><input name="password" type="password"  id="password" size="20">      </td>
      </tr>
      
    </table>
    
    <table width="299"  border=0 align=center cellspacing=1 class="list1" style="margin-bottom:0px; margin-top:0px;">
      <tr>
        <td><div align="center"></br>
          <label>
          <input  name="Submit3" type="submit" class="btn btn-primary btn3 mr10" value="提交">
          </label>
          <label> &nbsp;
          <input  name="Submit22" type="reset" class="btn btn3" value="重置">
          </label>
</div></td>
      </tr>
    </table>
   
  </form>

 
</div>
</body>

</html>

