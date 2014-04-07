<?php
/** THIS FILE IS NOT USED FOR ANYTHING **
 *  It is here as an idea for a possible future logging system
 *  For now, the logging system has been moved to the function logit() in core/functions.php
 **************************************


class Log {

  const SIZCO_LOG_NOTICE = 'SIZCO NOTICE: ';
  const SIZCO_LOG_WARNING = 'SIZCO WARNING: ';
  const SIZCO_LOG_ERROR = 'SIZCO ERROR: ';
  const SIZCO_LOG_FATAL = 'SIZCO FATAL: ';

  private $logpath, $logfile;

  public function __construct() {

    $this->logpath = $setting['root-path'].'/'.$setting['logfile'];

    //see if logfile exists, and if entry exists
    if(empty($setting['logfile'])) {
      $this->logfile = null;
      //do nothing for now.
    }
    else {
      //try to open/create the file
      $fhandle = fopen($logfile,'a+');
      if($fhandle === false) { //we failed!
        $this->logfile = null;
      }
      else {
        $this->logfile = $fhandle;
      }

    }

  } //end __construct

  public function __destruct() {
    if(!is_null($this->logfile)) {
      fclose($this->logfile);
    }
  }

  /** actual logging function **
  public function logit($severity, $message, $output, $isfatal = false) {
    if(!is_null($this->logfile)) {
      fwrite($this->logfile, $severity.$message.PHP_EOL);
    }

    if($isfatal) {
      fclose($this->logfile);
      throw new Exception('Sizco Fatal Error: '.$message);
    }
  }

}

******/
