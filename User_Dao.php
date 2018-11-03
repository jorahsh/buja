<?php

require_once 'KLogger.php';

class User_Dao {

	private $socket = '/tmp/mysql.socket';
	private $hostname = 'us-cdbr-iron-east-01.cleardb.net';
	private $database = 'heroku_176bc87887e3e6a';
	private $username = 'b3b1c0fdfa9db9';
	private $password = 'a2ddf83c';
	private $log;

	public function __construct() {
		$this->log = new KLogger("db_log.txt", KLogger::INFO);
		$this->log->LogInfo("successfully created User_Dao!");
	}


	public function getConnection() {
		try {
			$conn = new PDO("mysql:unix_socket={$this->socket};host={$this->hostname};dbname={$this->database}", $this->username, $this->password);
		}
		catch (Exception $e) {
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
			$ret = $stmt->fetch();
			$conn = null;
		}
		catch (Exception $e) {
			$this->log->LogFatal($e);
		}
		return $ret;
	}

	public function addUser($username, $email, $password) {
		$sql = "insert into user (username, email, password, access) values(:username, :email, :password, 1)";
		$conn = $this->getConnection();
		$stmt = $conn->prepare($sql);
		try {
			$stmt->bindParam(":username", $username);
			$stmt->bindParam(":email", $email);
			$stmt->bindParam(":password", $password);
			$stmt->execute();
			$ret = $stmt->rowCount();
			$conn = null;
		}
		catch (Exception $e) {
			$this->log->LogFatal($e);
		}
		return $ret;
	}
}
