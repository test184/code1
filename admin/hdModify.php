<?php
error_reporting(E_ALL & ~E_NOTICE);
 include_once "islogin.php";
 include_once "../include/db.php";
 include_once "../include/function.php";
 
?>

<html>
<head>
<LINK href="admin_Css.css" type=text/css rel=stylesheet>
<link rel="stylesheet" href="../lhedit/themes/default/default.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改</title>
<style type="text/css">
<!--
.STYLE1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>

<?php 
$lb=make_safe($_GET['lb']);
$id=make_safe($_GET['id']);
if ($lb==1) {
	$dhname="首页幻灯图片管理";
}
else{
	$dhname="快速链接图片管理";
}

$action=make_safe($_GET['action']);


if ($action=="modify")
{
	$title=make_safe($_POST['title']);
	$url=make_safe($_POST['url']);
	$picture=make_safe($_POST['d_image']);
	$xh=make_safe($_POST['xh']);
	


  if (empty($_POST['title'])||empty($_POST['url'])||empty($_POST['d_image'])||empty($_POST['xh']))
  {
  ok_info(0,"请检查各项参数是否完整");
   
  }
  else
  {
	$sql = "update hd set xh=:xh,title=:title,url=:url,picture=:picture where id=:id"; 
	$arru = array(
	':id'=>$id,
	':xh'=>$xh,
	':url'=>$url,
	':picture'=>$picture,
	':title'=>$title,
    );
    $resultupdate = setsql("update",$sql,$arru); 
	
    header("Location:hdpic.php?lb=".$lb);

  }
}
?>


<script charset="utf-8" src="../lhedit/kindeditor-all.js"></script>
<script charset="utf-8" src="../lhedit/lang/zh_CN.js"></script>
<script charset="utf-8" src="../lhedit/plugins/code/prettify.js"></script>
<script>
			KindEditor.ready(function(K) {
				var editor = K.editor({
					allowFileManager : true
				});
				K('#image1').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							imageUrl : K('#url1').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#url1').val(url);
								editor.hideDialog();
							}
						});
					});
				});
				K('#image2').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showLocal : false,
							imageUrl : K('#url2').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#url2').val(url);
								editor.hideDialog();
							}
						});
					});
				});
				K('#image3').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#d_image').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#d_image').val(url);
								editor.hideDialog();
							}
						});
					});
				});
			});
		</script>
</head>
<body>
<div class="crumb-wrap">
<div class="crumb-list">综合管理<span class="crumb-step">&gt;</span><span class="crumb-name"><a href="hdpic.php?lb=<?php echo $lb;?>"><?php echo $dhname; ?></a></span><span class="crumb-step">&gt;</span><span class="crumb-name">修改图片参数</span></div>
</div>
<div align="center"><br>
<?php  
$sql="select * from hd where id=:id";
$rs=getarrsql($sql,array(':id' => $id));
 ?>
  <form name="form1" method="post" action="?action=modify&id=<?php echo $rs[0]['id']; ?>&lb=<?php echo $lb; ?>">
  <table class="table-list" width="800">
   
    <tr>
      <td width="77" ><div align="right" >显示序号：</div></td>
      <td width="463" >
        <input name="xh" type="text" id="xh" value="<?php  echo $rs[0]['xh']; ?>" size="10">
       
        (显示图片的次序)        </td>
    </tr>
    <tr>
      <td ><div align="right">标题名称：</div></td>
      <td ><input name="title" type="text" id="title" value="<?php     echo $rs[0]['title']; ?>" size="50" class="common-text"></td>
    </tr>
    <tr>
      <td ><div align="right">链接地址：</div></td>
      <td ><input name="url" type="text" id="url" value="<?php     echo $rs[0]['url']; ?>" size="50" class="common-text"></td>
    </tr>
    <tr>
      <td ><div align="right">图 &nbsp;片：</div></td>
      <td >
      <input type="text" id="d_image" name="d_image" value="<?php     echo $rs[0]['picture']; ?>" size="70" /> 
		   <input type="button" class="button" id="image3" value="选择图片" />
		  </td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td align="center" ><div align="left" class="table_td2">
          <input name="Action" type="hidden" id="Action" value="Modify">
          <input  name="Save" type="submit" class="btn btn-primary btn3" id="Save" value="修 改" >
      </div></td>
    </tr>
  </table>
  
  </form>
  <p><br>
    <br>
  </p>
</div>
</body>

</html>

