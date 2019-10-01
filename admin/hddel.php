<?php
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";


$lb=make_safe($_GET['lb']);
$id=make_safe($_GET['id']);

$sql = "select picture FROM hd WHERE id=:id";  
$rs = setsql("select",$sql,array(':id' => $id));
$result=unlink($_SERVER['DOCUMENT_ROOT'].$rs[0]['picture']);
$sql = "DELETE FROM hd WHERE id=:id";  
$rs = setsql("delete",$sql,array(':id' => $id));

header("Location: "."hdpic.php?lb=".$lb);

?>
