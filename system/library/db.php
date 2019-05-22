<?php
class DB {
	private $db;

	public function __construct($driver, $hostname, $username, $password, $database) {
		$class = 'DB\\' . $driver;

		if (class_exists($class)) {
			$this->db = new $class($hostname, $username, $password, $database);
		} else {
			exit('Error: Could not load database driver ' . $driver . '!');
		}
	}

	public function query($sql) {
		return $this->db->query($sql);
	}

	public function escape($value) {
		return $this->db->escape($value);
	}

	public function countAffected() {
		return $this->db->countAffected();
	}

	public function getServerInfo() {
		return $this->db->getServerInfo();
	}

	public function getHostInfo() {
		return $this->db->getHostInfo();
	}

	public function getProtocolVersion() {
		return $this->db->getProtocolVersion();
	}

	public function getError() {
		return $this->db->getError();
	}

	public function getLastId() {
		return $this->db->getLastId();
	}
}
