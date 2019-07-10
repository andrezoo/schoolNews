<?php

  require '../../init.php';

  class edit {

    public function __construct($data) {

      if($this->connection()) {

        @$connection = $this->connection();

        $ip = substr($data['image'], 0, 32); $name = substr($data['image'], 33, 65);
        $title = $_POST['title']; $tags = $_POST['tags']; $lang = $_POST['lang'];

        $connection->set_charset("utf8");

        $request = "UPDATE `images` SET `title` = '$title',`tags` = '$tags',`status`='1',`lang`='$lang' WHERE `ip` = '$ip' and `name` = '$name'";

        $result = $connection->query($request);

        if($connection->error) {

          $response = array('iserror' => true, 'errormsg' => $connection->error, 'errornum' => 4);

          echo json_encode($response);

        }

      }

    }

    public function connection() {

      global $host, $user, $pass, $table;

      if($host && $user && $pass && $table) {

        @$connection = new mysqli($host, $user, $pass, $table);
          if (mysqli_connect_errno()) return false; else return $connection;

      } else return false;

    }

  }

  if (isset($_POST)) {

    if($_POST['title'] && $_POST['tags'] && $_POST['lang'] && $_POST['image']) {

      require '../../service/get_ip.php';

      if(substr($_POST['image'], 0, 32) == md5($ipaddress)) $e = new edit($_POST);

      else {

        $response = array('iserror' => true, 'errormsg' => 'Different addresses', 'errornum' => 3);

        echo json_encode($response);

      }

    } else {

      $response = array('iserror' => true, 'errormsg' => 'Incorrect data', 'errornum' => 2);

      echo json_encode($response);

    }

  } else {

    $response = array('iserror' => true, 'errormsg' => 'Incorrect request', 'errornum' => 1);

    echo json_encode($response);
  }

?>
