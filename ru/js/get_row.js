
$(document).ready(function() {

  function getIds() {

    var ids = [];

    $('article[loader]').children('div.row[type="block"]').each(function(i, elem) {
      ids.push($(elem).attr('ids'));
    });

    ids = ids.join();

    if(ids) return ids; else return false;

  }

  function getRow() {

    $.post('api/get_row.php', {'ids': getIds(), 'type': $('input.selected-post').val()}, function(data) {

      if(data) {

        if(!JSON.parse(data)['iserr'] && JSON.parse(data).length > 1 && JSON.parse(data)[JSON.parse(data).length - 1]['info'][0]) {

          var ids = JSON.parse(data)[JSON.parse(data).length - 1]['info'][0];
          var type = JSON.parse(data)[JSON.parse(data).length - 1]['info'][1];

          $('article[loader]').append('<div class="row" type="block" ids="' + ids + '"></div>');

          var block = $('article[loader]').children('div.row').last();

          var style, get, part, click = '';

          for(var i = 0; i <= JSON.parse(data).length - 1; i++) {

            if(JSON.parse(data)[i]['data'] && type == 'images') {

              get = JSON.parse(data)[i]['data'];
              $(block).append('<div post image></div>');

              part = $(block).children().last();

              $(part).css({'background-image': "linear-gradient(to top, rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('css/img/upload/moderation/" + get['ip'] + "/" + get['name'] + "')"});

              $(part).append('<div class="wrapper"><h3>' + get['title'] + '</h3></div>');

            } else if(JSON.parse(data)[i]['data'] && type == 'posts-preview') {

              get = JSON.parse(data)[i]['data'];
              $(block).append('<a post article href="p?a=' + get['url'] + '"></a>');
              part = $(block).children().last();

              $(part).css({'background': get['color']});

              $(part).append('<div class="wrapper"><h3>' + get['title'] + '</h3><span>' + get['description'] + '<a href="p?a=' + get['url'] + '">Далее...</a></span></div>');

            }

          }

        }

      }

    });

  }

  getRow();

  setInterval(

    function() {

          getRow();

    }, 2500);

});
