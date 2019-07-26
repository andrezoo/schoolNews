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

            $(elem).append(`<button onclick='stuff.fail("${response[obj]['ip']}", this.parentNode)' class='post-button fail-button'>Удалить всё</button>`);

          }

        } else {

          $('article[admin-panel]>.inner').children('div[warn]').first().remove();

          $('article[admin-panel]>.inner').append('<div info warn elem><h3>Предупреждение</h3><span>Новых записей не обнаружено. Лучше сделайте перерыв</span></div>');

        }

      });

    } else {

      $.post("admin/get_images.php", function(data) {

        if(typeof data == 'string' && data && !JSON.parse(data)['error']) {

          response = JSON.parse(data);

          for(var obj in response) {

            $('article[admin-panel]>.inner')
              .append('<div elem type="image"></div>');

            let elem = $('article[admin-panel]>.inner').children('div[type="image"]').last();

            let background = "background-image: url('css/img/upload/moderation/" + response[obj]['ip'] + "/" + response[obj]['name'] + "')";

            $(elem).append('<section style="' + background + '" class="wrapper"><div class="space"><h3>' + response[obj]['title'] + '</h3></div></section>');

            let success = `<button onclick="stuff.success('${response[obj]['name']}', this.parentNode.parentNode)" class="success-btn" btn>Опубликовать</button>`;

            let remove = `<button onclick="stuff.remove('${response[obj]['name']}', this.parentNode.parentNode)" class="remove-btn" btn>Удалить</button>`;

            let fail = `<button onclick='stuff.fail("${response[obj]['ip']}", this.parentNode)' class='fail-btn' btn>Удалить всё</button>`

            $(elem).append('<div class="btn-menu">' + success + remove + fail + '</div>');

          }

        } else {

          $('article[admin-panel]>.inner').children('div[warn]').first().remove();

          $('article[admin-panel]>.inner').append('<div info warn elem><h3>Предупреждение</h3><span>Новых записей не обнаружено. Лучше сделайте перерыв</span></div>');

        }

      });

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

  fail(name, type) {

    if(name && type.getAttribute('type') && typeof name == 'string') {

      let url = 'admin/fail-' + type.getAttribute('type') + '.php';

      $.post(url, {object: name}, function(data) {

        if(typeof data == 'string') {

          $(type).remove();

          console.info('All posts by that user was deleted (' + data + ')');

          window.location.reload();

        } else console.log('Some problems with server');

      });

    }

  }

  remove(ip, type) {

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
