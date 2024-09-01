<aside class="widget widget_hot_tags">
  <h3 class="widget-title">热门标签</h3>
  <div class="tagcloud">
    <?php \Widget\Metas\Tag\Cloud::alloc('ignoreZeroCount=1&desc=1&limit=15')->to($tags); ?>
    <?php while ($tags->next()): ?>
      <a href="<?php $tags->permalink(); ?>" class="tag-item" title="<?php $tags->name(); ?>">
        <span><?php $tags->name(); ?></span>
      </a>
    <?php endwhile; ?>
  </div>
</aside>
