
$("article[question]>.inner>div[left]").on("click", function() {

  $.post("php/load_image.php", function(data) {

    $('article[editor]').show();
    $('article[editor]').html(data);
    $('article[question]').remove();

    console.info("Loaded tag editor");

  });

});


$("article[question]>.inner>div[right]").on("click", function() {

  $.post("php/load_previewmaker.php", function(data) {

    $('article[editor]').show();
    $('article[editor]').html(data);
    $('article[question]').remove();

    console.info("Loaded preview maker");

  });

});
