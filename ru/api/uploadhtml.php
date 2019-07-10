<?php

  session_start(); $token = $_SESSION['select-token-post']; session_write_close();

  class previewinfo {

    public function __construct() {

      echo 'Вывод: '.$GLOBALS['token'];
      print_r($GLOBALS);
    }

  }

  $p = new previewinfo();

?>
