<?php
include_once "../include/db.php";
include_once "../include/function.php";
include_once "../mbfile/mb_fun.php";

$sys = new sysconfig;
$website=$sys->website;
$lhkeywords=$sys->lhkeywords;
$lhdescrip=$sys->lhdescrip;
$indexjt=$sys->indexjt;
$listjt=$sys->listjt;
$artjt=$sys->artjt;
$showhit=$sys->showhit;
$sys=null;
if (!empty($_GET['artid'])&&(is_numeric ($_GET['artid']))) 
{
$artid = make_safe($_GET['artid']);

$sql="select * from article where artid=:artid";
$rs = setsql(select,$sql,array(':artid'=>$artid));
$i=0;
include_once "../mbfile/dm_art_pub.php";
}

if(empty($mb_title)){$mb_title="{title}";}
if(empty($mb_keywords)){$mb_keywords="{keywords}";}
if(empty($mb_descrip)){$mb_descrip="{descrip}";}
if(empty($mb_artweizhi)){$mb_artweizhi="{artweizhi}";}
if(empty($mb_dhlbname)){$mb_dhlbname="{dhlbname}";}
if(empty($mb_subclassdh)){$mb_subclassdh="{subclassdh}";}
if(empty($mb_zhengwenlb)){$mb_zhengwenlb="{zhengwenlb}";}
if(empty($mb_addtime)){$mb_addtime="{addtime}";}
if(empty($mb_hits)){$mb_hits="{hits}";}
if(empty($mb_content)){$mb_content="{content}";}

if(empty($mb_newarticle)){$mb_newarticle="{newarticle}";}
if(empty($mb_rmarticle)){$mb_rmarticle="{rmarticle}";}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../images/layout.css" rel="stylesheet" type="text/css" />
<TITLE><?php echo $mb_title;?></TITLE> 
<META content="<?php echo $mb_keywords;?>" name=Keywords>
<META content="<?php echo $mb_descrip;?>" name=Description>
</head>

<body>
<div id="container">
<?php 
$alurl="../";
$indexurl="../";
include "head.php";
?>

 <div id="breadCrumb"><img src="../images/arrow2.gif" alt="当前位置" width="20" height="11" />当前位置：<span style="padding-top:4px;"><?php echo $mb_artweizhi;?></span> &gt; 文章内容</div>
   <div id="search">	
	  <form id="form1" name="form1" method="post" action="../view/search.php">
	 
      <input class="seatext" type="text" name="keyword" />
	 
	  <input class="imageinput" name="image" type="image"  src="../images/inputso.gif" width="59" height="24" />
	  </form>	  
	</div>
  
  <div class="clearfloat"></div>
  <div id="mainContent">
    <div id="content">
	
	<div id="articlecontent">
	
	<h1><?php echo $mb_title;?></h1>
	
	<div class="artbz"><?php echo $mb_hits;?>&nbsp;&nbsp;&nbsp;<?php echo $mb_addtime;?></div>
	<div class="hrline"></div>
	<br/>
	<div class="artcontentcss"><?php echo $mb_content;?></div>
    <br/>
    
	
	


	</div>
	
	
	<!--广告位置 -->
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

