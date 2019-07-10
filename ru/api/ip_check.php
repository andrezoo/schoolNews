<?php

ini_set('session.save_path', __DIR__.'\..\..\sessions');

session_set_cookie_params(999999);

  if(isset($_POST)) {

    session_start();

      if(!$_SESSION['token']) {

        require '../service/get_ip.php';
        require '../service/get_lang.php';
        require 'messages.php';
        require '../init.php';

        require 'ip_query.php';

        $q = new query();

        if($q->result) header('Location: badip');

      } 

    echo '<script>console.info("Client token is updated")</script>';

    session_write_close();

  }

?>
