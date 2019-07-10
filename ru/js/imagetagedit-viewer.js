
$(document).ready(function(){

  $('.asker>input[name="title"]').keyup(function() {

    $('.viewbar>.wrapper>h3').show();

    if($('.asker>input[name="title"]').val().length <= 35) $('.viewbar>.wrapper>h3').text($('.asker>input[name="title"]').val());
    else if(!$('.asker>input[name="title"]').val().length) $('.viewbar>.wrapper>h3').hide();
    else if($('.viewbar>.wrapper').width() < $('.viewbar>.wrapper>h3').width()) $('.viewbar>.wrapper>h3').text($('.asker>input[name="title"]').val().substr(0,25));

  });

  $('.asker>input[name="tags"]').keyup(function() {

    if($('.asker>input[name="tags"]').val().split(",") && $('.asker>input[name="tags"]').val()) {

      $('.asker>.tagsmanager').html('');

      for (i = 0; i <= $('.asker>input[name="tags"]').val().split(",").length - 1; i++) {

          if($('.asker>input[name="tags"]').val().split(",")[i].replace(/ /g,''.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, ''))) {
            $('.asker>.tagsmanager').append('<div tag>' + $('.asker>input[name="tags"]').val().split(",")[i].replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '') + '</div>');
          }

      }

      $('.asker>.tagsmanager').show();

    } else $('.asker>.tagsmanager').hide();

  });

  $('.asker').submit(function() {
    return false;
  });

  function createError(obj, error) {
    if(error) {
      obj.html(''); obj.show(); obj.append(error);
    } else {
      obj.html(''); obj.hide();
    }
  }

  $(".asker>button.btn").on("click", function() {

    let Data = $('.asker').serialize();

    //Проверка всех полей
    if(!$('.asker>input[name="title"]').val() || !$('.asker>input[name="lang"]').val() || !$('.asker>input[name="tags"]').val()) createError($('.asker>.alert'), errormsg_NotFullData);

    //Проверка валидности данных
    else if($('.asker>input[name="title"]').val().length > 50 || $('.asker>input[name="tags"]').val().split(",").length > 25) createError($('.asker>.alert'), errormsg_LargeData);

    else {

      createError($('.asker>.alert'), '');

      $.ajax({
        url: 'php/edit_imagetageditor.php',
        type: 'POST',
        data: Data,
        success: function(data) {

          if(data) createError($('.asker>.alert'), JSON.parse(JSON.stringify(data))['errormsg']);
          else location.href = 'news';

        }
      });

    }

  });

});
