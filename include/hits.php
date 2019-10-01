
<?php
include_once "db.php";
include_once "function.php";
$artid = make_safe($_GET['artid']);
if (!is_numeric($artid))
{
  exit();
} 

$sql="update article set hits=hits+1 where artid=$artid limit 1";
$mypdo = new DBPDO; ;
$rs = $mypdo->update($sql);

$sql="select * from article where artid=$artid limit 1";
$rs = $mypdo->select($sql);
$hits=$rs[0]['hits'];
$mypdo=null;

$pp=" <span>阅读</span> ".$hits." 次";
echo "document.write('".$pp."');";   
?>

