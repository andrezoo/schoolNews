function get_news() {

  $.post("api/get_news.php", function(data) {

    if(data) {

      for(var row in JSON.parse(data)) {

        if(JSON.parse(data)[row].length > 1 && !$('article[loader]').children('div.row[first="' + JSON.parse(data)[row][0]['id'] + '"]').first().length) {

          if(JSON.parse(data)[row] !== 'images') {

            var get;

            $('article[loader]').append('<div class="row" first="' + JSON.parse(data)[row][0]['id'] + '" data-type="block"></div>');
            $('article[loader]').children('div.row').last().hide();

            for(var obj in JSON.parse(data)[row]) {

              get = JSON.parse(data)[row][obj];

              if(get['name'] && get['ip'] && get['title'] && get['tags'] && get['status'] && get['lang'] && get['id']) {

                $('article[loader]').children('div.row').last().append('<div post image></div>');

                $('article[loader]').children('div.row').last().children('div[post]').last().css({
                  'background-image': 'linear-gradient(to top, rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url("css/img/upload/moderation/' + get['ip'] + '/' + get['name'] + '")'
                });

                $('article[loader]').children('div.row').last().children('div[post]').last().append('<div class="wrapper"><h3>' + get['title'] + '</h3></div>');

              }

            }

            setTimeout(function() {

              $('article[loader]').children('div.row').show();

            }, 0);

          }

        }

      }

    }

  });

}

setInterval(get_news(), 5000);
