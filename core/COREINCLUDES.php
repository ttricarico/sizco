<?php
$d = realpath(dirname(__FILE__));
$files = glob($d.'/*.class.php');
foreach($files as $f) {
  include_once($f);
}

include_once('functions.php');
