<?php require 'api/ip_check.php'; require 'php/result_check.php'; require 'messages.php'; ?>

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

    <title><?php echo $newspage; ?></title>

  </head>
  <body spellcheck="off">

    <div class="view-edit">
      <a sel href="api/view_grid"><i class="icon-menu-1"></i></a>
      <a href="api/view_blocks"><i class="icon-th-large"></i></a>
      <a href="api/view_slide"><i class="icon-stop-1"></i></a>
    </div>

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
      <article block unselectable style="height: 50% !important; margin-bottom: 0">
        <div class="inner">
          <h2 big>Новостная лента</h2><a desc>Самая новая и свежая информация из жизни школы</a>
        </div>
      </article>

      <article loader unselectable>

        <div class="row little-row">
          <section inner>
            <h3>Ваши новости</h3>
            <span>Добавьте свой собственный пост в систему SchoolNews за несколько кликов!</span>
            <a href="newPost"><button>Создать пост</button></a>
          </section>
        </div>

        <div class="row little-row">
          <section inner>

            <h3>Настройки показа</h3>
            <span>Выберите тип публикаций, который вы хотите видеть.</span><br>
            <a href="php/choose_img.php"><button style="display:inline-block; margin: 1.5vh 0.2%; width: auto">Изображения</button></a>
            <a href="php/choose_posts.php"><button style="display:inline-block; margin: 1.5vh 0.2%; width: auto">Статьи</button></a>

            <input type="hidden" class="selected-post" value="<?php echo $_SESSION['user-selected-post-type'] ?>">

          </section>
        </div>

        <?php if(checkPosts()) require 'php/result_thanks.php'; ?>

        <div class="row" type="block">

          <div big post article style="background: rgba(255,255,255,.5)">
            <div class="wrapper">
              <h3>Тестовый тест. Тестовый тест. Тестовый тест. Тестовый тест. Тестовый тест</h3>
              <span>Тестовый тест. Тестовый тест. Тестовый тест. Тестовый тест. Тестовый тест</span>
            </div>
          </div>

        </div>

        <!--<div class="row" type="block">
          <div post article style="background: rgba(255,255,255,.5)">
            <div class="wrapper">
              <h3>Тестовый тест. Тестовый тест. Тестовый тест. Тестовый тест. Тестовый тест</h3>
              <span>Тестовый тест. Тестовый тест. Тестовый тест. Тестовый тест. Тестовый тест</span>
            </div>
          </div>
        </div>-->

      </article>

      <footer class="foot-main" unselectable><a big>andrezo</a></footer>

    </section>

    <script src="js/scrollheader.js"></script>

  </body>
</html>
