<?php 
// 获取后台配置项目，防止未开启伪静态状态下分类链接404
$options = Typecho_Widget::widget('Widget_Options');
// 读取是否开启伪静态
$rewriteEnabled = $options->rewrite;
// 赋值
if ($rewriteEnabled) {
    $hasindex = $options->siteUrl;
} else {
    $hasindex = $options->siteUrl . "index.php/";
}
?>

<!-- 输出文章分类 -->
<li><a href="/" title="首页">首页</a></li>
<?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
<?php while($category->next()): ?>
  <?php if(count($category->children)):?>
    <li class="menu-item-has-children">
      <a href="<?php $category->permalink(); ?>" title="<?php echo $category->name; ?>"><?php echo $category->name; ?></a>
      <!-- 子分类 -->
      <ul class="sub-menu" style="display: none;">
        <?php foreach($category->children as $childCategory):?>
          <li><a href="<?php echo $hasindex . 'category/' . $childCategory['slug'] ?>" title="<?php echo $childCategory['name']; ?>"><?php echo $childCategory['name']; ?></a></li>
        <?php endforeach; ?>
      </ul>
    </li>
    <!-- 跳过循环 输出下一个分类-->
    <?php continue; ?>
  <?php else:?>
    <?php if($category->levels == 0):?>
      <li>
        <a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a>
      </li>
    <?php endif;?>
  <?php endif;?>
<?php endwhile; ?>
<!-- 输出独立页面 -->
<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
<?php while($pages->next()): ?>
  <li><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
<?php endwhile; ?>
