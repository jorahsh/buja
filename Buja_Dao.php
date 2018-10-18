<?php

require_once 'KLogger.php';

class Buja_Dao {

	private $hostname = 'us-cdbr-iron-east-01.cleardb.net';
	private $database = 'heroku_a10cdf868be118a';
	private $username = 'b046dc89c93083';
	private $password = '2d5d094e';
	private $log;

	public function __construct() {
		$this->log = new KLogger("db_log.txt", KLogger::INFO);
		$this->log->LogInfo("successfully created Buja_Dao!");
	}


	public function getConnection() {
		try {
			 echo "mysql: host={$this->hostname};dbname={$this->database}, {$this->username}, {$this->password}";
			$conn = new PDO("mysql: host={$this->hostname};dbname={$this->database}", $this->username, $this->password);
		}
		catch (Exception $e) {
			echo "$e";
			$this->log->LogFatal($e);
		}
		return $conn;
	}

	public function getUser($username, $password) {
		$sql = "select * from user where user.username = :username and user.password = :password";
		$conn = $this->getConnection();
		try {
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":username", $username);
			$stmt->bindParam(":password", $password);
			$stmt->execute();
			$stmt->bind_result($ret);
			$stmt->fetch();
			$conn = null;
		}
		catch (Exception $e) {
			$this->log->LogFatal($e);
		}
		return $ret;
	}

	public function setUser($username, $email, $password) {
		$sql = "insert into user (username, email, password, access) values(:username, :email, :password, 1)";
		$conn = $this->getConnection();
		$stmt = $conn->prepare($sql);
		try {
			$stmt->bindParam(":username", $username);
			$stmt->bindParam(":email", $email);
			$stmt->bindParam(":password", $password);
			$stmt->execute();
			$conn = null;
		}
		catch (Exception $e) {
			$this->log->LogFatal($e);
		}
	}
}
