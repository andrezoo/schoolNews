<?php

if($GLOBALS['_GET']['url']) $url = $GLOBALS['_GET']['url'];
elseif ($GLOBALS['_POST']['url']) $url = $GLOBALS['_POST']['url'];

if(!$url) $url = $_REQUEST ?: $_REQUEST['url'];

class check {

  public $result;

  public function response($iserr, $errmsg, $errnum) {

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
      $response = array('iserror' => $iserr, 'message' => $errmsg, 'errornum' => $errnum);

      echo '<script>document.write(JSON.stringify('.json_encode($response).'))</script>';

    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $response = array('iserror' => $iserr, 'message' => $errmsg, 'errornum' => $errnum);
      
      echo json_encode($response);

    } else if ($_SERVER['REQUEST_METHOD'] !== 'POST' &&  $_SERVER['REQUEST_METHOD'] !== 'GET') {

      $response = array('iserror' => $iserr, 'message' => $errmsg, 'errornum' => $errnum);

      echo json_encode($response);

    }

  }

  public function __construct() {

    global $url, $GLOBALS;

    require '../messages.php';

    if(isset($url)) {

      if($this->connection()) {

        if($this->isnotbusy($url)) {

          $this->response(false, $servergoodresult, 0); $this->result = true;

        } else $this->response(true, $errormsg_busy, 103);

      } else $this->response(true, $errormsg_connectionproblems, 102);

    } elseif ($GLOBALS['_GET']['url'] || $GLOBALS['_POST']['url']) {

      if($this->connection()) {

        if($this->isnotbusy($GLOBALS['_GET']['url']) || $this->isnotbusy($GLOBALS['_POST']['url'])) {

          $this->result = true;

        } else $this->response(true, $errormsg_busy, 103);

      } else $this->response(true, $errormsg_connectionproblems, 102);

    } else $this->response(true, $errormsg_notfulldata, 106);

  }

  public static function connection() {

    require '../../init.php';

    if($host && $user && $pass && $table) {

      @$connection = new mysqli($host, $user, $pass, $table);

        if (mysqli_connect_errno()) return false; else return $connection;

    } else return false;

  }

  public function isnotbusy($url) {

    if($this->connection()) {

      $result = $this->connection()->query("SELECT `url` FROM `registeredurls` WHERE `url` = '$url'");

      if($result->num_rows) return false; return true;

    } else return false;

  }

}

$c = new check();

?>
