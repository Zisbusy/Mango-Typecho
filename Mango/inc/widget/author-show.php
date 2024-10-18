<?php 
  //当前用户的评论总数 
  function getAuthorCommentCount($authorId) {
      $db = Typecho_Db::get();
      $prefix = $db->getPrefix();
      $select = $db->select()->from('table.comments')
          ->where('status = ?', 'approved') // 只计算已批准的评论
          ->where('authorId = ?', $authorId)
          ->order('coid', Typecho_Db::SORT_DESC)
          ->limit(1);
      $row = $db->fetchRow($select);
      $count = $db->fetchRow($db->select('COUNT(coid) AS total')->from('table.comments')
          ->where('status = ?', 'approved')
          ->where('authorId = ?', $authorId));
      return $count['total'];
  }

  // 热门文章函数
  $this->need('/inc/hotpost.php');
?>

<div class="author_show_box">
  <div class="author_show_head">
    <img alt="" src="<?php $this->options->avatar(); ?>" class="avatar avatar-80 photo" height="80" width="80" loading="lazy" decoding="async">
    <h3><?php $this->author(); ?></h3>
    <p><?php $this->options->introduce(); ?></p>
  </div>
  <div class="author_show_info">
    <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
    <span><i class="bi bi-book"></i><b>文章</b><?php $stat->publishedPostsNum() ?></span>
    <span><i class="bi bi-chat-square-dots"></i><b>评论</b><?php echo getAuthorCommentCount($this->author->uid); ?></span>
  </div>

  <ul class="author_post">
    <?php $this->widget('Widget_Contents_Post_Comments','pageSize=3')->to($Comments);while($Comments->next()): ?>
      <li>
      <img width="400" height="280" src="<?php echo processImage(getFirstImageContent($Comments->content),400,280); ?>" alt="<?php $Comments->title() ?>" decoding="async" loading="lazy">
      <div class="author_title">
        <h4><a class="stretched-link" href="<?php $Comments->permalink(); ?>"><?php $Comments->title(); ?></a></h4>
        <p><?php $Comments->commentsNum('暂无留言', '1条留言', '%d条留言'); ?></p>
      </div>
      </li>
    <?php endwhile; ?>
  </ul>
</div>