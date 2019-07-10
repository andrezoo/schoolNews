<?php

  ini_set('session.save_path', __DIR__.'\..\..\sessions');
  
  session_start();

  if($_SESSION['token']) {

    $_SESSION['view-type'] = 'grid';

    if($_SESSION['lang']) header('Location: ../news');
    else {$_SESSION['lang'] = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);header('Location: ../news');}

    session_write_close();

  } else header('Locaton: ../');

?>
