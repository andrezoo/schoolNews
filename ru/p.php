<?php require 'api/ip_check.php'; require 'php/result_check.php'; require 'messages.php';

  ini_set('session.save_path', __DIR__.'\..\sessions'); session_start();

  if($_SESSION['a'] || $_REQUEST['a']) {

    $a = ($_REQUEST['a']) ? $_REQUEST['a'] : $_SESSION['a'];

  } else header('Location: index');

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
    <link href="css/fontello.css" rel="stylesheet">
    <link href="css/fonts/NotoSans.css" rel="stylesheet">
    <link href="css/fonts/Montserrat.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>

    <title><?php echo $articleread; ?></title>

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

          <nav right menu float-right>
            <a class="elem" href="contacts">Контакты</a>
            <a class="elem" href="http://27.astana-bilim.kz/">Наша школа</a>
          </nav>

        </section>
      </header>

      <article reader>
        <section class="main_reader">

          <header class="main_reader_head">
            <h2 class="get_title" unselectable>Тестовый заголовок</h2>
          </header>

          <div class="main_reader_inner" unselectable></div>

        </section>
      </article>

      <script>

        var post = '<?php echo $a ?>';

        if(post) {

          $.post('api/get_article.php', {post: post}, function(data) {

            if(!JSON.parse(data)) window.location.href = 'index';

            $('.main_reader>.main_reader_head').css('background-color', JSON.parse(data)['info']['color']).css('opacity', '0.75');
            $('.main_reader>.main_reader_head>.get_title').text(JSON.parse(data)['info']['title']);

            $.get('api/decode_ent.php', {code: JSON.parse(data)['inner']['htmlcode']}, function(d) {

              $('.main_reader_inner').html(d);

            });

          });

        }

      </script>

    </section>

  </body>
</html>
