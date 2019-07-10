<?php require '../messages.php'; if($_SERVER['REQUEST_METHOD'] !== 'POST') header('Location: ../'); ?>

<section class="navbar">
  <div tip>
    <h4>Подсказка</h4>
    <span>Опишите данную фотографию в заголовке. Добавьте теги, подходящие к данному изображению. Максимальная длина заголовка - 60 символов</span>

    <h4>Рекомендации</h4>
    <span>Достаточно 5-6 тегов, которые подходят к данной фотографии. Лучше не использовать специальные символы в заголовке и тегах</span>
  </div>
</section>

<section class="viewbar" style="margin-top: 2vh" unselectable>

  <h4>Предосмотр</h4>

  <div class="inner" style="background-image: url('css/img/upload/moderation/<?php echo $_POST['name']; ?>')"></div>
  <div class="wrapper"><h3 style="display: none"></h3></div>

</section>

<section class="main">

    <form class="asker" spellcheck="false">

        <label>Напишите заголовок для фотографии:</label>
        <input type="text" name="title" autocomplete="off">

        <label>Введите подходящие теги: (Через запятую)</label>
        <input type="text" name="tags" autocomplete="off">

        <input type="hidden" name="lang" value="<?php echo $lang; ?>">
        <input type="hidden" name="image" value="<?php echo $_POST['name']; ?>">

        <div style="display: none" unselectable class="tagsmanager"></div>
        <div style="display: none" unselectable class="alert"></div>

        <button class="btn">Отредактировать информацию</button>

    </form>

</section>

<script src="js/messages.js"></script>
<script src="js/imagetagedit-viewer.js"></script>
