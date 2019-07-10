<?php

  require '../messages.php';

  class editinfo {

    public $token;

    private function json_response($response) {
      if($_SERVER['REQUEST_METHOD'] == 'GET') echo '<script>document.write(JSON.stringify('.json_encode($response).'))</script>';
      else echo json_encode($response);
    }

    public function connection() {

      require '../../init.php';

      if($host && $user && $pass && $table) {

        @$connection = new mysqli($host, $user, $pass, $table);
        $connection->set_charset("utf8");

          if (mysqli_connect_errno()) return false; else return $connection;

      } else return false;

    }

    public function exists() {

      if($this->connection()) {

        if($result = $this->connection()->query("SELECT * FROM `posts` WHERE `name` = '$this->token' and `url` = '$this->url'")) {

          if($result->num_rows) return true; else return false;

        } else return false;

      } else return false;

    }

    public function __construct($token, $code, $url) {

      if($token && $code && $url) {

        $this->url = $url;
        $this->token = $token;

        if($this->connection()) {

          if($this->exists()) {

            $code = htmlentities($code, ENT_NOQUOTES, 'UTF-8');
            $code = mysql_real_escape_string($code);

            //TODO: $code = html_entity_decode($code);

            $this->connection()->query("UPDATE `posts-preview` SET `status`='1' WHERE `name` ='$this->token' and `status` = '0' and `url` = '$url'");

            $this->connection()->query("UPDATE `posts` SET `htmlcode`='$code' WHERE `name` ='$this->token' and `url` = '$url'");

          } else {

            $code = htmlentities($code, ENT_NOQUOTES, 'UTF-8');
            $code = mysql_real_escape_string($code);

            $this->connection()->query("UPDATE `posts-preview` SET `status`='1' WHERE `name` ='$this->token' and `status` = '0' and `url` = '$url'");

            $this->connection()->query("INSERT INTO `posts`(`name`, `htmlcode`, `url`) VALUES ('$token','$code', '$url')");

          }

        } else {

          $response = array('iserr' => true, 'message' => $GLOBALS['errormsg_baddata'], 'errornum' => 104);

          $this->json_response($response);

        }

      } else {

        $response = array('iserr' => true, 'message' => $GLOBALS['errormsg_notfulldata'], 'errornum' => 106);

        $this->json_response($response);

      }

    }

  }

  ini_set('session.save_path', __DIR__.'\..\..\sessions'); session_start();

  $url = ($_REQUEST['selected-url']) ? $_REQUEST['selected-url'] : $_SESSION['selected-url'];
  $e = new editinfo($_REQUEST['token'], $_REQUEST['code'], $url);

?>
