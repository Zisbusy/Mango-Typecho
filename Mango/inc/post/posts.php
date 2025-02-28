<?php 
function showThumbnail($widget, $direction) {
  if ($direction === 'next') {
    $prevDefault = '/usr/themes/Mango/assets/img/prev/prev.webp';
  } else {
    $prevDefault = '/usr/themes/Mango/assets/img/prev/next.webp';
  }
  $attach = $widget->attachments(1)->attachment;
  $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
  if (preg_match_all($pattern, $widget->content, $thumbUrl)) {
    echo processImage($thumbUrl[1][0], 800, 200);
  }  else {
    echo $prevDefault;
  }
}

function getAdjacentPost($widget, $direction) {
  if ($direction === 'next') {
    $result = Typecho_Widget::widget('Widget_Archive@next');
    $sortOrder = Typecho_Db::SORT_ASC;
    $createdCondition = '>';
  } else {
    $result = Typecho_Widget::widget('Widget_Archive@prev');
    $sortOrder = Typecho_Db::SORT_DESC;
    $createdCondition = '<';
  }
  $db = Typecho_Db::get();
  $sql = $db->select()->from('table.contents')
    ->where('table.contents.created '.$createdCondition.' ?', $widget->created)
    ->where('table.contents.status = ?', 'publish')
    ->where('table.contents.type = ?', $widget->type)
    ->where('table.contents.password IS NULL')
    ->order('table.contents.created', $sortOrder)
    ->limit(1);//sql查询上一篇文章
  $db->fetchAll($sql, array($result, 'push'));
  return $result;//返回变量
}
//调用函数并将函数值给变量
$next = getAdjacentPost($this, 'next');
$prev = getAdjacentPost($this, 'prev');
?>

<?php if(!($next->created>$this->created) || !($prev->created<$this->created)): ?>
<style>
  .next_prev_posts .prev_next_box a,
  .next_prev_posts .prev_next_box a:after {
    border-radius: var(--main-radius);
  }
</style>
<?php endif; ?>

<div class="next_prev_posts">
  <!--判断上一篇文章是否存在-->
  <?php if($prev->created<$this->created): ?>
  <div class="prev_next_box nav_previous" <?php if(!($next->created>$this->created)){echo 'style="width:100%"';} ?>>
    <a href="<?php $prev->permalink(); ?>" title="<?php $prev->title(); ?>" rel="prev" style="background-image: url(<?php showThumbnail($prev, 'next'); ?>);">
    <div class="prev_next_info">
      <small>上一篇</small>
      <p><?php $prev->title(); ?></p>
    </div>
    </a>
  </div>
  <?php endif; ?>
  <!--判断下一篇文章是否存在-->
  <?php if($next->created>$this->created): ?>
  <div class="prev_next_box nav_next" <?php if(!($prev->created<$this->created)){echo 'style="width:100%"';} ?>>
    <a href="<?php $next->permalink() ?>" title="<?php $next->title(); ?>" rel="next" style="background-image: url(<?php showThumbnail($next, 'prev'); ?>);">
    <div class="prev_next_info">
      <small>下一篇</small>
      <p><?php $next->title(); ?></p>
    </div>
    </a>
  </div>
  <?php endif; ?>
</div>
