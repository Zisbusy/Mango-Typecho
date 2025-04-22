<?php
// 公安联网备案 获取备案号
function WangAnNum($str) {
  preg_match_all('/\d+/', $str, $matches);
  $result = implode('', $matches[0]);
  return $result;
}
?>

<section class="links mobile_none">
  <div class="container">
    <span>友情链接：</span>
    <a href="https://typecho.org/" rel="noopener" target="_blank">Typecho</a>
  </div>
</section>

<footer class="footbox">
  <div class="container">
    <div class="copyright">
      <p>© <?php echo date("Y");?> <?php $this->author(); ?> All Rights Reserved. Powered by <a href="https://typecho.org/" rel="external nofollow noopener noreferrer"  target="_blank">Typecho</a> & <a href="https://zhebk.cn/" rel="noopener" target="_blank" title="Mango 主题">Mango</a>
        <?php if ($this->options->ICP): ?>
        <a class="beian" href="https://beian.miit.gov.cn/" rel="external nofollow noopener noreferrer" target="_blank" title="备案号">
          <i class="bi bi-shield-check me-1"></i>
          <?php $this->options->ICP();?>
        </a>
        <?php endif; ?>
        <?php if ($this->options->WangAn): ?>
        <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php echo WangAnNum($this->options->WangAn);?>" rel="nofollow noopener noreferrer"  target="_blank" title="公安备案号">
          <i class="bi bi-shield-check me-1"></i>
          <?php $this->options->WangAn();?>
        </a>
        <?php endif; ?>
      </p>
    </div>
  </div>
</footer>

<button class="scrollToTopBtn" title="返回顶部"><i class="bi bi-chevron-up"></i></button>
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/jquery.min.js'); ?>" id="jquery-min-js"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/bootstrap.min.js'); ?>" id="bootstrap-js"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/fancybox.js'); ?>" id="fancybox-js"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/js.js'); ?>" id="dsjs-js"></script>
</body>
</html>
