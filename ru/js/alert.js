function createAlert(message, time) {

  if(!$('.alert').text()) {

    $('.alert').text(message);
    $('.alert').css('margin-left','0');

    setTimeout( function(){
       $('.alert').css('margin-left','-100%');
       $('.alert').text('');
    }, time * 1.5);

  }

}
