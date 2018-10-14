<?php

require_once 'db_config.php';
require_once 'KLogger.php';

class Buja_Dao {

	private $log;

	public function __Construct () {
		$this->log = new KLogger("db_log.txt", KLogger::INFO);
		$this->log->LogInfo("successfully created Buja_Dao!");
	}


	public function getConnection() {
		try {
			$conn = new PDO("mysql: host={$db['default']['hostname']};dbname={$db['default']['database']}", 
				$db['default']['username'], $db['default']['password']);
		}
		catch (Exception $e){
			$this->log.LogFatal($e);
		}
		return $conn;
	}

	public getUser($username, $password) {
		$sql = "select * from user where user.username = :username and user.password = :password";
		$conn = $this->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":username", $username);
		$stmt->bindParam(":password", $password);
		$stmt->execute();
		$stmt->bind_result($ret);
		$stmt->fetch();
		$conn = null;
		return $ret;
	}

	public setUser($username, $email, $password) {
		$sql = "insert into user (username, email, password, access) values(:username, :email, :password, 1)";
		$conn = $this->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":username", $username);
		$stmt->bindParam(":email", $email);
		$stmt->bindParam(":password", $password);
		$stmt->execute();
		$conn = null;
	}
}
