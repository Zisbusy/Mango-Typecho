<div class="post_box">
<?php while($this->next()): ?>
  <div class="post_loop">
    <div class="post_loop_head">
      <div class="post_loop_head_author">
        <a class="images_author" href="<?php $this->permalink() ?>" title="<?php $this->title() ?>">
          <img alt="<?php $this->author(); ?>" src="<?php $this->options->avatar() ?>" class="avatar avatar-80 photo" height="80" width="80" decoding="async">
        </a>
        <div class="images_author_name">
          <h3><?php $this->author(); ?></h3>
          <span><?php $this->dateWord(); ?></span>
        </div>
      </div>
      <a class="post_loop_more" href="<?php $this->permalink() ?>" title="<?php $this->title() ?>">
        <i class="bi bi-three-dots"></i>
      </a>
    </div>
    <div class="post_loop_conter">
        <div class="post_loop_title_box">
            <h2 class="post_loop_title">
              <a class="stretched-link" href="<?php $this->permalink() ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
            </h2>
            <p><?php $this->excerpt(80, '...'); ?></p>
        </div>
        <!-- 图片集合 -->
        <?php
          // 正则表达式用于匹配 img 标签中的 src 属性
          preg_match_all('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/', $this->content, $matches);
          // 获取所有匹配的 src 值
          $images = $matches[1];
          $imagesNum = count($images);
          // 用图片数量判断输出样式
          if ($imagesNum <= 9){
              $imagesShowNum = $imagesNum;
          } else {
              $imagesShowNum = 9;
          }
        ?>
        <?php if($imagesShowNum > 0): ?>
        <div class="post_images post_img_<?php echo $imagesShowNum; ?>">
          <!-- 循环输出图片 -->
          <?php foreach ($images as $index =>  $image): ?>
            <a data-fancybox="post-<?php $this->cid() ?>" href="<?php echo $image; ?>">
              <img src="<?php echo processImage($image,300,300); ?>">
              <?php 
                // 只显示9张图片，超出的标注在最后一张图上。  
                if ($index == 8 && $imagesNum > 9) {
                  echo '<b>+' . ($imagesNum - 9) . '</b></a>';
                  break;
                }
              ?>
            </a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <!-- 标签 -->
        <?php $this->need('/inc/tag.php'); ?>
        <!-- 文章信息 -->
        <div class="post_info_footer">
            <span class="">
              <i class="bi bi-chat-square-text-fill"></i>
              <?php $this->commentsNum('0评论', '1评论', '%d评论'); ?>
            </span>
            <span class=""><i class="bi bi-eye-fill"></i><?php echo Postviews($this);?>浏览</span>
            <span>
              <a href="javascript:;" data-action="ding" data-id="1437" class="specsZan ">
                  <i class="bi bi-heart-fill"></i>
                  <em class="count">1387</em>
              </a>
            </span>
        </div>
    </div>
  </div>
<?php endwhile; ?>
</div>
