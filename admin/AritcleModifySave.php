
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<title>修改信息</title>
</head>
<?php 
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";
 include_once "../mbfile/mb_fun.php";

  $sys = new sysconfig;
 $artjt=$sys->artjt;
 $sys=null;

if (empty($_POST['d_content'])) {ok_info(0,'内容不能为空');}
$artid = make_safe($_GET['artid']);
$page = make_safe($_GET['page']);

if (!empty($_REQUEST['selclassid'])&&(is_numeric ($_REQUEST['selclassid']))) 
{
	$selclassid = make_safe($_REQUEST['selclassid']);
	$caozuocs="selclassid=".$selclassid."&page=".$page;
}
else if(!empty($_REQUEST['searchkeys']))
{
	$searchkeys = make_safe($_REQUEST['searchkeys']);
	$caozuocs="searchkeys=".$searchkeys."&page=".$page;
}
else{
ok_info(0,"参数错误");
}


$classid = make_safe($_POST['lbclass']);
$classrs=getarrsql("select * from class where classid= :classid",array(':classid' => $classid));
$classname=$classrs[0]['classname'];
$parentid=$classrs[0]['parentid'];
$parentname=getclassname($parentid);

$title= make_safe($_POST['txttitle']);
$keywords= make_safe($_POST['keywords']);
if (empty($keywords)){$keywords='';}
$descrip= make_safe($_POST['descrip']);
if (empty($descrip)){$descrip='';}
$addtime= make_safe($_POST['addtime']);



$content='';
	if (!empty($_POST['d_content'])) {
		if (get_magic_quotes_gpc()) {
			$content = stripslashes($_POST['d_content']);
		} else {
			$content = $_POST['d_content'];
		}
	}



    $sql = "update article set title=:title,keywords=:keywords,descrip=:descrip,addtime=:addtime,content=:content,classid=:classid,parentid=:parentid,classname=:classname,parentname=:parentname where artid=:artid"; 
$arr = array(
    ':title'=>$title,
	':keywords'=>$keywords,
	':descrip'=>$descrip,
	':addtime'=>$addtime,
	':content'=>$content,
	':classid'=>$classid,
	':parentid'=>$parentid,
	':classname'=>$classname,
	':parentname'=>$parentname,
	':artid'=>$artid
);
	
  
	$result = setsql("update",$sql,$arr); 

if($result!==false)
{
  $sql="select * from article where artid=".$artid;
  $mypdo = new DBPDO;
  $rs = $mypdo->select($sql);
  if($artjt){
  make_html($rs,0);
  }
?>
<body>
<div class="crumb-wrap">
<div class="crumb-list">信息管理<span class="crumb-step">&gt;</span><span class="crumb-name">修改信息</span></div>
</div>
<?php
	  
 echo "<div align=center><br><br>修改成功！<p>是否继续修改此小类信息 <a href='ArticleModifylist.php?".$caozuocs."'>是</a> / <a href='ArticleModSelClass.php'>否</a></div>";
} 
else
{echo "<div align=center><br><br>数据没有修改或修改失败！<p>是否继续修改此小类信息 <a href='ArticleModifylist.php?".$caozuocs."'>是</a> / <a href='ArticleModSelClass.php'>否</a></div>";}



?>

