<?php

  //$_REQUEST['token'];

  require '../messages.php';

  class addtags {

    public $token;
    public $url;
    public $code;

    private function json_response($response) {
      if($_SERVER['REQUEST_METHOD'] == 'GET') echo '<script>document.write(JSON.stringify('.json_encode($response).'))</script>';
      else echo json_encode($response);
    }

    public function connection() {

      if($_SERVER['REQUEST_METHOD'] == "POST") require '../../init.php';
      else require '../../init.php';

      if($host && $user && $pass && $table) {

        @$connection = new mysqli($host, $user, $pass, $table);
        $connection->set_charset("utf8");

          if (mysqli_connect_errno()) return false; else return $connection;

      } else return false;

    }

    public function getData() {

      if($this->token) {

        if($this->connection()) {

          if($result = $this->connection()->query("SELECT * FROM `posts` WHERE `name` = '$this->token' and `url` = '$this->url'")) {

            if($result->num_rows) return true; else return false;

          } else return false;

        } else return false;

      } else return false;

    }

    public function __construct($token, $url, $code, $tags) {

      if($token && $url && $code && $tags) {

        $this->token = $token;
        $this->url = $url;
        $this->code = $code;

        if($this->connection()) {

          if($this->getData()) {

            $getdata = $this->getData();

            $code = $this->code;
            $code = htmlentities($code, ENT_NOQUOTES, 'UTF-8');
            $code = mysql_real_escape_string($code);

            //TODO: $code = html_entity_decode($code);

            $this->connection()->query("UPDATE `posts-preview` SET `status`= '2', `tags`='$tags' WHERE `name` ='$this->token' and NOT `status` = '2' and `url` = '$url'");

            $this->connection()->query("UPDATE `posts` SET `htmlcode`='$code' WHERE `name` ='$this->token' and `url` = '$url'");

          } else {

            $code = htmlentities($code, ENT_NOQUOTES, 'UTF-8');
            $code = mysql_real_escape_string($code);

            $this->connection()->query("UPDATE `posts-preview` SET `status`='2', `tags`='$tags' WHERE `name` ='$this->token' and `status` = '0' and `url` = '$url'");

            $this->connection()->query("INSERT INTO `posts`(`name`, `htmlcode`, `url`) VALUES ('$token','$code', '$url')");

          }

          ini_set('session.save_path', __DIR__.'\..\..\sessions'); session_start();

          $_SESSION['selected-token-post'] = ''; $_SESSION['selected-url'] = '';

          session_write_close();

        } else {

          $response = array('iserr' => true, 'message' => $GLOBALS['errormsg_baddata'], 'errnum' => 104);

          $this->json_response($response);

        }

      } else {

        $response = array('iserr' => true, 'message' => $GLOBALS['errormsg_notfulldata'], 'errnum' => 106);

        $this->json_response($response);

      }

    }

  }


  ini_set('session.save_path', __DIR__.'\..\..\sessions'); session_start();

  $token = ($_REQUEST['token']) ? $_REQUEST['token'] : $_SESSION['selected-token-post'];

  if(!$token) $token = $GLOBALS['token'];

  $url = ($_REQUEST['url']) ? $_REQUEST['url'] : $_SESSION['selected-url'];

  if(!$url) $url = $GLOBALS['url'];

  $a = new addtags($token, $url, $_REQUEST['code'], $_REQUEST['tags']);

?>
