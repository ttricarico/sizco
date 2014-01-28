<?php

class Events {
	
	//startup and shutdown
	const EVENT_STARTUP = 'startup';
	const EVENT_SHUTDOWN = 'shutdown';
	
	//routing pages
	const EVENT_PAGE_ROUTE = 'page_routing';
	const EVENT_ROUTING_TABLES_LOAD_START = 'page_routing_tables_load_start';
	const EVENT_ROUTING_TABLES_LOAD_END = 'page_routing_tables_load_end';
	
	

	private $events = array();
	
	//adding listeners and event firing
	/**
	 * public addListener
	 * @param String $event
	 * @param mixed $action g
	 * @return int $actionid
	 */
	public function addListener($event, $action) {
		
	}
	public function removeListener($actionid) {
		
	}
	public function fireEvent($event) {
		
	}
	
	
}
