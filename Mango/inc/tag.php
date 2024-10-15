<div class="post_loop_tag">
  <?php if (count($this->tags) > 0): ?>
    <em>
      <i class="bi bi-hash"></i><?php $this->tags ('</em><em><i class="bi bi-hash"></i>', true, 'none'); ?>
    </em>
  <?php endif; ?>
</div>