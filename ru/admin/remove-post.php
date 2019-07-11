<?php

class removePost {

  public function connection() {

    require '../../init.php';

    if($host && $user && $pass && $table) {

      @$connection = new mysqli($host, $user, $pass, $table);

        if (mysqli_connect_errno()) return false; else return $connection;

    } else return false;

  }

  public function remove($object, $con) {

    if($object && $con) {

      if($con->query("DELETE FROM `posts-preview` WHERE `url` = '$object'") &&
         $con->query("DELETE FROM `posts` WHERE `url` = '$object'") &&
         $con->query("DELETE FROM `registeredurls` WHERE `url` = '$object'")) {

        return true;

      } else return false;

    } else return false;

  }

  public function __construct($object) {

    if(isset($object) && is_string($object)) {

      if($this->connection()) {

        if($this->remove($object, $this->connection())) {

          echo $object;

        } else return false;

      } else return false;

    } else return false;

  }

}

$removePost = new removePost($_POST['object']);

?>
