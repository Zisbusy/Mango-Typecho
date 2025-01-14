// 初始化函数
window.onload = function(){
  ajaxNav();
  activeComment();
};

// 翻页
function ajaxNav() {
  $('.layoutSingleColumn').on('click', 'div.comments-nav a', function() {
    $this = $(this);
    let href = $this.attr("href");
    if (href != undefined) {
      $.ajax( {
        url: href,
        type: "get",
        error: function(request) {
          createButterbar("未知错误");
        },
        success: function(data) {
          // 移除当前的评论与翻页按钮
          $('ol.comment-list').remove();
          $('div.comments-nav').remove();
          // 添加新的评论与翻页按钮
          $('h3.comments-title').after($(data).find("ol.comment-list"));
          $('ol.comment-list').after($(data).find("div.comments-nav"));
          // 跳到锚点
          $("html,body").animate({scrollTop: $('#comments').offset().top - 120}, 0 );
        }
      });
    }
    return false;
  });
}

// 回复与取消按钮，用于判断位置与父子评论
function activeComment() {
  var replyTo = '';
  // 监听回复按钮，获取父级的 ID
  $('.layoutSingleColumn').on('click', '.comment-reply-link', function(){
    replyTo = $(this).parent().parent().attr("id");
  });
  // 监听取消回复按钮，清空变量
  $('.layoutSingleColumn').on('click', '#cancel-comment-reply-link', function(){ 
    replyTo = ''; 
  });
}

// 提示函数
function createButterbar(message) {
  jQuery("body").append('<div class="butterBar"><p class="butterBar-message">' + message + '</p></div>');
  setTimeout("jQuery('.butterBar').remove()", 3000);
}
