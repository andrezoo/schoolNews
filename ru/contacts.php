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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <title><?php echo $contpage; ?></title>
  </head>
  <body spellcheck="off">

    <!-- Work with actions -->
    <section wrapper></section>

    <!-- Alert messages -->
    <div class="alert" unselectable></div>

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
          <h2 big>Контакты</h2><a desc>В данном разделе находятся необходимые контакты</a>
        </div>
      </article>

      <article littleblock>
        <div class="inner" navbar>
          <section block>
            <h3 unselectable>Почта автора</h3>
            <p onClick="Copytoclipboard(this)">andreandnike@gmail.com</p>
          </section>
          <section block>
            <h3 unselectable>Номер телефона</h3>
            <p onClick="Copytoclipboard(this)">+7 (776) 20-77-309 </p>
          </section>
          <section block>
            <h3 unselectable>Вконтакте</h3>
            <p unselectable><a href="https://vk.com/andrezoishere">@andrezoishere</a></p>
          </section>
        </div>
      </article>

      <footer class="foot-main" unselectable><a big>andrezo</a></footer>

    </section>

    <script src="js/alert.js"></script>
    <script src="js/scrollheader.js"></script>
    <script src="js/autocopy.js"></script>

  </body>
</html>
