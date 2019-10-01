<?php
 include_once "islogin.php";
 include_once "../include/db.php";


 $usersql="select * from lhAdmin where lhuser=:lhuser";
 $rsuser=setsql("select",$usersql,array(':lhuser' => $_SESSION['lh_dluser']));
 $lmstr=$rsuser[0]['lm'];
 if(!empty($lmstr)){
	$lmstrsql=" and classid in (".$lmstr.") ";
  }
?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改信息</title>

<style type="text/css">
<!--
.STYLE2 {	font-size: 13;
	color: #000000;
	
}
.STYLE3 {font-family: Arial, Helvetica, sans-serif; margin-left:25px; height:30px; margin-top:10px;}
-->
</style>
</head>
<body>
<div class="crumb-wrap">
<div class="crumb-list">信息管理<span class="crumb-step">&gt;</span><span class="crumb-name">修改信息</span></div>
</div>
 <div class="search-wrap">
   <form name="postart" method="post"  action="ArticleModifylist.php">
  <input placeholder="关键字" name="searchkeys" type="text" id="searchkeys" size="20" style="margin-left:10px;" class="common-text">
  <input name="Submit" type="submit" class="btn btn-primary btn5 mr10" value="搜索">
&nbsp;&nbsp;&nbsp;&nbsp;<a href="classhbzy.php"></a>
</form>
</div>
<table width="98%"  align="center" class="table-list">
	<tr>
	  <th>请选择修改信息的类别</th>
	</tr>
   
 
	<tr>
      <td width="15%">
      <div align="left"><font style="line-height:150%"><br>
<?php 

$sql="select * from class where parentid =0".$lmstrsql." order by classid ";

$mypdo = new DBPDO;
$rs = $mypdo->select($sql);
if (count($rs)==0){
   	echo "<br><div align='center'>没有任何分类</div>";}
else
{
    	for ($i=0; $i<count($rs); $i++){
			
			
?>
		    <span class="STYLE2"><img src="images/class_big.gif" alt="大类图标" width="15" height="15" style="padding-bottom:8px;">
		 <a href="ArticleModifylist.php?selclassid=<?php echo $rs[$i]['classid']; ?>" style="color:#FF0000;text-decoration: none;"><?php  echo $rs[$i]['classname']; ?></a></span>
<?php      
			$sql2="select * from class where parentid=".$rs[$i]['classid'].$lmstrsql;
			
			$mypdo_s = new DBPDO; ;
			$rs_s = $mypdo_s->select($sql2);
			$mypdo_s = null;
			if (count($rs_s)>0) {echo "<div class=\"STYLE3\">";}
			else  {echo "<br><br>";}
      		 for ($j=0; $j<count($rs_s); $j=$j+1){
?>
             <img src="images/class_small.gif" alt="小类图标" width="15" height="15" style="padding-bottom:6px;"><a href="ArticleModifylist.php?selclassid=<?php echo $rs_s[$j]['classid']; ?> " style="color:#FF0000;text-decoration: none;"><?php echo $rs_s[$j]['classname']; ?></a>&nbsp;&nbsp;
			<?php  }
			if (count($rs_s)>0) {echo "</div";}
 
		}
} 
$mypdo=null;
?>
</font></div>
      </td>
    </tr>
    
</table>
<br>
 
</body>

</html>

