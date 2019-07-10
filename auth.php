<?php

  ini_set('session.save_path', __DIR__.'\sessions');

  session_set_cookie_params(999999);

  session_start();

  if($_SESSION['lang']) {

    if($_SESSION['token']) header('Location: '.$_SESSION['lang'].'/');
    else header('Location: '.$_SESSION['lang'].'/badip');

  } else {

    require_once 'service/get_lang.php';

    $language = new language;

    require_once $language->result.'/api/ip_query.php';

    if($_SESSION['token']) header('Location: '.$language->result.'/');
    else header('Location: '.$language->result.'/badip');

  }

?>

<meta http-equiv="Refresh" content="5">
