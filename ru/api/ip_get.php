<?php

  if(isset($_POST)) {

    require '../../service/get_ip.php';

    if ($ipaddress) echo md5($ipaddress); else return false;

  }

?>
