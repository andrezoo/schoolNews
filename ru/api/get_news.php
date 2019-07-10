<?php

  require '../messages.php';

  class get_news {

    public $con;

    public $lang;

    public function json_response($return) {

      if($_SERVER['REQUEST_METHOD'] == 'GET') echo '<script>document.write(JSON.stringify('.json_encode($return).'))</script>';

      else echo json_encode($return);

    }

    public function validmd5($address) {

      if($address) {

        return preg_match('/^[a-f0-9]{32}$/', $address);

      } else return false;

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

    public function checkip($ip) {

      if($ip && $this->con) {

        if($result = $this->con->query("SELECT * FROM `blocked` WHERE `ip` = '$ip'")) {

          if($result->num_rows) return false; else return true;

        } else return true;

      } else return false;

    }

    public function getPhotos() {

      if($this->con) {

        if($result = $this->connection()->query("SELECT * FROM `images` WHERE `lang` = '$this->lang' and `status` = '2' ORDER BY `id` DESC LIMIT 90")) {

          $infodata = [];

            for($s = 0; $s <= $result->num_rows; $s++) {

              for($i = 0; $i <= 2; $i++) {

                if($data = $result->fetch_assoc()) {

                  $infodata[$s][$i] = $data;

                }

              }

            }

            $infodata[] = 'images';

            return $infodata;

        } else return false;

      } else return false;

    }

    public function __construct($ip, $lang) {

      if($ip && $lang) {

        $this->lang = $lang;

        if(strlen($ip) == 32) {

          if($this->validmd5($ip)) {

            if($this->connection()) {

              $this->con = $this->connection();

              if($this->checkip($ip)) {

                if($this->getPhotos()) {

                  $this->json_response($this->getPhotos());

                } else {

                  $response = array('iserr' => true, 'message' => $GLOBALS['serverbadresult'], 'errnum' => 0);

                  $this->json_response($response);

                }

              } else {

                $response = array('iserr' => true, 'message' => $GLOBALS['errormsg_blockedip'], 'errnum' => 110);

                $this->json_response($response);

              }

            } else {

              $response = array('iserr' => true, 'message' => $GLOBALS['errormsg_baddata'], 'errnum' => 104);

              $this->json_response($response);

            }

          } else {

            $response = array('iserr' => true, 'message' => $GLOBALS['errormsg_incorrectdata'], 'errnum' => 109);

            $this->json_response($response);

          }

        } else {

          $response = array('iserr' => true, 'message' => $GLOBALS['errormsg_incorrectdata'], 'errnum' => 109);

          $this->json_response($response);

        }

      } else {

        $response = array('iserr' => true, 'message' => $GLOBALS['errormsg_notfulldata'], 'errnum' => 106);

        $this->json_response($response);

      }

    }

  }

  ini_set('session.save_path', __DIR__.'\..\..\sessions'); session_start();

  $ip = ($_REQUEST['address']) ? $_REQUEST['address'] : $_SESSION['address'];
  $lang = ($_REQUEST['lang']) ? $_REQUEST['lang'] : $_SESSION['lang'];

  $getnews = new get_news($ip, $lang);

?>
