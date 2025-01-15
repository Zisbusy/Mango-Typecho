<aside class="widget widget_comments">
  <h3 class="widget-title">最近评论</h3>
  <ul class="widget_comment_ul">
    <?php $this->widget('Widget_Comments_Recent','pageSize=5&ignoreAuthor=true')->to($recent);?>
    <?php while($recent->next()):?>
    <li>
      <img alt="" src="<?php echo getavatar($recent->mail); ?>" class="avatar avatar-40 photo" height="40" width="40" loading="lazy" decoding="async">
      <div class="widget_comment_info">
        <a rel="nofollow" href="<?php echo $recent->permalink; ?>"><?php echo contentFilter($recent->content);?></a>
        <span>
          <em><?php echo $recent->author; ?></em>
          <em><?php echo $recent->dateWord; ?></em>
        </span>
      </div>
    </li>
    <?php endwhile;?>
  </ul>
</aside>
