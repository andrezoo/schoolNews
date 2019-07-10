
$(document).ready(function() {

  $('.main_wrapper_head>aside[buttons]>a[type="post"]').on("click dblclick", function() {

    if(($('div.whitespace').css("display") && $('div.whitespace>.whitespace_workspace>section[block]').css("display")) == "none") {

      $.post('api/get_postinfo.php', {token: $('.main_wrapper_head>aside[buttons]>a[type="post"]').attr("token")}, function(data) {

        if(JSON.parse(data)['data']) {

          $('article.whitespace_preview>.standart_preview').css("background-color", JSON.parse(data)['data']['color']);
          $('article.whitespace_preview>.standart_preview>.standart_wrapper>h4').text(JSON.parse(data)['data']['title']);
          $('article.whitespace_preview>.standart_preview>.standart_wrapper>span').text(JSON.parse(data)['data']['description']);

        }

      });

      $('div.whitespace').show();
      $('section[data-type="uploadpost"]').show();

    } else $('div.whitespace').hide();

  });

  $('.whitespace_workspace>section[data-type="uploadpost"]>.whitespace_addtag').submit(function(){
    return false;
  })

  function createError(msg) {

    if(msg) {

      $('.whitespace_addtag>section[elemalert]').show();
      $('.whitespace_addtag>section[elemalert]').text(msg);

    } else {

      $('.whitespace_addtag>section[elemalert]').hide();
      $('.whitespace_addtag>section[elemalert]').empty();

    }

  }

  function checkTags() {

    $('.whitespace_addtag>section[elemoutput]').empty();

    var tags = $(this).val();

    if(tags) {

      if(tags.split(",")[0] !== tags || tags.split(",").length == 1) {

        if(tags.split(",").length !== $('.whitespace_addtag>section[elemoutput]').children('button').last().attr('index')) {

          if(tags.split(",").length <= 15) {

          createError(false);

          for (var i = 0; i <= tags.split(",").length; i++) {

            if(tags.split(",")[i]) {

              if(tags.split(",")[i].replace(/\s/g,'')) {

                if(tags.split(",")[i].length >= 35) {
                  let obj = '<button index="' + i + '" tagname bad onClick="deleteTag(this)"><i class="icon-cancel"></i>' + tags.split(",")[i].substr(0, 35) + '</button>';
                } else obj = '<button index="' + i + '" tagname onClick="deleteTag(this)"><i class="icon-cancel"></i>' + tags.split(",")[i] + '</button>';

                $('.whitespace_addtag>section[elemoutput]').append(obj);

                }

              }

            }

          } else createError(errormsg_alotoftags);

        }

      } else $('.whitespace_addtag>section[elemoutput]').children('button').remove();

    } else $('.whitespace_addtag>section[elemoutput]').children('button').remove();

  }

  $('.whitespace_workspace>section[data-type="uploadpost"]>.whitespace_addtag>input[name="tags"]').keydown(function(e) {

    if($(this).val()) {

      var text = $(this).val();

      if(((e.keyCode - 144) || (e.which - 144)) == ','.charCodeAt(0) && text.slice(-2).charCodeAt(0) == ','.charCodeAt(0)) return false;

      var regex = new RegExp("/[!#$%&'()*+.\/:;<=>?@\[\\\]^_'{|}~-]/");
      var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);

      if (regex.test(key)) {
        return false; e.preventDefault();
      }

    }

  });

  $('.whitespace_workspace>section[data-type="uploadpost"]>.whitespace_addtag>input[name="tags"]').on("input focus keyup keydown change", checkTags);

  $('.whitespace_workspace>section[data-type="uploadpost"]>.whitespace_addtag>input[type="submit"]').on("click", function() {

    if($('.whitespace_workspace>section[data-type="uploadpost"]>.whitespace_addtag>input[name="tags"]').val()) {

      var text = $('.whitespace_workspace>section[data-type="uploadpost"]>.whitespace_addtag>input[name="tags"]').val();

      if(text.split(',').length > 1) {

        if(text.split(',').length <= 15) {

          $('.main_postbuilder_canvas').children('article').remove();
          let htmlcode = $('.main_postbuilder_canvas').html().replace(/^\s+/g, '')

          $.post('api/add_tagstopost.php', {token: $(this).attr('token'), tags: $('.whitespace_addtag>input').val(), url: $(this).attr('url'), code: htmlcode.replace(/^\s+/g, '')}, function(data) {

            if(data) {

              if(JSON.parse(data)['message'] && JSON.parse(data)['iserr']) {

              $('.whitespace_addtag>section[elemalert]').show();
              $('.whitespace_addtag>section[elemalert]').text(JSON.parse(data)['message']);

              } else window.location.href = 'news';

            } else window.location.href = 'news';

          });

        }

      } else createError(errormsg_onetag);

    } else createError(errormsg_NotFullData);

  });

});
