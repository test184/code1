<?php

include_once "../include/db.php";
include_once "../include/function.php";
include_once "../mbfile/mb_fun.php";

$sys = new sysconfig;
$newsperpage=$sys->newsperpage;
$website=$sys->website;
$lhkeywords=$sys->lhkeywords;
$lhdescrip=$sys->lhdescrip;
$indexjt=$sys->indexjt;
$listjt=$sys->listjt;
$artjt=$sys->artjt;
$sys=null;

if (!empty($classid)&&(is_numeric ($classid)))
{
	$sql="select * from class where classid=:classid";
	$lrs = getarrsql($sql,array(':classid'=>$classid));
    include "../mbfile/dm_list_pub.php";
}

if (!empty($_REQUEST['classid'])&&(is_numeric ($_REQUEST['classid'])))
{
	$classid = make_safe($_REQUEST['classid']);
	$sql="select * from class where classid=:classid";
	$lrs = getarrsql($sql,array(':classid'=>$classid));
	include "../mbfile/dm_list_pub.php";
}


if(empty($mb_title)){$mb_title="{title}";}
if(empty($mb_keywords)){$mb_keywords="{keywords}";}
if(empty($mb_descrip)){$mb_descrip="{descrip}";}
if(empty($mb_listweizhi)){$mb_listweizhi="{listweizhi}";}
if(empty($mb_dhlbname)){$mb_dhlbname="{dhlbname}";}
if(empty($mb_subclassdh)){$mb_subclassdh="{subclassdh}";}

if(empty($mb_newarticle)){$mb_newarticle="{newarticle}";}
if(empty($mb_rmarticle)){$mb_rmarticle="{rmarticle}";}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../images/layout.css" rel="stylesheet" type="text/css" />
<TITLE><?php echo $mb_title;?></TITLE> 
<META name="keywords" content="<?php echo $mb_keywords;?>"> 
<META name="description" content="<?php echo $mb_descrip;?>">
</head>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<body>
<div id="container">
<?php 
$alurl="../";
$indexurl="../";
include "head.php";
?>
  <div id="breadCrumb"><img src="../images/arrow2.gif" alt="当前位置" width="20" height="11" />当前位置：<span style="padding-top:4px;"> <?php echo $mb_listweizhi;?></span></div>
  
  <div id="search">	
	  <form id="form1" name="form1" method="post" action="../view/search.php">
	 
      <input class="seatext" type="text" name="keyword" />
	 
	  <input class="imageinput" name="image" type="image"  src="../images/inputso.gif" width="59" height="24" />
	  </form>	  
	</div>
  
  <div class="clearfloat"></div>
  <div id="mainContent">
   <div id="content">
	
<?php
if(!empty($classid)){
	if (issc($classid)==1) { 
			
		require_once "../mbfile/dm_list_b.php";
		}
	else
		{
		require_once "../mbfile/dm_list_sub.php";
		}
}
else
{
?>
    <div id="listcontent">
	<div class="clearfloat"></div>
	 {listcontent}
	<div class="listpage">{pagecontent}</div>
	</div>	
<?php
}
?>	
    
	</div>
    <div id="sidebar">
	
	  
	<div class="sidebarsub">
	  <div class="columns_title">
	    <div class="columns_tb"></div><div class="columns_name">最新文章</div>
	    </div>
		  <div class="columns_content">
		    <?php echo $mb_newarticle;?>
	    </div>
	  </div>
	<!--广告位置 -->
    <div class="sidebarsub">
	    <div class="columns_title">
	      <div class="columns_tb"></div><div class="columns_name">热门文章</div>
	    </div>
		  <div class="columns_content">
		     <?php echo $mb_rmarticle;?>
	    </div>
	  </div>
	
	<!--广告位置 -->
	</div>
  </div>
  <div class="clearfloat"></div>
<?php 
include "foot.php";
?>
</div>
</body>
</html>

