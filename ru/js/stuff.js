class admin {

  feed(type) {

    let response = '';

    if(type == 'posts-preview') {

      $.post('admin/get_feed.php', function(data) {

        if(typeof data == 'string' && data && !JSON.parse(data)['error']) {

          response = JSON.parse(data);

          for(var obj in response) {

            $('article[admin-panel]>.inner')
              .append('<div style="background: ' + response[obj]['color'] + '" elem type="post"></div>');

            let elem = $('article[admin-panel]>.inner').children('div[type="post"]').last();

            $(elem).append('<h3>' + response[obj]['title'] + '</h3><span>' + response[obj]['description'] + '</span>');

            $(elem).append('<a target="_blank" href="p?a=' + response[obj]['url'] + '">Просмотреть статью</a>');

            $(elem).append(`<button onclick="stuff.success('${response[obj]['url']}', this.parentNode)" class="post-button success-button">Опубликовать</button>`);

            $(elem).append(`<button onclick="stuff.remove('${response[obj]['url']}', this.parentNode)" class="post-button remove-button">Удалить</button>`);

            $(elem).append(`<button onclick='stuff.fail("${response[obj]['url']}", this.parentNode)' class='post-button fail-button'>Удалить и заблокировать</button>`);

          }

        } else {

          $('article[admin-panel]>.inner').children('div[warn]').last().remove();

          $('article[admin-panel]>.inner').append('<div info warn elem><h3>Предупреждение</h3><span>Новых записей не обнаружено. Лучше сделайте перерыв</span></div>');

        }

      });

    } else if (type == 'images') {

    }

  }

  success(name, type) {

    if(name && type.getAttribute('type') && typeof name == 'string') {

      let url = 'admin/success-' + type.getAttribute('type') + '.php';

      $(type).remove();

      $.post(url, {object: name}, function(data) {

        console.log(data);

        if(typeof data == 'string' && data) {

          if(JSON.parse(data)['iserr']) {

            console.log('Some problems with upload (' + JSON.parse(data)['message'] + ')');

          } else {

            console.info('Post status changed to 5 (Uploaded to Vk)');

          }

        } else {

          $(type).remove();

          console.info('Post status changed to 5 (Uploaded to Vk)');

        }

      });

    } else return false;

  }

  remove(name, type) {

    if(name && type.getAttribute('type') && typeof name == 'string') {

      let url = 'admin/remove-' + type.getAttribute('type') + '.php';

      $.post(url, {object: name}, function(data) {

        if(typeof data == 'string') {

          $(type).remove();

          console.info('Post was deleted (' + data + ')');

        } else console.log('Some problems with server');

      });

    } else return false;

  }

}

let stuff = new admin();
