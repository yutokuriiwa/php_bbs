$(function () {
  'use strict';
  // $('#new_comment').on('submit', function () {
  //   let thread_id = $('#new_thread_id').val();
  //   let name = $('#new_name').val();
  //   let content = $('#new_content').val();
  //   // let date = new Date();
  //   // ajax処理
  //   $.post('./../../lib/Controller/Ajax.php', {
  //     thread_id: thread_id,
  //     name: name,
  //     content: content,
  //     mode: 'create',
  //     // token: $('#token').val()
  //   }, function (res) {
  //   // liを追加
  //   let $li = $('#comment_template li').clone();
  //     $li
  //       .attr('id', 'comment_' + res.id)
  //       .data('id', res.id)
  //       .find('.comment__item__name').text('名前：' + name);
  //     $li.find('.comment__item__content').text('投稿日時：' + content);
  //     $li.find('.comment__item__date').text(res.date);
  //     $($li).appendTo('.thread__body').hide().fadeIn(1000);
  //   });
  //   return false;
  // });

  // $('input[type=file]').after('<span></span>');

  // アップロードするファイルを選択
  $('input[type=file]').change(function() {
    var file = $(this).prop('files')[0];

    // 画像以外は処理を停止
    if (! file.type.match('image.*')) {
      // クリア
      $(this).val('');
      $('.imgarea').html('');
      return;
    }

    // 画像表示
    var reader = new FileReader();
    reader.onload = function() {
      var img_src = $('<img>').attr('src', reader.result);
      $('.imgarea').html(img_src);
    }
    reader.readAsDataURL(file);
  });
})
