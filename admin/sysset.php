<?php
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";
 include_once "../mbfile/mb_fun.php";
 

$action=make_safe($_GET['action']);
if ($action=="ok")
{

$website=make_safe($_POST['website']);
$weburl=make_safe($_POST['weburl']);
$lhkeywords=make_safe($_POST['lhkeywords']);
$lhdescrip=make_safe($_POST['lhdescrip']);
$showhit=make_safe($_POST['showhit']);
$newsperpage=make_safe($_POST['newsperpage']);
$indexjt=make_safe($_POST['indexjt']);
$listjt=make_safe($_POST['listjt']);
$indexjt_y=make_safe($_POST['indexjt_y']);
$artjt=make_safe($_POST['artjt']);



 
  $sql = "update sys set website=:website,weburl=:weburl,lhkeywords=:lhkeywords,lhdescrip=:lhdescrip,showhit=:showhit ,newsperpage=:newsperpage,indexjt=:indexjt,listjt=:listjt,artjt=:artjt where id=1"; 
	$arru = array(
	':website'=>$website,
	':weburl'=>$weburl,
	':lhkeywords'=>$lhkeywords,
	':lhdescrip'=>$lhdescrip,
	':showhit'=>$showhit,
	':newsperpage'=>$newsperpage,
	':indexjt'=>$indexjt,
	':listjt'=>$listjt,
	':artjt'=>$artjt,
    );
    $resultupdate = setsql("update",$sql,$arru); 
	
	//如果首页静态则把index.php改成mb_index.php，同时生成静态首页，否则把mb_index.php改成index.php、删除静态首页
if($indexjt!=$indexjt_y){
   if($indexjt==1){
    if (file_exists('../index.php')){rename('../index.php','../mb_index.php');make_index();}
   }
   else
   {
	if (file_exists('../mb_index.php')){rename('../mb_index.php','../index.php');unlink('../index.html');}
   }
}

	
	
   echo "<script language=javascript>";
   echo "alert('系统设置成功！');";
   echo "</script>";
  
}

 $sysrs=setsql("select","select * from sys where id=1");

$website=$sysrs[0]['website'];
$weburl=$sysrs[0]['weburl'];
$lhkeywords=$sysrs[0]['lhkeywords'];
$lhdescrip=$sysrs[0]['lhdescrip'];
$newsperpage=$sysrs[0]['newsperpage'];
$showhit=$sysrs[0]['showhit'];
$indexjt=$sysrs[0]['indexjt'];
$listjt=$sysrs[0]['listjt'];
$artjt=$sysrs[0]['artjt'];

?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统设置</title>

<style type="text/css">
<!--
.STYLE1 {
	font-size: 14px;
	color: #0000FF;
	font-weight: bold;
}
-->
</style>
</head>


<body>
<div class="crumb-wrap">
<div class="crumb-list">系统管理<span class="crumb-step">&gt;</span><span class="crumb-name">系统设置</span></div>
</div>
<div align="center">
  <form name="form1" method="post" action="sysset.php?action=ok">
  
  
  <table class="table-list" width="98%">
   
      <td ><div align="left">本站站名&nbsp;&nbsp;&nbsp;&nbsp;</div>
      <div align="center"></div>        <div align="center"></div></td>
      <td ><input name="website" type="text" value="<?php echo $website; ?>" size="30" class="common-text"></td>
    </tr>
    <tr>
      <td ><div align="left">本站网址&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td ><input name="weburl" type="text" value="<?php echo $weburl; ?>" size="30" class="common-text">
        </td>
    </tr>
    

    
    <tr>
      <td width="223" ><div align="left">首页默认 keywords</div></td>
      <td colspan="-2" ><input name="lhkeywords" type="text" value="<?php echo $lhkeywords; ?>" size="60" class="common-text">
        (多个关键字以，相隔）</td>
    </tr>
    <tr>
      <td >首页默认 Description</td>
      <td width="976" colspan="-2" ><textarea name="lhdescrip" cols="80" rows="5" id="lhdescrip"><?php echo $lhdescrip; ?></textarea></td>
    </tr>
	 
	 <tr>
	   <td >文章页是否显示阅读次数</td>
	   <td colspan="-2" ><input name="showhit" type="checkbox" id="showhit" value="1" <?php if ($showhit==true)
{
?>checked><?php } ?></td>
      </tr>
	 
	 <tr>
	   <td >列表页显示的文章条数</td>
	   <td colspan="-2" ><input name="newsperpage" type="text" id="newsperpage" value="<?php echo $newsperpage; ?>" size="5" class="common-text"></td>
      </tr>
      
      
  </table>
  <p>
    <input name="Submit" type="submit" class="btn btn-primary btn4" value="设 置">
     &nbsp;&nbsp;&nbsp;<br>
  </form>
  </p>
  <br>
</div>
</body>

</html>

