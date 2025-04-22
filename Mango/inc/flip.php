<?php if(!empty($this->options->other) && in_array('openAjax', $this->options->other)): ?>
  <div class="post-read-more">
    <?php $this->pageLink('加载更多','next'); ?>
  </div>
<?php else: ?>
  <?php 
    $this->pageNav('上页', '下页', 1, '...', 
      array(
      'wrapTag' => 'div', 
      'wrapClass' => 'posts-nav', 
      'itemTag' => '', 
      'textTag' => 'span', 
      'currentClass' => 'page-numbers current', 
      'prevClass' => 'prev page-numbers', 
      'nextClass' => 'next page-numbers',
    ));
  ?>
<?php endif; ?>
