// 变黑函数
function setDark() {
  document.documentElement.classList.add("dark");
  if (darkModeMediaQuery.matches) {
    localStorage.removeItem("isDarkMode")
  } else {
    localStorage.setItem("isDarkMode", "1");
  }
}
// 变白函数
function removeDark() {
  document.documentElement.classList.remove("dark");
  if (!darkModeMediaQuery.matches) {
    localStorage.removeItem("isDarkMode")
  } else {
    localStorage.setItem("isDarkMode", "0");
  }
}
// 切换按钮
function switchDarkMode() {
  // 检查 <html> 元素是否包含 'dark' 类名
  if (document.documentElement.classList.contains('dark')) {
    removeDark();
  } else {
    setDark();
  }
}
// fancybox 图片灯箱
Fancybox.bind('[data-fancybox]', {
  // Your custom options
});

jQuery(document).ready(function($){
  //table预设calss
  $('.wznrys table').addClass("table");
});

$(document).ready(function(){
  //子菜单点击展开
  $('.menu-zk .menu-item-has-children').prepend('<span class="czxjcdbs"></span>');
  $('.menu-zk li.menu-item-has-children .czxjcdbs').click(function(){
  $(this).toggleClass("kai");
  $(this).nextAll('.sub-menu').slideToggle("slow");
  });
});

//列表ajax加载
jQuery(document).ready(function($) {
$('div.post-read-more a').click( function() {
    $this = $(this);
    $this.addClass('loading');
    var href = $this.attr("href");
    if (href != undefined) {
        $.ajax( {
            url: href,
            type: "get",
        error: function(request) {
        },
        success: function(data) {
            $this.removeClass('loading');
            var $res = $(data).find(".post_loop");
            $('.post_box').append($res);
            var newhref = $(data).find(".post-read-more a").attr("href");
            if( newhref != undefined ){
                $(".post-read-more a").attr("href",newhref);
            }else{
                $(".post-read-more").hide();
            }
        }
        });
    }
    return false;
});
});


//导航菜单
function ds_mainmenu(ulclass){
    $(document).ready(function(){
        $(ulclass+' li').hover(function(){
            $(this).children("ul").show();
        },function(){
            $(this).children("ul").hide();
        });
    });
}
ds_mainmenu('.header-menu-ul');

// 点赞
$.fn.postLike = function() {
  let postLikeNum = $(this).find(".count").text();
  let action = $(this).toggleClass('done').hasClass('done') ? 'do' : 'undo';
  postLikeNum = parseInt(postLikeNum, 10) + (action === 'do' ? 1 : -1);
  $(this).find(".count").text(postLikeNum);
  // 请求
  $.post('/likes', {
    cid: $(this).data("id"),
    action: action
  });
};
$(document).on("click", ".specsZan", function() {$(this).postLike();});

//返回顶部
const scrollToTopBtn = document.querySelector(".scrollToTopBtn")
const rootElement = document.documentElement
function handleScroll() {
  const scrollTotal = rootElement.scrollHeight - rootElement.clientHeight
  if ((rootElement.scrollTop / scrollTotal ) > 0.80 ) {
    scrollToTopBtn.classList.add("showBtn")
  } else {
    scrollToTopBtn.classList.remove("showBtn")
  }
}
function scrollToTop() {
  rootElement.scrollTo({
    top: 0,
    behavior: "smooth"
  })
}
scrollToTopBtn.addEventListener("click", scrollToTop)
document.addEventListener("scroll", handleScroll)

