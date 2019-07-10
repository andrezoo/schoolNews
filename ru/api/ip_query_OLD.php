<?php

class query {

  public $result;

  public function __construct() {

    if ($this->connection()) $this->language(); else @header('Location: '.substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2).'/badip');

  }
  public static function language() {
    if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) && in_array(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2), scandir(__DIR__))) {
      header('Location: '.substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2).'/');
    } elseif (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) && !in_array(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2), scandir(__DIR__))) header('Location: ru/');
  }
  public function getip() {
      require_once 'service/get_ip.php';  if ($ipaddress) return md5($ipaddress); else return false;
  }
  public function connection() {
    global $host, $user, $pass, $table;

    if($host && $user && $pass && $table) {

      @$connection = new mysqli($host, $user, $pass, $table);
        if (mysqli_connect_errno()) return true;

      $address = ($this->getip()) ?: $this->getip();

      if ($result = $connection->query("SELECT `reason` FROM `blocked` WHERE `ip` = \"$address\"")) {

        if ($result->num_rows) {
          $this->result = false;
          session_start(); $_SESSION['token'] = null; session_write_close();

          return false;

        } else {

          $this->result = true;
          session_start(); $_SESSION['token'] = md5($this->getip()); session_write_close();

          return true;

        }

      }

    }

  }

}

class indexes {

    public $result;

    public function __construct() {
      if (!$this->connection()) @header('Location: badip');
    }
    public function getip() {
         $ipaddress = '';
         $ipaddress = ($_SERVER['HTTP_CLIENT_IP']) ?: $_SERVER['HTTP_CLIENT_IP'];
         $ipaddress = ($_SERVER['HTTP_X_FORWARDED_FOR']) ?: $_SERVER['HTTP_X_FORWARDED_FOR'];
         $ipaddress = ($_SERVER['HTTP_X_FORWARDED']) ?: $_SERVER['HTTP_X_FORWARDED'];
         $ipaddress = ($_SERVER['HTTP_FORWARDED_FOR']) ?: $_SERVER['HTTP_FORWARDED_FOR'];
         $ipaddress = ($_SERVER['HTTP_FORWARDED']) ?: $_SERVER['HTTP_FORWARDED'];
         $ipaddress = ($_SERVER['REMOTE_ADDR']) ?: $_SERVER['REMOTE_ADDR'];

         if ($ipaddress) return $ipaddress; else return false;
    }
    public function connection() {
      global $host, $user, $pass, $table;

      if($host && $user && $pass && $table) {

        @$connection = new mysqli($host, $user, $pass, $table);
          if (mysqli_connect_errno()) return true;

        @$address = ($this->getip()) ?: $this->getip();

        if ($result = $connection->query("SELECT `reason` FROM `blocked` WHERE `ip` = \"$address\"")) {
          if ($result->num_rows) {
            $this->result = false; session_start(); $_SESSION['token'] = null; session_write_close();

            return false;
          } else {
            $this->result = true; session_start(); $_SESSION['token'] = md5($this->getip()); session_write_close();

            return true; }
        } else return true;
     } else return true;
    }
}

class api {

    public $result;

    public function __construct() {
      if ($this->connection()) $this->result = true; else $this->result = false;
    }
    public function getip() {

        require '../service/get_ip.php';

        if ($ipaddress) return md5($ipaddress); else return false;

    }
    public function connection() {
      global $host, $user, $pass, $table;

      if($host && $user && $pass && $table) {

        @$connection = new mysqli($host, $user, $pass, $table);
          if (mysqli_connect_errno()) return true;

        @$address = ($this->getip()) ?: $this->getip();

        if ($result = $connection->query("SELECT `reason` FROM `blocked` WHERE `ip` = \"$address\"")) {
          if ($result->num_rows) {
            $this->result = false;
            session_start();
            $_SESSION['token'] = null;
            session_write_close();

            return false;

          } else {
            $this->result = true;
            session_start(); $_SESSION['token'] = md5($this->getip());
            session_write_close();

            return true;
          }
        }

     } else return true;
    }
}

?>
