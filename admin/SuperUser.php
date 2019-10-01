<?php
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";

  
$action=make_safe($_GET['action']);


if ($action=="del")
{
  $id=make_safe($_GET['id']);
  $sql="delete from lhadmin where id=:id";
  $rs = setsql("delete",$sql,array(':id'=>$id));  
} 


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
.STYLE2 {color: #0000CC}
.textstype {
	height: 20px;
	width: 100%;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
#lmgl { 
	 display:none;
}

-->
</style>

</head>


<body>
<div class="crumb-wrap">
<div class="crumb-list">系统管理<span class="crumb-step">&gt;</span><span class="crumb-name">用户管理</span></div>
</div>

<div align="center">
 <br><img src="images/add.jpg" width="16" height="16" style="padding-bottom:3px;"><a href="SuperUserAdd.php"><span class="STYLE2"> 添加用户</span> </a>
  <table width="60%" class="table-list">
    <tr>
      <th colspan="5" >用户列表</th>
    </tr>
    <tr>
      <td width="34" ><div align="center">ID号</div></td>
      <td width="120" ><div align="center">用户名</div></td>
      <td width="82" ><div align="center">管理权限</div></td>
      <td width="82" ><div align="center">修改</div></td>
      <td width="83" ><div align="center">删除</div></td>
    </tr>
	
	<?php 
// $rs is of type "ADODB.RecordSet"
$rs=setsql("select","select * From lhadmin");
for($i=0;$i<count($rs);$i++)
{

?>
    <tr>
      <td width="34" ><div align="center"><?php   echo $rs[$i]['id']; ?></div></td>
      <td ><div align="center"><?php   echo $rs[$i]['lhuser']; ?></div></td>
      <td width="82" ><div align="center">
        <?php if($rs[$i]['dj']==1) echo "<font color=#0033CC>网站管理员</font>" ;
	   if($rs[$i]['dj']==2) echo "信息录入员" ;
	  ?>
      </div></td>
       <td width="82" ><div align="center"><a href="SuperUserModify.php?id=<?php echo $rs[$i]['id']?>">修改</a></div></td>
      <td width="83" ><div align="center"><a href="SuperUser.php?id=<?php echo $rs[$i]['id']?>&action=del" onClick="return confirm('确定要删除吗？')">删除</a></div></td>
     </tr>
<?php }?> 
  </table>
  
  
 
</div>
</body>

</html>

