<?php

class Sizco{

	public static $instance;
	public $route;
	public $appVersion = '1.0a';
	public $events;

	private $plugins = array();
	private $eventListeners = array();
	private $sessionId;


	public function __construct() {
		global $databaseInfo, $setting;

		ob_start();
		self::$instance = $this;
		$this->events = new Events();

		$this->sessionStart();
		$this->db = new Database($databaseInfo['dbname'], $databaseInfo['host'], $databaseInfo['user'], $databaseInfo['pass']);
		$this->route = new Router($this->db);
		$this->registerPlugins();
		//after plugins are registerd
		$this->events->fireEvent(Events::EVENT_STARTUP);

	}

	public function __destruct() {
		$this->events->fireEvent(Events::EVENT_SHUTDOWN);
	}

	/**
	 * Registers plugins found in /plugins.
	 */

	private function registerPlugins() {
		//later, something with routes and such


	}






	//session controls
	public function sessionStart() {
		session_start();
	}
	public function sessionEnd() {
		session_destroy();
	}
	public function sessionSet($key = null, $value = null) {
		$_SESSION[$key] = $value;
		return $value;
	}
	public function sessionGet($key = null) {
		if(is_null($key)) {
			return false;
		}
		elseif(empty($_SESSION[$key])) {
			return false;
		}
		else {
			return $_SESSION[$key];
		}

	}
	public function sessionDelete($key = null) {
		unset($_SESSION[$key]);
		return true;
	}

	/** templating **/
	public function printToScreen($data) {
		//add the beginning html stuff
		//check if <!DOCTYPE or <!doctype is set, if so, don't send to templating engine
		$data = trim($data);
		if(substr($data, 0, 9) == '<!DOCTYPE' || substr($data, 0, 9) == '<!doctype') {
			//the templates have the beginning of the html
			echo $data;
		}

	}

}

//external function
function errorShutdown($errorName, $errorMessage) {

	ob_end_clean();
	include('templates/fatal-error.php');

	die();

}
