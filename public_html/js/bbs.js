$(function () {
  // アップロードするファイルを選択
  console.log();
  $('input[type=file]').change(function () {
    var file = $(this).prop('files')[0];

    // 画像以外は処理を停止
    if (!file.type.match('image.*')) {
      // クリア
      $(this).val('');
      $('.imgarea').html('');
      return;
    }

    // 画像表示
    var reader = new FileReader();
    reader.onload = function () {
      var img_src = $('<img>').attr('src', reader.result);
      $('.imgarea').html(img_src);
    }
    reader.readAsDataURL(file);
  });

  $('.fav__btn').on('click', function () {
    $favbtn = $(this);
    $($favbtn).toggleClass('active');
  });
});
