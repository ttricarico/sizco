<?php
/**
 * The settings file for the entire site. This is site-wide stuff, like mysql connections
 *
 *
 ***/


/** mysql connections **/
$databaseInfo['dbname'] = '';
$databaseInfo['host'] = '';
$databaseInfo['user'] = '';
$databaseInfo['pass'] = '';

$setting['server_name'] = '';
$setting['root_path'] = realpath(dirname(__FILE__));

/** routing table **/
$setting['routing_table'] = 'site-routes.php';

/** log file **/
$setting['logfile'] = 'site-log.txt';
