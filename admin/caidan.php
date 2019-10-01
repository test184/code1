<?php
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";

?>
<html>
<head>
<script language="JavaScript" type="text/JavaScript">
function ConfirmDelyq()
{
   if(confirm("确定要删吗"))
     return true;
   else
     return false;	 
}
</script>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>菜单管理</title></head>

<body>
<div class="crumb-wrap">
<div class="crumb-list">综合管理<span class="crumb-step">&gt;</span><span class="crumb-name">自定义菜单</span></div>

<div align="center">
  
      <img src="images/add.jpg" width="16" height="16" style="padding-bottom:3px;"><a href="caidanedit.php?action=add"><span class="STYLE2"> 添加自定义菜单</span> </a>
      
    
      <table class="table-list" width="700" >
	  <tr>
          <th colspan="3" >自定义菜单管理</th>
          </tr>
        <tr>
          <td width="31%" ><div align="center">菜单名称</div></td>
          <td width="48%" ><div align="center">链接地址</div></td>
          <td width="21%" ><div align="center">操作选项</div></td>
        </tr>	
		<?php 
		
	$sql="select * from cd";
    $rsyq=setsql("select",$sql);
    for($i=0;$i<count($rsyq);$i++){
?>		 
        <tr>
          <td ><?php echo $rsyq[$i]['cdname'];?></td>
          <td ><div align="left"><?php   echo $rsyq[$i]['url']; ?></div></td>
          <td ><div align="center"><a href="caidanedit.php?action=mod&id=<?php   echo $rsyq[$i]['id']; ?>">修改</a> | <a href="caidanedit.php?action=del&id=<?php   echo $rsyq[$i]['id']; ?>" onClick="return ConfirmDelyq();">删除</a> &nbsp;</div></td>
        </tr>
		<?php 
 
} 
?>
      </table>
      <table  width="500" >
        <tr>
          <td> 
            <div align="center">如果添加了自定义菜单，自定义菜单将显示在自动生成菜单的后面</br>
            链接地址不要填&quot;相对地址&quot;，要添加&quot;绝对根地址&quot;，否则不能正确链接 </div>
		  </td>
        </tr>
      </table>
   
</div>

</body>
</html>


