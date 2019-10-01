
<?php 
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";



$classid = make_safe($_GET['classid']);

$action = make_safe($_GET['action']);
if($action=="edit")
{
	if (is_numeric ($_POST['menuxh'])) 
	{$menuxh = make_safe($_POST['menuxh']);}
	else{
	ok_info(0,"菜单序号不正确");
	}
	
	if (is_numeric ($_POST['lmxh']))
	{$lmxh = make_safe($_POST['lmxh']);}
	else{
	ok_info(0,"栏目序号不正确");
	}
	
	$newclassname = make_safe($_POST['newclassname']);
	
		 $mypdo = new DBPDO;  
		
   		 $sql = "update class set classname=:newclassname,lmxh=:lmxh,menuxh=:menuxh where classid=:classid"; 
		 
	 	 $arr = array(
 	    ':newclassname'=>$newclassname,
		':lmxh'=>$lmxh,
		':menuxh'=>$menuxh,
		':classid'=>$classid
		);
   		 $result = $mypdo->update($sql,$arr);  
		
		 
		 $sql = "update article set classname=:newclassname where classid=:classid"; 
		 
	 	 $arr = array(
 	    ':newclassname'=>$newclassname,
		':classid'=>$classid
		);
   		 $result = $mypdo->update($sql,$arr);  
		 
		
		 header("Location: "."ClassManage.php");
		
	
}

$sql="select * from class where classid=:classid";
$rsclass=getarrsql($sql,array(':classid' => $classid));
$classname=$rsclass[0]['classname'];
$lmxh=$rsclass[0]['lmxh'];
$menuxh=$rsclass[0]['menuxh'];
?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<script language="JavaScript" type="text/JavaScript">
function checkBig()
{
  if (document.form1.newclassname.value=="")
  {
    alert("类别名称不能为空！");
    document.form1.newclassname.focus();
    return false;
  }
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改类别名称</title>
<style type="text/css">
<!--
.STYLE1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<div class="crumb-wrap">
<div class="crumb-list">综合管理<span class="crumb-step">&gt;</span><span class="crumb-name"><a href="ClassManage.php">类别管理</a></span></div>
<div align="center">
    
      <form name="form1" method="post" action="?classid=<?php echo $classid; ?>&action=edit" onSubmit="return checkBig()">
  <table class="table-list" width="350" >
    <tr>
      <th colspan="2"><div align="center">修改类别名称</div></th>
    </tr>
    <tr>
      <td ><div align="right">类别id：</div></td>
      <td ><?php echo $classid; ?>
        </td>
    </tr>
    <tr>
      <td ><div align="right">类别名称：</div></td>
      <td ><input name="newclassname" type="text" id="newclassname" value="<?php  echo $classname; ?>" size="20" maxlength="30" class="common-text"></td>
    </tr>
    <tr>
      <td ><div align="right">菜单显示序号：</div></td>
      <td align="center" bgcolor="#E3E3E3" class="tdbg"><div align="left">
        <input name="menuxh" type="text" value="<?php  echo $menuxh ?>" size="5" class="common-text">
      </div></td>
    </tr>
	<?php
      if (issc($classid)==0)
       { echo "<tr>";}
	  else
	  
	   { echo " <tr style=\"display:none\">";}

?>
   
      <td ><div align="right">首页栏目显示序号：</div></td>
      <td align="center" bgcolor="#E3E3E3" class="tdbg"><div align="left">
        <input name="lmxh" type="text" value="<?php  echo $lmxh ?>" size="5" class="common-text">
      </div></td>
    </tr>
	
    <tr>
      <td >&nbsp;</td>
      <td align="center" bgcolor="#E3E3E3" class="tdbg"><div align="left" >
          <input name="Action" type="hidden" id="Action" value="Modify">
          <input name="Save" type="submit" id="Save" value="修 改" class="btn btn-primary btn4">
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


