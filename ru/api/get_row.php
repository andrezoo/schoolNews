<?php

  require '../messages.php';

  class get_row {

    public $con;

    public function json_response($return) {

      if($_SERVER['REQUEST_METHOD'] == 'GET') echo '<script>document.write(JSON.stringify('.json_encode($return).'))</script>';

      else echo json_encode($return);

    }

    public function validIp($ip) {

      if($ip) return preg_match('/^[a-f0-9]{32}$/', $ip);

      else return false;

    }

    private function connection() {

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

    public function checkIp($ip) {

      if($ip && $this->con) {

        if($result = $this->con->query("SELECT * FROM `blocked` WHERE `ip` = '$ip'")) {

          if($result->num_rows) return false; else return true;

        } else return true;

      } else return false;

    }

    public function getRow($type, $handler) {

      if($type) {

        if(join('', $handler)) {

          if($this->con) {

            if($result = $this->con->query("SELECT * FROM `$type` WHERE `status` = '5' ORDER BY RAND() DESC LIMIT 3")) {

              $parsed = [];
              $ids = [];

              while($row = $result->fetch_assoc()) {

                if(!in_array($row['id'], $handler)) {

                  $parsed[]['data'] = $row;
                  $ids[] = $row['id'];

                }

              }

              $parsed[]['info'] = [join(',',$ids), $type];

              return $parsed;

            } else return false;

          } else return false;

          return true;

        } else {

          if($this->con) {

            if($result = $this->con->query("SELECT * FROM `$type` WHERE `status` = '5' ORDER BY RAND() LIMIT 3")) {

              $parsed = [];
              $ids = [];

              while($row = $result->fetch_assoc()) {

                $parsed[]['data'] = $row;
                $ids[] = $row['id'];

              }

              $parsed[]['info'] = [join(',',$ids), $type];

              return $parsed;

            } else return false;

          } else return false;

        }

      } else return false;

    }

    public function __construct($ip, $lang, $ids, $type) {

      if($ip && $lang && $ids && $type) {

        if($this->validIp($ip)) {

          if($this->connection()) {

            $this->con = $this->connection();

            if($this->checkIp($ip)) {

              $idhandler = split(",", $ids);

              if($idhandler) {

                if($this->getRow($type, $idhandler)) {

                  echo json_encode($this->getRow($type, $idhandler));

                } else {

                  $response = array('iserr' => true, 'messase' => $GLOBALS['serverbadresult'], 'errnum' => 1);

                  $this->json_response($response);

                }

              } else {

                $response = array('iserr' => true, 'messase' => $GLOBALS['errormsg_incorrectdataforcontobd'], 'errnum' => 105);

                $this->json_response($response);

              }

            } else {

              $response = array('iserr' => true, 'messase' => $GLOBALS['errormsg_blockedip'], 'errnum' => 110);

              $this->json_response($response);

            }

          } else {

            $response = array('iserr' => true, 'messase' => $GLOBALS['errormsg_incorrectdataforcontobd'], 'errnum' => 105);

            $this->json_response($response);

          }

        } else {

          $response = array('iserr' => true, 'messase' => $GLOBALS['errormsg_incorrectdata'], 'errnum' => 109);

          $this->json_response($response);

        }

      } else {

        $response = array('iserr' => true, 'messase' => $GLOBALS['errormsg_notfulldata'], 'errnum' => 106);

        $this->json_response($response);

      }

    }

  }

  ini_set('session.save_path', __DIR__.'\..\..\sessions'); session_start();

  $ip = ($_REQUEST['address']) ? $_REQUEST['address'] : $_SESSION['address'];
  $lang = ($_REQUEST['lang']) ? $_REQUEST['lang'] : $_SESSION['lang'];
  $ids = $_REQUEST['ids']; $type = $_REQUEST['type'];

  $get_row = new get_row($ip, $lang, $ids, $type);

?>
