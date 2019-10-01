<?php
error_reporting(0);//忽视未定义错误
ini_set('date.timezone','Asia/Shanghai');

header("Content-type:text/html; charset=utf-8");  
include_once "config.php";    
  
    class DBPDO {  
  
        private static $instance;         
        public $dsn;         
        public $dbuser;         
        public $dbpwd;         
        public $sth;         
        public $dbh;   
  
        //初始化  
        function __construct() {  
            $this->dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;  
            $this->dbuser = DB_USER;  
            $this->dbpwd = DB_PWD;  
            $this->connect();  
            $this->dbh->query("SET NAMES 'UTF8'");  
            $this->dbh->query("SET TIME_ZONE = '+8:00'");  
        }  
  
        //连接数据库  
        public function connect() {  
            try {  
                $this->dbh = new PDO($this->dsn, $this->dbuser, $this->dbpwd);  
            }  
            catch(PDOException $e) {  
                exit('连接失败:'.$e->getMessage());  
            }  
        }  
  
        //获取表字段  
        public function getFields($table='vista_order') {  
            $this->sth = $this->dbh->query("DESCRIBE $table");  
            $this->getPDOError();  
            $this->sth->setFetchMode(PDO::FETCH_ASSOC);  
            $result = $this->sth->fetchAll();  
            $this->sth = null;  
            return $result;  
        }  
  
        /*插入数据  
        $test = new DBPDO;  
		$sql = "insert into article(title,classid) values(:title,:classid)";
		$result = $test->insert($sql, array(':title' => 'ppp1',':classid' =>6 ));
		echo $result;
		*/
		
		public function insert($sql, $parameters = array())
		 {
		  $rows = $this->dbh->prepare($sql);
		  $rows->execute($parameters);
		  return $this->dbh->lastInsertId();  
		  //return $rows->rowCount();
		 }


  
        /*删除数据  
        $test = new DBPDO;  
		$sql = "delete from article where artid=:id";
		$result = $test->delete1($sql, array(':id' => 155));
		echo $result;
        */
		public function delete($sql, $parameters = array())
		 {
		  $rows = $this->dbh->prepare($sql);
		  $rows->execute($parameters);
		
		  return $rows->rowCount();
		 }

  
        /*更改数据  
        $test = new DBPDO;  
		$sql = "update article set title = :title where artid=:artid";
		$result = $test->update($sql, array(':title' => 'a8', ':artid' => 154));
		echo $result;
		*/
		public function update($sql, $parameters = array())
		 {
		  $rows = $this->dbh->prepare($sql);
		  $rows->execute($parameters);
		  return $rows->rowCount();
		 }
		

		
  
        /*获取数据  
        $test = new DBPDO;  
		$sql = "select artid,title from article where title like :keyword order by artid asc limit 5";
		$result = $test->select($sql, array(':keyword' => '4%'));
		print_r($result);
		*/
		
		public function select($sql, $parameters = array(), $option = PDO::FETCH_ASSOC)
	   {
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute($parameters);
		$row = $stmt->fetchAll($option);
		$stmt=null;
		return $row;
	   }
	   
	   public function query($sql, $parameters = array(), $option = PDO::FETCH_ASSOC)
	   {
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute($parameters);
	  
		$tmp = array();
		while($row = $stmt->fetch($option))
		{
		 $tmp[] = $row;
		}
	  
		return $tmp;
	   }


  
        //获取数目  
        public function count($sql) {  
            $count = $this->dbh->query($sql);  
            $this->getPDOError();  
            return $count->fetchColumn();  
        }  
  
        //获取PDO错误信息  
        private function getPDOError() {  
            if($this->dbh->errorCode() != '00000') {  
                $error = $this->dbh->errorInfo();  
                exit($error[2]);  
            }  
        }  
  
        //关闭连接  
        public function __destruct() {  
            $this->dbh = null;  
        }  
		
		
		/**
    开启事务
    */
    public function beginTransaction(){
        return $this->dbh->beginTransaction();
    }
    /**
    提交事务
    */
    public function commit(){
        return $this->dbh->commit();
    }
    /**
    事务回滚
    */
    public function rollBack(){
        return $this->dbh->rollBack();
    }
     
    public function lastInertId(){
        return $this->dbh->lastInsertId();
    }
	
	/**
    全局属性设置，包括：列名格式和错误提示类型    可以使用数字也能直接使用参数
    */
	public function setAttr($param, $val = ''){
        if(is_array($param)){
            foreach($param as $key => $val){
                $this->dbh->setAttribute($key, $val);
            }
        }else{
            if($val != '' ){
                $this->dbh->setAttribute($param, $val);
            }else{
                return false;
            }
        }
    }
    /**
    生成一个编译好的sql语句模版 你可以使用 ? :name 的形式
    返回一个statement对象
    */
    public function prepare($sql){
        if(empty($sql)){
            return false;
        }
        $this->statement = $this->dbh->prepare($sql);
        return $this->statement;
    }
    /**
    执行Sql语句，一般用于 增、删、更新或者设置  返回影响的行数
    */
    public function exec($sql){
        if(empty($sql)){
            return false;
        }
        try{
            return $this->dbh->exec($sql);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
		
		
		
    }  

//判断是否有子类
function issc($classid)
      {
	
	$sql="select * from class where parentid = :classid";
	$mypdo1 = new DBPDO;
	$rs1 = $mypdo1->select($sql,array(':classid' => $classid));
	
	if(count($rs1)==0){
  		return 0;}
  	else
 		 {
  		return 1;}
    $mypdo1 =null;
} 
//取得类别名字
function getclassname($classid){ 
  $sql="select classname from class where classid = :classid";
  $mypdo = new DBPDO; ;
  $rs = $mypdo->select($sql,array(':classid' => $classid));
  $mypdo=null;
  return $rs[0]['classname'];
}

//取得记录
//print_r (getarrsql("select * from class where classid=:classid",array(':classid'=>1)));
//print_r (getarrsql("select * from class "));
function getarrsql($mysql,$parameters = array()){
	$mypdo = new DBPDO;
	$rs = $mypdo->select($mysql,$parameters);
	$mypdo=null;
	return $rs;
}
function setsql($action,$mysql,$parameters = array()){
	$mypdo = new DBPDO;
	switch ($action)
	{
	 case "select":
	 	  $rs = $mypdo->select($mysql,$parameters);
	 	  break;
	case "insert":
	 	  $rs = $mypdo->insert($mysql,$parameters);
	 	  break;
	case "update":
	 	  $rs = $mypdo->update($mysql,$parameters);
	 	  break;
	case "delete":
	 	  $rs = $mypdo->delete($mysql,$parameters);
	 	  break;
	}

	$mypdo=null;
	return $rs;
}


?>