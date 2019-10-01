<?php
error_reporting(0);//����δ�������
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
  
        //��ʼ��  
        function __construct() {  
            $this->dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;  
            $this->dbuser = DB_USER;  
            $this->dbpwd = DB_PWD;  
            $this->connect();  
            $this->dbh->query("SET NAMES 'UTF8'");  
            $this->dbh->query("SET TIME_ZONE = '+8:00'");  
        }  
  
        //�������ݿ�  
        public function connect() {  
            try {  
                $this->dbh = new PDO($this->dsn, $this->dbuser, $this->dbpwd);  
            }  
            catch(PDOException $e) {  
                exit('����ʧ��:'.$e->getMessage());  
            }  
        }  
  
        //��ȡ���ֶ�  
        public function getFields($table='vista_order') {  
            $this->sth = $this->dbh->query("DESCRIBE $table");  
            $this->getPDOError();  
            $this->sth->setFetchMode(PDO::FETCH_ASSOC);  
            $result = $this->sth->fetchAll();  
            $this->sth = null;  
            return $result;  
        }  
  
        /*��������  
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


  
        /*ɾ������  
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

  
        /*��������  
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
		

		
  
        /*��ȡ����  
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


  
        //��ȡ��Ŀ  
        public function count($sql) {  
            $count = $this->dbh->query($sql);  
            $this->getPDOError();  
            return $count->fetchColumn();  
        }  
  
        //��ȡPDO������Ϣ  
        private function getPDOError() {  
            if($this->dbh->errorCode() != '00000') {  
                $error = $this->dbh->errorInfo();  
                exit($error[2]);  
            }  
        }  
  
        //�ر�����  
        public function __destruct() {  
            $this->dbh = null;  
        }  
		
		
		/**
    ��������
    */
    public function beginTransaction(){
        return $this->dbh->beginTransaction();
    }
    /**
    �ύ����
    */
    public function commit(){
        return $this->dbh->commit();
    }
    /**
    ����ع�
    */
    public function rollBack(){
        return $this->dbh->rollBack();
    }
     
    public function lastInertId(){
        return $this->dbh->lastInsertId();
    }
	
	/**
    ȫ���������ã�������������ʽ�ʹ�����ʾ����    ����ʹ������Ҳ��ֱ��ʹ�ò���
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
    ����һ������õ�sql���ģ�� �����ʹ�� ? :name ����ʽ
    ����һ��statement����
    */
    public function prepare($sql){
        if(empty($sql)){
            return false;
        }
        $this->statement = $this->dbh->prepare($sql);
        return $this->statement;
    }
    /**
    ִ��Sql��䣬һ������ ����ɾ�����»�������  ����Ӱ�������
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

//�ж��Ƿ�������
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
//ȡ���������
function getclassname($classid){ 
  $sql="select classname from class where classid = :classid";
  $mypdo = new DBPDO; ;
  $rs = $mypdo->select($sql,array(':classid' => $classid));
  $mypdo=null;
  return $rs[0]['classname'];
}

//ȡ�ü�¼
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