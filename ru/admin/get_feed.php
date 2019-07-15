<?php

  class getFeed {

    public static function connection() {

      require '../../init.php';

      if($host && $user && $pass && $table) {

        @$connection = new mysqli($host, $user, $pass, $table);

          if (mysqli_connect_errno()) return false; else return $connection;

      } else return false;

    }

    public function getSelection() {

      $con = $this->connection();

      $con->set_charset("utf8");

      if($result = $con->query("SELECT * FROM `posts-preview` WHERE `status` < 5 LIMIT 50")) {

        while($data = $result->fetch_assoc()) $response[$data['url']] = $data;

      }

      return $response;

    }

    public function __construct() {

      if($this->connection()) {

        if($this->getSelection()) {

          echo json_encode($this->getSelection());

        } else return false;

      } else return false;

    }

  }

  $getFeed = new getFeed();

?>
