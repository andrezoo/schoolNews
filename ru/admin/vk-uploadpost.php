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

      if($con = $this->connection()) {

        $con->set_charset("utf8");

        $con->query("SET NAMES utf8");

        if($result = $con->query("SELECT * FROM `posts-preview` WHERE `url` = '$post'")) {

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

        return ($shorturl['response']['short_url']) ? $shorturl['response']['short_url'] : "Новостная лента SchoolNews ($post)";

      } else return false;

    }

    public function __construct($post, $type) {

      if($post && $type) {

        if(gettype($post) && gettype($type) == 'string') {

          require '../../init.php';

          if($type == 'post' && $this->getData($post)) {

            $response = $this->getData($post);

            $this->token = $token;

            $text = urldecode($response['title']."\n".$response['description'])."\n\nИсточник: ".$this->getShort($post, $siteurl, $token);

            $url = "https://api.vk.com/method/wall.post?";

            $content = file_get_contents($url."owner_id=".$this->groupId."&from_group=1&message=".urlencode($text)."&access_token=".$this->token."&v=5.101");

            $query = json_decode($content);

            echo json_encode(array('iserr' => false, 'message' => 'Good result', 'object' => $query));

          }

        } else echo json_encode(array('iserr' => true, 'message' => 'Incorrect data', 'errobject' => 'vk-problem'));

      } else echo json_encode(array('iserr' => true, 'message' => 'Not full data', 'errobject' => 'vk-problem'));

    }

  }

?>
