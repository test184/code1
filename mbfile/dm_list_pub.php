
<?php
    $classname=$mb_title=$lrs[0]['classname'];
    $parentname=getclassname($lrs[0]['parentid']);
	$mb_keywords=$mb_descrip=$classname.",".$website;
	
	
	if ($lrs[0]['parentid']==0){
	$mb_listweizhi=$classname;
		if (issc($classid)){
		$rmsql="select artid,title from article where parentid=$classid order by hits desc limit 10";}
		else
		{$rmsql="select artid,title from article where classid=$classid order by hits desc limit 10";}
	
	}
	else{
	$mb_listweizhi="<a href=\"../".get_list_url($listjt,$lrs[0]['parentid'],1)."\">".$parentname."</a> &gt; ".$classname;
	$rmsql="select artid,title from article where classid=$classid order by hits desc limit 10";
	
		
	}
	
	 
	 $mb_rmarticle=gettj($rmsql,34); 
	 $zxsql="select artid,title from article order by artid desc limit 10";
	 $mb_newarticle=gettj($zxsql,34); 

?>
