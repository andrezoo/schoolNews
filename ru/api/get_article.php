<?php

  require '../messages.php';

  class get_article {

    public $con;

    public function json_response($response) {

      if($_SERVER['REQUEST_METHOD'] == 'GET') echo '<script>document.write(JSON.stringify('.json_encode($return).'))</script>';

      else echo json_encode($return);

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

    public function exists($post) {

      if($this->con) {

        if($result = $this->con->query("SELECT * FROM `posts-preview` WHERE `url` = '$post' LIMIT 1")) {

          if($result->num_rows) return $result->num_rows; else return false;

        } else return false;

      } else return false;

    }

    public function getInfo($post) {

      if($post) {

        if($result = $this->con->query("SELECT * FROM `posts-preview` WHERE `url` = '$post' LIMIT 1")) {

          $postdata = [];

          if($data = $result->fetch_assoc()) {

            $postdata['info'] = $data;

            if($result2 = $this->con->query("SELECT * FROM `posts` WHERE `url` = '$post' LIMIT 1")) {

              if($data2 = $result2->fetch_assoc()) {

                $postdata['inner'] = $data2;

                return $postdata;

              } else return false;

            } else return false;

          } else return false;

        } else return false;

      } else return false;

    }

    public function __construct($post) {

      if($post) {

        if($this->connection()) {

          $this->con = $this->connection();

          if($this->exists($post)) {

            if($this->getInfo($post)) {

              echo json_encode($this->getInfo($post));

            } else {

              $response = array('iserr' => true, 'message' => $GLOBALS['serverbadresult'], 'errnum' => 1);

              $this->json_response($response);

            }

          } else {

            $response = array('iserr' => true, 'message' => $GLOBALS['errormsg_baddata'], 'errnum' => 104);

            $this->json_response($response);

          }

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

  $get_article = new get_article($_REQUEST['post']);

?>
