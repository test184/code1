<?php
include_once "../include/db.php";
include_once "../include/function.php";
$sys = new sysconfig;
$website=$sys->website;

$sys=null;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta content="telephone=no" name="format-detection">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<?php 
$artid=make_safe($_GET['artid']);
if (!empty($_GET['artid'])&&(is_numeric ($_GET['artid']))) {
$arrs=setsql("select","select * from article where artid=:artid",array(':artid' => $artid));
  $newscontent=$arrs[0]['content'];
  $classname=$arrs[0]['classname'];
  $arttitle=$arrs[0]['title'];
  if ($arrs[0]['keywords']!="")
  {

    $Keywords=$arrs[0]['keywords'];
  }
    else
  {

    $Keywords=$arrs[0]['title']."_".$website;
  } 

  if ($arrs[0]['Descrip']!="")
  {

    $Descrip=$arrs[0]['Descrip'];
  }
    else
  {

    $descrip=$arrs[0]['content'];
    $descrip=cutstr_html($descrip,150);
  } 


  $hits=$arrs[0]['hits'];
  $newsdate=formatdata($arrs[0]['addtime']);


}
else{
	ok_info("参数错误！");
}

?>

<title><?php echo $arttitle; ?></title>
<META content="<?php echo $lhkeywords; ?>" name=Keywords>
<META content="<?php echo $lhdescrip; ?>" name=Description>
<!--可无视-->
<link href="../m/css/global.css" rel="stylesheet">
<!--必要样式-->
<link type="text/css" href="../m/css/style.css" rel="stylesheet">
<link href="../m/css/component.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../m/js/jquery.js"></script>
<script type="text/javascript" src="../m/js/modernizr.custom.js"></script>
<script type="text/javascript" src="../m/js/jquery.dlmenu.js"></script>

</head>
<body>

<header class="header">
	<a href="javascript:history.go(-1);" class="back"><span>返回</span></a>
	<span class="sitename"><?php echo $website; ?></span>
	<?php include_once "header.php";?>
</header>

<script type="text/javascript">
$(function(){
	$( '#dl-menu' ).dlmenu();
});
</script>

<div style="text-align:left;margin-bottom:10px; 'MicroSoft YaHei';">

<div class="arttitle"><?php echo $arttitle; ?></div>
<div class="riqi"><?php echo $newsdate; ?></div>
<div class="TextContent">
<?php echo $newscontent; ?>
</div>

</div>


<div class="footer">Copyright &nbsp;<?php echo $website; ?></div>
</body>
</html>
