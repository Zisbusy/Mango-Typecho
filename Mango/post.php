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
            <span><i class="bi bi-eye"></i><?php echo Postviews($this);?></span>
            <span><i class="bi bi-chat-square-text"></i><?php $this->commentsNum(); ?></span>
          </p>
        </div>
        <!-- 文章详情 -->
        <div class="post_container">
          <article class="wznrys">
            <?php echo wrapImagesInLinks(setLinks($this->content),$this->title); ?>
          </article>
          <!-- 标签 -->
          <?php $this->need('inc/tag.php'); ?>
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
              <a href="javascript:;" data-action="ding" data-id="<?php $this->cid(); ?>" class="specsZan <?php echo likeDone($this->cid); ?>"><i class="bi bi-hand-thumbs-up-fill"></i><small class="count"><?php echo likeup($this->cid,'show'); ?></small></a>
            </div>
          </div>
        </div>
        <!-- 上一篇/下一篇文章 -->
        <?php $this->need('inc/post/posts.php'); ?>
        <!-- 相关文章 -->
        <?php $this->need('inc/post/related.php'); ?>
        <!-- 评论 -->
        <?php $this->need('inc/post/comment.php'); ?>

        
      </div>
      <!-- 侧边信息 -->
      <div class="col-lg-4">
        <div class="sidebar_sticky">
          <!-- 作者信息 -->
          <?php $this->need('inc/widget/author-show.php'); ?>
          <!-- 热门标签 -->
          <?php $this->need('inc/widget/widget-tags.php'); ?>
        </div>
      </div>



      
    </div>

</div>
</section>





<?php $this->need('footer.php'); ?>
