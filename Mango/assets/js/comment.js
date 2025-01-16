// 初始化函数
window.onload = function(){
  ajaxNav();
  ajaxComment();
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

// 评论
function ajaxComment() {
  // 回复与取消按钮，用于判断位置与父子评论
  let replyTo = '';
  // 监听回复按钮，获取父级的 ID
  $('.layoutSingleColumn').on('click', '.comment-reply-link', function(){
    replyTo = $(this).parent().parent().attr("id");
    // 修正评论表单位置
    $('.comment-respond').insertAfter('#' + replyTo);
  });
  // 监听取消回复按钮，清空变量
  $('.layoutSingleColumn').on('click', '#cancel-comment-reply-link', function(){ 
    replyTo = ''; 
  });

  // 评论数加一
  function commentCounts() {
    var smallTag = $(".comments-title small")
    var newNumber = parseInt(smallTag.text().match(/\d+/)[0]) + 1;
    smallTag.text("(" + newNumber + ")");
  }
  
  // 发送数据前淡化表单禁用提交按钮
  function beforeSendComment() {
    $('#submit').val("提交中...");
    $(".comment-respond").css({ 'opacity': '0.5' });
    $("#submit").attr("disabled", true).css('cursor', 'not-allowed');
  }

  // 发送数据后恢复表单、提交按钮，绑定点击事件
  function afterSendComment(isSuccess) {
    $('#submit').val("再次评论");
    $(".comment-respond").css({ 'opacity': '1' });
    $("#submit").attr("disabled", false).css('cursor', 'pointer');
    if (isSuccess) {
      // 评论加一
      commentCounts()
      // 清空回复位置变量
      replyTo = '';
      // 清空留言内容
      document.querySelector("#comment").value = '';
    }
  }

  // 添加父评论
  function fatherComment(data) {
    // 移除空评论容器
    $('.commentsTip').remove();
    // 移除当前的评论与翻页按钮
    $('ol.comment-list').remove();
    $('div.comments-nav').remove();
    // 添加新的评论与翻页按钮
    $('h3.comments-title').after($(data).find("ol.comment-list"));
    $('ol.comment-list').after($(data).find("div.comments-nav"));
    // 跳到锚点
    $("html,body").animate({scrollTop: $('#comments').offset().top - 120}, 0 );
  }
  
  // 添加子评论
  function childrenComment(data) {
    // 获取新评论 ID
    newCommentId = $(".comment-list", data).html().match(/id=\"?comment-\d+/g).join().match(/\d+/g).sort(function (a, b) { return a - b }).pop();
    // 新评论
    newComment = $("#comment-" + newCommentId, data).parent();
    // 插入数据
    $('#' + replyTo).after(newComment);
    // 取消评论
    TypechoComment.cancelReply();
  }

  // 前端过滤 xss 提交
  function infoChack(commentform) {
    // 定义 xss 关键词
    const xssPatterns = [
      /<!--.*?-->/,  // HTML注释
      /<[^>]+>/,  // 匹配任何HTML标签
      /&#?\w+;/,  // 匹配HTML实体编码
      /javascript:/i,  // JavaScript URL scheme
      /\bbase64\b/i,  // Base64编码
    ];
    // 评论内容验证
    for (let pattern of xssPatterns) {
      if (pattern.test(commentform[0].value)) {
        createButterbar("评论格式错误");
        return false;
      }
    }
    // 链接内容验证
    for (let pattern of xssPatterns) {
      if (pattern.test(commentform[3].value)) {
        createButterbar("链接格式错误");
        return false;
      }
    }
    // 邮箱验证
    if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(commentform[2].value)) {
      createButterbar("邮箱格式错误");
      return false;
    }
    // 昵称验证
    let nameLenght = commentform[1].value.length;
    console.log(nameLenght);
    if (nameLenght <= 0 || nameLenght > 10) {
      createButterbar("昵称不能为空或不能大于10个字符");
      return false;
    }
    return true;
  }
  
  // 监听发送按钮
  $('.layoutSingleColumn').on('click', '#submit', function() {
    // 发送数据前操作
    beforeSendComment();
    // 表单位置、数据
    let commentform = $("#commentform");
    let commentData = $("#commentform").serializeArray();
    // 提交前数据校验
    if (!infoChack(commentData)){
      afterSendComment(false);
      return false;
    }
    // 请求
    $.ajax( {
      url: commentform.attr('action'),
      type: commentform.attr('method'),
      data: commentData,
      error: function (date) {
        afterSendComment(false);
        createButterbar($(".container", date.responseText).prevObject[7].innerHTML.replace(/\s*/g,""));
      },
      success: function(data) {
        if (replyTo == "") {
          // 添加父评论
          fatherComment(data);
        } else {
          // 添加子评论
          childrenComment(data);
        }
        // 提交成功后操作
        afterSendComment(true);
      }
    });
    return false;
  });
  
}

// 提示函数
function createButterbar(message) {
  jQuery("body").append('<div class="butterBar"><p class="butterBar-message">' + message + '</p></div>');
  setTimeout("jQuery('.butterBar').remove()", 3000);
}
