
<?php
  $artid=$rs[$i]['artid'];
  $classname=$rs[$i]['classname'];
  $parentname=$rs[$i]['parentname'];
  $classid=$rs[$i]['classid'];
  $parentid=$rs[$i]['parentid'];
  
  $title=$rs[$i]['title'];
  $mb_title=$title; 
  $content=$rs[$i]['content'];
  $mb_content=$content;
  $mb_addtime="日期：".formatdata($rs[$i]['addtime']);
  $mb_keywords=$rs[$i]['keywords'];
  $mb_descrip=$rs[$i]['descrip'];
  if (empty($mb_keywords)) {$mb_keywords=$title;}
  if (empty($mb_descrip)) {$mb_descrip=cutstr_html(clearHtml($content),150);}
  
  if ($parentid==0) {
	 $mb_subclassdh="&nbsp;";
	 $mb_zhengwenlb=$classname;
	 $mb_dhlbname=$classname;
	 $mb_artweizhi="<a href=\"../".get_list_url($listjt,$classid,0)."\">".$classname."</a>";
	 }
  else{
	  
	 
	
	 $mb_zhengwenlb=$classname; 
	 $mb_dhlbname=$parentname;
	 $mb_artweizhi="<a href=\"../".get_list_url($listjt,$parentid,1)."\">".$parentname."</a> &gt; <a href=\"../".get_list_url($listjt,$classid,0)."\">".$classname."</a>";
	 }
	 
	 if ($showhit){
		 $mb_hits="<script language=\"JavaScript\" src=\"../include/Hits.php?artid=$artid\" type=\"text/javascript\"></script>";
		 }
      else{
      $mb_hits="&nbsp;";
      } 
	 
	 $rmsql="select artid,title from article where classid=$classid order by hits desc limit 10";
	 $mb_rmarticle=gettj($rmsql,34); 
	 $zxsql="select artid,title from article order by artid desc limit 10";
	 $mb_newarticle=gettj($zxsql,34); 
	 
	 
?>
