<?php $this->need('/inc/core/hotpost.php'); ?>

<aside class="widget widget_hot_posts">
  <h3 class="widget-title">热门文章</h3>
  <ul class="widget_hot_post">
  <?php $this->widget('Widget_Contents_Post_Comments','pageSize=3')->to($Comments);while($Comments->next()): ?>
    <li class="widget_hot_li">
      <img width="400" height="280" src="<?php echo processImage(getFirstImageContent($Comments->content),400,280); ?>" class="wp-post-image" alt="<?php $Comments->title() ?>" decoding="async" loading="lazy"> 
      <div class="hot_post_info">
        <h4><a class="stretched-link" href="<?php $Comments->permalink() ?>"><?php $Comments->title() ?></a></h4>
        <p><?php $Comments->commentsNum('暂无留言', '1条留言', '%d条留言'); ?></p>
      </div>
    </li>
  <?php endwhile; ?>
  </ul>
</aside>
