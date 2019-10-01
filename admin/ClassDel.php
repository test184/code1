<?php 
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";

 $sys = new sysconfig;
 $artjt=$sys->artjt;
 $sys=null;

$classid = make_safe($_GET['classid']);

  $sql="delete from class where classid=:classid or parentid=:classid";
  $rs = setsql("delete",$sql,array(':classid'=>$classid));  
 
 if($rs){
	if($artjt){
    $artsql="select artid from article where classid=:classid or parentid=:classid";
	$arr=getarrsql($artsql,array(':classid'=>$classid)); 
	for ($i=0; $i<count($arr); $i++){
	$file="..\article\\".$arr[$i]['artid'].".html";
    $result=unlink($file);
	}}
 
	 $artsql="delete from article where classid=:classid or parentid=:classid";
     $artrs = setsql("delete",$artsql,array(':classid'=>$classid));  
	
 }

$test = null;
header("Location: "."ClassManage.php");
?>




