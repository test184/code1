
	<div class="tit">最新发布</div>

<?php 

$fbsql="select artid,title,classid,classname,addtime from article order by artid desc limit 8";
$fbrs = setsql("select",$fbsql);


 for($i=0;$i<count($fbrs);$i++)
  {

   
    $xstitle=cutstr_html($fbrs[$i]['title'],56);
	$url=get_art_url($artjt,$fbrs[$i]['artid']); 
    $rsdata= formatdata($fbrs[$i]['addtime']);
    
?>	
<div class="fbdl">
<div class="fbdt">

<a href="<?php echo get_list_url($listjt,$fbrs[$i]['classid'],0); ?>" target ="_blank"><?php echo $fbrs[$i]['classname']; ?></a>
</div>
<div class="fbdd"><a title="<?php  echo $fbrs[$i]['title']; ?>" href="<?php  echo $url; ?>" target ="_blank"><?php     echo $xstitle; ?></a></div>
<div class="fbdata"><?php     echo $rsdata; ?></div>
</div>
<?php 


  } 
 


?>

