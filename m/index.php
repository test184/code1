<?php
include_once "../include/db.php";
include_once "../include/function.php";
$sys = new sysconfig;
$website=$sys->website;
$lhkeywords=$sys->lhkeywords;
$lhdescrip=$sys->lhdescrip;
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
<title><?php echo $website; ?></title>
<META content="<?php echo $lhkeywords; ?>" name=Keywords>
<META content="<?php echo $lhdescrip; ?>" name=Description>
<!--可无视-->
<link href="css/global.css" rel="stylesheet">
<!--必要样式-->
<link type="text/css" href="css/style.css" rel="stylesheet">
<link href="css/component.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<script type="text/javascript" src="js/jquery.dlmenu.js"></script>

<script src="js1/min/flickerplate.min.js" type="text/javascript"></script>
<script src="js2/TouchSlide.1.1.js"></script>
<script>
$(document).ready(function(){
	
	$('.flicker-example').flicker();
});
</script>


</head>
<body>

<header class="header">
	
	<span class="sitename"><?php echo $website; ?></span>
	<?php include_once "header.php";?>
</header>

<script type="text/javascript">
$(function(){
	$( '#dl-menu' ).dlmenu();
});
</script>

<div id="slideBox" class="slideBox"><div class="bd">
<div class="tempWrap" style="overflow:hidden; position:relative;">
<ul style="width: 5464px; position: relative; overflow: hidden; padding: 0px; margin: 0px; transition-duration: 0ms; transform: translate(-1366px, 0px) translateZ(0px);">

		<?php 


$picsql="Select * From hd where lb=1 order by xh";
$picrs=setsql("select",$picsql);

for($i=0;$i<count($picrs);$i++)

  {
    $urlm=$picrs[$i]['url'];
    if (strpos($urlm,"article"))
    {

      $urlm=str_replace("/","/m",$urlm);
      $urlm="../".$urlm;
    } 

?>
			<li style="display: table-cell; vertical-align: top; width: 1366px;"><a href="<?php     echo $urlm; ?>"><img src="<?php     echo $picrs[$i]['picture']; ?>" height=300 alt="<?php     echo $picrs[$i]['title']; ?>"></a></li>
			<?php 
   
  } 


?>	
			
			
</ul></div>
</div>
<div class="hd"><ul><li class="on">1</li><li class="">2</li></ul></div></div>
<script type="text/javascript">
TouchSlide({
slideCell:"#slideBox",
titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
mainCell:".bd ul", 
effect:"leftLoop", 
delayTime:"200",
interTime:"4000",
autoPage:true,//自动分页
autoPlay:true //自动播放
});
</script>


<div style="text-align:left;margin-bottom:10px; font:normal 1.0em 'MicroSoft YaHei';">
<?php
$lmsql="select * from class where lmis ='1' and classid not in (select DISTINCT parentid from class) order by lmxh";
$rs = setsql("select",$lmsql);
for($n=0;$n<count($rs);$n++){
	
	
?>
        <li class="li_classname"><?php   echo $rs[$n]['classname']; ?>
		<SPAN class="li_right"><a href="<?php   echo "list.php?classid=".$rs[$n]['classid']; ?>">更多..</a></SPAN>
		</li>
		<?php 
         $lmsql="select artid,title,classid,classname,parentname,parentid,addtime from article where classid=".$rs[$n]['classid']." order by artid desc limit 6";
         $sylmrs = setsql("select",$lmsql);
        for($i=0;$i<count($sylmrs);$i++)
         {


?>
		<li class="li_title">
		<a href="article.php?artid=<?php  echo $sylmrs[$i]['artid']; ?>" title="<?php echo $sylmrs[$i]['title']; ?>"  >
		<?php     echo $sylmrs[$i]['title']; ?>
         </a>
        </li>
       
        <?php 

  
  } }
  ?>
</div>
<div class="footer">Copyright &nbsp;<?php echo $website; ?>&nbsp;<a href="../index.php?#pc">电脑版</a></div>
</body>
</html>
