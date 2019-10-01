<?php
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";
 error_reporting(E_ALL & ~E_NOTICE);
?>

<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<script language="JavaScript" type="text/JavaScript">
function checkadd()
{
  if (document.form1.caidanname.value=="")
  {
    alert("菜单名称不能为空！");
    document.form1.caidanname.focus();
    return false;
  }
  if (document.form1.caidanurl.value=="")
  {
    alert("菜单地址不能为空！");
    document.form1.caidanurl.focus();
    return false;
  }
}

function checkmod()
{
  if (document.form2.caidanname.value=="")
  {
    alert("菜单名称不能为空！");
    document.form2.caidanname.focus();
    return false;
  }
   if (document.form2.caidanurl.value=="")
  {
    alert("菜单地址不能为空！");
    document.form2.caidanurl.focus();
    return false;
  }
  
}
</script>
<?php 
$id = make_safe($_REQUEST['id']);
$action = make_safe($_GET['action']);



//删除操作代码
if ($action=="del" && (!empty($id)))
{
$sql = "delete from cd where id=:id";  
$rs = setsql("delete",$sql,array(':id' => $id));
header("Location: caidan.php");
} 

//删除操作代码结束
//添加操作代码
if ($action=="addsave")
{

  $caidanname = make_safe($_POST['caidanname']);
  $caidanurl = make_safe($_POST['caidanurl']);
  if (empty($caidanname))
  {
    ok_info(0,"菜单名称不能为空");
  } 
 if (empty($caidanurl))
  {
    ok_info(0,"菜单地址不能为空");
  } 


  $crs=setsql("select","select * from cd where cdname= :caidanname",array(':caidanname' => $caidanname));
  if ($crs) {
   ok_info(0,"菜单名字已经存在");

  }
  else
  {

  $sql = "insert into cd(cdname,url) values (:caidanname,:caidanurl)";  
  $arr = array(
    ':caidanname'=>$caidanname,
	':caidanurl'=>$caidanurl,
    );
   $result = setsql("insert",$sql,$arr); 
 
   header("Location: caidan.php");
} 
}

//添加操作代码结束
//修改操作代码
if ($action=="modsave" )
{
 
  $caidanname = make_safe($_POST['caidanname']);
  $caidanurl = make_safe($_POST['caidanurl']);
  if (empty($caidanname))
  {
    ok_info(0,"菜单名称不能为空");
  } 
 if (empty($caidanurl))
  {
    ok_info(0,"菜单地址不能为空");
  } 


  $crs=setsql("select","select * from cd where cdname= :caidanname and id!=:id",array(':caidanname' => $caidanname,':id' => $id));
  if ($crs) {
   ok_info(0,"菜单名字已经存在");

  }
  else
  {
  
    $sql = "update cd set cdname=:caidanname,url=:caidanurl where id=:id"; 
	$arru = array(
	':caidanname'=>$caidanname,
	':caidanurl'=>$caidanurl,
	':id'=>$id,
    );
    $resultupdate = setsql("update",$sql,$arru); 
    header("Location: caidan.php");

  }
  }
?>
<body>
<div class="crumb-wrap">
<div class="crumb-list">综合管理<span class="crumb-step">&gt;</span><span class="crumb-name"><a href="caidan.php">自定义菜单</a></span></div>
<div align="center">
<!--添加表单部分 -->
<?php 
if ($action=="add" && (empty($id)))
{

?>
    <form name="form1" method="post" action="?action=addsave" onSubmit="return checkadd()">
  <table class="table-list" width="541" >
    <tr>
      <th colspan="2" ><div align="center">添加自定义菜单</div></th>
    </tr>
    <tr>
      <td width="77" ><div align="right">菜单名称：</div></td>
      <td width="436" ><input name="caidanname" type="text" id="caidanname" size="30"></td>
    </tr>
    <tr>
      <td ><div align="right">链接地址：</div></td>
      <td ><input name="caidanurl" type="text" id="caidanurl" size="30">
     </td>
    </tr>
    <tr>
      <td class="table_td1">&nbsp;</td>
      <td height="22" align="center" bgcolor="#E3E3E3" class="tdbg"><div align="left" class="table_td2">
          
          <input  name="add" type="submit" class="button" value=" 添 加 ">
      </div></td>
    </tr>
  </table>
  
  </form>
 <?php } ?>
 <!--修改表单部分 -->
<?php 
if ($action=="mod" && (!empty($id)))
{
$sql="select * from cd where id=:id";
$rs=getarrsql($sql,array(':id' => $id));

?>
 <form name="form2" method="post" action="?action=modsave" onSubmit="return checkmod()">
  <table class="table-list" width="542" >
    <tr>
      <th colspan="2" ><div align="center">修改自定义菜单</div></th>
    </tr>
    <tr>
      <td width="77" ><div align="right">ID：</div></td>
      <td width="375" ><?php   echo $rs[0]['id']; ?>
        <input name="id" type="hidden" id="id" value="<?php   echo $rs[0]['id']; ?>">        </td>
    </tr>
    <tr>
      <td ><div align="right">菜单名称：</div></td>
      <td ><input name="caidanname" type="text" id="caidanname" value="<?php   echo $rs[0]['cdname']; ?>" size="30"></td>
    </tr>
    <tr>
      <td ><div align="right">链接地址：</div></td>
      <td ><input name="caidanurl" type="text" id="caidanurl" value="<?php   echo $rs[0]['url']; ?>" size="30">
       </td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td align="center" ><div align="left" class="table_td2">
         
          <input  name="Save" type="submit" class="button" id="Save" value=" 修 改 ">
      </div></td>
    </tr>
  </table> 
  </form>
<?php 
  

} 

?>
</div>
</body>
</html>

