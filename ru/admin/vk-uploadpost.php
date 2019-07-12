<?php

  class vkPostUpload {

    public $groupId = "-181426441";
    public $token;

    public function __construct($post, $type) {

      if($post && $type) {

        if(gettype($post) && gettype($type) == 'string') {

          require '../../init.php';

          if($type == 'post') {

            $this->token = $token;

            $text = 'Test';

            $url = sprintf('https://api.vk.com/method/wall.post?');

            $ch = curl_init();

            curl_setopt_array($ch, array(
              CURLOPT_POST => TRUE,
              CURLOPT_RETURNTRANSFER => TRUE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_POSTFIELDS => array(
                "owner_id" => $this->groupId,
                "from_group" => 1,
                "message" => $text,
                "access_token" => $this->token,
                "v" => "5.101"
              ),
              CURLOPT_URL => $url
            ));

            $query = curl_exec($ch);

            curl_close($ch);

            echo json_encode(array('iserr' => false, 'message' => 'Good result', 'object' => $query));

          }

        } else echo json_encode(array('iserr' => true, 'message' => 'Incorrect data', 'errobject' => 'vk-problem'));

      } else echo json_encode(array('iserr' => true, 'message' => 'Not full data', 'errobject' => 'vk-problem'));

    }

  }

?>
