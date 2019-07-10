<?php

  class indexes {

    public $language;
    public $result;

    public function __construct() {
      if($this->getlang()) $this->connection();
    }

    public function response($return) {
      echo '<script>console.log(JSON.parse(JSON.stringify('.json_encode($return).')))</script>';

      //echo '<script>document.write(JSON.stringify(data))</script>';

      $this->result = $return['iserror'];

    }

    public function getlang() {

      global $lang;

      $this->language = $lang;

      return $this->language;

    }

    public function getip() {
        global $ipaddress; if ($ipaddress) return md5($ipaddress); else return false;
    }

    public function connection() {

      global $host, $user, $pass, $table;

      if($host && $user && $pass && $table) {

        @$connection = new mysqli($host, $user, $pass, $table);

          if (mysqli_connect_errno()) $this->response(array('iserror' => true, 'lang' => $this->language, 'message' => $GLOBALS['errormsg_incorrectdataforcontobd'], 'errornum' => 105));

          else {

            $address = ($this->getip()) ?: $this->getip();

            if($address) {

              if ($result = $connection->query("SELECT `reason` FROM `blocked` WHERE `ip` = \"$address\"")) {

                if ($result->num_rows) {

                  session_start(); $_SESSION['token'] = null; session_write_close();

                  $reason = array(); while ($row = $result->fetch_assoc()) array_push($reason, $row['reason']);

                  $this->response(array('iserror' => true, 'reason' => $reason, 'lang' => $this->language, 'message' => $GLOBALS['serverbadresult'], 'errornum' => 1));

                }

                else {

                  session_start(); $_SESSION['token'] = $this->getip(); session_write_close();

                  $this->response(array('iserror' => false, 'lang' => $this->language, 'token' => $this->getip(), 'message' => $GLOBALS['servergoodresult'], 'errornum' => 0));

                }

              } else $this->response(array('iserror' => true, 'lang' => $this->language, 'message' => $GLOBALS['errormsg_notfulldata'], 'errornum' => 106));

            } else $this->response(array('iserror' => true, 'lang' => $this->language, 'message' => $GLOBALS['errormsg_notfulldata'], 'errornum' => 106));

        }  } else $this->response(array('iserror' => true, 'lang' => $this->language, 'message' => $GLOBALS['errormsg_baddata'], 'errornum' => 104));

    }

  }

  //$q->result

  require __DIR__.'\..\..\init.php';
  require __DIR__.'\..\..\service\get_ip.php';
  require_once __DIR__.'\..\..\service\get_lang.php';
  require __DIR__.'\..\messages.php';

  $q = new query();

  $authresult = $q->result;

  return $authresult;

?>
