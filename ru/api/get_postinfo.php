<?php

  require '../messages.php';

  class postinfo {

    public $token;
    public $url;

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

    public function getinfo() {

      if($this->token) {

        if($result = $this->connection()->query("SELECT * FROM `posts` WHERE `name` = '$this->token' and `url` = '$this->url'")) {

          if($data = $result->fetch_assoc()) {

            $data['htmlcode'] = html_entity_decode($data['htmlcode']);

            return $data;

          } else return false;


        }

      }

    }

    public function getheading() {

      if($this->token) {

        if($result = $this->connection()->query("SELECT * FROM `posts-preview` WHERE `name` = '$this->token' and `url` = '$this->url'")) {

          if($data = $result->fetch_assoc()) return $data; else return false;

        }

      }

    }

    public function __construct($token, $url) {

      if($token){

        $this->url = $url;
        $this->token = $token;

        if($this->connection()) {

          if($out = $this->getinfo()) {

            if($out2 = $this->getheading()) {

              $response = array('iserr' => false, 'object' => $out, 'data' => $out2);

              $this->json_response($response);

            }

          } else {

            if($output = $this->getheading()) {

              $response = array('iserr' => false, 'data' => $output);

              $this->json_response($response);

            } else {

            $response = array('iserr' => true, 'message' => $GLOBALS['serverbadresult'], 'errornum' => 1);

            $this->json_response($response);

            }

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

  $p = new postinfo($_REQUEST['token'], $url);

?>
