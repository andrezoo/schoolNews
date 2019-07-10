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
    <link href="css/fontello.css" rel="stylesheet">
    <link href="css/fonts/NotoSans.css" rel="stylesheet">
    <link href="css/fonts/Montserrat.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>

    <title><?php echo $editpage; ?></title>

  </head>
  <body spellcheck="off">

    <!-- Work with actions -->
    <section wrapper></section>

    <!-- Main part of site -->
    <section content>

      <!-- Header of site -->
      <header class="head-main antiscroll" unselectable>
        <section class="inner">

          <nav left menu>
            <a class="elem" href="index">Главная</a>
            <a class="elem" href="info">Информация</a>
            <a class="elem" href="news">Новости</a>
          </nav>

          <div center>
            <h2>SchoolNews</h2><img style="margin-top: -85% !important; animation: none !important; opacity: 0.85" width="100%" src="css/img/big-icon.png">
          </div>

          <nav right menu float-right>
            <a class="elem" href="contacts">Контакты</a>
            <a class="elem" href="http://27.astana-bilim.kz/">Наша школа</a>
          </nav>

        </section>
      </header>

      <article question>

        <h3 unselectable>Выберите тип поста</h3>

        <div class="inner" unselectable>
          <div style="background: rgba(131,84,143,.75)" class="block" left>

            <h2>Изображение</h2>
            <span>Обычное изображение с заголовком. Заметьте, что загружать фотографии можно только с компьютера</span>

          </div>
          <div style="background: rgba(144,135,197,.75)" class="block" right>

            <h2>Статья</h2>
            <span>Большой функционал редактора статьи поможет вам быстро написать школьную статью</span>

          </div>
        </div>
      </article>

      <article editor style="display: none"></article>

      <footer style="margin-top: 2.5vw" class="foot-main" special unselectable><span>Сервис SchoolNews начал свою работу в 2019 году. Он разработан для публикации информации, связанной со школьной жизнью</span></footer>

    </section>

    <script src="js/loader.js"></script>

  </body>
</html>
