<?php
  session_start();
  include_once "islogin.php";
  include_once "../include/db.php";
  include_once "../include/function.php";
  $sys = new sysconfig;
  $indexjt=$sys->indexjt;
  $listjt=$sys->listjt;
  $artjt=$sys->artjt;
  $sys=null;
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
 html { overflow-x:hidden; } 
</style>
<link href="images/style.css" rel="stylesheet" type="text/css" />
</head>
<body  style=" background:url(images/leftybg.gif) repeat-y;scrollbar-3dlight-color:#c1c1c1; scrollbar-arrow-color:#FFFFFF; scrollbar-base-color:#CFCFCF; scrollbar-darkshadow-color:#FFFFFF; scrollbar-face-color:#CFCFCF; scrollbar-highlight-color:#FFFFFF; scrollbar-shadow-color:#c1c1c1;overflow-x:hidden;">
<script type="text/javascript">
if (document.getElementById){ //DynamicDrive.com change
document.write('<style type="text/css">\n')
document.write('.submenu{display: none;}\n')
document.write('</style>\n')
}
function SwitchMenu(obj){
if(document.getElementById){
var el = document.getElementById(obj);
var ar = document.getElementById("masterdiv").getElementsByTagName("span"); //DynamicDrive.com change
if(el.style.display != "block"){ //DynamicDrive.com change
for (var i=0; i<ar.length; i++){
if (ar[i].className=="submenu") //DynamicDrive.com change
ar[i].style.display = "none";
}
el.style.display = "block";
}else{
el.style.display = "none";
}
}
}
</script>
<div class="pub_left">
<p><img src="images/mlgl.gif" /></p>
<div class="pub_lbot">

  <div id="masterdiv">
  <?php
  $sql="select * from lhadmin where lhuser =:lhuser";
  $rsclass=setsql("select",$sql,array(':lhuser'=>$_SESSION['lh_dluser']));

  if($rsclass[0]['dj']==1){
  ?>
    <div class="menutitle" style="background:url(images/left1.gif) no-repeat;" onClick="SwitchMenu('sub1')">信息管理</div>
    <span class="submenu" id="sub1" style="display:block">
    <p><a href="ArticleAdd.php" target="main">发布信息</a></p>
    <p><a href="ArticleModSelClass.php" target="main">修改信息</a></p>
   
    </span>
    
    <div class="menutitle" style="background:url(images/left3.gif) no-repeat;" onClick="SwitchMenu('sub2')">综合管理</div>
    <span class="submenu" id="sub2">
	<p><a href="ClassManage.php" target="main">类别管理</a></p>
    
     <?php 
	 $filename = '../mbfile/mbadmin.php'; 
     if (file_exists($filename)) { 
	 include "../mbfile/mbadmin.php" ;
     }
	 if(empty($hdpic1)){ 
	 ?>
     <p><a href="hdpic.php?lb=1" target="main">幻灯图片</a></p>
     <?php } 
	 if(empty($hdpic2)){ 
	 ?>
     <p><a href="hdpic.php?lb=2" target="main">快速链接</a></p>
     <?php } ?>
     <p><a href="caidan.php" target="main">自定义菜单</a></p>
     
    </span>
    
    <div class="menutitle" style="background:url(images/left4.gif) no-repeat;" onClick="SwitchMenu('sub3')">系统管理</div>
    <span class="submenu" id="sub3">
    <p><a href="sysset.php" target="main">系统设置</a></p>  
    <p><a href="SuperUser.php" target="main">用户管理</a></p>
    
    </span>
 <?php
  }
  else
  {
 ?>
    <div class="menutitle" style="background:url(images/left1.gif) no-repeat;" onClick="SwitchMenu('sub1')">信息管理</div>
    <span class="submenu" id="sub1" style="display:block">
    <p><a href="ArticleAdd.php" target="main">发布信息</a></p>
    <p><a href="ArticleModSelClass.php" target="main">修改信息</a></p>
    <?php if($indexjt||$listjt||$artjt){ ?>
	<p><a href="HtmlMake.php" target="main">生成静态页</a></p>
    <?php } ?>
    </span>
 
    <div class="menutitle" style="background:url(images/left4.gif) no-repeat;" onClick="SwitchMenu('sub2')">密码管理</div>
    <span class="submenu" id="sub2">
    
    <p><a href="SuperUserModify_b.php" target="main">更改密码</a></p>
    </span>
 	
 <?php
  }
 ?>
   </div>

</div>
</div>
 
</body>

</html>

