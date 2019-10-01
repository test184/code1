
<?php 
 include_once "../include/db.php";
 include_once "../include/function.php";
 

$act = make_safe($_GET['act']);
if($act=="addtj"){
	$artid = make_safe($_POST['artid']);
	$tt=getarrsql("select artid from article where artid=:artid",array(':artid' => $artid));
	if (!$tt){
	echo "<script language=javascript>alert( '没有此id的信息！');</script>";	
	}
	else{
		$mypdo = new DBPDO;  
		$sql = "update article set tj=1 where artid=:artid"; 
		$arr = array(
		':artid'=>$artid
	);
		$result = $mypdo->update($sql,$arr);  
		echo "<script language=javascript>alert( '操作完成！');</script>";
	}
	
	
}


if($act=="deltj"){
$artid = make_safe($_GET['artid']);
$mypdo = new DBPDO;  
		$sql = "update article set tj=0 where artid=:artid"; 
		$arr = array(
		':artid'=>$artid
	);
		$result = $mypdo->update($sql,$arr);  
		echo "<script language=javascript>alert( '操作完成！');</script>";


}
?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>


<title></title>

<style type="text/css">
<!--
.STYLE1 {
	font-size: 14px;
	color: #0000FF;
	font-weight: bold;
}
-->
</style>
<script language="JavaScript" type="text/javascript">
function check_input()  
{  
	if (form1.id.value==""){
		alert ("\n请填写id号！");
		document.form1.id.focus();
		return false;
	}
		return true;
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>


<body>
<div align="center">
  <p><br></p>
  <table class="list" width="90%" border="0" cellspacing="1" cellpadding="0">
    
    <tr>
      <th colspan="5" ><div align="center">推荐信息列表</div></th>
    </tr>
    <tr>
      <td width="77" ><div align="center">ID号</div></td>
      <td width="489" ><div align="center">标题</div></td>
      <td width="71" ><div align="center">浏览</div></td>
      <td width="147" ><div align="center">日期</div></td>
      <td width="145" ><div align="center">操作</div></td>
    </tr>
  <?php 


// $rs is of type "ADODB.RecordSet"


$sql="select artid,title,hits,addtime from article where tj =1 order by artid desc";
$rs=getarrsql($sql);
$tjlhsum=0;
if (!$rs) 
{

  echo "<tr><td colspan='5' ><div align='center'>暂时没有记录</div> </td></tr>";
}
  else
{


for ($i=0;$i<count($rs);$i++)
  {

?>	
	
    <tr >
      <td width="77" class="table_td1"><div align="center"><?php echo $rs[$i]['artid']; ?></div></td>
      <td class="table_td1"><a href="../article/<?php echo $rs[$i]['artid']; ?>.html"  target=_blank><?php echo $rs[$i]['title']; ?></a></td>
      <td width="71" class="table_td1"><div align="center"><?php echo $rs[$i]['hits']; ?></div></td>
      <td width="147" class="table_td1"><div align="center"><?php echo $rs[$i]['addtime']; ?></div></td>
      <td width="145" class="table_td1"><div align="center"><a href='?act=deltj&artid=<?php echo $rs[$i]['artid']; ?>'>取消</a></div></td>
    </tr>
<?php 
   

    $tjlhsum=$tjlhsum+1;
  } 
} 



?>	
	
    
    <tr>
      <td colspan="5" ><div align="center">注：推荐信息只显示10条,目前共<?php echo $tjlhsum; ?>条</div>        
        <div align="center"></div></td>
    </tr>
    <tr>
      <td colspan="5" ><table width="90%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td width="58%"><form id="form1" name="form1" onSubmit="return check_input()" method="post" action="TjArticle.php?act=addtj">
            输入推荐信息id号：
            <input name="artid" type="text" id="artid" size="10" />
            <input style="height:20px;" name="Submit" type="submit" class="button" value="提交" />
          </form></td>
          <td width="42%" valign="top"></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p><br>
  </p>
</div>
</body>

</html>

