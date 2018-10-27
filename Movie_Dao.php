<?php

require_once 'KLogger.php';

class Movie_Dao {

	private $socket = '/tmp/mysql.socket';
	private $hostname = 'us-cdbr-iron-east-01.cleardb.net';
	private $database = 'heroku_176bc87887e3e6a';
	private $username = 'b3b1c0fdfa9db9';
	private $password = 'a2ddf83c';
	private $log;

	public function __construct() {
		$this->log = new KLogger("db_log.txt", KLogger::INFO);
		$this->log->LogInfo("successfully created Movie_Dao!");
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

	public function getAllMovies() {
		$sql = "select * from movie";
		$conn = $this->getConnection();
		try {
			$ret = $conn->query($sql, PDO::FETCH_ASSOC);
			$conn = null;
		}
		catch (Exception $e) {
			$this->log->LogFatal($e);
		}
		return $ret;
	}

}
