<?php

  class get_headers {

    public $token;

    public function json_response($data) {

      if($_SERVER['REQUEST_METHOD'] == "GET" && $data) echo '<script>document.write(JSON.stringify('.json_encode($data).'))</script>';
      else echo json_encode($data);

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

    public function getPosts() {

      if($con = $this->connection()) {

        $token = $this->token;

        if($result = $con->query("SELECT * FROM `posts-preview` WHERE `name` = '$token' and `status` = '0'")) {

          $postsdata = [];
          $i = 0;

          while ($row = $result->fetch_assoc()) {

            $postsdata[$i]['title'] = $row['title'];
            $postsdata[$i]['description'] = $row['description'];
            $postsdata[$i]['name'] = $row['name'];

            $i++;

          }

          if(!$result->num_rows) $_SESSION['selected-token-post'] = '';

          if($postsdata) return $postsdata;

        }

      }

    }

    public function __construct() {

      if($this->token = $this->getToken()) {

        if($this->token) {

          if($this->connection()) {

            $response = array('iserr' => false, 'object' => $this->getPosts());

            $this->json_response($response);

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

    //<getToken> - Получает токен пользователя и заносит его в $this->token
    public function getToken() {

      //Проверяем отправленный метод
      if($_SERVER['REQUEST_METHOD'] == ("POST" || "GET")) {

        ini_set('session.save_path', __DIR__.'\..\..\sessions');

        //Конструкция try удобна тем, что имеет обязательное условие finally
        try {

          //Проверяем сессию
          if(session_start() && $_SESSION['selected-token-post']) {
            return $_SESSION['selected-token-post']; $this->token = $_SESSION['selected-token-post'];
          } else return false;

        } catch (Exception $e) {return $e; $this->token = false; }

        //Закрываем сессию
        finally {
          session_write_close();
        }

      } elseif($_REQUEST['selected-token-post']) {

        return $_REQUEST['selected-token-post']; $this->token = $_SESSION['selected-token-post'];

      }

    }

  }

  $h = new get_headers();

?>
