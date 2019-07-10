<?php require 'api/ip_check.php'; require 'messages.php'; ?>

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
    
    <script src="js/jquery.min.js"></script>

    <title><?php echo $infopage; ?></title>

  </head>
  <body spellcheck="off">

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
      <article block unselectable style="height: auto !important">
        <div class="inner">
          <h2 big>Информация</h2><a desc>В данном разделе можно найти информацию об авторе нейронной сети и подробной информации о проекте</a>
        </div>
      </article>

      <article littleblock>
        <div class="inner" navbar>
          <section block>
            <h3>Информация о проекте</h3>
            <span>Сервис SchoolNews начал свою работу в 2019 году. Он разработан для публикации информации связанной со школьной жизнью.
            Проект основан на нейронной сети, которая понимает потребности пользователя</span>
          </section>
          <section block>
            <h3>Информация о школе</h3>
            <span>Государственное учреждение «Школа – лицей №27» Управления образования г. Астаны расположено в типовом здании с проектной мощностью 1568 мест по адресу: город Астана, микрорайон Молодежный ул. Таха -Хусейна 5/1.</span>
          </section>
          <section block>
            <h3>Информация об авторе</h3>
            <span><a href="https://vk.com/andrezoishere">Андрей Ляпейков</a> - ученик 27 школы-лицея. Занимается разработкой нейронной сети и сайта для сервиса SchoolNews</span>
          </section>
        </div>
      </article>

      <footer class="foot-main" unselectable><a big>andrezo</a></footer>

    </section>

  <script src="js/scrollheader.js"></script>

  </body>
</html>
