<?php require '../messages.php'; if($_SERVER['REQUEST_METHOD'] !== 'POST') header('Location: ../'); ?>

  <section class="navbar">
    <div tip>

      <h4 style="margin-top: calc(100vh - 95.5vh)">Помощь</h4>
      <span>Здесь вы можете настроить внешний вид блока статьи</span>

      <h4>Подсказка</h4>
      <span>Опишите данный блок в заголовке. Определите ссылку для доступа к блогу, с её помощью пользователи смогут просматривать блог</span>

      <h4>Рекомендации</h4>
      <span>Тему блога можно кратко раскрыть в описании. Достаточно 20-30 слов</span>

    </div>
  </section>

  <section class="viewbar" unselectable>

    <h4>Предосмотр</h4>

    <div class="inner" style="background: rgba(255,255,0,.5)"></div>
    <div class="wrapper"><h4 style="display: none"></h4><span style="display: none"></span></div>

  </section>

  <section class="main">

      <form class="asker" style="width: 90%; float: right" spellcheck="false">

        <section inner>

          <div class="color-picker">

            <h3 unselectable>Цвет блока</h3>

            <!-- Wow, Someone else uses onClick -->
            <button onClick="changeColor('rgba(255,255,0,.45)')"><div style="background: rgba(255,255,0,.45)"></div></button>
            <button onClick="changeColor('rgba(0,0,255,.45)')"><div style="background: rgba(0,0,255,.45)"></div></button>
            <button onClick="changeColor('rgba(0,255,0,.45)')"><div style="background: rgba(0,255,0,.45)"></div></button>
            <button onClick="changeColor('rgba(255,0,0,.45)')"><div style="background: rgba(255,0,0,.45)"></div></button>
            <button onClick="changeColor('rgba(150,0,255,.45)')"><div style="background: rgba(150,0,255,.45)"></div></button>
            <button onClick="changeColor('rgba(255,200,50,.45)')"><div style="background: rgba(255,200,50,.45)"></div></button>

            <!-- You can make your own colors, bro © andrezo -->
            <input name="picker" type="hidden" picker value="rgba(255,255,0,.45)">

          </div>

          <script src="js/colorpick.js"></script>

          <div class="blockview-editor" unselectable>
            <h3>Содержание</h3>

            <label>Заголовок</label>
            <input id="blockview-editor-title" name="title" type="text" autocomplete="off">

            <label>Краткое описание</label>
            <textarea id="blockview-editor-desc" name="description" type="text" autocomplete="off"></textarea>

            <label>Ссылка доступа (Только латинские символы)</label>
            <input id="blockview-editor-url" name="url" type="text" autocomplete="off">
            <input type="hidden" name="token">

            <div style="display: none" unselectable class="alert"></div>

            <button creator>Отредактировать вид</button>

          </div>

          <script src="js/messages.js"></script>
          <script src="js/blockvnsview.js"></script>

          <div class="fix-height"></div>

        </section>

      </form>

  </section>

  <section class="fix"></section>
