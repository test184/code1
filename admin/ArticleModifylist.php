

<?php
 include_once "islogin.php";
 include_once "../include/db.php";
include_once "../include/function.php";
//error_reporting(E_ALL);
$sys = new sysconfig;
$newsperpage=$sys->newsperpage;
$artjt=$sys->artjt;
$sys=null;

 $usersql="select * from lhAdmin where lhuser=:lhuser";
 $rsuser=setsql("select",$usersql,array(':lhuser' => $_SESSION['lh_dluser']));
 $lmstr=$rsuser[0]['lm'];
 if(!empty($lmstr)){
	$lmstrsql=" and classid in (".$lmstr.") ";
  }



if (!empty($_REQUEST['selclassid'])&&(is_numeric ($_REQUEST['selclassid']))) 
{
	$selclassid = make_safe($_REQUEST['selclassid']);
	if (issc($selclassid)){
		$tj="article where parentid = :selclassid ".$lmstrsql." order by artid";
	}
	else{
		$tj="article where classid = :selclassid ".$lmstrsql." order by artid";
	}
	$countsql="Select count(*)as amount From $tj";
    $amount =getcount($countsql,array(':selclassid' => $selclassid)); //$amount的值为记录条数，是个整数
}


else if(!empty($_REQUEST['searchkeys']))
{
	$searchkeys = make_safe($_REQUEST['searchkeys']);
	$tj="article where title like :searchkeys ".$lmstrsql." order by artid";
 	$countsql="Select count(*)as amount From $tj";	
    $amount =getcount($countsql,array(':searchkeys' =>'%'.$searchkeys.'%')); //$amount的值为记录条数，是个整数
}
else{
ok_info(0,"参数错误");
}

	$PageSize =$newsperpage; //每页显示多少条记录
	
	$PageCount=getPageCount($amount,$PageSize);//$PageCount表示总共有多少页

        
	 //接收page参数
	 if(isset($_REQUEST['page'])&&(is_numeric ($_REQUEST['page'])))
	 {
		 $page = intval($_REQUEST['page']);
		 if ($page>$PageCount){$page=$PageCount;} 
	  }
	  else
	  {$page = 1;}
	  
	 $ziduan="artid,title,hits,addtime,tj,classid,classname,parentid,parentname";
	 $sql="select $ziduan from $tj desc limit ".($page-1)*$PageSize.",".$PageSize;
	 

?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<script language = "JavaScript">
function go(URL,cfmText)
{
	var ret;
	ret = confirm(cfmText);
	if(ret!=false)window.location=URL;
}
function CheckAll(form)
	{
	for (var i=0;i<form.elements.length;i++){
	var e = form.elements[i];
	if (e.name != 'chkall')
		e.checked = form.chkall.checked;
		}
	}
 </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改信息列表</title>

</head>


<body>
<div class="crumb-wrap">
<div class="crumb-list">信息管理<span class="crumb-step">&gt;</span><span class="crumb-name">修改信息</span><span class="crumb-step">&gt;</span><span class="crumb-name">信息列表</span></div>
</div>
<div align="center">
 
      
  <table width="98%"  align="center"  class="table-list">
  <form name="art_m" method="POST" action="artplDel.php?selclassid=<?php echo $selclassid; ?>&page=<?php echo $page; ?>&searchkeys=<?php echo $searchkeys; ?>">
    
    <tr>
      <th width="20" align="center"> <input onclick=CheckAll(this.form) type="checkbox" name="chkall" value="checkbox" ></td>
      <th width="46" ><div align="center">ID号</div></th>
      <th width="237"><div align="center">标题</div></th>
      <th width="44" ><div align="center">浏览数</div></th>
      <th width="100"><div align="center">所属类别</div></th>
      
      <th width="100"><div align="center">日期</div></th>
      <th width="80"><div align="center">操作</div></th>
    </tr>
<?php 


     $mypdo = new DBPDO; ;
	 if (!empty($_REQUEST['selclassid'])){
	 	$rs = $mypdo->select($sql,array(':selclassid' => $selclassid));
		$pagecanshu="selclassid=".$selclassid;
		}
	 if(!empty($_REQUEST['searchkeys'])){
	 	$rs = $mypdo->select($sql,array(':searchkeys' => '%'.$searchkeys.'%'));
		$pagecanshu="searchkeys=".$searchkeys;
		}
	 $mypdo = null;//关闭数据库资源
	 
if (count($rs)==0)
{

 echo "<tr><td colspan='9'><div align='center'>没有记录</div> </td></tr>";
}
  else
{

 for ($i=0; $i<count($rs); $i=$i+1)
	 {
	 $title=$rs[$i]['title'];
	 $turl="../".get_art_url($artjt,$rs[$i]['artid']);
	 $hits=$rs[$i]['hits'];
	 $addtime=formatdata($rs[$i]['addtime']);

     $modname="ArticleModify.php";
     $delname="ArticleDel.php";
	 
	 if (!empty($_REQUEST['selclassid'])){
		$caozuocs="selclassid=".$selclassid."&artid=".$rs[$i]['artid']."&page=".$page;
		}
	 if(!empty($_REQUEST['searchkeys'])){
		$caozuocs="searchkeys=".$searchkeys."&artid=".$rs[$i]['artid']."&page=".$page;
		}
   
?> 
    <tr class="table_td2">
      <td width="20" align="center"><input type="checkbox" name="pldel[]"  value="<?php     echo $rs[$i]['artid']; ?>"></td>
      <td width="46"><div align="center"><?php     echo $rs[$i]['artid']; ?></div></td>
      <td ><a  href="<?php     echo $turl; ?>"  target=_blank><?php     echo $title; ?></a></td>
      <td width="44" ><div align="center"><?php     echo $rs[$i]['hits']; ?></div></td>
	  <?php 
    if ($rs[$i]['parentid']!=0){
      $leibei=$rs[$i]['parentname']."-".$rs[$i]['classname'];
    }
      else{
      $leibei=$rs[$i]['classname'];
    } 


?>
      <td width="144" ><div align="center"><?php     echo $leibei; ?></div></td>
      <td width="75" ><div align="center"><?php     echo $addtime; ?></div></td>
      <td width="80" ><div align="center"><a href='<?php echo $modname; ?>?<?php echo $caozuocs; ?>'>修改</a>&nbsp; <a href="javascript:go('<?php echo $delname; ?>?<?php echo $caozuocs; ?>','您确定要删除？')">删除</a>  </div></td>
    </tr>
<?php 
   

  } 


?>	
	
    
	
    <tr>
      <td colspan="8" > <br> <div align="left">
        
          
          <input  name="Submit" type="submit" class="btn btn-info btn6 mr10" value="批量删除" 
		  onclick="{if(confirm('确定要删除吗?')){
  					this.document.art_m.submit();
 					 return true;}return false;
 					}"> 
&nbsp;
		  <input  name="Submit" type="submit" class="btn btn-info btn6" value="批量更改类别">
        
      </div>    </form>    


 <div class="list-page">
 <form method=Post  id='pageform' name='pageform' action="?<?php echo $pagecanshu?>">
 <?php 
if (count($rs)>0) {  
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
     echo " 转到：<input type='text' class='common-text' name='page' size=4 maxlength=10  value=".$page.">";
     echo " <input class=btn type='submit'  value=' Goto '  name='cndok'></span>";
}
?>

</form>
 
 
 </div>
      </td>      
    </tr>
<?php 
} 
$rs=null;
?>
</table>
  
 
  <p><br>
  </p>

</body>

</html>

