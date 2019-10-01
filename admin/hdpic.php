<?php
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";
 
?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>幻灯管理</title>
<style type="text/css">
<!--
.STYLE1 {color: #0000FF}
.STYLE2 {color: #0000CC}
-->
</style>
<script language = "JavaScript">
function go(URL,cfmText)
{
	var ret;
	ret = confirm(cfmText);
	if(ret!=false)window.location=URL;
}

 </script>
</head>

<?php 

$lb=make_safe($_GET['lb']);

$sql="Select * From hd where lb=:lb order by xh";
$rspic = setsql("select",$sql,array(':lb'=>$lb)); 

if ($lb==1) {
	$dhname="首页幻灯图片管理";
}
else{
	$dhname="快速链接图片管理";
}

?>
<body>
<div class="crumb-wrap">
<div class="crumb-list">综合管理<span class="crumb-step">&gt;</span><span class="crumb-name"><?php echo $dhname; ?></span></div>
</div>
<div align="center">      
     <br><img src="images/add.jpg" width="16" height="16" style="padding-bottom:3px;"><a href="hdadd.php?lb=<?php echo $lb; ?>"><span class="STYLE2"> 添加图片</span> </a>
      <table class="table-list" width="800" >
       
        <tr>
          <th width="10%" ><div align="center">显示序号</div></th>
          <th width="50%" ><div align="center">幻灯标题/链接</div></th>
          <th width="24%" ><div align="center"> 图片</div></th>
          <th width="16%" ><div align="center">操作选项</div></th>
        </tr>
		
		<?php for($i=0;$i<count($rspic);$i++)
{
?>
		 
        <tr>
          <td valign="middle" ><p align="center"><?php   echo $rspic[$i]['xh']; ?></p>            </td>
          <td ><p><span class="STYLE1">标题</span>：<?php   echo $rspic[$i]['title']; ?></p>
            <p><span class="STYLE1">链接</span>：<?php   echo $rspic[$i]['url']; ?></p></td>
          <td ><div align="center"><?php   if (!empty($rspic[$i]['picture']))
  {
?><img src="<?php     echo $rspic[$i]['picture']; ?>" width="150" height="120">
              <?php   } ?></div></td>
          <td ><div align="center">
            <p><a href="hdModify.php?lb=<?php   echo $lb; ?>&id=<?php   echo $rspic[$i]['id']; ?>">修改</a> | <a href="javascript:go('hddel.php?lb=<?php   echo $lb; ?>&id=<?php   echo $rspic[$i]['id']; ?>','您确定要删除？')">删除</a></p>
            </div></td>
        </tr>
		<?php 


} 
?>
      </table></div>
      <p>&nbsp;</p>  


</body>
</html>


