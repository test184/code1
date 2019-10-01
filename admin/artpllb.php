<?php
include_once "islogin.php";
include_once "../include/db.php";
include_once "../include/function.php";

 $usersql="select * from lhAdmin where lhuser=:lhuser";
 $rsuser=setsql("select",$usersql,array(':lhuser' => $_SESSION['lh_dluser']));
 $lmstr=$rsuser[0]['lm'];

  $plstr = $_GET['plstr'];
  $page = make_safe($_GET['page']);
  
  if (!empty($_REQUEST['selclassid'])&&(is_numeric ($_REQUEST['selclassid']))) 
{
	$selclassid = make_safe($_REQUEST['selclassid']);
	$caozuocs="plstr=".$plstr."&selclassid=".$selclassid."&page=".$page;
}
else if(!empty($_REQUEST['searchkeys']))
{
	$searchkeys = make_safe($_REQUEST['searchkeys']);
	$caozuocs="plstr=".$plstr."&searchkeys=".$searchkeys."&page=".$page;
}
else{
ok_info(0,"参数错误");
}


?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

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
<div class="crumb-list">信息管理<span class="crumb-step">&gt;</span><span class="crumb-name">修改信息</span><span class="crumb-step">&gt;</span><span class="crumb-name">批量更改类别</span></div>
</div>
<br>
<table width="200" border=0 align=center cellspacing=1 class="List">
	<tr>
	  <th width="15%">请选择批量更改信息的类别</th>
	</tr>
    
	<tr>
	  <td><div align="center"><br>
	   <form name="form1" method="post" action="artpllbsave.php?<?php echo $caozuocs; ?>">
	  
				    <?php lb_option("lbclass","请选择类别",1,0,$lmstr);?>
	 
	 <input type="submit" style="margin-left:10px;" name="Submit" value="提交" class="btn btn-primary btn4">
	    </form>
	  </div></td>
  </tr>
</table>


</body>

</html>

