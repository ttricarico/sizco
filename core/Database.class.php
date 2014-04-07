<?php

class Database{

	private $db;

	public function __construct($db, $host, $user, $pass) {
		try{
			$this->db = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return true;
		}
		catch(Exception $e) {
			die('<h1>Database Error: Cannot connect.</h1><br/>'.$e->getMessage());
		}
	}

	public function one($query, $vars) {
		try {
			$p = $this->prepare($query, $params);
			return $p->fetch(PDO::FETCH_ASSOC);
		}
		catch(Exception $e) {
			throw new Exception('Database Error: '.$e->getMessage());
		}
	}
	public function many($query, $vars) {
		try{
			$p = $this->prepare($query, $params);
			return $p->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e) {
			throw new Exception('Database Error: '.$e->getMessage());
		}
	}
	public function run($query, $vars) {
		try{
			$p = $this->prepare($query, $params);
			if(preg_match('/insert/i', $query)) {	//get inserted id
				return $this->db->lastInsertId();
			}
			else {
				return $p->rowCount();
			}
		}catch(Exception $e) {
			throw new Exception('Database Error: '.$e->getMessage());
		}
	}
	public function lastId() {
		$id = $this->db->lastInsertId();
		if($id < 0) {
			return $id;
		}
		else {
			return false;
		}
	}
	private function prepare($query, $params = array()) {
		try {
			$p = $this->db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$p->execute($params);
			return $p;
		}
		catch(Exception $e) {
			throw new Exception('PDO says: '.$e->getMessage().' - Your query: '.$query);
		}
	}
}
