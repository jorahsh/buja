<?php

require_once 'KLogger.php';

class Comments_Dao {

	private $socket = '/tmp/mysql.socket';
	private $hostname = 'us-cdbr-iron-east-01.cleardb.net';
	private $database = 'heroku_176bc87887e3e6a';
	private $username = 'b3b1c0fdfa9db9';
	private $password = 'a2ddf83c';
	private $log;

	public function __construct() {
		$this->log = new KLogger("db_log.txt", KLogger::INFO);
		$this->log->LogInfo("successfully created Comments_Dao!");
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

	public function getAllComments() {
		$sql = "select * from comments";
		$conn = $this->getConnection();
		try {
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$ret = $stmt->fetchAll();
			$conn = null;
		}
		catch (Exception $e) {
			$this->log->LogFatal($e);
		}
		return $ret;
	}

	public function getMovieComments($movie) {
		$sql = "select username, comment, date from comments c join user u on u.id = c.user_id where c.movie_id = :movie";
		$conn = $this->getConnection();
		try {
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":movie", $movie);
			$stmt->execute();
			$ret = $stmt->fetchAll();
			$conn = null;
		}
		catch (Exception $e) {
			$this->log->logFatal($e);
		}
		return $ret;
	}

	public function addComment($user,$movie,$comment) {
		$sql = "insert into comments (user_id, movie_id, comment) values (:user, :movie, :comment)";
		$conn = $this->getConnection();
		try {
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":user", $user);
			$stmt->bindParam(":movie", $movie);
			$stmt->bindParam(":comment", $comment);
			$stmt->execute();
			$conn = null;
		}
		catch (Exception $e) {
			$this->log->logFatal($e);
		}
	}	
}
