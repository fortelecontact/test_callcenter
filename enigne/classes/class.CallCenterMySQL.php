<?php

class CallCenterMySQL extends PDO {

	private $hostname;
	private $username;
	private $password;
	private $database;

	private $sUnlockRow = "SELECT phone,statusId,contactId FROM contacts WHERE  (lockedAt < TIMESTAMP(DATE_SUB(NOW(), INTERVAL ? SECOND)) or lockedAt is null) and statusId IN ( :status_array )  LIMIT 1";
	private $uRowLock = "UPDATE contacts SET lockedAt = NOW() where contactId = :contactId ";
	private $uRowUnLock = "UPDATE contacts SET lockedAt = null where contactId = :contactId ";
	private $uStatus = "UPDATE contacts SET statusId = :statusId where contactId = :contactId ";
	private $currentUserId;

	public $pdo;
	private $bConnected = false;
	private $arrayedResult;

	//Первоя строка результата(правда,в данном случае иных и не может быть).
	public 	$oneRowArrayResult;

	function __construct($database=DBNAME, $username=DBUSER, $password=DBPASS, $hostname=DBHOST, $port=3306){
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
		$this->hostname = $hostname.':'.$port;
		
		$this->Connect();
	}

	// Коннект
	private function Connect(){
		$dsn = 'mysql:dbname='.$this->database.';host='.$this->hostname.'';
		try 
		{
			$this->pdo = new PDO($dsn, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->bConnected = true;
		}
		catch (PDOException $e) 
		{
			echo $this->ExceptionLog($e->getMessage());
			die();
		}
	}

	// Может принимать массив значений статусов подходящих для выборки. 
	// После выборки ставит timestamp для рассчета блокировки. 
	public function selectUnlockRowsAndLock($statusArray = 0){
		$this->sUnlockRow = str_ireplace(":status_array", implode(',', array_fill(0, count($statusArray), '?')), $this->sUnlockRow);
		$bParam = array(CALL_INTERVAL);
		$bParam= array_merge((array)$bParam, (array)$statusArray);
		if($this->executeSQL($this->sUnlockRow,$bParam,false)){
			$this->oneRowArrayResult=$this->arrayedResult['0'];
			$this->setUserId($this->oneRowArrayResult['contactId']);
			if($this->setRowLock())
				return 1;
		}
		return 0;	
	}

	public function setRowLock(){
		$bParam = array(
			":contactId" => $this->currentUserId,
		);
		if($this->executeSQL($this->uRowLock,$bParam)){
			return 1;
		}
		return 0;
	}

	public function unsetRowLock(){
		$bParam = array(
			":contactId" => $this->currentUserId,
		);
		if($this->executeSQL($this->uRowUnLock,$bParam)){
			return 1;
		}
		return 0;
	}

	// В данной реализации  предполгается, что после изменения статуса, занятая строка освобождается
	//Получает id статуса на который заменяем
	public function chageStatus($status){
		$bParam = array(
			":statusId" => $status,
			":contactId" => $this->currentUserId,
		);
		if($this->executeSQL($this->uStatus,$bParam)){
			if($this->unsetRowLock());
				return 1;
		}
		return 0;
	}

	// Если named = false, значит вместо : - ? (индексация +1)
	public function executeSQL($query,$bParam=0,$named=true)
	{
		if($this->bConnected){
			$res = $this->pdo->prepare($query);
			if(!empty($bParam)){
			if($named){
				foreach ($bParam as $key => &$val) {
					$res->bindValue($key, $val);
				}
			}
			else{
					foreach ($bParam as $key => &$val) {
					$res->bindValue(($key+1), $val);
				}
			}
			}
			$res->execute();
			$statement = strtolower(substr($query, 0 , 6));
			if ($statement === 'select') {
				$this->arrayedResult = $res->fetchAll(PDO::FETCH_ASSOC);
			}
			return 1;
		}
		return 0;
	}
	
	public function setUserId($cid){
		$this->currentUserId = $cid;
	}

}