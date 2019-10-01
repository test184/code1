
<?php 
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";
 $sys = new sysconfig;
 $artjt=$sys->artjt;
 $sys=null;

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
// 删除新闻
  
 $test = new DBPDO;  

 $sql = "DELETE FROM article WHERE artid=:artid";  
 $rs = $test->delete($sql,array(':artid'=>$artid));  
 $test = null;
 if($rs){
  if($artjt){
  $file="..\article\\".$artid.".html";
  $result=unlink($file);
  }
  header("Location: ArticleModifylist.php?".$caozuocs);
  }
 else
  {ok_info("删除失败！");}
 







?>
