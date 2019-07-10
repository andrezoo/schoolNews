
$(document).ready(function(){

  function createError(obj, error) {
    if(error) {
      obj.html(''); obj.show(); obj.append(error);
    } else {
      obj.html(''); obj.hide();
    }
  }

  $('.asker>[inner]>.blockview-editor>input[name="title"]').keyup(function() {

    $('.viewbar>.wrapper>h4').show();

    if($('.asker>[inner]>.blockview-editor>input[name="title"]').val().length <= 45) {
      $('.viewbar>.wrapper>h4').text($('.asker>[inner]>.blockview-editor>input[name="title"]').val());
      createError($('.blockview-editor>.alert'), '');
    }
    else if(!$('.asker>[inner]>.blockview-editor>input[name="title"]').val().length) $('.viewbar>.wrapper>h4').hide();
    else {

      $('.viewbar>.wrapper>h4').text($('.asker>[inner]>.blockview-editor>input[name="title"]').val().substr(0,45));

      createError($('.blockview-editor>.alert'), errormsg_LargeTitle);

    }

  });

  $('.asker>[inner]>.blockview-editor>textarea[name="description"]').keyup(function() {

    $('.viewbar>.wrapper>span').show();

    if($('.asker>[inner]>.blockview-editor>textarea[name="description"]').val().length <= 750) {
      $('.viewbar>.wrapper>span').text($('.asker>[inner]>.blockview-editor>textarea[name="description"]').val());
      createError($('.blockview-editor>.alert'), '');
    }
    else if(!$('.asker>[inner]>.blockview-editor>textarea[name="description"]').val().length) $('.viewbar>.wrapper>span').hide();
    else {
      $('.viewbar>.wrapper>span').text($('.asker>[inner]>.blockview-editor>textarea[name="description"]').val().substr(0,750));
      createError($('.blockview-editor>.alert'), errormsg_LargeDesc);
    }

  });

  $('.asker>[inner]>.blockview-editor>input[name="url"]').keyup(function() {

    $.post("api/accessname_check.php", {url: $('.asker>[inner]>.blockview-editor>input[name="url"]').val()}, function(data) {

      function createError(obj, error) {
        if(error) {
          obj.html(''); obj.show(); obj.append(error);
        } else {
          obj.html(''); obj.hide();
        }
      }

      if(JSON.parse(data)['iserror']) {
        $('.asker>[inner]>.blockview-editor>input[name="url"]').addClass('badresult');
        createError($('.blockview-editor>.alert'), errormsg_Busyurl);
      }
      else {
        $('.asker>[inner]>.blockview-editor>input[name="url"]').removeClass('badresult');
        createError($('.blockview-editor>.alert'), '');
      }

    });

  });

  $('.asker>[inner]>.blockview-editor>input[name="url"]').keypress(function(e) {

    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);

    if (!regex.test(key)) {
      e.preventDefault(); return false;
    } else $('.asker>[inner]>.blockview-editor>input[name="url"]').val($('.asker>[inner]>.blockview-editor>input[name="url"]').val().split(' ').join('-'));

  });

  $('.asker>[inner]>.blockview-editor>button[creator]').on("click", function() {

    let Form = $('.asker').serialize();

    $.post("api/create_viewblock.php", Form, function(data) {

      if(JSON.parse(data)['iserror']) {
        $('.alert').text(''); $('.alert').show();
        $('.alert').append(JSON.parse(data)['message']);
      } else $('.asker>[inner]>.blockview-editor>input[name="token"]').val(JSON.parse(data)['object']);

      if($('.asker>[inner]>.blockview-editor>input[name="token"]').val() && JSON.parse(data)['object']) window.location.href = 'postMaker';

    });

  });

  $('.asker').submit(function() {
    return false;
  });

});
