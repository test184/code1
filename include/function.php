<?php 
function cutstr_html1($string,$length=0,$ellipsis=''){    
$string=strip_tags($string);    
$string=preg_replace('/\n/is','',$string);    
$string=preg_replace('/ |　/is','',$string);    
$string=preg_replace('/ /is','',$string);    
preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/",$string,$string);    
if(is_array($string)&&!empty($string[0])){    
if(is_numeric($length)&&$length){    
$string=join('',array_slice($string[0],0,$length)).$ellipsis;    
 }else{    
 $string=implode('',$string[0]);    
 }    
}else{    
 $string='';    
}    
return $string;    
}   
function cutstr_html($text, $length)
{
     if(mb_strlen($text, 'utf8') > $length) 
    return mb_substr($text, 0, $length, 'utf8').'...';
     return $text;
}


function clearHtml($content){    
$content=preg_replace("/<a[^>]*>/i","",$content);    
$content=preg_replace("/<\/a>/i","",$content);    
$content=preg_replace("/<div[^>]*>/i","",$content);    
$content=preg_replace("/<\/div>/i","",$content);    
$content=preg_replace("/<!--[^>]*-->/i","",$content);//注释内容        
$content=preg_replace("/style=.+?['|\"]/i",'',$content);//去除样式        
$content=preg_replace("/class=.+?['|\"]/i",'',$content);//去除样式        
$content=preg_replace("/id=.+?['|\"]/i",'',$content);//去除样式           
$content=preg_replace("/lang=.+?['|\"]/i",'',$content);//去除样式            
$content=preg_replace("/width=.+?['|\"]/i",'',$content);//去除样式         
$content=preg_replace("/height=.+?['|\"]/i",'',$content);//去除样式         
$content=preg_replace("/border=.+?['|\"]/i",'',$content);//去除样式         
$content=preg_replace("/face=.+?['|\"]/i",'',$content);//去除样式         
$content=preg_replace("/face=.+?['|\"]/",'',$content);//去除样式 只允许小写 正则匹配没有带 i 参数      
return $content;    
}

function formatdata($addtime){

	$rsdatay=date("Y",strtotime($addtime));
	$rsdatam=date("m",strtotime($addtime)); 
	$rsdatad=date("d",strtotime($addtime));
	return $rsdatay."-".$rsdatam."-".$rsdatad;
}
function formatdata_d($addtime){

	$rsdatam=date("m",strtotime($addtime)); 
	$rsdatad=date("d",strtotime($addtime));
	return $rsdatam."-".$rsdatad;
}



//防注入函数 主要是为了防止恶意写入后台数据库
function input_check($sql_str) { 
   $check=eregi('select|order by|from|and|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|system_user|user|current_user|database|version', $sql_str);     // 进行过滤 
   if($check){ 
       echo "非法注入内容！"; 
       exit(); 
   }else{ 
       return $sql_str; 
   } 

} 


function injCheck($sql_str) { 
	$check = preg_match('/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/', $sql_str);
	if ($check) {
		ok_info('/index.html','非法字符');
		exit;
	} else {
		return $sql_str;
	}
}

function make_safe($variable) {
$variable = addslashes(trim($variable));
return $variable;
}

/**操作成功提示**/
function ok_info($url,$langinfo){
	if($url==0){
		echo("<script type='text/javascript'> alert('$langinfo');history.go(-1);</script>");		
	}else{
		echo("<script type='text/javascript'> alert('$langinfo');location.href= '$url'; </script>");  
	}
	exit;
}

function getIp() {
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip = getenv("HTTP_CLIENT_IP");
	else
		if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else
			if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
				$ip = getenv("REMOTE_ADDR");
			else
				if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
					$ip = $_SERVER['REMOTE_ADDR'];
				else
					$ip = "unknown";
	return ($ip);
}
//翻页函数
function getcount($countsql,$parameters = array()){
	$mypdo = new DBPDO; ;
	$sylmrs = $mypdo->select($countsql,$parameters);
    $amount = $sylmrs[0]['amount'];  //$amount的值为记录条数，是个整数
	$mypdo = null;	
	return $amount;
}

function getPageCount($amount,$PageSize){
	 if($amount)
	   {   //$PageCount表示总共有多少页。
        
          if($amount<$PageSize){$PageCount = 1;}//如果总数据量小于每页数量则总页数为1
          if($amount%$PageSize)
		   	 {$PageCount = (int)($amount/$PageSize)+1;}
          else
	         {$PageCount = $amount/$PageSize;}
       }
       else
	   { $PageCount = 0;}
	   
	   return $PageCount;
}

class sysconfig {  
		
		public $website;
		public $weburl;
		public $beianhao;
		public $lhkeywords;
		public $lhdescrip;
		public $lhauthor;
		public $lhorigin;
		public $newsperpage;
		public $showhit;
		public $indexjt;
		public $listjt;
		public $artjt;
		public $moban;
  
