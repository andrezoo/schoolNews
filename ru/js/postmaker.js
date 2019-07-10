  //document.activeElement

  $(document).ready(function() {

    function selectioncheck() {

      if(window.getSelection().focusNode) {
        if(window.getSelection().focusNode.parentNode.tagName !== "H1") {

          if (typeof window.getSelection != "undefined") return window.getSelection().toString();
          else if (typeof document.selection != "undefined" && document.selection.type == "Text") return document.selection.createRange().text;

        } else return false;
      }

    }

    if(!selectioncheck()) {

      setTimeout(function() {
        $('.main_instruments_workspace').attr('type', 'closeded');
      }, 500, function() {
        $('.main_instruments_workspace').css({'margin-top': 'calc(100vh - ' + $(".main_instruments_workspace>.main_instruments_head").height() * 2 + 'px)'});
      });

    }

    $('.main_postbuilder_canvas').on("DOMSubtreeModified",function(){

      if(!$(this).children().length) $(this).append($('.helper_invisible_postbuilder').html());

      try {

        if(($(this).children().length == 1 && $(this).children().last().className == "main_postbuilder_ghost") || $(this).children().eq(1).get(0).tagName == 'P') {
          $('.main_postbuilder_ghost>.post_builder_h1_decoration').addClass('post_builder_hidden'); $('.main_postbuilder_ghost>.post_builder_a_decoration').addClass('post_builder_hidden');
        }

      } catch(e) {

      }

      if($(this).children('article').length > 1) $(this).children('article').last().remove();
       
      if(!$(this).children('.post_builder_h1_first').length) $('.main_postbuilder_ghost>.post_builder_h1_decoration').addClass('post_builder_hidden');

      if(!$(this).children('.post_builder_a_first').length) $('.main_postbuilder_ghost>.post_builder_a_decoration').addClass('post_builder_hidden');

      if(!$(this).children('.post_builder_h1_first').first().text() && !$(this).children('.post_builder_a_first').first().text() && $(this).children().length == 3) {
        $('.main_postbuilder_ghost>.post_builder_h1_decoration').removeClass('post_builder_hidden'); $('.main_postbuilder_ghost>.post_builder_a_decoration').removeClass('post_builder_hidden');
      }

      if(!$(this).children('.post_builder_a_first').length && $(this).children('.post_builder_h1_first').length) $('.main_postbuilder_ghost>.post_builder_a_decoration').addClass('post_builder_hidden');

      try {

        if($.inArray('post_builder_p', $('.main_postbuilder_canvas').children().eq(2).attr('class').split(' ')) > -1) {

          result = $.inArray('post_builder_p', $('.main_postbuilder_canvas').children().eq(2).attr('class').split(' '));

          thisClass = $('.main_postbuilder_canvas').children().eq(2).attr('class').split(' ')[result];

          if(thisClass == "post_builder_p") {

            $('.main_postbuilder_canvas').children().eq(2).removeClass();

            $('.main_postbuilder_canvas').children().eq(2).addClass('post_builder_a post_builder_a_first post_builder_tip');

          }

        }

      } catch(e) {

      }

      if($(this).children('.post_builder_h1_first').first().text()) $('.main_postbuilder_ghost>.post_builder_h1_decoration').addClass('post_builder_hidden');

      if($(this).children('.post_builder_a_first').first().text()) $('.main_postbuilder_ghost>.post_builder_a_decoration').addClass('post_builder_hidden');

      $(this).children().each(function(index, elem) {

        setTimeout(function() {

          if(!$(elem).html() && $(elem).html() != "<br><br>") $(elem).append('<br>');

          else if($(elem).html() == "<br><br>") $(elem).html('<br>');

        }, 0);

      });

    });

    $('.main_postbuilder_canvas>.post_builder_h1_first').on("DOMSubtreeModified",function(){

      if($('.main_postbuilder_canvas>.post_builder_h1_first').text()) {

        if(!$('.main_postbuilder_ghost>.post_builder_h1_decoration').hasClass('post_builder_hidden')) $('.main_postbuilder_ghost>.post_builder_h1_decoration').addClass('post_builder_hidden');

        if($('.main_postbuilder_canvas>.post_builder_h1_first').height()) {
          $('.main_postbuilder_ghost>.post_builder_h1_decoration').height($('.main_postbuilder_canvas>.post_builder_h1_first').height());
        } else $('.main_postbuilder_ghost>.post_builder_h1_decoration').height("3vh");

      } else $('.main_postbuilder_ghost>.post_builder_h1_decoration').removeClass('post_builder_hidden');

    });

    $('.main_postbuilder_canvas>.post_builder_a_first').on("DOMSubtreeModified",function(){

      if($('.main_postbuilder_canvas>.post_builder_a_first').text()) {

        if(!$('.main_postbuilder_ghost>.post_builder_a_decoration').hasClass('post_builder_hidden')) $('.main_postbuilder_ghost>.post_builder_a_decoration').addClass('post_builder_hidden');

      } else $('.main_postbuilder_ghost>.post_builder_a_decoration').removeClass('post_builder_hidden');

    });

    $('.main_environment').on("mouseover mouseenter keyup keydown", function() {

      function selectioncheck() {

        if(window.getSelection().focusNode) {
          if(window.getSelection().focusNode.parentNode.tagName !== "H1") {

            if (typeof window.getSelection != "undefined") return window.getSelection().toString();
            else if (typeof document.selection != "undefined" && document.selection.type == "Text") return document.selection.createRange().text;

          } else return false;
        }

      }

      function selectiontype() {

        if((window.getSelection().focusNode &&
              (window.getSelection().focusNode.parentNode.tagName == "P"
              || window.getSelection().focusNode.parentNode.tagName == "PRE"
              || window.getSelection().focusNode.parentNode.tagName !== "H1")
        ) || (document.getSelection().focusNode &&
              (document.getSelection().focusNode.parentNode.tagName == "P"
              || document.getSelection().focusNode.parentNode.tagName == "PRE"
              || document.getSelection().focusNode.parentNode.tagName !== "H1")))
        return 'simpletext';

      }

      setInterval(function() {

        if(selectioncheck()) {

          $('.main_instruments_workspace').css({
            'margin-top': 'calc(100vh - (100vh - ' + $('.main_instruments_workspace').height() + 'px))'
          });

          $('.main_instruments_workspace').attr('type', 'opened');

          $('.main_instruments_space').children().attr('enabled', 'false');

          if($('.main_instruments_space').children('div[objtype=' + selectiontype() + ']').attr('full') != true) {
            $('.main_instruments_space').children('div[objtype=' + selectiontype() + ']').attr('enabled', 'true');
          }

        } else {

          $('.main_instruments_space').children().attr('enabled', 'false');

          $('.main_instruments_workspace').css({
            'margin-top': 'calc(100vh - ' + $(".main_instruments_workspace>.main_instruments_head").height() * 2 + 'px)'
          });

          if($('.main_instruments_workspace').attr('type') !== "closed") $('.main_instruments_workspace').attr('type', 'closed');

        }

      }, 0);

    });

    $('.main_postbuilder_canvas').on("keyup mouseup", function(){

      try {

        if(!$(this).children().length) $(this).append('<h1 class="post_builder_h1 post_builder_h1_first post_builder_tip"><br></h1>');

        if($(this).children().length == 1 && !$(this).children('post_builder_h1_first').first().text()) $(this).append('<p class="post_builder_a post_builder_a_first"><br></p>');

        if ($(this).children().last().text() && $(this).children().last().attr('class').toLowerCase() != "post_builder_h1"
            && $(this).children().last().attr('class').toLowerCase() != "post_builder_p") $(this).append('<p class="post_builder_p"><br></p>');

        $('.main_postbuilder_canvas').children('br').remove(); $('.main_postbuilder_canvas').children('div').remove();

      } catch(e) {
        console.log(e);
      }

    });

    //Обрабатываем вставки
    $('.main_postbuilder_canvas').on("paste", function(e) {

      let get = e.originalEvent.clipboardData.getData('text');

      function escapeHtml(unsafecode) {
        return unsafecode.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
      }

      $.post('api/parsehtml.php', {htmlcode: get}, function(data) {

        if(JSON.parse(data)['object'] && (document.getSelection().focusNode.parentNode.tagName == "SPAN" || document.getSelection().focusNode.parentNode.tagName == "P")) {

          $(document.getSelection().focusNode).children('br').first().remove();

          $(document.getSelection().focusNode).append('<span>' + escapeHtml(JSON.parse(data)['object']).replace(/\n/g, '<br>') + '</span>');

        } else if(JSON.parse(data)['object'] && (document.getSelection().focusNode.parentNode.tagName == "H1" || document.getSelection().focusNode.parentNode.tagName == "PRE")) {

          $(document.getSelection().focusNode.parentNode).children('br').first().remove();

          $(document.getSelection().focusNode.parentNode).append('<span>' + escapeHtml(JSON.parse(data)['object']).replace(/\n/g, '<br>') + '</span>');

        } else if(JSON.parse(data)['object'] && document.getSelection().focusNode.parentNode.tagName == "DIV") {

          $(document.getSelection().focusNode).children('br').first().remove();

          $(document.getSelection().focusNode).append('<span>' + escapeHtml(JSON.parse(data)['object']).replace(/\n/g, '<br>') + '</span>');

        }

      });

      return false;

    });

    //Обрабатываем работу с enter
    $('.main_postbuilder_canvas').keydown(function(e) {

      if (e.keyCode === 13 || e.which == 13) {

        if(document.getSelection().anchorNode.parentNode.tagName == "H1") $('.main_postbuilder_ghost>.post_builder_a_decoration').addClass('post_builder_hidden');

        else if($(this).children().last().text() && $(this).children('post_builder_a_first').length) $(this).append('<p class="post_builder_p"><br></p>');

        else if($(this).children().last().text() && !$(this).children('post_builder_a_first').length) $(this).append('<p class="post_builder_a post_builder_a_first"><br></p>');

        else if(window.getSelection().anchorNode) {

          let focused = window.getSelection().anchorNode.parentNode;

          let index = $(focused).index();

          if($(this).children().eq(index + 1).text()) {

            let obj = $(this).children().eq(index + 1);

            setTimeout(function() {$(obj).focus(); obj.focus();}, 0);

          } else if($(this).children().last().text()) $(this).append('<p class="post_builder_p"><br></p>');

        }

      }

    });

  });
