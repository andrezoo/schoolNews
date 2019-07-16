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

    <script src="js/jquery.min.js"></script>

    <title>Модерация</title>

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
            <h2>SchoolNews</h2> <img style="margin-top: -85% !important; animation: none !important; opacity: 0.85" width="100%" src="css/img/big-icon.png">
          </div>

          <nav right menu float-right>
            <a class="elem" href="contacts">Контакты</a>
            <a class="elem" href="http://27.astana-bilim.kz/">Наша школа</a>
          </nav>

        </section>
      </header>

      <article admin-panel unselectable>

        <section class="inner">

          <h2>Неопубликованные посты</h2>

          <div info elem>

            <h3>Информация</h3><span>Для того, чтобы начать работу выберите тип постов</span>

            <div class="selector">
              <button onClick="selectType(this, 'posts-preview')" side>Статьи</button><button onClick="selectType(this, 'images')" style="border: none" side>Изображения</button>
            </div>

            <script>

              function selectType(obj, type) {

                if(type) {

                  $.post('admin/select_type.php', {type: type}, function(data) {

                    if(data && !obj.disabled) {

                      var feed = stuff.feed(type);

                      obj.disabled = true;

                    }

                  });

                } else return false;

              }

            </script>

          </div>

          <?php ini_set('session.save_path', __DIR__.'\..\sessions'); session_start(); if($_SESSION['admin']['selected-type']): ?>

          <script src="js/stuff.js"></script>

          <script>

            //var response = stuff.feed('<?php //echo $_SESSION['admin']['selected-type']; ?>');

          </script>

          <div elem type="image"></div>

          <!--<div style="background: rgba(255,255,0,.5)" elem type="post">

            <h3>Тестовый заголовок для блока статьи</h3>

            <span>

              Повседневная практика показывает, что сложившаяся структура организации в значительной степени обуславливает создание соответствующий условий активизации. Таким образом сложившаяся структура организации представляет собой интересный эксперимент проверки дальнейших направлений развития. Повседневная практика показывает, что рамки и место обучения кадров требуют определения и уточнения существенных финансовых и административных условий. Значимость этих проблем настолько очевидна, что сложившаяся структура организации способствует подготовки и реализации систем массового участия. Равным образом реализация намеченных плановых заданий играет важную роль в формировании модели развития. Значимость этих проблем настолько очевидна, что консультация с широким активом представляет собой интересный эксперимент проверки позиций, занимаемых участниками в отношении поставленных задач. Идейные соображения высшего порядка, а также сложившаяся структура организации позволяет оценить значение направлений прогрессивного развития. Не следует, однако забывать, что консультация с широким активом требуют от нас анализа системы обучения кадров, соответствует насущным потребностям.

            </span>

            <a target="_blank" href="p?a=andrezo-is-here">Просмотреть статью</a>

            <button onClick="stuff.success('andrezo-is-here')" class="post-button success-button">Опубликовать</button>

            <button onClick="stuff.remove('andrezo-is-here')" class="post-button remove-button">Удалить</button>

            <button onClick="stuff.fail('andrezo-is-here')" class="post-button fail-button">Удалить и заблокировать</button>

          </div>-->

          <?php endif ?>

        </section>

      </article>

      <footer class="foot-main" special unselectable><span>Сервис SchoolNews начал свою работу в 2019 году. Он разработан для публикации информации связанной со школьной жизнью</span></footer>

    </section>

  </body>
</html>
