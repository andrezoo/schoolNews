<?php

  require '../messages.php';

  class checkdata {

    public function json_response($response) {

      echo json_encode($response);

    }

    public function __construct() {

      if(isset($_POST)) {

        if($_POST['email'] && $_POST['pass']) {

          $response = array('iserr' => false, 'object' => array('email' => md5($_POST['email']), 'pass' => md5($_POST['pass'])));

          $this->json_response($response);

        } else {

          $response = array('iserr' => true, 'message' => $GLOBALS['error_notfullinfo'], 'errnum' => 107);

          $this->json_response($response);

        }

      } else {

        $response = array('iserr' => true, 'message' => $GLOBALS['errormsg_incorrectmethod'], 'errnum' => 101);

        $this->json_response($response);

      }

    }

  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') $checkdata = new checkdata();

?>
