
<?php 



//生成首页
function make_index(){
     ob_start();   
	 include "../mb_index.php"; 
	 file_put_contents('../index.html', ob_get_clean());
}
//生成父类页面（大类页面）
function make_list_b($classid,$classname){
	    ob_start();  
		include "../view/list.php"; 
		$mbfile_b = ob_get_contents();
		ob_get_clean();
		file_put_contents('../list/'.$classid.'.html',$mbfile_b);
		echo "[".$classname."]  文件 ".$classid.".html 已更新完毕！<br>";
	
}

//生成文章页
function make_html($rs,$info){
  $sys = new sysconfig;
  $website=$sys->website;
  $lhkeywords=$sys->lhkeywords;
  $lhdescrip=$sys->lhdescrip;
  $indexjt=$sys->indexjt;
  $listjt=$sys->listjt;
  $artjt=$sys->artjt;
  $showhit=$sys->showhit;
  $sys=null;
  ob_start(); //开启缓存区  
  include "../view/article.php";
  $okfile_y = ob_get_contents();
  ob_get_clean();
 
  
  for($i=0;$i<count($rs);$i++)
  {  
	  $okfile=$okfile_y;
	  include "dm_art_pub.php";
	  
	  $okfile=str_replace('{title}',$mb_title,$okfile);
	  $okfile=str_replace('{keywords}',$mb_keywords,$okfile);
      $okfile=str_replace('{descrip}',$mb_descrip,$okfile);
	  $okfile=str_replace('{artweizhi}',$mb_artweizhi,$okfile);
	  $okfile=str_replace('{dhlbname}',$mb_dhlbname,$okfile);
	  $okfile=str_replace('{subclassdh}',$mb_subclassdh,$okfile);
	  $okfile=str_replace('{zhengwenlb}',$mb_zhengwenlb,$okfile);
      $okfile=str_replace('{addtime}',$mb_addtime,$okfile);
	  $okfile=str_replace('{hits}',$mb_hits,$okfile);
	  $okfile=str_replace('{content}',$mb_content,$okfile);
	  $okfile=str_replace('{rmarticle}',$mb_rmarticle,$okfile);
	  $okfile=str_replace('{newarticle}',$mb_newarticle,$okfile);
	  
	  $webhtmname=$artid.".html";
	  file_put_contents('../article/'.$webhtmname,$okfile);
	  if($info){
		 echo "[".$classname."]  文件 ".$webhtmname." 已更新完毕<br>";}
  }     
  return $i;
}


