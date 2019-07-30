<?php

class successImage {

  public function connection() {

    require '../../init.php';

    if($host && $user && $pass && $table) {

      @$connection = new mysqli($host, $user, $pass, $table);

        if (mysqli_connect_errno()) return false; else return $connection;

    } else return false;

  }

  public function success($object, $con) {

    if($con && $object) {

      if($con->query("UPDATE `images` SET `status` = '5' WHERE `name` = '$object'")) {

        require 'vk-uploadimage.php';

        $con->set_charset("utf8");

        $con->query("SET NAMES utf8");
        
        if($result = $con->query("SELECT * FROM `images` WHERE `name` = '$object' LIMIT 1")) {

          $initVK = new vkImageUpload($object, 'image', $result->fetch_assoc());

        }

        return true;

      } else return false;

    } else return false;

  }

  public function __construct($object) {

    if(isset($object) && is_string($object)) {

      if($this->connection()) {

        if($this->success($object, $this->connection())) {

          return true;

        } else return false;

      } else return false;

    } else return false;

  }

}

$successImage = new successImage($_REQUEST['object']);

?>
