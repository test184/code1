<?php
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";

?>

<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<script language="JavaScript" type="text/JavaScript">
function checkBig()
{
  if (document.form1.classname.value=="")
  {
    alert("类别名称不能为空！");
    document.form1.classname.focus();
    return false;
  }
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加类别</title>
<style type="text/css">
<!--
.STYLE1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>
<?php 
$action=make_safe($_POST['action']);

$classname=make_safe($_POST['classname']);
if ($action=="add")
{


  $classrs=setsql("select","select * from class where parentid=0 and classname= :classname",array(':classname' => $classname));
  if ($classrs) {
    echo "<script language=javascript>alert( '类别名称已经存在！'  );location.href = 'javascript:history.back()'</script>";

  }
  else
  {
   
    $sql = "INSERT INTO class(classname,parentid,menuis,lmis) VALUES (:classname,:parentid,:menuis,:lmis)";  
	$arr = array(
    ':classname'=>$classname,
	':parentid'=>0,
	':menuis'=>1,
	':lmis'=>1,
    );
    $result = setsql("insert",$sql,$arr); 
	if($result)
	{ 
		 $sql = "update class set menuxh=:menuxhid,lmxh=:lmxhid where classid=:classid"; 
	$arru = array(
	':classid'=>$result,
	':menuxhid'=>$result,
	':lmxhid'=>$result,
	
	
    );
    $resultupdate = setsql("update",$sql,$arru); 
		
		if($resultupdate)
	{
		 header("Location: "."ClassManage.php");}
    } 



  }
}
?>
<body>
<div class="crumb-wrap">
<div class="crumb-list">综合管理<span class="crumb-step">&gt;</span><span class="crumb-name"><a href="ClassManage.php">类别管理</a></span><span class="crumb-step">&gt;</span><span class="crumb-name">添加类别</span></div>
</div>
<div align="center"><br>
    
      <form name="form1" method="post" action="" onSubmit="return checkBig()">
  <table class="table-list" width="350" >
    <tr>
      <th colspan="2" ><div align="center">添加类别</div></th>
    </tr>
    <tr>
      <td ><div align="right">类别名称：</div></td>
      <td ><input name="classname" type="text" size="20" maxlength="30" class="common-text"></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td height="22" align="center" bgcolor="#E3E3E3" class="tdbg"><div align="left" >
          <input name="action" type="hidden" id="action" value="add">
          <input name="Add" type="submit" value="添 加" class="btn btn-primary btn4">
      </div></td>
    </tr>
  </table>
  
  </form>
  <p><br>
    <br>
  </p>
</div>
</body>

</html>

