
<?php

  function checkPosts() {

    require '../service/get_ip.php';
    require '../init.php';

    if($host && $user && $pass && $table) {

      @$connection = new mysqli($host, $user, $pass, $table);
        if (mysqli_connect_errno()) return false;

    } else return false;

    $connection->set_charset("utf8");

    $ip = md5($ipaddress);

    $request = "SELECT * FROM `images` WHERE (`ip` = \"$ip\" and `status` = '1') or (`ip` = \"$ip\" and `status` = '2')";
    $request2 = "SELECT * FROM `posts-preview` WHERE (`ip` = \"$ip\" and `status` = '1') or (`ip` = \"$ip\" and `status` = '2')";
    $result = $connection->query($request);
    $result2 = $connection->query($request2);

    if($result->num_rows || $result2->num_rows) return true;

  }

?>
