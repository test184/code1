<?php
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";

  
$action=make_safe($_GET['action']);

if ($action=="modify")
{
	
	$dj=make_safe($_POST['dj']);
	
	 if ($dj==2)
      {
		  
		$blm=$_POST['blm'];
		$slm=$_POST['slm'];
		$lmd=",";
		$lmx=",";
		foreach($slm as $name){
		   $lmx=$lmx.$name.",";}
		
		foreach($blm as $name)
		 {
			//如果父类勾选，子类没有勾选，则删除父类
			 if(issc($name)){
				 if (strpos($lmx, ",".$name.",") !== false) {
				 	 $lmd=$lmd.$name.",";
				 }
			 }
			 else{	 
			 $lmd=$lmd.$name.",";}
			 
		  }

		  
		 //如果子类的父类没有勾选，则添加父类
		 $sqlslm="select distinct parentid from class where classid in (".substr($lmx,1,strlen($lmx)-2).")";
		 $lbslm=setsql("select",$sqlslm);
		  for($i=0;$i<count($lbslm);$i++){
			  if (strpos($lmd, ",".$lbslm[$i]['parentid'].",") === false)
			  {$lmd=$lmd.$lbslm[$i]['parentid'].",";}
			}
		 	
		
	   }
	$lm= substr($lmd,1,strlen($lmd)-1).substr($lmx,1,strlen($lmx)-2);
   
	$id=make_safe($_POST['id']);
	
	if (empty($_POST['password'])){
		$sql = "update lhadmin set dj=:dj,lm=:lm where id=:id";
		$arr = array(
		':dj'=>$dj,
		':lm'=>$lm,
		':id'=>$id
		); 
	}
	else {
		$password=make_safe($_POST['password']);
		$sql = "update lhadmin set lhpassword=:lhpassword,dj=:dj,lm=:lm where id=:id"; 
		$arr = array(
		':lhpassword'=>md5($password),
		':dj'=>$dj,
		':lm'=>$lm,
		':id'=>$id
		);
	}
    $result = setsql("update",$sql,$arr);
	
	header("Location: "."SuperUser.php");
	

} 

?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改</title>
<script language="JavaScript" type="text/javascript">
function check_input()  
{  
	
	if (form1.password.value==""){
		alert ("\n请填写密码！");
		document.form1.password.focus();
		return false;
	}
		return true;
}

</script>
<style type="text/css">
<!--
.STYLE1 {
	font-size: 14px;
	color: #0000FF;
	font-weight: bold;
}
.textstype {
	height: 20px;
	width: 100%;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}

-->
</style>
</head>
<script language = "JavaScript">
	function typechange()
  { choiceid=form1.dj.selectedIndex

	  if(form1.dj.options[choiceid].value=="2"){
		  
		  lmgl.style.display ="inline" 
		  
		  
		  }
	  if(form1.dj.value=="1"){
		  
		  lmgl.style.display="none" 
	  }

   }
function checkAll(domId,name)
{
    var el = document.getElementById(domId).getElementsByTagName("input"); 
    //var el = document.getElementsByTagName('input');
 //取document domId中所有的input，比如文本输入框、按钮等元件，全都取出来存入数组，可以用el.length取数量，el[i]取内容
    var len = el.length;
    for(var i=0; i<len; i++)
    {
        if((el[i].type=="checkbox") && (el[i].name=='slm[]'))
        {
              el[i].checked = true;
        }
    }
}
function clearAll(domId,name)
{
    //var el = document.getElementsByTagName('input');
    var el = document.getElementById(domId).getElementsByTagName("input"); 
	var len = el.length;
    for(var i=0; i<len; i++)
    {
        if((el[i].type=="checkbox") && (el[i].name=='slm[]'))
        {
              el[i].checked = false;
        }
    }
}

</script>

