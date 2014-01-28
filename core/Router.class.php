<?php

class Router {
	
	const httpGET = 'GET';
	const httpPOST = 'POST';
	const httpPUT = 'PUT';
	const httpDELETE = 'DELETE';
	
	private $routeKey = '__route__';
	private $routes = array();
	private $regexes = array();
	
	private $httpCodes = array(200 => 'OK',
								303 => 'See Other',
								307 => 'Temporary Redirect',
								400 => 'Bad Request',
								401 => 'Unauthorized',
								403 => 'Forbidden',
								404 => 'Not Found',
								420 => 'Enhance Your Calm',
								500 => 'Internal Server Error');
								
	public function __construct($db) {
		/**
		 * We don't care about plugin routes, those are added as the
		 * plugins are registered and initialized. Instead, we only
		 * want to worry about the 'soft routes,' the ones to the 
		 * database-powered pages and such.
		 */
		//get pages from database
		$pages = $db->many('SELECT path FROM pages WHERE published=1');
		//create route table
		foreach($pages as $p) {
			$this->addRoute($p['method'], $p['path'], array('PageCreator', 'startTheMagic'));
		}
		
	}
	
	public function redirect($path) {
		
	}
	
	//for plugins to add routes
	public function newRoute($method, $path, $callback) {
		//eventually, do a check to make sure stuff
		$this->addRoute($method, $path, $callback);
	} 
	
	private function addRoute($method, $path, $callback) {
		$this->routes[] = array('httpMethod' => $method,
								'path' => $path,
								'callback' => $callback);
		$this->regexes[] = "#^{$path}\$#";
	}
	private function getRoute($path = false, $method = false) {
		if(!$path && !$method) {
			throw new Exception("Can't find route or method");
			return false;
		}
		
		foreach($this->regexes as $i => $regex) {
			if(preg_match($regex, $path, $arguments)) {
				array_shift($arguments);
				$def = $this->routes[$i];
				if($method != $def['httpMethod']) {
					continue;
				}
				elseif(is_array($def['callback']) && method_exists($def['callback'][0], $def['callback'][1])) {
					$a = $def; // array is copied
					$a['arguments'] = $arguments;
					return $a;
				}
				else {
					throw new Exception("Can't find method {$method}");
				}
			}
		}
		throw new Excpetion("Can't find route {$path}");
	}
	public function run() {
		
		$path = isset($_REQUEST[$this->routeKey]) ? $_REQUEST[$this->routeKey] : '/'; //get request path
		$httpMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : self::httpGET;
		
		$route = $this->getRoute($path, $httpMethod);	//get route to run
		ob_start();
		$call_user_func_array($route['callback'], $route['arguments']);
		$data = ob_get_flush();
		
		//send to templating
		Sizico::$instance -> printToScreen($data);
	}
}
