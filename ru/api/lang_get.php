<?php
  function getlang() {
    session_start(); if($_SESSION['token']) return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); session_write_close();
  }
?>
