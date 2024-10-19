<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<!-- 文章页面 -->
<section class="index_area">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-8">
        <!-- 文章 -->
        <?php $this->need('/inc/article.php'); ?>

      </div>
      <!-- 侧边信息 -->
      <div class="col-lg-4">
        <div class="sidebar_sticky">
          <!-- 作者信息 -->
          <?php $this->need('/inc/widget/author-show.php'); ?>
          <!-- 热门标签 -->
          <?php $this->need('/inc/widget/widget-tags.php'); ?>
        </div>
      </div>



      
    </div>

</div>
</section>





<?php $this->need('footer.php'); ?>
