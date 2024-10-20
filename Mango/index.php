<?php
/**
 * 移植自 WoerdPress 的 Mango 主题，原作者：疯狂的大叔。
 *
 * @package Mango For Typecho
 * @author 大哲
 * @version Dev 1.0
 * @link https://zhebk.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<!-- banner -->
<?php $this->need('/inc/banner.php'); ?>
<!-- 内容展示 -->
<section class="index_area">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
              <!-- 文章列表 -->
              <?php $this->need('/inc/excerpt.php'); ?>
              <!-- 文章翻页 -->
              <?php $this->need('/inc/flip.php'); ?>
            </div>
            <div class="col-lg-4">
              <div class="sidebar_sticky">
                <!-- 热门文章 -->
                <?php $this->need('/inc/widget/widget-hotpost.php'); ?>
                <!-- 热门标签 -->
                <?php $this->need('/inc/widget/widget-tags.php'); ?>
                <!-- 最近评论 -->
                <?php $this->need('/inc/widget/widget-comments.php'); ?>
              </div>
            </div>
        </div>
    </div>
</section>
<!-- 页底信息 -->
<?php $this->need('footer.php'); ?>
