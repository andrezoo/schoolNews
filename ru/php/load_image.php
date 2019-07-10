<?php if($_SERVER['REQUEST_METHOD'] !== 'POST') header('Location: ../'); ?>

<section class="navbar">
  <div tip>
    <h4 style="margin-top: calc(100vh - 95.5vh)">Подсказка</h4>
    <span>Для того, чтобы начать загрузку фотографии, нужно перетащить изображение в зелёную область</span>

    <h4>Рекомендации</h4>
    <span>Фотографии желательно загружать с расширениями: png или jpg. Минимальные требования к фотографии: Хорошое качество (HD), среднее разрешение</span>
  </div>
</section>

<section class="main">
<form method="post" id="upload" class="inner" unselectable><div>
  <i class="icon-plus-1"></i>
  <input id="file-input" type="file" name="file" style="display: none">
  <label for="file-input" tabindex="0">Выберите файл</label><span> или перетащите <br>его сюда</span>
</div></form>
</section>

<section class="alertbar" unselectable>
  <div class="elem middle" extension><a>Допустимые расширения фотографий: png, jpeg</a></div>
  <div class="elem middle" filesize><a>Максимальный размер: 10 мегабайт</a></div>
  <div class="elem middle" filecount><a>Загрузить можно только одну фотографию</a></div>
</section>

<script src="js/dad.js"></script>
