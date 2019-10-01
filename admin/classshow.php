
<?php
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";
 
 $lb= make_safe($_GET['lb']);

 $id= make_safe($_GET['id']);
 $sh=make_safe($_GET['sh']);
$mypdo = new DBPDO;  
if ($lb=="l"){
 $sql = "update class set lmis=:sh where classid=:id"; 
}
if ($lb=="m"){
 $sql = "update class set menuis=:sh where classid=:id"; 
}
	 	 $arr = array(
		':sh'=>$sh,
		':id'=>$id
		);
 $result = $mypdo->update($sql,$arr);  

header("Location: "."ClassManage.php");

?>


