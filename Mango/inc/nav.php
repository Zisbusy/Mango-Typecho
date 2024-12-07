<!-- 输出文章分类 -->
<li><a href="/" title="首页">首页</a></li>
<?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
<?php while($categorys->next()): ?>
  <?php if ($categorys->levels === 0): ?>
    <?php $children = $categorys->getAllChildren($categorys->mid); ?>
    <?php if (empty($children)) { ?>
      <!-- 遍历一级标题 -->
      <li>
        <a href="<?php $categorys->permalink(); ?>" title="<?php $categorys->name(); ?>"><?php $categorys->name(); ?></a>
      </li>
    <?php } else { ?>
      <li class="menu-item-has-children">
        <a href="<?php $categorys->permalink(); ?>" title="<?php $categorys->name(); ?>"><?php $categorys->name(); ?></a>
        <!-- 二级标题 -->
        <ul class="sub-menu">
          <?php foreach ($children as $mid) { ?>
          <?php $child = $categorys->getCategory($mid); ?>
            <li>
              <a href="<?php echo $child['permalink'] ?>" title="<?php echo $child['name']; ?>"><?php echo $child['name']; ?></a>
            </li>
          <?php } ?>
        </ul>
      </li>
    <?php } ?>
  <?php endif; ?>
<?php endwhile; ?>
<!-- 输出独立页面 -->
<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
<?php while($pages->next()): ?>
  <li><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
<?php endwhile; ?>
