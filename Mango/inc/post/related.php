<?php $this->related(3)->to($relatedPosts); ?>
<?php if ($relatedPosts->have()): ?>
  <div class="post_related mb-3">
  <h3 class="widget-title">相关文章</h3>
  <?php while ($relatedPosts->next()): ?>
    <div class="post_related_list">
      <a class="" href="<?php $relatedPosts->permalink(); ?>" title="<?php $relatedPosts->title(); ?>"><?php $relatedPosts->title(); ?></a>
    </div>
  <?php endwhile; ?>
  </div>
<?php endif; ?>