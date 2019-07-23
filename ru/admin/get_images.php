<?php

  class getImages {

    private static function connection() {

      require '../../init.php';

      if($host && $user && $pass && $table) {

        @$connection = new mysqli($host, $user, $pass, $table);

          if (mysqli_connect_errno()) return false; else return $connection;

      } else return false;

    }

    public function getSelection() {

      $con = $this->connection();

      $con->set_charset("utf8");

      if($result = $con->query("SELECT * FROM `images` WHERE `status` < 5 LIMIT 50")) {

        while($data = $result->fetch_assoc()) $response[$data['name']] = $data;

      }

      return $response;

    }

    public function __construct() {

      require '../messages.php';

      if(isset($_POST)) {

        if($this->connection()) {

          if($this->getSelection()) {

            echo json_encode($this->getSelection());

          } else echo json_encode(array('error' => true));

        } else echo json_encode(array('iserr' => true, 'errmsg' => $errormsg_baddata));

      } else echo json_encode(array('iserr' => true, 'errmsg' => $errormsg_incorrectmethod));

    }

  }

  $getImages = new getImages();

?>
