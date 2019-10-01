
<?php 
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";

//error_reporting(E_ALL);
 
 $usersql="select * from lhAdmin where lhuser=:lhuser";
 $rsuser=setsql("select",$usersql,array(':lhuser' => $_SESSION['lh_dluser']));
 $lmstr=$rsuser[0]['lm'];

?>
<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加信息</title>
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
	function checkForm(){
	
		
		if (document.postart.txttitle.value.length == 0) {
			alert("请输入标题！");
			document.postart.txttitle.focus();
			return false;
		}
		
		if (document.postart.classid.value == 0) {
			alert("请选择类别！");
			document.postart.classid.focus();
			return false;
		}
		

       return true;

		

	}
	

</script>
<style type="text/css">
<!--
.STYLE1 {
	color: #0066CC;
	font-weight: bold;
}
.STYLE2 {color: #FF0000; }
-->
</style>
</head>
<body>
<div class="crumb-wrap">
<div class="crumb-list">信息管理<span class="crumb-step">&gt;</span><span class="crumb-name">发布信息</span></div>
</div>
<div align="center">
<form method="POST" action="AritcleAddSave.php" name="postart" onSubmit="return checkForm()">

           
              <table class="table-list"  width="98%" >
               
                <tr> 
                  <td width="10%" align="right" valign="middle"  class="table_td2" ><div align="center">信息类别：</div></td>
                 
                  <td >
		   <?php lb_option("classid","请选择类别",1,$_GET['classid'],$lmstr);?>
		  <input name="parentid" type="hidden" id="parentid" value="<?php echo $parentid; ?>">
         </td>
                </tr>
                
                
                <tr> 
                  <td width="10%" align="right" Class="table_td2" valign="middle" ><div align="center"><span class="STYLE2">*</span> 标&nbsp; 题：</div></td>
                  <td  colspan="2"><input name="txttitle"  type="TEXT" size=60 class="common-text">
                    </td>
                </tr>
				
   
	
	<input type=hidden name=d_savepathfilename>
	<tr> 
                  <td width="10%" align="right" valign="top"  ><div align="center">关 键 字：</div></td>
                  <td colspan=2 ><input name="keywords" id="keywords" type="TEXT" size=60 class="common-text">
                    (如留空则关键字为:标题_网站名)</td>
                </tr>
				<tr>
                  <td align="right" valign="middle"  ><div align="center">描述信息：</div></td>
                  <td colspan=2 ><textarea name="Descrip" cols="75" rows="3" id="Descrip"></textarea>
                  (如留空则描述信息为文章前150字符)</td>
                </tr>
				
				
                
                
                <tr> 
                  <td height="25" colspan=3 align="left"> 
                    <textarea id="d_content" name="d_content" style="width:750px;height:300px;" ></textarea>					</td>
                </tr>
                
                <tr> 
                  <td  colspan=3 align=left style=" padding-left:280px;"> 
                    <input  name="cmdok" type="submit" class="btn btn-primary btn5 mr10" style=" height=40px;" value=" 添 加 " >
                    &nbsp;  &nbsp;&nbsp;  &nbsp;
                    <input name="cmdcancel" type="reset" class="btn btn5" value=" 重 写 " >
&nbsp;&nbsp;                  </td>
                </tr>
    </table>

</form>
</div>

