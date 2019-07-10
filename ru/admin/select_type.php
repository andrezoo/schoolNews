<?php

  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if($_POST['type']) {

      ini_set('session.save_path', __DIR__.'\..\..\sessions'); session_start();

      if(gettype($_SESSION['admin']) !== 'array') $_SESSION['admin'] = [];

      $_SESSION['admin']['selected-type'] = $_POST['type'];

      session_write_close();

      echo 'true';

    } else return false;

  } else return false;

?>
