<?php 
error_reporting(E_ALL & ~E_NOTICE);
$indexcontent="";
$smsql="select * from class where parentid=:classid";
$classrs=setsql("select",$smsql,array(':classid' => $classid));
for($i=0;$i<count($classrs);$i++)
{
	if ($i%2==0) {
	$indexcontent=$indexcontent ."<div class=\"lmleft\">". "\r\n";}
	else{
	$indexcontent=$indexcontent ."<div class=\"lmright\">". "\r\n";
	}
	
	$indexcontent=$indexcontent ."<div class=\"item_title\"><div class=\"item_name\">".$classrs[$i]['classname']."</div>". "\r\n";
	$indexcontent=$indexcontent ."<div class=\"item_more\"><a href=\"".$alurl.get_list_url($listjt,$classrs[$i]['classid'],0)."\" target=\"_blank\"><img src=\"../images/more.gif\" width=\"42\" height=\"12\" border=\"0\" /></a></div></div><div class=item_content>". "\r\n";
	$indexcontent=$indexcontent."<ul>". "\r\n";
	 $lmsql="select artid,title,addtime from article where classid=:classid order by artid desc limit 8";
    $lmrs=setsql("select",$lmsql,array(':classid' => $classrs[$i]['classid']));
    for($j=0;$j<count($lmrs);$j++)
    {
	
    $indexcontent=$indexcontent."<li>·<A title=".$lmrs[$j]['title']." href=". $alurl.get_art_url($artjt,$lmrs[$j]['artid'])." target =\"_blank\">".cutstr_html($lmrs[$j]['title'],30)."</a></li>". "\r\n";
	}
	$indexcontent=$indexcontent."</ul></div></div>". "\r\n";
	if ($i%2==1) {	
	$indexcontent = $indexcontent . "<div class=\"clearfloat\"></div>". "\r\n";
	}
}




	
echo $indexcontent;


?>