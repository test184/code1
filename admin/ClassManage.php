<?php
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";

?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>

<script language="JavaScript" type="text/JavaScript">

function ConfirmDelClass()
{
   if(confirm("确定要删除此类别？"))
     return true;
   else
     return false;
	 
}

function ConfirmDelSub()
{
   if(confirm("确定要删除此子类吗？"))
     return true;
   else
     return false;
	 
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>类别管理</title>
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
-->

</style>
</head>

<body>

<div class="crumb-wrap">
<div class="crumb-list">综合管理<span class="crumb-step">&gt;</span><span class="crumb-name">类别管理</span></div>
</div>
<div align="center">
      
 <div style=" text-align:left; margin-top:10px; margin-left:15px;font-size:14px;"  >   <a href="ClassAdd.php" ><img src="images/add.jpg" width="16" height="16" style="padding-bottom:3px;"><font color: color="#0000CC">  添加类别 </font></a></div>
     
     
      <table class="table-list" width="98%">
        <tr>
          <th width="21%" ><div align="center">栏目名称</div></th>
          <th width="7%" ><div align="center">ID号</div></th>
          <th width="13%">是否在菜单显示</th>
          <th width="12%">菜单显示顺序</th>
          <th width="16%">是否在首页栏目显示</th>
          <th width="13%">首页栏目显示顺序</th>
          <th width="18%"><div align="center">操作选项</div></th>
        </tr>
		
		<?php 
		
		$sql="select * from class where parentid =0 order by classid ";
$mypdo = new DBPDO;
$bigrs = $mypdo->select($sql);
for ($i=0; $i<count($bigrs); $i++){
	$issub=issc($bigrs[$i]['classid']);
?>
		 
        <tr>
          <td > <img src="images/class_big.gif" alt="大类图标" width="15" height="15" style="padding-bottom:6px;"><?php echo $bigrs[$i]['classname']; ?></td>
          <td ><div align="center"><?php   echo $bigrs[$i]['classid']; ?></div></td>
          <td ><div align="center">
            <?php   
			
			if ($bigrs[$i]['menuis']==1) { 
				echo "<a href='classshow.php?lb=m&sh=0&id=".$bigrs[$i]['classid']."'><font color='#339933'>是</font></a>";}
            else {
            	echo "<a href='classshow.php?lb=m&sh=1&id=".$bigrs[$i]['classid']."'><font color='#CC0000'>否</font></a>";
            	}
			
			?>
          </div></td>
          <td ><div align="center">
            <?php echo $bigrs[$i]['menuxh'];?>
          </div></td>
          <td ><div align="center">
            
            <?php   
			if ($issub==0){
			if ($bigrs[$i]['lmis']==1) { 
				echo "<a href='classshow.php?lb=l&sh=0&id=".$bigrs[$i]['classid']."'><font color='#339933'>是</font></a>";}
            else {
            	echo "<a href='classshow.php?lb=l&sh=1&id=".$bigrs[$i]['classid']."'><font color='#CC0000'>否</font></a>";
            	}
			} 
			?>
            
          </div></td>
          <td ><div align="center">
		  
		  <?php 
  if ($issub==0)
  {

   echo $bigrs[$i]['lmxh'];
  } 

?></div></td>
          <td ><div align="right"><span class="STYLE1"><a class="1" href="ClassAddSub.php?parentid=<?php   echo $bigrs[$i]['classid']; ?>">添加子类</a></span> | <a href="ClassModify.php?classid=<?php echo $bigrs[$i]['classid']; ?>">修改</a> | <a href="ClassDel.php?classid=<?php   echo $bigrs[$i]['classid']; ?>"onClick="return ConfirmDelClass();">删除</a>&nbsp;</div></td>
        </tr>
		<?php 


      $sql2="select * from class where parentid=".$bigrs[$i]['classid'];
			$mypdo_s = new DBPDO; ;
			$smallrs = $mypdo_s->select($sql2);
			$mypdo_s = null;
   		 for ($j=0; $j<count($smallrs); $j=$j+1){

?>
        <tr>
          <td style="padding-left:30px;"><img src="images/class_small.gif" alt="小类图标" width="15" height="15" style="padding-bottom:2px;"><?php       echo $smallrs[$j]['classname']; ?></td>
          <td ><div align="center"><?php       echo $smallrs[$j]['classid']; ?></div></td>
          <td ><div align="center">
            <?php   
			
			if ($smallrs[$j]['menuis']==1) { 
				echo "<a href='classshow.php?lb=m&sh=0&id=".$smallrs[$j]['classid']."'><font color='#339933'>是</font></a>";}
            else {
            	echo "<a href='classshow.php?lb=m&sh=1&id=".$smallrs[$j]['classid']."'><font color='#CC0000'>否</font></a>";
            	}
			
			?>
          </div></td>
          <td ><div align="center">
            <?php       echo $smallrs[$j]['menuxh']; ?>
          </div></td>
          <td ><div align="center">
           <?php   
			
			if ($smallrs[$j]['lmis']==1) { 
				echo "<a href='classshow.php?lb=l&sh=0&id=".$smallrs[$j]['classid']."'><font color='#339933'>是</font></a>";}
            else {
            	echo "<a href='classshow.php?lb=l&sh=1&id=".$smallrs[$j]['classid']."'><font color='#CC0000'>否</font></a>";
            	}
			
			?>
          </div>
          </td>
          <td ><div align="center">
           <?php       echo $smallrs[$j]['lmxh']; ?>
</div></td>
          <td ><div align="right"> <a href="ClassModify.php?classid=<?php  echo $smallrs[$j]['classid']; ?>">修改</a> | <a href="ClassDel.php?classid=<?php       echo $smallrs[$j]['classid']; ?>"onClick="return ConfirmDelSub();">删除</a>&nbsp;</div></td>
        </tr>
		<?php 
   

    } 
  } 

  

?>
      </table>
	  <table class="list1"  width="98%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td><div align="center"><br>
            点击“是”或“否”可改变显示状态，“是”在菜单或首页栏目显示，“否”在菜单或首页栏目不显示<br>
      “显示顺序号”是排列次序，序号为数字，序号越小越靠前排列
          </div></td>
        </tr>
      </table>
     
</div>

</body>
</html>

