<?php

require_once('./core/COREINCLUDES.php');

require_once('settings.php');
//create the site
$sizco = new Sizco();

//ready? run the route
$sizco->route->run();
