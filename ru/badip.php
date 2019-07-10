<?php

  session_start();

    require '../service/get_ip.php';
    require '../service/get_lang.php';

    $lang = new language;

    require 'messages.php';
    require '../init.php';

    require 'api/ip_query.php'; $q = new query();

    if(!$_SESSION['token']) {
      echo '<strong>[Ошибка входа]</strong> Ваш айпи заблокирован в системе. Если это ошибка, то попробуйте обновить страницу или написать администратору';
    } elseif ($_SESSION['token']) header('Location: ../');

  session_write_close();

?>
<META HTTP-EQUIV="REFRESH" CONTENT="5">
