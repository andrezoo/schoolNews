<?php

  require 'api/ip_check.php'; require 'messages.php';

  //if(!$_REQUEST['access-token']) header('Location: ../');
  //elseif($_REQUEST['access-token'] !== $_SESSION['token']) header('Location: ../');

  ini_set('session.save_path', __DIR__.'\..\sessions'); session_start();

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
    <script src="js/jquery.md5.js"></script>

    <title>Административная панель</title>

  </head>
  <body spellcheck="off" style="overflow: hidden">

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

      <article auth unselectable>

        <h2>Авторизация</h2>

        <form method="post" class="inner_space">

          <label for="email">Введите электронную почту</label>
          <input name="email" autofocus tabindex="1" type="email" autocomplete="off" placeholder="Введите почту в данном поле">

          <label for="email">Введите токен доступа</label>
          <input name="pass" tabindex="2" type="password" autocomplete="off" placeholder="Введите пароль в данном поле">

          <div class="alert-bar" style="display: none"></div>

          <div class="progress-bar" style="display: none">
            <div class="progress-active" style="width: 0%">
              <span style="display: none">Успешная верификация аккаунта</span>
            </div>
          </div>

          <input type="hidden" name="token" value='<?php echo $_SESSION["token"]; ?>'>

          <input tabindex="3" type="submit" value="Войти" button>

        </form>

        <script>

          function createError(message) {

            if(message) {

              $('.alert-bar').show(); $('.alert-bar').text(message);

            } else {

              $('.alert-bar').hide(); $('.alert-bar').empty();

            }

          }

          function loadMenu(hash) {

            $.post('php/load_poststuff.php', {'hashcode': hash, 'email': $('.inner_space>input[type="email"]').val(), 'pass': $('.inner_space>input[type="password"]').val()}, function(data) {

              $('article[auth]').remove(); $('section[content]>header.head-main').after(data);

            });

          }

          function progressLoad(elem, object) {

              if(!$(elem).attr('hash')) {

                if($('.progress-bar')) {

                  $('.progress-bar').show();

                  $('.progress-active').animate({
                    width: '50%'
                  }, 3000, function() {
                    $('.progress-active>span').show("fast");
                  });

                  $('.progress-active').animate({
                    width: '100%'
                  }, 1500, function() {

                    $(elem).attr('hash', $.md5($('.inner_space>input[name="token"]').val()));

                    loadMenu($.md5($('.inner_space>input[name="token"]').val()));

                  });

                } else $(elem).attr('hash', '')

            } else return false;

          }

          $('form.inner_space').submit(function(e) {

            $.post('admin/checkdata.php', {'email': $('.inner_space>input[type="email"]').val(), 'pass': $('.inner_space>input[type="password"]').val()}, function(data) {

              if(data) {

                if(!JSON.parse(data)['iserr']) {

                  createError('');

                    $.post('admin/login.php', {'email': $('.inner_space>input[type="email"]').val(), 'pass': $('.inner_space>input[type="password"]').val()}, function(data2) {

                      if(data2) {

                        if(JSON.parse(data2)['iserr']) createError(JSON.parse(data2)['message']);
                        else progressLoad($('form.inner_space'), JSON.parse(data2)['object']);

                      } else progressLoad($('form.inner_space'), 'Hash generated');

                    });

                } else {

                  createError(JSON.parse(data)['message']);

                  return false;

                }

              } else {

                createError('');

                return false;

              }

            });

            $('form.inner_space').children('input[name="email"]').attr('type', 'email');

            $('form.inner_space').children('input[name="pass"]').attr('type', 'password');

            return false;

          });

        </script>

      </article>

      <footer class="foot-main" special unselectable><span>Сервис SchoolNews начал свою работу в 2019 году. Он разработан для публикации информации связанной со школьной жизнью</span></footer>

    </section>

  </body>
</html>
