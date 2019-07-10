<?php require 'api/ip_check.php'; header('Content-Type: text/html; charset=utf-8');

require 'messages.php'; ini_set('session.save_path', __DIR__.'\..\sessions'); session_start();

if(!$_SESSION['selected-token-post']) header('Location: newPost');

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
    <link href="css/fontello.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/fonts/NotoSans.css" rel="stylesheet">
    <link href="css/fonts/Montserrat.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>

    <title><?php echo $editpage; ?></title>

  </head>
  <body spellcheck="off" style="overflow: hidden">

    <div class="whitespace">
      <div class="whitespace_workspace">
        <section block data-type="uploadpost" unselectable>

          <h3>Публикация поста</h3>
          <span>Вы уже почти польностью закончили статью. Осталось только добавить теги к посту</span>

          <article class="whitespace_preview">

            <div class="standart_preview">
              <div class="standart_wrapper">
                <h4></h4><span></span>
              </div>
            </div>

          </article>

          <form class="whitespace_addtag" method="post" action="api/add_tagtopost.php">
            <input eleminput type="text" name="tags" autofocus autocomplete="off" placeholder="Введите сюда теги, связанные с темой блога или поста. Например: Физика, олимпиада">
            <section elemalert style="display: none"></section>
            <section elemoutput>
              <!--<button index="0" tagname><i class="icon-cancel"></i>Тестовый тег</button>-->
            </section>

            <input token="<?php echo $_SESSION['selected-token-post']; ?>" url="<?php echo $_SESSION['selected-url']; ?>" eleminput type="submit" value="Опубликовать">

          </form>

          <script>

            function deleteTag(obj) {

              if($(obj).attr('index') <= $('.whitespace_workspace>section[data-type="uploadpost"]>.whitespace_addtag>input[name="tags"]').val().split(",").length) {

                var index = $(obj).attr('index');

                var arr = $('.whitespace_workspace>section[data-type="uploadpost"]>.whitespace_addtag>input[name="tags"]').val().split(",");

                arr.splice(index, 1);

                $('.whitespace_workspace>section[data-type="uploadpost"]>.whitespace_addtag>input[name="tags"]').val(arr);

                $('.whitespace_addtag>section[elemoutput]').children('button[index="' + index + '"]').first().remove();

                return true;

              }

            }

          </script>

        </section>
      </div>
    </div>

    <div class="errormessage" unselectable style="display: none"></div>

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
            <h2>SchoolNews</h2> <img  style="margin-top: -85% !important; animation: none !important; opacity: 0.85" width="100%" src="css/img/big-icon.png">
          </div>

          <nav right menu float-right>
            <a class="elem" href="contacts">Контакты</a>
            <a class="elem" href="http://27.astana-bilim.kz/">Наша школа</a>
          </nav>

        </section>
      </header>

      <article class="main_environment">

        <div class="main_instruments" unselectable>
          <div class="main_instruments_workspace" type="closed">
            <header class="main_instruments_head">Инструменты</header>
            <section class="main_instruments_space">

              <div class="selecttype" enabled="false" full="false" objtype="simpletext">
                <header onClick="i.openThis(this.parentNode)">Работа с текстом</header>
                <article>

                  <div class="element" onClick="i.setBold()" styletype="bold">B</div>
                  <div class="element" onClick="i.setItal()" styletype="ital">I</div>
                  <div class="element" onClick="i.setStrike()" styletype="strike">S</div>

                </article>
              </div>

              <script src="js/codecheck.js"></script>

            </section>
          </div>
        </div>

        <div class="main_workspace">

          <div class="main_header"></div>

          <div class="main_wrapper">

            <header class="main_wrapper_head" unselectable>

              <aside info><strong>•</strong><a>Без заголовка (Выберите пост)</a></aside>

              <aside buttons>
                <a data-type="black" onClick="getHeaders()">Посты</a>

                <a onClick="saveThisPost(this)">Сохранить</a>

                <a token="<?php echo $_SESSION['selected-token-post']; ?>" type="post">Опубликовать</a>
              </aside>

              <script src="js/messages.js"></script>

              <script>

                function saveThisPost() {

                  $.post('api/edit_postinfo.php', {token: '<?php echo $_SESSION["selected-token-post"]; ?>', code: $('.main_postbuilder_canvas').html().replace(/^\s+/g, '')}, function(data) {
                    console.log('Data is saved');
                  });

                }

                $.post('api/get_postinfo.php', {token: '<?php echo $_SESSION["selected-token-post"]; ?>'}, function(data) {

                  if(JSON.parse(data)['object'] && !JSON.parse(data)['iserror']) {

                    if(JSON.parse(data)['object']['htmlcode']) {

                      $('.main_postbuilder_canvas').children().remove();

                      $('.main_postbuilder_canvas').append(JSON.parse(data)['object']['htmlcode']);

                    }
                    
                  }

                  $('.main_wrapper_head>aside[info]>a').text(JSON.parse(data)['data']['title']);

                });

                function changeEditor(obj, tokenkey) {

                    if(!$(obj).attr('active')) {

                      $(obj).attr('active', true);

                      $.post('api/get_postinfo.php', {token: tokenkey}, function(data) {

                        if(JSON.parse(data) && !JSON.parse(data)['iserror']) {

                            if(JSON.parse(data)['object']['htmlcode']) {

                            $('.main_postbuilder_canvas').children().each(function(index, obj) {
                              if(!$(obj).text()) $(obj).remove();
                            });

                            $('.main_postbuilder_canvas').append(JSON.parse(data)['object']['htmlcode']);

                            }

                            $('.main_wrapper_head>aside[info]>a').text(JSON.parse(data)['data']['title']);

                        }

                      });

                    }

                }

                function showInfobar(data) {

                  if($('.main_infobar_workspace').attr('type') == "closed") {

                    $('.main_infobar_workspace').attr('type', 'opened');

                    if(data['object']) {

                      for (post in data['object']) {

                        name = data['object'][post]['name'];

                        $('.main_infobar_posts').first().append(`<div class='standart_post' onClick='changeEditor(this, \"` + name + `\")'></div>`);

                        obj = $('.main_infobar_posts').children('.standart_post').last();

                        obj.append('<h4>' + data['object'][post]['title'] + '</h4>');

                        if(data['object'][post]['description'].length >= 20) obj.append('<p>' + data['object'][post]['description'].substr(0, 20) + '...</p>');
                        else obj.append('<p>' + data['object'][post]['description'] + '</p>');

                      }

                    }

                  }

                }

                function getHeaders() {

                  $.ajax("api/get_headers.php", {
                    type: "POST",
                    data: {'selected-token-post': '<?php echo $_SESSION['selected-token-post']; ?>'},
                    success: function(data) {

                      if(!JSON.parse(data)['object']) window.location = "newPost";

                      else if(!JSON.parse(data)['iserr'] && JSON.parse(data)['object']) showInfobar(JSON.parse(data));

                    }
                  });

                }

                function createError(message, object) {
                  if(object) {

                    let pos = object.getBoundingClientRect();

                    $('.errormessage').text(message);
                    $('.errormessage').css({'left': 'calc(' + (pos.left + $(object).width()) + 'px + 3.5vw)', 'top': pos.top});
                    $('.errormessage').show();

                    setTimeout(function() {$('.errormessage').hide(250); $('.errormessage').empty()}, 2000);

                  }
                }

                function uploadThisPost(obj) {

                  $('.main_postbuilder_canvas').children()

                    .each(function(index, obj) {if(!$(obj).text()) $(obj).remove();});

                  if($('.main_postbuilder_canvas').children().length == (1 || 2)) createError(errormsg_emptypost, obj);
                  else {

                    $.post('api/uploadhtml.php', $('.main_postbuilder_canvas').html(), function(data) {
                      console.log(data);
                    });

                  }

                }

              </script>

            </header>

            <div class="main_wrapper_fix"></div>

            <section class="main_postbuilder">

              <div class="main_postbuilder_canvas" contenteditable="true">

                <article contenteditable="false" class="main_postbuilder_ghost">
                  <h1 class="post_builder_h1 post_builder_h1_decoration post_builder_tip">Введите заголовок для статьи</h1>
                  <p class="post_builder_a post_builder_a_decoration post_builder_tip">Дайте волю своему воображению</p>
                </article>

                <h1 class="post_builder_h1 post_builder_h1_first post_builder_tip"><br></h1>
                <p class="post_builder_a post_builder_a_first post_builder_tip"><br></p>

              </div>

              <div class="helper_invisible_postbuilder"><article contenteditable="false" class="main_postbuilder_ghost">
                <h1 class="post_builder_h1 post_builder_h1_decoration post_builder_tip">Введите заголовок для статьи</h1>
                <p class="post_builder_a post_builder_a_decoration post_builder_tip">Дайте волю своему воображению</p>
              </article></div>

              <script src="js/postmaker.js"></script>

            </section>

          </div>

        </div>

        <div class="main_infobar">
          <div class="main_infobar_workspace" type="closed">
            <header unselectable class="main_infobar_head"><img class="bracket" src="css/img/bracket.png"></header>
              <article class="main_infobar_posts" unselectable>
              </article>
          </div>
        </div>

      </article>

    </section>

    <script src="js/loadpreupload.js"></script>

  </body>
</html>
