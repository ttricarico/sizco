<?php

/**
 * returns the url, including https
 * @param $print - if true, echo the url, if false, return
 * @return String $url
 */
function baseurl($print = false) {
	global $setting;
	
	$protocol = '';
	
	if($_SERVER['https'] == 'on') 
		$protcol = 'https';
	else
		$protocol = 'http';
	
	if($print)
		echo $protocol.'://'.$setting['server_name'];
	
	return $protocol.'://'.$setting['server_name'];
}

function filepath($print = false) {
	
}

/** catch all to get any setting **/
function getSetting($s) {
	global $setting;
	
	return $setting[$s];
}

/** event handling
 * really, these are just a wrapper for the sizco object
 */
function fireEvent($event) {
	global $sizco;
	
	$sizco->events->fireEvent($event);
}
function addListener($event, $action) {
	global $sizco;
	$sizco->events->addListener($event, $action);
}
function removeListener($actionid) {
	global $sizco;
	$sizco->events->removeListener($actionid);
}
