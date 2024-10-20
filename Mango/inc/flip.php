<?php if(!empty($this->options->other) && in_array('flipajax', $this->options->other)): ?>
  <div class="post-read-more">
    <?php $this->pageLink('加载更多','next'); ?>
  </div>
  <script>
    $('.post-read-more .next').on('click', function(event) {
      // 阻止默认行为
      event.preventDefault(); 
      // 获取 href 属性
      let href = $(this).attr('href'); 
      // 修改地址栏链接
      history.replaceState({}, document.title, href);
    });
  </script>
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