<?php

  class vkImageUpload {

    public function parseTags($tags) {

      if(gettype($tags) == 'string') {

        $last = '';

        for($i = 0; $i < strlen($tags); $i++) {

          if($tags[$i] == $last && $tags[$i] == ',') {

            $tags = substr($tags, 0, $i - 1).substr($tags, -(strlen($tags) - $i), strlen($tags) - 1 - $i);

          }

          $last = $tags[$i];

        }

        if($tags[0] == ',') $tags = substr($tags, 1);

        if($tags[strlen($tags) - 1] == ',') $tags = substr($tags, 0, -1);

        return $tags;

      } else return false;

    }

    public function __construct($obj, $type, $image) {

      if($obj && $type == 'image' && $image) {

        require '../../init.php';

        $data = [
            //'album_id' => 264777456,
            //'group_id' => 184973945,
            'access_token' => $apptoken,
            'v' => '5.101'
        ];

        $uploadurl = "https://api.vk.com/method/photos.getWallUploadServer?".http_build_query($data);

        $result = json_decode(file_get_contents($uploadurl), true);

        $curl = curl_init();

        $file = __DIR__.'\..\css\img\upload\moderation/'.$image['ip'].'/'.$image['name'];

        $file = curl_file_create($file, mime_content_type($file), pathinfo($file)['basename']);

        $headers = array('Content-type: multipart/form-data');

        curl_setopt($curl, CURLOPT_URL, $result['response']['upload_url']);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CAINFO, __DIR__."..\..\..\cacert.pem");
        curl_setopt($curl, CURLOPT_POSTFIELDS, ['file' => $file]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $response_image = json_decode(curl_exec($curl));

        curl_close($curl);

        $data = [
            'server' => $response_image->server,
            'photo' => $response_image->photo,
            'hash' => $response_image->hash,
            'access_token' => $token,
            'v' => '5.101'
        ];

        $url = "https://api.vk.com/method/photos.saveWallPhoto?".http_build_query($data);

        $result_image = json_decode(file_get_contents($url), true);

        $parameters = [
          'owner_id' => -184973945,
          'from_group' => 1,
          'message' => $image['title']."\nТеги: ".$this->parseTags($image['tags'])."\n\nИсточник: Новостная лента SchoolNews",
          'attachment' => 'photo'.$result_image['response'][0]['owner_id'].'_'.$result_image['response'][0]['id'],
          'access_token' => $apptoken,
          'v' => '5.101'
        ];

        $url = "https://api.vk.com/method/wall.post?".http_build_query($parameters);

        file_get_contents($url);

      }

      return true;

    }

  }

?>
