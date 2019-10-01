<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php

include_once "include/db.php";
include_once "include/function.php";
$sys = new sysconfig;
$website=$sys->website;
$lhkeywords=$sys->lhkeywords;
$lhdescrip=$sys->lhdescrip;
$indexjt=$sys->indexjt;
$listjt=$sys->listjt;
$artjt=$sys->artjt;
$sys=null;
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="images/layout.css" rel="stylesheet" type="text/css" />
<script src="include/uaredirect.js" type="text/javascript"></script>
<script type="text/javascript">uaredirect("m");</script>
<META content="<?php echo $lhkeywords; ?>" name=Keywords>
<META content="<?php echo $lhdescrip; ?>" name=Description>
<title><?php echo $website; ?></title>
</head>

<body>
<div id="container">

<?php 
$indexurl=get_index_url($indexjt);
include_once "view/head.php"; 
?>
<div id="breadCrumb"><img src="images/arrow2.gif" alt="当前位置" width="20" height="11" />当前位置 &gt; 首页</div>

<div id="search">	
	  <form id="form1" name="form1" method="post" action="view/search.php">
	  
      <input class="seatext" type="text" name="keyword" />
	  
	  <input class="imageinput" name="image" type="image"  src="images/inputso.gif" width="59" height="24" />
	  </form>	  
</div>

<div class="clearfloat"></div>
<!-- 幻灯片开始-->
<div id="huanding">
<?php include_once "mbfile/dm_index_hd.php"; ?>
</div>	
<!-- 幻灯片结束-->	

<!-- 最新发布开始-->
<div id="newfb">
<?php include_once "mbfile/dm_index_zxfb.php"; ?>
</div>
<!-- 最新发布结束-->

<div style="clear:both;height:7px;"></div>

<!-- 生成首页栏目开始-->
<?php include_once "mbfile/dm_index_lm.php"; ?>
<!-- 生成首页栏目结束-->
<div style="clear:both;height:1px;"></div>
<?php include_once "view/foot.php"; ?>

</div>
</body>
</html>



