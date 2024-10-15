<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<!-- 文章页面 -->
<section class="index_area">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-8">
        <!-- 文章头部 -->
        <div class="post_container_title">
          <h1><?php $this->title() ?></h1>
          <p>
            <span><i class="bi bi-clock"></i><?php $this->dateWord(); ?></span>
            <span><i class="bi bi-eye"></i>2,908</span>
            <span><i class="bi bi-chat-square-text"></i>18</span>
          </p>
        </div>
        <!-- 文章详情 -->
        <div class="post_container">
          <article class="wznrys"><?php $this->content(); ?></article>
          <!-- 标签 -->
          <?php $this->need('/inc/tag.php'); ?>
        </div>
        <!-- 文章底部作者信息 -->
        <div class="post_author">
          <div class="post_author_l">
            <img alt="" src="<?php $this->options->avatar(); ?>" class="avatar avatar-30 photo" height="30" width="30" loading="lazy" decoding="async">
            <span><?php $this->author(); ?></span>
          </div>
          <div class="post_author_r">
            <div class="post_author_icon">
              <a href="#post_comment_anchor"><i class="bi bi-chat-square-dots-fill"></i><?php $this->commentsNum(); ?></a>
              <a href="javascript:;" data-action="ding" data-id="1300" class="specsZan "><i class="bi bi-hand-thumbs-up-fill"></i><small class="count">104</small></a>
            </div>
          </div>
        </div>

      </div>
      <!-- 侧边信息 -->
      <div class="col-lg-4">
        <div class="sidebar_sticky">
        <div class="author_show_box">
            <div class="author_show_head">
                <img alt="" src="<?php $this->options->avatar(); ?>" class="avatar avatar-80 photo" height="80" width="80" loading="lazy" decoding="async">
                <h3><?php $this->author(); ?></h3>
                <p>站在巨人的肩膀上而已</p>
            </div>
            <div class="author_show_info">
                <span><i class="bi bi-book"></i><b>文章</b>8</span>
                <span><i class="bi bi-chat-square-dots"></i><b>评论</b>3</span>
            </div>

        <ul class="author_post">

        <li>
            <img width="400" height="280" src="https://mango.huitheme.cn/wp-content/cache/thumbnails/2022/09/2022092314502441-400x280-c.webp" class="attachment-400x280x1 size-400x280x1 wp-post-image" alt="" decoding="async" loading="lazy">            <div class="author_title">
                <h4><a class="stretched-link" href="https://mango.huitheme.cn/1437.html">也许是最实用的万兆NAS  超长文分页</a></h4>
                <p>16条留言</p>
            </div>
        </li>

    

        <li>
          <img width="400" height="280" src="https://mango.huitheme.cn/wp-content/cache/thumbnails/2022/09/2022092305140523-400x280-c.jpg" class="attachment-400x280x1 size-400x280x1 wp-post-image" alt="" decoding="async" loading="lazy">            <div class="author_title">
          <h4><a class="stretched-link" href="https://mango.huitheme.cn/1300.html">对隐茶书房</a></h4>
          <p>18条留言</p>
          </div>
        </li>

    

        <li>
            <img width="400" height="280" src="https://mango.huitheme.cn/wp-content/cache/thumbnails/2022/09/2022092304413371-400x280-c.webp" class="attachment-400x280x1 size-400x280x1 wp-post-image" alt="" decoding="async" loading="lazy">            <div class="author_title">
                <h4><a class="stretched-link" href="https://mango.huitheme.cn/1121.html">干净通透的沉浸式工作台[文章分页效果]</a></h4>
                <p>13条留言</p>
            </div>
        </li>

    </ul>
  </div>

    <!-- 热门标签 -->
    <?php $this->need('/inc/widget/widget-tags.php'); ?>
        
        
        
        </div>
</div>
        </div>

    </div>
</section>





<?php $this->need('footer.php'); ?>
