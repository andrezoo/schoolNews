<?php

  ini_set('session.save_path', __DIR__.'\..\..\sessions'); session_start();

  function checkData() {

    if(isset($_POST) && $_POST['hashcode'] && $_POST['email'] && $_POST['pass']) {

      if($_SESSION['admin-token'] == md5($_POST['pass'])) {

        return true;

      } else return false;

    } else return false;

  }

  if(checkData()): ?>

  <article admin-panel unselectable>

    <section class="inner">

      <h3>Неопубликованные посты</h3>

      <div elem>

      </div>

    </section>

  </article>

<?php else: ?>

  <article block unselectable>
      <div class="inner"><h2 big>Проблемы с токеном</h2><a desc>Сервер ожидал токен: <?php echo $_SESSION['admin-token']; ?>, но получил: <?php echo md5($_POST['pass']); ?></a></div>
  </article>

<?php endif ?>
