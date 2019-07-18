<?php

  try {

    $ctx = stream_context_create(array('http' => array('timeout' => 10)));
    $getipfromsite = @file_get_contents('https://api.ipify.org', false, $ctx);

    $ipaddress = $getipfromsite;

    @session_start();
    $_SESSION['address'] = md5($ipaddress);
    @session_write_close();

  }
  catch (Exception $ex) {

    $ipaddress = '';
    $ipaddress = ($_SERVER['HTTP_CLIENT_IP']) ?: $_SERVER['HTTP_CLIENT_IP'];
    $ipaddress = ($_SERVER['HTTP_X_FORWARDED_FOR']) ?: $_SERVER['HTTP_X_FORWARDED_FOR'];
    $ipaddress = ($_SERVER['HTTP_X_FORWARDED']) ?: $_SERVER['HTTP_X_FORWARDED'];
    $ipaddress = ($_SERVER['HTTP_FORWARDED_FOR']) ?: $_SERVER['HTTP_FORWARDED_FOR'];
    $ipaddress = ($_SERVER['HTTP_FORWARDED']) ?: $_SERVER['HTTP_FORWARDED'];
    $ipaddress = ($_SERVER['REMOTE_ADDR']) ?: $_SERVER['REMOTE_ADDR'];

    @session_start();
    $_SESSION['address'] = md5($ipaddress);
    @session_write_close();

  }

?>