        //初始化  
        function __construct() {  
		      $syssql="select * from sys where id=1";
			  $mypdo = new DBPDO;
  			  $sysrs = $mypdo->select($syssql);
			  
			  $this->website = $sysrs[0]['website'];
			  $this->weburl=$sysrs[0]['weburl'];
			  $this->beianhao=$sysrs[0]['beianhao'];
			  $this->lhkeywords=$sysrs[0]['lhkeywords'];
			  $this->lhdescrip=$sysrs[0]['lhdescrip'];
			  $this->lhauthor=$sysrs[0]['lhauthor'];
			  $this->lhorigin=$sysrs[0]['lhorigin'];
			  $this->newsperpage=$sysrs[0]['newsperpage'];
			  $this->showhit=$sysrs[0]['showhit'];
			  $this->indexjt=$sysrs[0]['indexjt'];
			  $this->listjt=$sysrs[0]['listjt'];
			  $this->artjt=$sysrs[0]['artjt'];
			  $this->moban=$sysrs[0]['moban'];
			  
			   
        }  
		
}

//类别选择下拉框 
//$op_name 下拉框名字
//$ts_info 下拉框显示提示信息
//$show 是否类别全都可选择，0都可选择，1有子类的不可选
//$sel_clssid 被选择的classid ，0为没有
//例 lb_option("lbname","请选择类别",1,0);
//$lmstr是信息录入员栏目权限;
function lb_option($op_name,$ts_info,$show,$sel_clssid,$lmstr)
{
	 echo "<select class=\"common-text\" name=\"".$op_name."\">";
	 echo "<option value=\"0\">".$ts_info."</option>";
	 	  if(empty($lmstr)){
			 $sql1="select * from class where parentid=0";}
		  else
		    {
			 $sql1="select * from class where parentid=0 and classid in (".$lmstr.")";}
			 $lb1=getarrsql($sql1);
			 for($i=0;$i<count($lb1);$i++)
			 
			 {
				 if(empty($lmstr)){
				   $sql2="select * from class where parentid = :classid";
				   $lb2=getarrsql($sql2,array(':classid'=>$lb1[$i]['classid']));}
				 else
				 {
				    $sql2="select * from class where parentid = :classid and classid in (".$lmstr.")";
				    $lb2=getarrsql($sql2,array(':classid'=>$lb1[$i]['classid']));
					 }
				 if ($lb2&&$show) {
					 echo  "<option value=\"".$lb1[$i]['classid']."\" disabled=\"disabled\">".$lb1[$i]['classname']."</option>\r\n";}
				 else{
					 if($lb1[$i]['classid']==$sel_clssid){
						 echo  "<option value=\"".$lb1[$i]['classid']."\" selected=\"selected\">".$lb1[$i]['classname']."</option>\r\n";}
						
					 else{
					 	 echo  "<option value=\"".$lb1[$i]['classid']."\">".$lb1[$i]['classname']."</option>\r\n";}
				 }
					
				for($j=0;$j<count($lb2);$j++){
					if($lb2[$j]['classid']==$sel_clssid){
						echo  "<option value=\"".$lb2[$j]['classid']."\" selected=\"selected\">&nbsp;&nbsp;&nbsp;".$lb2[$j]['classname']."</option>\r\n";}
					else{
						echo  "<option value=\"".$lb2[$j]['classid']."\">&nbsp;&nbsp;&nbsp;".$lb2[$j]['classname']."</option>\r\n";}
					
				}
			}
			 echo "</select>";
}



function get_list_url($listjt,$classid,$issc)
{
if($listjt){
	
	 if($issc){$url="list/".$classid.".html";}
	 else {$url="list/".$classid."_1.html";}
	}
else{
	 $url="view/list.php?classid=".$classid;
     }
return $url;
}

function get_art_url($artjt,$artid)
{
if($artjt){
	
	 $url="article/".$artid.".html";}
	
else{
	 $url="view/article.php?artid=".$artid;
     }
return $url;
}

function get_index_url($indexjt)
{
if($indexjt){
	
	 $url="index.html";}
	
else{
	 $url="index.php";
     }
return $url;
}


function deldir($dir) { 
  //先删除目录下的文件： 
  $dh=opendir($dir); 
  while ($file=readdir($dh)) { 
    if($file!="." && $file!="..") { 
      $fullpath=$dir."/".$file; 
      if(!is_dir($fullpath)) { 
          unlink($fullpath); 
      } else { 
          deldir($fullpath); 
      } 
    } 
  } 
  closedir($dh); 
  //删除当前文件夹： 
  if(rmdir($dir)) { 
    return true; 
  } else { 
    return false; 
  } 
}
?>