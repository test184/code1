<?php
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";

?>

<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<script language="JavaScript" type="text/JavaScript">
function checkSmall()
{
  if (document.form1.subclassname.value=="")
  {
    alert("类别名称不能为空！");
	document.form1.subclassname.focus();
	return false;
  }

 
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加子类</title>
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
$action=make_safe($_GET['action']);
$parentid=make_safe($_GET['parentid']);


if ($action=="add")
{

  $subclassname=make_safe($_POST['subclassname']);
  $classrs=getarrsql("select * from class where parentid=:parentid and classname= :subclassname",array(':subclassname' => $subclassname,':parentid'=>$parentid));
  if ($classrs) {
    echo "<script language=javascript>alert( '类别名称已经存在！'  );location.href = 'javascript:history.back()'</script>";

  }
 
 else{
    $mypdo = new DBPDO;  
    $sql = "INSERT INTO class(classname,parentid,menuis,lmis) VALUES (:subclassname,:parentid,:menuis,:lmis)";  
	$arr = array(
    ':subclassname'=>$subclassname,
	':parentid'=>$parentid,
	':menuis'=>1,
	':lmis'=>1,
    );
    $result = $mypdo->insert($sql,$arr); 
	if($result)
	{
	$sql = "update class set menuxh=:menuxhid,lmxh=:lmxhid where classid=:classid"; 
	$arru = array(
	':classid'=>$result,
	':menuxhid'=>$result,
	':lmxhid'=>$result,
    );
    $resultupdate = $mypdo->update($sql,$arru); 
		
		if($resultupdate)
	{
		 header("Location:"."ClassManage.php");}
    } 



  }
}
?>
<body>
<div class="crumb-wrap">
<div class="crumb-list">综合管理<span class="crumb-step">&gt;</span><span class="crumb-name"><a href="ClassManage.php">类别管理</a></span><span class="crumb-step">&gt;</span><span class="crumb-name">添加子类</span></div>
<div align="center">
    
<form name="form1" method="post" action="?action=add&parentid=<?php   echo $parentid; ?>" onSubmit="return checkSmall()">  
<table class="table-list" width="350" >
    <tr>
      <th colspan="2" ><div align="center">添加子类</div></th>
    </tr>
    <tr>
      <td ><div align="right">所属类别：</div></td>
      
      <td ><?php echo getclassname($parentid); ?></td>
    </tr>
    <tr>
      <td ><div align="right">子类名称：</div></td>
      <td ><input name="subclassname" type="text" size="20" maxlength="30" class="common-text"></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td height="22" align="center" bgcolor="#E3E3E3" class="tdbg"><div align="left">
          <input name="add" type="submit" value="添 加" class="btn btn-primary btn4">
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

