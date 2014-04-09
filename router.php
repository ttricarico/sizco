<?php
/** for use with the command line built-in php server
    otherwise, it will just redirect to index.php

    to start the php webserver, type:
          php -S localhost:8080 router.php

    into the command line
    **/

if(php_sapi_name() == 'cli-server') {

  $_REQUEST['u'] = $_SERVER['REQUEST_URI'];

  return false;

}
else {
  require('index.php');
}
