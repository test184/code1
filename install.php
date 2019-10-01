

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>烈火文章管理系统安装程序</title>
</head>
<style type="text/css">
body	{ margin-top:20px; padding:0px; font-size:13px; line-height:1.7; color:#6d2f2f; }
.table-list {
	margin-top: 10px;
	border-collapse: collapse;
	border: 1px solid #ddd;
	text-align: center;
}
.table-list th,.table-list td{padding:5px;border-bottom: 1px solid #ddd;border-right: 1px solid #e1e1e1;}
.table-list th {
	COLOR: #000; HEIGHT: 35px; background: url("images/tab-thbg.png") #f9f9f9 0 bottom repeat-x;font-size: 14px;ONT-FAMILY: 微软雅黑
}
.table-list td {
	PADDING-LEFT: 5px; HEIGHT: 35px; BACKGROUND-COLOR: #FFF;font-size: 14px;ONT-FAMILY: 微软雅黑
}
</style>
<body>
    <center>
        <h2>烈火文章管理系统配置初始化</h2>
    <hr/>
    
  
    <?php
header('Content-Type:text/html; charset=utf-8');

error_reporting(E_ALL & ~E_NOTICE);

if($_GET['action']=="install"){
//接收数据库信息
$db_host = trim($_POST['db_host']);
$db_user = trim($_POST['db_user']);
$db_pass = trim($_POST['db_pass']);
$db_name = trim($_POST['db_name']);

//接收管理员信息
$ad_user = trim($_POST['ad_user']);
$ad_pass = md5(trim($_POST['ad_pass']));
$ad_repass = md5(trim($_POST['ad_repass']));

if(empty($db_host) or empty($db_user) or empty($db_pass) or empty($db_name)){
	die ('<script type="text/javascript">alert("数据库信息不能为空！");history.go(-1)</script>');
}

if(empty($ad_user) or empty($ad_pass) ){
	die ('<script type="text/javascript">alert("管理员信息不能为空！");history.go(-1)</script>');
} 

if($ad_pass!=$ad_repass){
	die ('<script type="text/javascript">alert("两次密码不一致！");history.go(-1)</script>');
}  

	


//配置文件内容
    $config="<?php";
    $config.="\n";
    $config.="define('DB_HOST', '".$db_host."');";
    $config.="\n";
    $config.="define('DB_USER', '".$db_user."');";
    $config.="\n";
    $config.="define('DB_PWD', '".$db_pass."');";
    $config.="\n";
    $config.="define('DB_NAME', '".$db_name."');";
    $config.="\n";
    $config.="?>";

$filename="include/config.php";
$myfile = fopen($filename, "w") ;
fwrite($myfile, $config);
fclose($myfile);





include_once $alurl."include/config.php";

try {
        $conn = new PDO("mysql:host=".DB_HOST, DB_USER, DB_PWD);
        echo "<br/>数据库连接成功<br/>"; 
        
        //创建数据库
        // 设置 PDO 错误模式为异常 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql = "CREATE DATABASE ".DB_NAME; 
        // 使用 exec() ，因为没有结果返回 
        $conn->exec($sql); 
        echo "数据库创建成功<br>";        
    
    $conn = null;


    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PWD);
    // 设置 PDO 错误模式，用于抛出异常
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 使用 sql 创建数据表
   
	$sql1="CREATE TABLE IF NOT EXISTS `article` (
  `artid` int(11) NOT NULL AUTO_INCREMENT,
  `classid` int(11) DEFAULT '0',
  `classname` varchar(50) DEFAULT NULL,
  `parentid` int(11) DEFAULT '0',
  `parentname` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `descrip` longtext,
  `keywords` longtext,
  `author` varchar(50) DEFAULT NULL,
  `origin` varchar(50) DEFAULT NULL,
  `content` longtext,
  `addtime` datetime DEFAULT NULL,
  `hits` int(11) DEFAULT '0',
  `tj` tinyint(1) DEFAULT '0',
  `savepathfilename` longtext,
  PRIMARY KEY (`artid`),
  KEY `BigClassID` (`parentid`),
  KEY `smallclassid` (`classid`),
  KEY `typeid` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql2="CREATE TABLE IF NOT EXISTS `class` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL,
  `classname` varchar(50) DEFAULT NULL,
  `menuis` tinyint(1) DEFAULT '1',
  `menuxh` int(11) NOT NULL DEFAULT '0',
  `lmis` tinyint(1) DEFAULT '1',
  `lmxh` int(11) DEFAULT '0',
  PRIMARY KEY (`classid`),
  KEY `BigClassID` (`classid`),
  KEY `showid` (`menuis`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql3="CREATE TABLE IF NOT EXISTS `lhadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lhuser` varchar(50) DEFAULT NULL,
  `lhpassword` varchar(50) DEFAULT NULL,
  `dj` varchar(50) DEFAULT NULL,
  `lm` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql4="CREATE TABLE IF NOT EXISTS `sys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website` varchar(50) DEFAULT NULL,
  `weburl` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `beianhao` varchar(50) DEFAULT NULL,
  `lhkeywords` longtext,
  `lhdescrip` longtext,
  `newsperpage` int(11) DEFAULT '0',
  `showhit` tinyint(1) DEFAULT NULL,
  `indexjt` tinyint(1) DEFAULT NULL,
  `artjt` tinyint(1) DEFAULT NULL,
  `listjt` tinyint(1) DEFAULT NULL,
  `moban` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql5="CREATE TABLE IF NOT EXISTS `hd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `url` longtext,
  `picture` varchar(100) DEFAULT NULL,
  `lb` int(11) DEFAULT '0',
  `xh` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql6="CREATE TABLE IF NOT EXISTS `cd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cdname` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql7="INSERT INTO `sys` (`id`, `website`, `weburl`, `mail`, `beianhao`, `lhkeywords`, `lhdescrip`, `newsperpage`, `showhit`, `indexjt`, `artjt`, `listjt`, `moban`) VALUES
(1, '烈火文章管理系统', 'http://www.strongfire.cn', '', '', '文章管理系统，烈火文章管理系统', '烈火文章管理系简单实用，操作方便，界面简洁。', 30, 1, 0, 0, 0, 1)";

$sql8="INSERT INTO `lhadmin` (`id`, `lhuser`, `lhpassword`, `dj`, `lm`) VALUES
(1, '".$ad_user."', '".$ad_pass."', '1', '')";
// 使用 exec() ，没有结果返回
$conn->exec($sql1);
$conn->exec($sql2);
$conn->exec($sql3);
$conn->exec($sql4); 
$conn->exec($sql5);
$conn->exec($sql6);
echo "数据表创建成功</br>";
$conn->exec($sql7);
$conn->exec($sql8);
echo "初始化数据完成</br>";
rename("install.php", "install.lock");
echo "</br><a href=\"admin\">登录</a>&nbsp;后台进行管理 </br>";
    }
    catch(PDOException $e)
    {
        echo "<mark><br>".$sql . "<br>" . $e->getMessage()."<br></mark>";
    }
    
    //关闭连接
    $conn = null;
	

}
else{
?>
    
    
    
        <form action="?action=install" method="post">
            <table  width="400" class="table-list">
                <tr>
                  <th colspan="2">填写数据库信息</th>
                </tr>
                <tr>
                    <td>数据库主机：</td>
                    <td><input name="db_host" type="text" id="db_host" placeholder="127.0.0.1"/></td>
                </tr>
                <tr>
                    <td>数据库账号：</td>
                    <td><input name="db_user" type="text" id="db_user"/></td>
                </tr>
                <tr>
                    <td>数据库密码：</td>
                    <td><input type="password" name="db_pass" id="db_pass"/></td>
                </tr>
                    <td>数据库名称：</td>
                    <td><input name="db_name" type="text" id="db_name" placeholder="lhcms"></td>
                </tr>
                    <tr>
                      <th colspan="2">填写管理员信息</th>
                    </tr>
                    <tr>
                      <td>管理帐号：</td>
                      <td><input type="text" name="ad_user" id="ad_user"/></td>
                    </tr>
                    <tr>
                      <td>管理密码：</td>
                      <td><input type="password" name="ad_pass" id="ad_pass"/></td>
                    </tr>
                    <tr>
                    <td>确认密码：</td>
                    <td><input type="password" name="ad_repass" id="ad_repass"/></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <input type="submit" value="安装"/>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="reset" value="重置"/>
                    </td>
                </tr>
            </table>
            

        </form>
<?php } ?>
    </center>
</body>
</html>