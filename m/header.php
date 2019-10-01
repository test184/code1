<div id="dl-menu" class="dl-menuwrapper">
		<button id="dl-menu-button">Open Menu</button>
		<ul class="dl-menu">
			<li><a href="index.php">首页</a></li> 
<?php 
$dhsql="select * from class where menuis =1 and parentid =0 order by menuxh";
$dhrs =setsql("select",$dhsql);
for($i=0;$i<count($dhrs);$i++){
    if (issc($dhrs[$i]['classid'])==0){

?><li><a href="list.php?classid=<?php echo $dhrs[$i]['classid']; ?>"><?php echo $dhrs[$i]['classname']; ?></a></li>
 <?php   }
    else
    {
?>
 			<li>
				<a href="Line"><?php  echo $dhrs[$i]['classname']; ?></a>
				<ul class="dl-submenu">
					<li class="dl-back"><a href="#">返回上一级</a></li>
                     <?php 

                     $dhsql2="select * from class where parentid=".$dhrs[$i]['classid']." and menuis =1 order by menuxh";
		              $smallrs = setsql("select",$dhsql2);
		              for($j=0;$j<count($smallrs);$j++){

                      ?>

					  <li><a href="list.php?classid=<?php echo $smallrs[$j]['classid']; ?>"><?php echo $smallrs[$j]['classname']; ?></a></li>
					 <?php 
                       } 
                       ?>
				</ul>
			</li>
 <?php  } 
 

 
 }
 
$dhsql="select * from cd";
$dhrsc = setsql("select",$dhsql);
for($j=0;$j<count($dhrsc);$j++){
	$cdurl=$dhrsc[$j]['url'];
	$urlb=strstr($cdurl,"/article");
	if($urlb)
	{
		if(strstr($urlb,"artid="))
		{
			$urlc=trim(strstr($urlb,"="));
			$cdurl="article.php?artid=".substr($urlc,1,strlen($urlc)-1);
		}
		if(strstr($urlb,"article/"))
		{
			$urlc=trim(strstr($urlb,"article/"));
			$cdurl="article.php?artid=".substr($urlc,8,strlen($urlc)-13);
		}
		
	}
	
    echo "<li><a href=\"".$cdurl."\">".$dhrsc[$j]['cdname']."</a></li>\n";
  } 

 
 ?>
			
	</ul>
	</div>