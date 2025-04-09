<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<section class="index_area">
  <div class="container">
    <div class="post_container_title">
      <h1><?php $this->title() ?></h1>
    </div>
    <div class="post_container">
      <article class="wznrys">
        <?php echo wrapImagesInLinks(setLinks($this->content),$this->title); ?>
      </article>
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
    <!-- 评论 -->
    <?php $this->need('inc/post/comment.php'); ?>
  </div>
</section>
<?php $this->need('footer.php'); ?>
