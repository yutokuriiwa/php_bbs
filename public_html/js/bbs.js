$(function () {
  'use strict';
  $('#new_comment').on('submit', function () {
    let thread_id = $('#new_thread_id').val();
    let name = $('#new_name').val();
    let content = $('#new_content').val();
    // let date = new Date();
    // ajax処理
    $.post('./../../lib/Controller/Ajax.php', {
      thread_id: thread_id,
      name: name,
      content: content,
      mode: 'create',
      // token: $('#token').val()
    }, function (res) {
    // liを追加
    let $li = $('#comment_template li').clone();
      $li
        .attr('id', 'comment_' + res.id)
        .data('id', res.id)
        .find('.comment__item__name').text('名前：' + name);
      $li.find('.comment__item__content').text('投稿日時：' + content);
      $li.find('.comment__item__date').text(res.date);
      $($li).appendTo('.thread__body').hide().fadeIn(1000);
    });
    return false;
  });

  // $('#new_thread').on('submit', function () {
  //   return false;
  // });
})
