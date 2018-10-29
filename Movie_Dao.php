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

	public function getMoviesUserHasNotSeen($user) {
		$sql = "select * from movie m where not exists (select * from movie m left join user_movie um on m.id = um.movie_id where um.user_id = :user)";
		$conn = $this->getConnection();
		try {
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":user", $user);
			$stmt->execute();
			$ret = $stmt->fetchAll();
			$conn = null;
		}
		catch (Exception $e) {
			$this->log->logFatal($e);
		}
		return $ret;
	}

	public function addSeenMovie($user,$movie) {
		$sql = "insert into user_move (user_id, movie_id) values (:user, :movie)";
		$conn = $this->getConnection();
		try {
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":user", $user);
			$stmt->bindParam(":movie", $user);
			$stmt->execute();
			$conn = null;
		}
		catch (Exception $e) {
			$this->log->logFatal($e);
		}
	}	
}
