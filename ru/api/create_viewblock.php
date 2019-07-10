<?php

  require '../messages.php';

  class creator {

    public $ip;

    public function response($return) {
      //echo '<script>console.log(JSON.parse(JSON.stringify('.json_encode($return).')))</script>';

      if($_SERVER['REQUEST_METHOD'] == 'GET') echo '<script>document.write(JSON.stringify('.json_encode($return).'))</script>';

      else echo json_encode($return);

    }

    public function check($link) {

      require 'accessname_check.php'; if($c->result) return true; else return false;

    }

    private function createBlock() {

      global $_REQUEST;

      if($this->connection()) {

        $name = md5(md5($this->getip()));

        ini_set('session.save_path', __DIR__.'\..\..\sessions');

        session_start();

        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        $lang = ($_SESSION['lang']) ? $_SESSION['lang'] : $_REQUEST['lang'];
        $ip = $this->getip();
        $color = $_REQUEST['picker'];
        $url = $_REQUEST['url'];

        if(!$lang) substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

        session_write_close();

        $this->connection()->set_charset("utf8");

        $query = "INSERT INTO `posts-preview`(`name`, `title`, `description`, `color`, `url`, `status`, `lang`, `ip`) VALUES ('$name','$title','$description','$color', '$url', '0','$lang','$ip')";
        $query2 = "INSERT INTO `registeredurls`(`ip`, `url`, `token`) VALUES ('$ip','$url','$name')";

        if ($result = $this->connection()->query($query) && $second = $this->connection()->query($query2)) echo $this->response(array('iserror' => false, 'object' => $name));

        ini_set('session.save_path', __DIR__.'\..\..\sessions');

        session_start();

        $_SESSION['access-token-post'] = [];
        $_SESSION['selected-token-post'] = $name;
        $_SESSION['access-token-post'][] = $name;
        $_SESSION['selected-url'] = $url;

        session_write_close();

      }

    }

    public function __construct() {

      if(isset($_REQUEST)) {

        if($_REQUEST['title'] && $_REQUEST['description'] && $_REQUEST['url'] && $_REQUEST['picker']) {

          if(strlen($_REQUEST['title']) > 3 && strlen($_REQUEST['title']) < 50) {

            if(strlen($_REQUEST['description']) > 10 && strlen($_REQUEST['description']) < 1000) {

              if($this->check($_REQUEST['url'])) {

                if($this->postsbyuser()) {

                  $this->createBlock($_REQUEST);

                } else $this->response(array('iserror' => true, 'message' => $GLOBALS['errormsg_wait'], 'errornum' => 108));

              } //else $this->response(array('iserror' => true, 'message' => $GLOBALS['errormsg_busy'], 'errornum' => 103));

            } else $this->response(array('iserror' => true, 'message' => $GLOBALS['errormsg_desc_big'], 'errornum' => 1002));

          } else $this->response(array('iserror' => true, 'message' => $GLOBALS['errormsg_title_big'], 'errornum' => 1001));

        } else $this->response(array('iserror' => true, 'message' => $GLOBALS['error_notfullinfo'], 'errornum' => 107));

      } else $this->response(array('iserror' => true, 'message' => $GLOBALS['errormsg_baddata'], 'errornum' => 104));

    }

    public function getip() {
      session_start();

      if($_SESSION['address']) {
        return $_SESSION['address']; $this->ip = $_SESSION['address']; session_write_close();
      } else {
        require '../../service/get_ip.php';

        return $_SESSION['address']; $this->ip = $_SESSION['address']; session_write_close();
      }
    }

    public function postsbyuser() {

      if($this->connection()) {

        $ipaddress = $this->getip();

        if($result = $this->connection()->query("SELECT * FROM `posts-preview` WHERE `ip` = '$ipaddress' and `status` = 0")) {

          if($result->num_rows) return false; else return true;

        }

      } else return false;

    }

    public function connection() {

      require '../../init.php';

      global $host, $user, $pass, $table;

      require '../../init.php';

      if($host && $user && $pass && $table) {

        @$connection = new mysqli($host, $user, $pass, $table);

        $connection->set_charset("utf8");

        if (mysqli_connect_errno()) $this->response(array('iserror' => true, 'message' => $GLOBALS['errormsg_incorrectdataforcontobd'], 'errornum' => 105));

        else return $connection;

      } else $this->response(array('iserror' => true, 'message' => $GLOBALS['errormsg_incorrectdataforcontobd'], 'errornum' => 105));

    }

  }

  $c = new creator();

 ?>
