
<?php 

include_once "islogin.php";
include_once "../include/db.php";
include_once "../include/function.php";



  $plstr = $_GET['plstr'];
  $page = make_safe($_GET['page']);
  $classid = make_safe($_POST['lbclass']);
  $classrs=getarrsql("select * from class where classid= :classid",array(':classid' => $classid));
  $classname=$classrs[0]['classname'];
  $parentid=$classrs[0]['parentid'];
  $parentname=getclassname($parentid);
  
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

if ($classid ==0)
{
  ok_info(0,"请选择类别");
}

$mypdo = new DBPDO;  
    $sql = "update article set classid=:classid,parentid=:parentid,classname=:classname,parentname=:parentname where artid in ($plstr)"; 

$arr = array(
	':classid'=>$classid,
	':parentid'=>$parentid,
	':classname'=>$classname,
	':parentname'=>$parentname,

	
);
	
    $result = $mypdo->update($sql,$arr);  
	if($result!==false)
	{
	
echo("<script type='text/javascript'> alert('批量更改成功');location.href= 'ArticleModifylist.php?".$caozuocs."'; </script>");  


	}

?>
