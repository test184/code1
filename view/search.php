<?php
error_reporting(E_ALL & ~E_NOTICE);
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

if(!empty($_REQUEST['keyword']))
{
	$searchkeys = make_safe($_REQUEST['keyword']);
	$tj="article where title like :searchkeys ".$lmstrsql." order by artid";
 	$countsql="Select count(*)as amount From $tj";	
    $amount =getcount($countsql,array(':searchkeys' =>'%'.$searchkeys.'%')); //$amount的值为记录条数，是个整数

}
else{
ok_info(0,"参数错误");
}
$PageSize =$newsperpage; //每页显示多少条记录
	
	$PageCount=getPageCount($amount,$PageSize);//$PageCount表示总共有多少页

        
	 //接收page参数
	 if(isset($_REQUEST['page'])&&(is_numeric ($_REQUEST['page'])))
	 {
		 $page = intval($_REQUEST['page']);
		 if ($page>$PageCount){$page=$PageCount;} 
	  }
	  else
	  {$page = 1;}
  
	 $ziduan="artid,title,hits,addtime,classid,classname";
	 $sql="select $ziduan from $tj desc limit ".($page-1)*$PageSize.",".$PageSize;
     $rs = setsql("select",$sql,array(':searchkeys' => '%'.$searchkeys.'%'));
	 $pagecanshu="keyword=".$searchkeys;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../images/layout.css" rel="stylesheet" type="text/css" />
<TITLE><?php echo $website;?></TITLE> 
<META name="keywords" content="<?php echo $website;?>"> 
<META name="description" content="<?php echo $website;?>">
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
  <div id="breadCrumb"><img src="../images/arrow2.gif" alt="当前位置" width="20" height="11" />当前位置：<span style="padding-top:4px;"> 站内搜索</span></div>
  
  <div id="search">	
	  <form id="form1" name="form1" method="post" action="../view/search.php">
	 
      <input class="seatext" type="text" name="keyword" />
	 
	  <input class="imageinput" name="image" type="image"  src="../images/inputso.gif" width="59" height="24" />
	  </form>	  
	</div>
  
  <div class="clearfloat"></div>
  <div id="mainContent">
   <div id="content">
	
<div id="listcontent">
	<div class="clearfloat"></div>
<?php
	
	 for ($i=0; $i<count($rs); $i=$i+1)
	 {
	 $title=cutstr_html($rs[$i]['title'],40);
	 $turl=$alurl.get_art_url($artjt,$rs[$i]['artid']);
	 $hits=$rs[$i]['hits'];
	 $addtime=formatdata($rs[$i]['addtime']);
	
	 echo "<dl><dt>·<a href=\"".$turl."\"target=_blank>".$title."</a></dt><dd>".$addtime."</dd></dl>" ."\r\n";

	 
	 }
	 if(count($rs)==0){echo "<br><div align=center>没有符合要求的文章</div><br>";}

?>
  
<div class="listpage">


<form method=Post  id='pageform' name='pageform' action="?<?php echo $pagecanshu?>">
 <?php 
if($PageCount>1){//如果只有一页，则不显示翻页
 
if (count($rs)>0) {  
	if($page==1){ echo "首页 上一页&nbsp;";}
    else
    {
      echo "<a href=?".$pagecanshu."&page=1>首页</a>&nbsp;";
      echo "<a href=?".$pagecanshu."&page=".($page-1).">上一页</a>&nbsp;";
    } 

    if(($page==$PageCount)||($PageCount==0)){ echo "下一页 尾页";}
    else
	{
     echo "<a href=?".$pagecanshu."&page=".($page+1).">";
     echo "下一页</a> <a href=?".$pagecanshu."&page=".$PageCount.">尾页</a>";
    } 
	
     echo "&nbsp;页次：<strong><font color=red>".$page."</font>/".$PageCount."</strong>页 ";
     echo "&nbsp;共<b><font color='#FF0000'>".$amount."</font></b>条记录 <b>".$PageSize."</b>条记录/页";
     echo " 转到：<input type='text' name='page' size=4 maxlength=10  value=".$page.">";
     echo " <input class=button type='submit'  value=' Goto '  name='cndok'></span>";
}

}
?>

</form>
</div></div>

   
	</div>
    <div id="sidebar">
	
	  
	<div class="sidebarsub">
	  <div class="columns_title">
	    <div class="columns_tb"></div><div class="columns_name">最新文章</div>
	    </div>
		  <div class="columns_content">
		    <?php 
			$zxsql="select artid,title from article order by artid desc limit 10";
	 		echo gettj($zxsql,34); 
			?>
	    </div>
	  </div>
	<!--广告位置 -->
    <div class="sidebarsub">
	    <div class="columns_title">
	      <div class="columns_tb"></div><div class="columns_name">热门文章</div>
	    </div>
		  <div class="columns_content">
		     <?php 
			 $rmsql="select artid,title from article order by hits desc limit 10";
			 echo gettj($rmsql,34); 
			 ?>
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

