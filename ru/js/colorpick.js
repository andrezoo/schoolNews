
  $('.asker').submit(function() {
    return false;
  });

  function changeColor(color) {
    $('.color-picker>input[picker]').val(color);
    $('.viewbar>.inner').css("background-color",color);
  }
