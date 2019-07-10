<?php

  if($_SERVER['REQUEST_METHOD'] == 'GET') {

    ini_set('session.save_path', __DIR__.'\..\sessions'); session_start();

    if($_SESSION['token'] && $_SESSION['address']) {

      echo $_SESSION['token'];
      
    } else header('Location: index');

  } else header('Location: index');

?>
