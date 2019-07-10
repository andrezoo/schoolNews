<?php

  require '../messages.php';

  class login {

    public function json_response($response) {

      echo json_encode($response);

    }

    public function connection() {

      require '../../init.php';

      if($host && $user && $pass && $table) {

        @$connection = new mysqli($host, $user, $pass, $table);

          if (mysqli_connect_errno()) return false; else return $connection;

      } else return false;

    }

    private function login($data) {

      $con = $this->connection();

      if($result = $con->query("SELECT * FROM `admin` WHERE `email` = '".$data['email']."' and `token` = '".md5($data['pass'])."'")) {

        if($result->num_rows) return true; else return false;

      }

    }

    private function auth($data) {

      if($data) {

        ini_set('session.save_path', __DIR__.'\..\..\sessions'); session_start();

        $_SESSION['admin-email'] = $data['email']; $_SESSION['admin-token'] = md5($data['pass']);

        session_write_close();

      } else return false;

    }

    public function __construct($data) {

      if($data['email'] && $data['pass']) {

        if($this->connection()) {

          if($this->login($data)) {

            if($this->auth($data)) {

              $response = array('iserr' => false, 'message' => $GLOBALS['servergoodresult'], 'errnum' => 0);

              $this->json_response($response);

            }

          } else {

            $response = array('iserr' => true, 'object' => md5($data['pass']), 'message' => $GLOBALS['errormsg_incorrectdata2'], 'errnum' => 112);

            $this->json_response($response);

          }

        } else {

          $response = array('iserr' => true, 'message' => $GLOBALS['errormsg_baddata'], 'errnum' => 104);

          $this->json_response($response);

        }

      } else {

        $response = array('iserr' => true, 'message' => $GLOBALS['error_notfullinfo'], 'errnum' => 107);

        $this->json_response($response);

      }

    }

  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') $logindata = new login($_POST);

?>
