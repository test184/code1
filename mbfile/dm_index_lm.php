<?php


$lmsql="select * from class where lmis ='1' and classid not in (select DISTINCT parentid from class) order by lmxh";
$rs = getarrsql($lmsql);

for($n=0;$n<count($rs);$n++){
	
$lmsql="select artid,title,classid,classname,parentname,parentid,addtime from article where classid=".$rs[$n]['classid']." order by artid desc limit 7";
$sylmrs = getarrsql($lmsql);

?>



<div class="news">

    <div class="newscontent">
         <div class="news_title">
               <div class="title_zi"><?php echo $rs[$n]['classname']; ?></div>
               <div class="title_more"><a href="<?php echo get_list_url($listjt,$rs[$n]['classid'],0); ?>">more</a></div>
         </div>
         <div class="newscontent_nr">
               <ul class="nl">
	       <?php
		  for($i=0;$i<count($sylmrs);$i++)
		  {
		  ?>
			   
               <li><span class="nrdian"></span><span class="nrtitle"><a href="<?php echo get_art_url($artjt,$sylmrs[$i]['artid']); ?>" target="_blank" title="<?php echo $sylmrs[$i]['title']; ?>">
			   <?php echo cutstr_html($sylmrs[$i]['title'],40); ?>
			   </a></span><span class="gray dateR"><?php echo formatdata($sylmrs[$i]['addtime']); ?></span></li>
	          <?php 
			   } 
			  ?>
			  </ul>
         </div>
					
   </div>
<?php
if ($n%2==0) {
?>

<div style=" width:10px; height:289px; float:left"></div>
<?php } else {?>
<div style="clear:both;height:7px;"></div>
<?php } ?>


 <?php 
 } 
?>
