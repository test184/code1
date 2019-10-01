

<?php 

error_reporting(E_ALL & ~E_NOTICE);
$hdwidth=368; //幻灯div宽度
$hdheight=298; //幻灯div高度
$hdpicw=368; //幻灯图片宽度
$hdpich=276; //幻灯图片高度
; ?>

<style type="text/css">
<!--


#focus {
	WIDTH:<?php echo $hdwidth; ?>px;
	POSITION: relative;
	HEIGHT: <?php echo $hdheight; ?>px;
}
#au {
	FILTER: progid:DXImagetransform.Microsoft.Fade (duration=0.5,overlap=1.0); WIDTH: <?php echo $hdwidth; ?>px; HEIGHT: <?php echo $hdheight; ?>px;
}

#conau {
	MARGIN-TOP: 0px;
	FONT-WEIGHT: normal;
	FONT-SIZE: 13px;
	LEFT: 0px;
	WIDTH: <?php echo $hdwidth; ?>px;
	COLOR: #333333;
	FONT-FAMILY: "宋体";
	POSITION: absolute;
	HEIGHT: 22px;
	TEXT-ALIGN: center;
	background-color: #FFFFFF;
	bottom: 0px;
}
#conau A {
	COLOR: #990000;
	FONT-SIZE: 13px;
	text-decoration:none;
	
}
#conau A:hover {
	COLOR: #990000;
	FONT-SIZE: 13px;
	text-decoration:none;

}
.lunbo {
	RIGHT: 3px;
	WIDTH: 138px;
	POSITION: absolute;
	TOP: 250px;
	HEIGHT: 21px
}
.lunbo TABLE {
	HEIGHT: 21px
}
.lunbo TD {
	FONT-WEIGHT: bold; COLOR: #000; LINE-HEIGHT: 12px
}
.lunbo .bg { padding:2px 0px 0px 0px; BACKGROUND-IMAGE: url(images/pic_2.gif);  WIDTH: 18px; LINE-HEIGHT: 21px; HEIGHT: 21px; TEXT-ALIGN: center; COLOR: #030100; background-repeat:no-repeat;}

.lunbo .active { padding:2px 0px 0px 0px; BACKGROUND-IMAGE: url(images/pic_1.gif);  WIDTH: 18px; LINE-HEIGHT: 21px; HEIGHT: 21px; TEXT-ALIGN: center; COLOR: #a8471c; background-repeat:no-repeat;}


-->
</style>
<div align="center">

	  <div id="focus">
     <div id="au">
<?php 



$sql="Select * From hd where lb=1 order by xh";
$tprs = getarrsql($sql);
$r=count($tprs)-1;

?>
<div style="display: block"><a href="<?php echo $tprs[0]['url']; ?>" target="_blank"><img src="<?php echo $tprs[0]['picture']; ?>" width="<?php echo $hdpicw; ?>" height="<?php echo $hdpich; ?>" alt="<?php echo $tprs[0]['title']; ?>"  border="0"/></a></div>
<?php for ($i=1; $i<=$r; $i=$i+1)
{
?>

<div style="display: none"><a href="<?php   echo $tprs[$i]['url']; ?>" target="_blank"><img src="<?php   echo $tprs[$i]['picture']; ?>" width="<?php   echo $hdpicw; ?>" height="<?php   echo $hdpich; ?>" alt="<?php   echo $tprs[$i]['title']; ?>" border="0"/></a></div>

<?php 
} ?>


<div class="lunbo">
<table border="0" cellPadding="0" cellSpacing="0" align="right">
<tr>

<td class="active" id="t0" onmouseover="Mea(0);clearAuto();" onmouseout="setAuto();">1</td>
<td width="6"></td>
<?php for ($i=1; $i<=$r; $i=$i+1)
{
?>
<td class="bg" id="t<?php   echo $i; ?>" onmouseover="Mea(<?php   echo $i; ?>);clearAuto();" onmouseout="setAuto();"><?php   echo $i+1; ?></td>
<td width="6"></td>
<?php 
} ?>

</tr>
</table>
</div>
<div id="conau">
<div  style="padding-top:3px;"><a href="<?php echo $tprs[0]['url']; ?>" target="_blank"><?php echo cutstr_html($tprs[0]['title'],32); ?></a></div>
<?php for ($i=1; $i<=$r; $i=$i+1)
{
?>
<div style="display: none;padding-top:3px;"><a href="<?php   echo $tprs[$i]['url']; ?>" target="_blank"><?php   echo cutstr_html($tprs[$i]['title'],32); ?></a></div>
<?php 

} 


?>
</div>
</div>
</div>

<script type="text/javascript"> 
var n=0;
var ni=<?php echo $r+1; ?>;
function Mea(value){
	n=value;
	setBg(value);
	plays(value);
	conaus(n);
	}
function setBg(value){
	for(var i=0;i<ni;i++)
		document.getElementById("t"+i+"").className="bg";
		document.getElementById("t"+value+"").className="active";
	} 
function plays(value){
	try
	{
		with (au){
			filters[0].Apply();
			for(i=0;i<ni;i++)i==value?children[i].style.display="block":children[i].style.display="none"; 
			filters[0].play(); 		
			}
	}
	catch(e)
	{
		var d = document.getElementById("au").getElementsByTagName("div");
		for(i=0;i<ni;i++)i==value?d[i].style.display="block":d[i].style.display="none"; 
	}
}
function conaus(value){
	try
	{
		with (conau){

				for(i=0;i<ni;i++)i==value?children[i].style.display="block":children[i].style.display="none"; 
				
				}
	}
	catch(e)
	{
		var d = document.getElementById("conau").getElementsByTagName("div");
		for(i=0;i<ni;i++)i==value?d[i].style.display="block":d[i].style.display="none"; 
	}

}
function clearAuto(){clearInterval(autoStart)}
function setAuto(){autoStart=setInterval("auto(n)", 4000)}
function auto(){
	n++;
	if(n><?php echo $r; ?>)n=0;
	Mea(n);
	conaus(n);
} 
setAuto(); 
 
</script>
</div>

	