//生成列表
function make_list($classid,$mbfile){
	
	 $sys = new sysconfig;
	 $website=$sys->website;
	 $indexjt=$sys->indexjt;
     $listjt=$sys->listjt;
     $artjt=$sys->artjt;
	 $newsperpage=$sys->newsperpage;
	 $sys=null;
	
	$lsql="select * from class where classid=:classid";
    $lrs = getarrsql($lsql,array(':classid'=>$classid));
    include "../mbfile/dm_list_pub.php"; 
  
	$ziduan="artid,title,addtime,classname";
	$tj="article where classid = :classid order by artid";
 	$countsql="Select count(*)as amount From $tj";
    $amount =getcount($countsql,array(':classid' => $classid)); //$amount的值为记录条数，是个整数
	$PageSize = $newsperpage; //每页显示多少条记录
	$PageCount=getPageCount($amount,$PageSize);//$PageCount表示总共有多少页
   
	//有记录
for($page=1;$page<=$PageCount;$page++)
{
	   $okfile=$mbfile;
   
	   // listcontent
	   $listcontent="";
	   $sql="select $ziduan from $tj desc limit ".($page-1)*$PageSize.",".$PageSize;
	   $rs = setsql("select",$sql,array(':classid' => $classid));
	   for ($i=0; $i<count($rs); $i=$i+1)
	   {
		   $perrec="";
		   $title=$rs[$i]['title'];
		   $turl="../".get_art_url($artjt,$rs[$i]['artid']);
		   $addtime=formatdata($rs[$i]['addtime']);
		   $perrec="<dl><dt>·<A title=".$title." href=\"".$turl."\" target=\"_blank\">".$title."</A></dt><dd>".$addtime."</dd></dl>"."\r\n";
		 
			$listcontent=$listcontent.$perrec;
		}	
		
		// pagecontent
		$pagecontent="";
	if($PageCount>1){//如果只有一页，则不显示翻页
		$pagename=$classid;
		$pagecontent=$pagecontent."<form id='pageform' name='pageform'>";
		if($page==1){      
		   $pagecontent=$pagecontent. "首页 上一页&nbsp;";}
		else{
		   $pagecontent=$pagecontent. "<a href=".$pagename. "_1.html>首页</a>&nbsp;";
		   $pagecontent=$pagecontent. "<a href=".$pagename. "_" .($page-1) . ".html>上一页</a>&nbsp;";
		}
		if(($page==$PageCount)||($PageCount==0)){
		   $pagecontent=$pagecontent. "下一页 尾页";}
		else{
		   $pagecontent=$pagecontent. "<a href=".$pagename. "_".($page+1) . ".html>";
		   $pagecontent=$pagecontent. "下一页</a> <a href=".$pagename."_".$PageCount.".html>尾页</a>";
		}
		$pagecontent=$pagecontent. "&nbsp;页次：<strong><font color=red>".$page."</font>/".$PageCount."</strong>页 ";
		$pagecontent=$pagecontent. "&nbsp;共<b><font color='#FF0000'>".$amount."</font></b>条记录 <b>".$PageSize."</b>条记录/页";
		$pagecontent=$pagecontent. " 转到：<select name=\"menupage\" onChange=\"MM_jumpMenu('parent',this,0)\">";
		$pagestr="";
		for($pagej=1; $pagej<=$PageCount;$pagej++){
		   if ($pagej==$page){
		   $pagestr=$pagestr."<option value=\"".$pagename."_".$pagej.".html\" selected>".$pagej."</option>"."\r\n";}
		   else{
		   $pagestr=$pagestr."<option value=\"".$pagename."_".$pagej.".html\">".$pagej."</option>"."\r\n";}
		   }
		 $pagecontent=$pagecontent.$pagestr;     
		 $pagecontent=$pagecontent."</select></form>";
	}
	    $okfile=str_replace('{listcontent}',$listcontent,$okfile);
		$okfile=str_replace('{pagecontent}',$pagecontent,$okfile);
		$okfile=str_replace('{title}',$mb_title,$okfile);
	    $okfile=str_replace('{keywords}',$mb_keywords,$okfile);
	    $okfile=str_replace('{descrip}',$mb_descrip,$okfile);
	    $okfile=str_replace('{listweizhi}',$mb_listweizhi,$okfile);
	    $okfile=str_replace('{dhlbname}',$mb_dhlbname,$okfile);
	    $okfile=str_replace('{subclassdh}',$mb_subclassdh,$okfile);
		$okfile=str_replace('{website}',$website,$okfile);
		$okfile=str_replace('{classname}',$classname,$okfile);
		$okfile=str_replace('{rmarticle}',$mb_rmarticle,$okfile);
		$okfile=str_replace('{newarticle}',$mb_newarticle,$okfile);
		
	    $webhtmname=$classid."_".$page.".html";
	    file_put_contents('../list/'.$webhtmname,$okfile);
        echo "[".$classname."]  文件 ".$webhtmname." 已更新完毕！<br>";
  }
  
  	 //如果没有记录
	    if($amount==0){
		$okfile=$mbfile;
		$listcontent="暂无内容";
		$pagecontent="";
		
		$okfile=str_replace('{listcontent}',$listcontent,$okfile);
		$okfile=str_replace('{pagecontent}',$pagecontent,$okfile);
		$okfile=str_replace('{title}',$mb_title,$okfile);
	    $okfile=str_replace('{keywords}',$mb_keywords,$okfile);
	    $okfile=str_replace('{descrip}',$mb_descrip,$okfile);
	    $okfile=str_replace('{listweizhi}',$mb_listweizhi,$okfile);
	    $okfile=str_replace('{dhlbname}',$mb_dhlbname,$okfile);
	    $okfile=str_replace('{subclassdh}',$mb_subclassdh,$okfile);
		$okfile=str_replace('{website}',$website,$okfile);
		$okfile=str_replace('{classname}',$classname,$okfile);
		$okfile=str_replace('{rmarticle}',$mb_rmarticle,$okfile);
		$okfile=str_replace('{newarticle}',$mb_newarticle,$okfile);
		
	    $webhtmname=$classid."_1.html";
	    file_put_contents('../list/'.$webhtmname,$okfile);
        echo "[".$classname."]  文件 ".$webhtmname." 已更新完毕！<br>";
		
	}
	
}



function gettj($sql,$n){
	
	 $sys = new sysconfig;
	 $website=$sys->website;
	 $indexjt=$sys->indexjt;
     $listjt=$sys->listjt;
     $artjt=$sys->artjt;
	 $newsperpage=$sys->newsperpage;
	 $sys=null;
	 $getrs=setsql("select",$sql);
	 for($i=0;$i<count($getrs);$i++)
	 {
		 $title=$getrs[$i]['title'];
		 $xstitle=cutstr_html($getrs[$i]['title'],$n);
		 $url="../".get_art_url($artjt,$getrs[$i]['artid']);
		 $str=$str."<dl><dt></dt><dd><a title=\"".$title."\" href=\"".$url."\" target =\"_blank\">".$xstitle."</a></dd></dl>"."\r\n";
	 }
	 
	 return $str;
}
?>
