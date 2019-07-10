<?php require 'api/ip_check.php'; require 'messages.php';

  ini_set('session.save_path', __DIR__.'\..\sessions'); session_start();

  if($_REQUEST['a']) {

    $_SESSION['a'] = $_REQUEST['a'];

    header('Location: p');

  }

  session_write_close();

?>

<html lang="<?php echo $lang; ?>">
  <head>

    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="author" content="andrezo">

    <!-- Open graph -->
    <meta property="og:title" content="schoolNews">
    <meta property="og:image" content="css/img/favicon.ico">
    <meta property="og:type" content="website">

    <!-- Link tags -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/fonts/NotoSans.css" rel="stylesheet">
    <link href="css/fonts/Montserrat.css" rel="stylesheet">

    <link media="(max-width: 1280px)" href="css/laptop.css" rel="stylesheet">
    <link media="screen and (width: 375px), (max-width: 768px)" href="css/mobile.css" rel="stylesheet">

    <title>Главная</title>

  </head>
  <body spellcheck="off" style="overflow: hidden">

    <!-- Work with actions -->
    <section wrapper></section>

    <!-- Main part of site -->
    <section content>

      <!-- Header of site -->
      <header class="head-main" unselectable>
        <section class="inner">

          <nav left menu>
            <a class="elem" href="index">Главная</a>
            <a class="elem" href="info">Информация</a>
            <a class="elem" href="news">Новости</a>
          </nav>

          <div center>
            <h2>SchoolNews</h2> <img width="100%" src="css/img/big-icon.png">
          </div>

          <nav right menu float-right>
            <a class="elem" href="contacts">Контакты</a>
            <a class="elem" href="http://27.astana-bilim.kz/">Наша школа</a>
          </nav>

        </section>
      </header>

      <!-- Block part-->
      <article block unselectable>
        <div class="inner">

          <h2 big>Быстро и удобно</h2>
          <a desc>Сервис для публикации информативных постов из жизни школы-лицея №27</a>

          <a class="button" href="news">
            <div class="white">Новостная лента</div>
          </a>

        </div>
      </article>

      <footer class="foot-main" special unselectable><span>Сервис SchoolNews начал свою работу в 2019 году. Он разработан для публикации информации связанной со школьной жизнью</span></footer>

    </section>

  </body>
</html>
