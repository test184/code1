<div id="listcontent">
	<div class="clearfloat"></div>
<?php
	$ziduan="artid,title,hits,addtime";
	if (issc($classid)){
		$tj="article where parentid = :classid order by artid";
	}
	else{
		$tj="article where classid = :classid order by artid";
	}
	
 	$countsql="Select count(*)as amount From $tj";
    $amount =getcount($countsql,array(':classid' => $classid)); //$amount的值为记录条数，是个整数
	
	$PageSize = $newsperpage; //每页显示多少条记录
	
	$PageCount=getPageCount($amount,$PageSize);//$PageCount表示总共有多少页
	
        
	 //接收page参数
	 if(isset($_REQUEST['page'])&&(is_numeric ($_REQUEST['page'])))
	 {
		 $page = intval($_REQUEST['page']);
		 if ($page>$PageCount){$page=$PageCount;} 
	  }
	  else
	  {$page = 1;}
	  
	 $sql="select $ziduan from $tj desc limit ".($page-1)*$PageSize.",".$PageSize;
	 $mypdo = new DBPDO; ;
	 $sublist = $mypdo->select($sql,array(':classid' => $classid));
	 $mypdo = null;//关闭数据库资源
	 for ($i=0; $i<count($sublist); $i=$i+1)
	 {
	 $title=cutstr_html($sublist[$i]['title'],40);
	 $turl=$alurl.get_art_url($artjt,$sublist[$i]['artid']);
	 $hits=$sublist[$i]['hits'];
	 $addtime=formatdata($sublist[$i]['addtime']);
	
	 echo "<dl><dt>·<a href=\"".$turl."\"target=_blank>".$title."</a></dt><dd>".$addtime."</dd></dl>" ."\r\n";

	 
	 }

?>
  
<div class="listpage">
<?php   $pagecanshu="classid=".$classid;?>

<form method=Post  id='pageform' name='pageform' action="?<?php echo $pagecanshu?>">
 <?php 
if($PageCount>1){//如果只有一页，则不显示翻页
 
if (count($sublist)>0) {  
	if($page==1){ echo "首页 上一页&nbsp;";}
    else
    {
      echo "<a href=?".$pagecanshu."&page=1>首页</a>&nbsp;";
      echo "<a href=?".$pagecanshu."&page=".($page-1).">上一页</a>&nbsp;";
    } 

    if(($page==$PageCount)||($PageCount==0)){ echo "下一页 尾页";}
    else
	{
     echo "<a href=?".$pagecanshu."&page=".($page+1).">";
     echo "下一页</a> <a href=?".$pagecanshu."&page=".$PageCount.">尾页</a>";
    } 
	
     echo "&nbsp;页次：<strong><font color=red>".$page."</font>/".$PageCount."</strong>页 ";
     echo "&nbsp;共<b><font color='#FF0000'>".$amount."</font></b>条记录 <b>".$PageSize."</b>条记录/页";
     echo " 转到：<input type='text' name='page' size=4 maxlength=10  value=".$page.">";
     echo " <input class=button type='submit'  value=' Goto '  name='cndok'></span>";
}

}
?>

</form>
</div></div>
