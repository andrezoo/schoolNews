<?php

class failPost {

  public function connection() {

    require '../../init.php';

    if($host && $user && $pass && $table) {

      @$connection = new mysqli($host, $user, $pass, $table);

        if (mysqli_connect_errno()) return false; else return $connection;

    } else return false;

  }

  public function remove($object, $con) {

    if($object && $con) {

      $token = md5(md5($object));

      if($con->query("DELETE FROM `posts-preview` WHERE `ip` = '$object' LIMIT 10000") &&
         $con->query("DELETE FROM `posts` WHERE `name` = '$token' LIMIT 10000") &&
         $con->query("DELETE FROM `registeredurls` WHERE `ip` = '$object' LIMIT 10000")) {

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

$failPost = new failPost($_POST['object']);

?>
