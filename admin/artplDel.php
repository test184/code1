
<?php 
include_once "islogin.php";
include_once "../include/db.php";
include_once "../include/function.php";
 $sys = new sysconfig;
 $artjt=$sys->artjt;
 $sys=null;

  $pldel = $_POST['pldel'];
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






if ($_POST['Submit']=="批量更改类别")
{
$plstr=$pldel[0];
for($i=1;$i<count($pldel);$i++)
{
	$plstr=$plstr.",".$pldel[$i];
}
  header("Location: "."artpllb.php?plstr=".$plstr."&".$caozuocs);
  exit();

} else{


for($i=0;$i<count($pldel);$i++)
{
 $test = new DBPDO;  
 $sql = "DELETE FROM article WHERE artid=:artid";  
 $rs = $test->delete($sql,array(':artid'=>$pldel[$i]));  
 $test = null;
 if($rs){
 if($artjt){
 $file="..\article\\".$pldel[$i].".html";
 $result=unlink($file);
 }
 
  }
 header("Location: "."ArticleModifylist.php?".$caozuocs);
}



}


?>
