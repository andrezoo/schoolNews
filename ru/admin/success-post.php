<?php

class successPost {

  public function connection() {

    require '../../init.php';

    if($host && $user && $pass && $table) {

      @$connection = new mysqli($host, $user, $pass, $table);

        if (mysqli_connect_errno()) return false; else return $connection;

    } else return false;

  }

  private function success($object, $con) {

    if($con && $object) {

      if($con->query("UPDATE `posts-preview` SET `status` = '5' WHERE `url` = '$object'")) {

        return true;

      } else return false;

    } else return false;

  }

  public function __construct($object) {

    if(isset($object) && is_string($object)) {

      if($this->connection()) {

        if($this->success($object, $this->connection())) {

          echo $object;

        } else return false;

      } else return false;

    } else return false;

  }

}

$successPost = new successPost($_POST['object']);

?>
