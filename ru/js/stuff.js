class admin {

  success(name, type) {

    if(name && type.getAttribute('type') && typeof name == 'string') {

      let url = 'admin/success-' + type.getAttribute('type') + '.php';

      $(type).remove();

      $.post(url, {object: name}, function(data) {

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

  remove(name, type) {

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