<body>
<div class="crumb-wrap">
<div class="crumb-list">系统管理<span class="crumb-step">&gt;</span><span class="crumb-name"><a href="SuperUser.php">用户管理</a></span><span class="crumb-step">&gt;</span><span class="crumb-name">修改用户</span></div>
</div>
<div align="center">
  
  <?php 
$id=make_safe($_GET['id']);
$rsuser=setsql("select","select * from lhadmin where id=:id",array(':id' =>$id));

?>
  <form name="form1" method="post" action="?action=modify">
  <input name="id" type="hidden" value="<?php echo $id; ?>">
  
    <table  width="60%" border=0 align=center cellspacing=1 class="table-list"  >
      <tr>
        <th colspan="2" ><div align="center">修改用户</div>
            <div align="center"></div></td>
      </th>
      <tr>
        <td width="78" ><div align="center">用户名：</div></td>
        <td width="146"><?php echo $rsuser[0]['lhuser']; ?></td>
      </tr>
      <tr>
        <td ><div align="center">新密码：</div></td>
        <td ><input name="password" type="password"  id="password" size="20"> 新密码为空则密码不变       </td>
      </tr>
      <tr>
        <td ><div align="center">管理权限</div></td>
        <td ><select name="dj" id="dj" onChange="typechange()">
            <option value="1">网站管理员</option>
            <option value="2" <?php if($rsuser[0]['dj']==2){; ?>selected="selected"<?php } ?>>信息录入员</option>
          </select>        </td>
      </tr>
    </table>
    <table width="60%" align="center" class="table-list" id="lmgl" style="margin-top:0px;<?php if($rsuser[0]['dj']==1){; ?>display:none<?php } ?>">
	<tr>
	  <td><div align="center">管理栏目</div></td>
	</tr>
	<tr>
      <td >
      <div align="left"><font style="line-height:150%">
<?php 
$sql="select * from class where parentid =0 order by classid ";
$mypdo = new DBPDO;
$rs = $mypdo->select($sql);
if (count($rs)==0){
   	echo "<br><div align='center'>没有任何分类</div>";}
else
{
		$lmstr=",".$rsuser[0]['lm'].",";
    	for ($i=0; $i<count($rs); $i++){
			
			
?> 			 <div id="div<?php  echo $rs[$i]['classid']; ?>">
		   <input name="blm[]" type="checkbox" value="<?php     echo $rs[$i]['classid']; ?>" <?php if(strpos($lmstr,",".$rs[$i]['classid'].",") !== false){ ?> checked<?php } ?> onClick="if(this.checked==true) { checkAll('div<?php     echo $rs[$i]['classid']; ?>','slm'); } else { clearAll('div<?php     echo $rs[$i]['classid']; ?>','slm'); }">&nbsp;<?php     echo $rs[$i]['classname']; ?></br>
<?php 
			$sql2="select * from class where parentid='".$rs[$i]['classid']."'";
			$mypdo_s = new DBPDO;
			$rs_s = $mypdo_s->select($sql2);
			$mypdo_s = null;
			
      		 for ($j=0; $j<count($rs_s); $j=$j+1){
?>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="slm[]" type="checkbox" value="<?php       echo $rs_s[$j]['classid']; ?>" <?php if(strpos($lmstr,",".$rs_s[$j]['classid'].",") !== false){ ?> checked<?php } ?>>&nbsp;<?php       echo $rs_s[$j]['classname']; ?>&nbsp;&nbsp;
			<?php  }
			
 			echo " </div>";
			
			
		} 
} 
$mypdo=null;
?>
</div>
      </td>
    </tr>
    
</table>
    <table width="299"  border=0 align=center cellspacing=1 class="list1" style="margin-bottom:0px; margin-top:0px;">
      <tr>
        <td><div align="center"></br>
          <label>
          <input  name="Submit3" type="submit" class="btn btn-primary btn3 mr10" value="提交">
          </label>
          <label> &nbsp;
          <input  name="Submit22" type="reset" class="btn btn3" value="重置">
          </label>
</div></td>
      </tr>
    </table>
   
  </form>

 
</div>
</body>

</html>

