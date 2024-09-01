<?php
class Widget_Contents_Post_Comments extends Widget_Abstract_Contents{
  public function execute(){
    $this->parameter->setDefault(array('pageSize' => $this->options->postsListSize));
    $this->db->fetchAll($this->select()
    ->where('table.contents.status = ?', 'publish')
    ->where('table.contents.created <= ?', $this->options->time)
    ->where('table.contents.type = ?', 'post')
    ->order('commentsNum', Typecho_Db::SORT_DESC)
    ->limit($this->parameter->pageSize), array($this, 'push'));
  }
}

function getFirstImageContent($html) {
  $pattern = '/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i';
  if (preg_match($pattern, $html, $matches)) {
    return $matches[1];
  }
  return "/usr/themes/Mango/assets/img/hostpostimg.webp";
}
?>

<aside id="hot_posts-2" class="widget widget_hot_posts">
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