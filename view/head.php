
<div id="header">
  <div class="logo"><a href="http://www.strongfire.cn" target="_blank"><img src="<?php echo $alurl; ?>images/strong.gif" alt="<?php echo $website; ?>" width="190" height="110" /></a></div>
  
  <div class="banner"> <a href="http://www.strongfire.cn" target="_blank"><img src="<?php echo $alurl; ?>images/top.gif" /></a>
  </div>
  
</div>
  
  <div class="clearfloat"></div>

<div id="navbar">
<div class="navbarl"></div>
<div class="navbarr"></div>
<ul>  
<li><a  href="<?php echo $indexurl; ?>" class="first">首&nbsp;&nbsp;页</a></li>


<?php 


$dhsql="select * from class where menuis =1 and parentid =0 order by menuxh";
$dhrs =setsql("select",$dhsql);
for($i=0;$i<count($dhrs);$i++){
   if (issc($dhrs[$i]['classid'])==0){
		echo "<li><a href=\"".$alurl. get_list_url($listjt,$dhrs[$i]['classid'],0)."\">".$dhrs[$i]['classname']."</a></li>\n";	 
	}
    else {
		echo "<li><a href=\"".$alurl.get_list_url($listjt,$dhrs[$i]['classid'],1)."\">".$dhrs[$i]['classname']."</a>";
		echo "<ul>";
		$dhsql2="select * from class where parentid=".$dhrs[$i]['classid']." and menuis =1 order by menuxh";
		$smallrs = setsql("select",$dhsql2);
		for($j=0;$j<count($smallrs);$j++){
			echo "<li><a href=\"".$alurl.get_list_url($listjt,$smallrs[$j]['classid'],0)."\">".$smallrs[$j]['classname']."</a></li>";	
		}
        echo "</ul></li>\n";
   
	}
	
	
  } 
	$dhsql="select * from cd";
    $dhrsc = setsql("select",$dhsql);
    for($j=0;$j<count($dhrsc);$j++){
    echo "<li><a href=\"".$dhrsc[$j]['url']."\">".$dhrsc[$j]['cdname']."</a></li>\n";
	
	}

?>
</ul>
</div>
