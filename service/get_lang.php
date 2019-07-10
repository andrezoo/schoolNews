<?php

class language {

  public $result;

  public function __construct() {

    if($this->getLang() && ($lang = $this->getLang())) $this->result = $this->checkDir($lang);

  }

  public function checkDir($language) {

    if(!file_exists(__DIR__.str_replace(' ', '', "\..\ $language"))) {

      session_start(); $_SESSION['lang'] = 'ru'; session_write_close();

      return 'ru';

    } else return $language;

  }

  public function getLang() {

    session_start();

    if(!$_SESSION['lang']) {

      $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); $_SESSION['lang'] = $lang;

    } else $lang = $_SESSION['lang'];

    session_write_close();

    return $lang;

  }

}

$lang = new language;

//$lang->result - результат

?>
