<?php 
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";
 include_once "../mbfile/mb_fun.php";
$sys = new sysconfig;
$artjt=$sys->artjt;
$sys=null;
?>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<title>添加信息</title>
</head>
<?php 
if (empty($_POST['d_content'])) {ok_info(0,'内容不能为空');}

$classid = make_safe($_POST['classid']);

  $sql="select * from class where classid= :classid";
  $mypdo = new DBPDO; ;
  $rs = $mypdo->select($sql,array(':classid' => $classid));
  $parentid=$rs[0]['parentid'];
  $classname=$rs[0]['classname'];
  $mypdo=null;

$parentname=getclassname($parentid);

$title= make_safe($_POST['txttitle']);
$keywords= make_safe($_POST['keywords']);
$descrip= make_safe($_POST['Descrip']);



$content='';
	if (!empty($_POST['d_content'])) {
		if (get_magic_quotes_gpc()) {
			$content = stripslashes($_POST['d_content']);
		} else {
			$content = $_POST['d_content'];
		}
	}

//写入数据库


    $mypdo = new DBPDO;  
    $sql = "INSERT INTO article(title,keywords,descrip,addtime,content,classid,parentid,classname,parentname) VALUES (:title,:keywords,:descrip,:addtime,:content,:classid,:parentid,:classname,:parentname)";  
	
$arr = array(
    ':title'=>$title,
	':keywords'=>$keywords,
	':descrip'=>$descrip,
	':addtime'=>date("Y-m-d"),
	':content'=>$content,
	':classid'=>$classid,
	':parentid'=>$parentid,
	':classname'=>$classname,
	':parentname'=>$parentname
);
    $result = $mypdo->insert($sql,$arr); 
	if($result)
	{
	if($artjt){
    $artsql="select * from article where artid=".$result;
	$rs=setsql("select",$artsql);
	make_html($rs);
	}
    //make_html(get_article_up($classid,$result));

?>
<body>
<div class="crumb-wrap">
<div class="crumb-list">信息管理<span class="crumb-step">&gt;</span><span class="crumb-name">发布信息</span></div>
</div>
<?php

  echo "<div align=center><br><br>保存成功！<p>是否继续添加此小类信息 <a href='ArticleAdd.php?classid=".$classid."'>是</a> / <a href='ArticleAdd.php'>否</a></div>";

	}
	

else
echo "<div align=center><br><br>添加失败</div>";
$mypdo = null;
?>

