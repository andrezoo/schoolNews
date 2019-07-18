<?php

  if(isset($_POST) && $_POST['name']) {

    if(is_string($_POST['name'])) {

      require '../../init.php';

      //<.connection>
      function connection() {
        
        global $host, $user, $pass, $table;

        if($host && $user && $pass && $table) {

          @$connection = new mysqli($host, $user, $pass, $table);
            if (mysqli_connect_errno()) return false; else return $connection;

        } else return false;

      }
      //<./connection>

      $name = $_POST['name'];

      //<.getip>
      function getip() {

        require '../../service/get_ip.php';

        if ($ipaddress) return md5($ipaddress); else return false;
      }
      //<./getip>

      //<.exists>
      function exists() {

        global $name;

        if(connection() && getip()) {

          @$address = getip(); @$name = $_POST['name'];

          if($result = connection()->query("SELECT `ip` FROM `moder-images` WHERE `name` = \"$name\"")) {

            if(!($result->num_rows)) return false; else return true;

          } else return false;

        } else return false;

      }
      //<./exists>

      //<.add>
      function add() {

        global $name;

        if(!exists()) {

            if(connection() && $ip = getip()) {

              if($result = connection()->query("INSERT INTO `images`(`name`, `title`, `tags`, `status`, `lang`, `ip`) VALUES (\"$name\",'','','0','',\"$ip\")")) echo $name;

            }
        }

      }
      //<./add>

      add();

    }

  }

?>
