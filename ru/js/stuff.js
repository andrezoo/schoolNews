class admin {

  success(name, type) {

    if(name && type.getAttribute('type') && typeof name == 'string') {

      let url = 'admin/success-' + type.getAttribute('type') + '.php';

      $.post(url, {object: name}, function(data) {

        if(typeof data == 'string') {

          $(type).remove();
          
          console.info('Post status changed to 5 (' + data + ')');

        }

      });

    } else return false;

  }

}

let stuff = new admin();