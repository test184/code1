<?php
include_once "../include/db.php";
include_once "../include/function.php";
$sys = new sysconfig;
$website=$sys->website;
$lhkeywords=$sys->lhkeywords;
$lhdescrip=$sys->lhdescrip;
$newsperpage=$sys->newsperpage;
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
if (!empty($_GET['classid'])&&(is_numeric ($_GET['classid'])))
{
$classid = make_safe($_GET['classid']);
}
else{ok_info("参数错误");}
$sql="select * from class where classid=:classid";
$rs = setsql("select",$sql,array(':classid'=>$classid));
$classname=$rs[0]['classname'];


?>
<title><?php echo $classname; ?>_<?php echo $website; ?></title>
<META content="<?php echo $classname; ?>,<?php echo $website; ?>" name=Keywords>
<META content="<?php echo $classname; ?>,<?php echo $website; ?>" name=Description>
<!--可无视-->
<link href="css/global.css" rel="stylesheet">
<!--必要样式-->
<link type="text/css" href="css/style.css" rel="stylesheet">
<link href="css/component.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<script type="text/javascript" src="js/jquery.dlmenu.js"></script>

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

<div style="text-align:left;margin-bottom:10px; font:normal 1.0em 'MicroSoft YaHei';">
<li class="li_classname"><?php echo $classname; ?></li>
<?php 
    $ziduan="artid,title,hits,addtime";
	if (issc($classid)){
		$tj="article where parentid = :classid order by artid";
	}
	else{
		$tj="article where classid = :classid order by artid";
	}
	
 	$countsql="Select count(*)as amount From $tj";
    $amount =getcount($countsql,array(':classid' => $classid)); //$amount的值为记录条数，是个整数
	
	$PageSize = $newsperpage; //每页显示多少条记录
	
	$PageCount=getPageCount($amount,$PageSize);//$PageCount表示总共有多少页
	
        
	 //接收page参数
	 if(isset($_REQUEST['page'])&&(is_numeric ($_REQUEST['page'])))
	 {
		 $page = intval($_REQUEST['page']);
		 if ($page>$PageCount){$page=$PageCount;} 
	  }
	  else
	  {$page = 1;}
	  
	 $sql="select $ziduan from $tj desc limit ".($page-1)*$PageSize.",".$PageSize;
	 $mypdo = new DBPDO; ;
	 $rs = $mypdo->select($sql,array(':classid' => $classid));
	 $mypdo = null;//关闭数据库资源
	 for ($i=0; $i<count($rs); $i=$i+1)
	 {
	 $title=$rs[$i]['title'];
	 $turl="article.php?artid=".$rs[$i]['artid'];
	 

?>	
     <li class="li_title">
		<a href=<?php     echo $turl; ?> title="<?php     echo $rs[$i]['title']; ?>"  >
		<?php  echo $rs[$i]['title']; ?>
         </a>
     </li>
		
    <?php  } ?>
    
    
</div>

<?php   
if ($PageCount>1){
$pagecanshu="classid=".$classid;?>


<div class="listpage">
	<form method=Post  id='pageform' name='pageform' action="?<?php echo $pagecanshu?>">
 <?php 

 
if (count($rs)>0) {  
	if($page==1){ echo "<span class=\"button white\" >首页</span> <span class=\"button white\">上一页</span>&nbsp;";}
    else
    {
      echo "<a class=\"button white\" href=?".$pagecanshu."&page=1>首页</a>&nbsp;";
      echo "<a class=\"button white\" href=?".$pagecanshu."&page=".($page-1).">上一页</a>&nbsp;";
    } 

    if(($page==$PageCount)||($PageCount==0)){ echo "<span class=\"button white\">下一页</span> <span class=\"button white\">尾页</span>";}
    else
	{
     echo "<a class=\"button white\" href=?".$pagecanshu."&page=".($page+1).">";
     echo "下一页</a> <a class=\"button white\" href=?".$pagecanshu."&page=".$PageCount.">尾页</a>";
    } 
	
     echo "&nbsp;<strong><font color=red>".$page."</font>/".$PageCount."</strong>";
    
}
?>

</form>
</div>
<?php }?>
<br>
<div class="footer">Copyright &nbsp;<?php echo $website; ?></div>
</body>
</html>
