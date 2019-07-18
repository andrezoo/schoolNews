$(document).ready(function(){

	var dropZone = $('#upload');

	dropZone.on('drag dragstart dragend dragover dragenter dragleave drop', function(){
		return false;
	});

	dropZone.on('dragover dragenter', function() {
		dropZone.addClass('dragover');
	});

	dropZone.on('dragleave', function(e) {
		let dx = e.pageX - dropZone.offset().left;
		let dy = e.pageY - dropZone.offset().top;
		if ((dx < 0) || (dx > dropZone.width()) || (dy < 0) || (dy > dropZone.height())) {
			dropZone.removeClass('dragover');
		}
	});

	dropZone.on('drop', function(e) {
		dropZone.removeClass('dragover');
		let files = e.originalEvent.dataTransfer.files;
		sendFiles(files);
	});

	$('#file-input').change(function() {
		let files = this.files;
		sendFiles(files);
	});

  function createError(name) {
    $('.alertbar>.elem[' + name + ']').removeClass('middle').removeClass('good').addClass('bad');
  }

	function deleteErrors() {
		$('.alertbar>.elem[extension]').addClass('middle').removeClass('good').removeClass('bad');
		$('.alertbar>.elem[filesize]').addClass('middle').removeClass('good').removeClass('bad');
	}

	function showinfoeditor(data) {

		$.post("api/ip_get.php", function(ip) {

			if(data) {

				let url = ip.replace('::','') + '/' + data;

				$.post("php/load_imagetageditor.php", {name: url}, function(data) {

					$('article[editor]').show();
					$('article[editor]').html(data);
					$('article[question]').remove();

				});

			}

		});

	}

	function addtobase(name) {

		if(name) {

			$.post("php/db_addimage.php", {name: name}, function(data) {

				showinfoeditor(data);
				
			});

		}

	}
	function sendFiles(files) {
		let maxFileSize = 5242880;
		let Data = new FormData();
		$(files).each(function(index, file) {

			deleteErrors();

			let scorer = 0;

			if ((file.type !== 'image/png') && (file.type !== 'image/jpeg')) {
        createError('extension');
      } else scorer += 1;

      if(file.size >= maxFileSize) {
          createError('filesize');
      } else scorer += 1;

			if(scorer == 2) Data.append('image', file);

		});

    $.ajax({
      url: 'php/download_image.php',
      type: 'POST',
      data: Data,
			cache: false,
			contentType: false,
			processData: false,
      success: function(data) {
      	addtobase(data);
      }
    });
	}
})
