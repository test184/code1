<?php
 include_once "islogin.php";
 include_once "../include/db.php";
include_once "../include/function.php";
//error_reporting(E_ALL);
 $usersql="select * from lhAdmin where lhuser=:lhuser";
 $rsuser=setsql("select",$usersql,array(':lhuser' => $_SESSION['lh_dluser']));
 $lmstr=$rsuser[0]['lm'];

  $artid = make_safe($_GET['artid']);
  $page = make_safe($_GET['page']);
  
  if (!empty($_REQUEST['selclassid'])&&(is_numeric ($_REQUEST['selclassid']))) 
{
	$selclassid = make_safe($_REQUEST['selclassid']);
	$caozuocs="artid=".$artid."&selclassid=".$selclassid."&page=".$page;
}
else if(!empty($_REQUEST['searchkeys']))
{
	$searchkeys = make_safe($_REQUEST['searchkeys']);
	$caozuocs="artid=".$artid."&searchkeys=".$searchkeys."&page=".$page;
}
else{
ok_info(0,"参数错误");
}
  

$sql="select * from article where artid=:artid";
$rs=getarrsql($sql,array(':artid' => $artid));
$classname=$rs[0]['classname'];
$parentame=$rs[0]['parentame'];
$parentid=$rs[0]['parentid'];
$classid=$rs[0]['classid'];
$keywords=$rs[0]['keywords'];
$descrip=$rs[0]['descrip'];
$title=$rs[0]['title'];
$content=$rs[0]['content'];
$addtime=formatdata($rs[0]['addtime']);
$savepathfilename=$rs[0]['savepathfilename'];


?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改信息</title>
<link rel="stylesheet" href="../lhedit/themes/default/default.css" />
<link rel="stylesheet" href="../lhedit/plugins/code/prettify.css" />
<script charset="utf-8" src="../lhedit/kindeditor-all.js"></script>
<script charset="utf-8" src="../lhedit/lang/zh_CN.js"></script>
<script charset="utf-8" src="../lhedit/plugins/code/prettify.js"></script>
<script language="JavaScript">

	KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="d_content"]', {
				cssPath : '../lhedit/plugins/code/prettify.css',
				uploadJson : '../lhedit/php/upload_json.php',
				fileManagerJson : '../lhedit/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=postart]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=postart]')[0].submit();
					});
				}
			});
			prettyPrint();
		});

	</script>
<script language="JavaScript">
	function checkDate(dateval){
     var arr = new Array();
     
     if(dateval.indexOf("-") != -1){
         arr = dateval.toString().split("-");
     }else if(dateval.indexOf("/") != -1){
         arr = dateval.toString().split("/");
     }else{
         return false;
     }
     
     //yyyy-mm-dd || yyyy/mm/dd
     if(arr[0].length==4){
         var date = new Date(arr[0],arr[1]-1,arr[2]);
         if(date.getFullYear()==arr[0] && date.getMonth()==arr[1]-1 && date.getDate()==arr[2]){
             return true;
         }
     }
     //dd-mm-yyyy || dd/mm/yyyy
     if(arr[2].length==4){
         var date = new Date(arr[2],arr[1]-1,arr[0]);
         if(date.getFullYear()==arr[2] && date.getMonth()==arr[1]-1 && date.getDate()==arr[0]){
             return true;
         }
     }
     //mm-dd-yyyy || mm/dd/yyyy
     if(arr[2].length==4){
         var date = new Date(arr[2],arr[0]-1,arr[1]);
         if(date.getFullYear()==arr[2] && date.getMonth()==arr[0]-1 && date.getDate()==arr[1]){
             return true;
         }
     }
     
     return false;
 }
	function checkForm(){
	
		
		if (checkDate(document.postart.addtime.value)==false)
		{alert("请正确填写日期（例如:2018-1-23）！");
		return false;
		}
		 
		if (document.postart.lbclass.value=="0") {
			alert("请选择类别！");
			document.postart.lbclass.focus();
			return false;
		}
		
		
		if (document.postart.txttitle.value.length == 0) {
			alert("请输入标题！");
			document.postart.txttitle.focus();
			return false;
		}
		
		

       return true;

		

	}
	


</script>
<style type="text/css">
<!--
.STYLE2 {color: #FF0000; padding-top:5px;}
-->
</style>
</head>


<body>
<div class="crumb-wrap">
<div class="crumb-list">信息管理<span class="crumb-step">&gt;</span><span class="crumb-name">修改信息</span><span class="crumb-step">&gt;</span><span class="crumb-name">该信息ID为：<b><?php echo $artid; ?></span></div>
</div>
<div align="center">
<form method="POST" action="AritcleModifySave.php?<?php echo $caozuocs; ?>" name="postart" onSubmit="return checkForm()">
	
            
              <table align="center" class="table-list"  width="98%" >
               
                <tr>
                  <td align="right" valign="middle" bgcolor="#FFFFFF" class="table_td2" ><div align="center">信息类别：</div></td>
                  <td bgcolor="#FFFFFF">
                  <?php lb_option("lbclass","请选择类别",1,$classid,$lmstr);?>
                      <span class="STYLE2">*</span></td> 
                </tr>
                
                
                <tr> 
                  <td width="10%" align="right"  valign="middle" ><div align="center"><span class="STYLE2">*</span>标&nbsp;&nbsp; 题：</div></td>
                  <td  colspan="2"><input class="common-text" name="txttitle" type="TEXT" id="txttitle"  value="<?php echo $title; ?>" size=60>
                  </td>
                </tr>
                <tr>
                  <td align="right"  valign="middle" ><div align="center">关 键 字：</div></td>
                  <td  colspan="2"><input class="common-text" name="keywords" type="TEXT" id="keywords"  value="<?php echo $keywords; ?>" size=60>
                  (如留空则关键字为:标题_网站名)</td>
                </tr>
				<tr>
                  <td align="right" valign="middle"  ><div align="center">描述信息：</div></td>
                  <td colspan=2 ><textarea name="descrip" cols="75" rows="3" id="descrip"><?php echo $descrip; ?></textarea>
                  (如留空则描述信息为文章前150字符)</td>
                </tr>
   				

                
                <tr> 
                  <td height="25" colspan=3 align="left" > 
                     <textarea id="d_content" name="d_content" style="width:750px;height:300px;">
                   <?php if ($content!=""){
 					 echo htmlspecialchars($content);} ?>
                   </textarea>					</td>
                </tr>
                <tr>
                  <td height="20" align=center ><div align="center">发布日期：</div></td>
                  <td height="20" colspan="2"  ><input name="addtime" type="TEXT" size=20 maxlength=20  value="<?php echo $addtime; ?>">
注意不要改变格式。</td>
                </tr>
                
                <tr> 
                  <td height="20" colspan=3 align=left style=" padding-left:280px;"> 
                    <input  name="cmdok" type="submit" class="btn btn-primary btn5 mr10" value="修 改" >
                    &nbsp; 
                    <input  name="cmdcancel" type="reset" class="btn btn5" value="重 写" >
&nbsp;&nbsp;                  </td>
                </tr>
    </table>


</form>
</div>

