<?php

  class vkPostUpload {

    public $groupId = "-181426441";
    public $token;

    public function connection() {

      require '../../init.php';

      if($host && $user && $pass && $table) {

        @$connection = new mysqli($host, $user, $pass, $table);

          if (mysqli_connect_errno()) return false; else return $connection;

      } else return false;

    }

    private function getData($post) {

      if($this->connection()) {

        if($result = $this->connection()->query("SELECT * FROM `posts-preview` WHERE `url` = '$post'")) {

          $data = $result->fetch_array();

          return $data;

        }

      } else return false;

    }

    public function getShort($post, $url, $token) {

      if($post) {

        $longurl = "$url/ru/?a=$post";

        $query = file_get_contents("https://api.vk.com/method/utils.getShortLink?url=".urlencode($longurl)."&access_token=".$token."&v=5.101");

        $shorturl = json_decode($query, true);

        return ($shorturl['response']['short_url']) ? $shorturl['response']['short_url'] : "@$post";

      } else return false;

    }

    public function __construct($post, $type) {

      if($post && $type) {

        if(gettype($post) && gettype($type) == 'string') {

          require '../../init.php';

          if($type == 'post' && $this->getData($post)) {

            $response = $this->getData($post);

            $this->token = $token;

            $text = $response['title'].'
                    '.$response['description'].'
                    
                    Источник: '.$this->getShort($post, $siteurl, $token);

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
