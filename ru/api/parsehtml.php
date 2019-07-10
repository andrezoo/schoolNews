
<?php

  require __DIR__.'\..\messages.php';

  class parser {

    public function __construct($htmlcode) {

      if($htmlcode) {

        if(strip_tags($htmlcode) == $htmlcode) {

          $this->response(array('iserror' => false, 'object' => htmlspecialchars($htmlcode)));

        } else {

          $htmlcode = strip_tags($htmlcode, '<br>'); $this->response(array('iserror' => false, 'object' => htmlspecialchars($htmlcode)));

        }

      } else $this->response(array('iserror' => true, 'message' => $GLOBALS['error_notfullinfo'], 'errornum' => 107));

    }

    public function response($response) {

      if($_SERVER['REQUEST_METHOD'] == 'GET') {

        echo '<script>document.write(JSON.stringify('.json_encode($response).'))</script>';

      } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        echo json_encode($response);

      } else if ($_SERVER['REQUEST_METHOD'] !== 'POST' &&  $_SERVER['REQUEST_METHOD'] !== 'GET') {

        echo json_encode($response);

      }

    }

  }

  $p = new parser($_REQUEST['htmlcode']);

?>
