<?php if (count($this->tags) > 0): ?>
<div class="post_loop_tag">
  <em>
    <i class="bi bi-hash"></i><?php $this->tags ('</em><em><i class="bi bi-hash"></i>', true, 'none'); ?>
  </em>
</div>
<?php endif; ?>


