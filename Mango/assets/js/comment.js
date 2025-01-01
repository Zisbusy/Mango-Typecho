// ajax 翻页执行函数
window.onload = ajaxNav;
// ajax 翻页函数
function ajaxNav() {
  $('div.comments-nav a').click( function() {
    $this = $(this);
    var href = $this.attr("href");
    // 修改地址栏链接
    history.replaceState({}, document.title, href);
    if (href != undefined) {
      $.ajax( {
        url: href,
        type: "get",
        error: function(request) {
          console.log("未知错误");
        },
        success: function(data) {
          // 获取新评论与翻页按钮
          var comments = $(data).find("ol.comment-list");
          var commentsNav = $(data).find("div.comments-nav");
          // 移除当前的评论与翻页按钮
          $('ol.comment-list').remove();
          $('div.comments-nav').remove();
          // 添加新的评论与翻页按钮
          $('h3.comments-title').after(comments);
          $('ol.comment-list').after(commentsNav);
          // 跳到锚点
          $("html,body").animate({scrollTop: $('#comments').offset().top - 120}, 0 );
          // 再次执行 绑定一下事件
          ajaxNav()
        }
      });
    }
    return false;
  });
}
