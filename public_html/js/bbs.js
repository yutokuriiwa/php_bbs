$(function () {
  $('input[type=file]').change(function () {
    var file = $(this).prop('files')[0];

    // 画像以外は処理を停止
    if (!file.type.match('image.*')) {
      // クリア
      $(this).val('');
      $('.imgfile').html('');
      return;
    }

    // 画像表示
    var reader = new FileReader();
    reader.onload = function () {
      var img_src = $('<img>').attr('src', reader.result);
      $('.imgfile').html(img_src);
      $('.imgarea').removeClass('noimage');
    }
    reader.readAsDataURL(file);
  });

  $('.fav__btn').on('click', function () {
    origin = location.origin;
    $favbtn = $(this);
    $threadid = $favbtn.parent().parent().data('threadid');
    $myid = $('.prof-show').data('me');
    $.ajax({
      type: 'post',
      url: origin + '/public_html/ajax.php',
      data: {
        'thread_id': $threadid,
        'user_id': $myid,
      }
    })
      .done(function (data) {
        if (data == 1) {
          $($favbtn).addClass('active');
        } else {
          $($favbtn).removeClass('active');
        }
      })
  })
});
