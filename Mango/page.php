<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<section class="index_area">
  <div class="container">
    <div class="post_container_title">
      <h1><?php $this->title() ?></h1>
    </div>
    <div class="post_container mb-4">
      <article class="wznrys">
        <?php echo wrapImagesInLinks($this->content,$this->title); ?>
      </article>
    </div>
  </div>
</section>
<?php $this->need('footer.php'); ?>