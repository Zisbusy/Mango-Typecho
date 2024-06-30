<!doctype html>
<script>
  const isDark= localStorage.getItem("isDarkMode");
  if(isDark==="1"){
    document.documentElement.classList.add('dark');
  }else{
    document.documentElement.classList.remove('dark');
  }
</script>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="email=no">
<meta name="format-detection" content="address=no">
<meta name="format-detection" content="date=no">
<title><?php
    $this->archiveTitle(array(
      'category'=>_t('%s'),
      'search'=>_t('%s'),
      'tag' =>_t('%s'),
      'author'=>_t('%s')), 
      '', ' - '); 
    if($this->_currentPage>1) {
      echo '第 '.$this->_currentPage.' 页 - ';
    }
    // 主标题
    $this->options->title(); 
    // 副标题
    if($this->is('index') && $this->options->subTitle && $this->_currentPage<=1) {
      echo ' - '.$this->options->subTitle;
    }
?></title>
<?php $this->header('generator=&template=&pingback=&xmlrpc=&wlw=&rss2=&rss1=&atom=&commentReply=&antiSpam='); ?>
<link rel="shortcut icon" href="/usr/themes/Mango/assets/img/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/bootstrap.min.css'); ?>" type="text/css" media="all">
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/fancybox.css'); ?>" type="text/css" media="all">
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/bifont/bootstrap-icons.css'); ?>" type="text/css" media="all">
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/style.css'); ?>" type="text/css" media="all">
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/jquery.min.js'); ?>" id="jquery-min-js"></script>
</head>

<body class="home blog">
  <style>:root{--ds_background:url(/usr/themes/Mango/assets/img/background.svg)}</style>
  <header class="header sticky-top">
    <div class="container">
      <div class="top">
        <!-- 手机端菜单按钮 -->
        <button class="mobile_an" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobile_right_nav"><i class="bi bi-list"></i></button>
        <!-- PC端左侧-->
        <div class="top_l">
          <h1 class="logo">
            <a href="/" title="<?php $this->options->title() ?>">
              <img src="/usr/themes/Mango/assets/img/logo.png" alt="">
              <b><?php $this->options->title() ?></b>
            </a>
          </h1>
          <?php $this->need('/inc/nav.php'); ?>
        </div>
        <!-- PC端右侧-->
        <div class="top_r">
            <div class="top_r_an theme-switch me-4" onclick="switchDarkMode()"><i class="bi bi-lightbulb-fill"></i></div>
            <button class="top_r_an" type="button" data-bs-toggle="offcanvas" data-bs-target="#c_sousuo"><i class="bi bi-search"></i></button>
        </div>
      </div>
    </div>
  </header>




  <section class="links mobile_none">
    <div class="container">
        <span>友情链接：</span>
        <a href="http://www.2zzt.com" rel="noopener" target="_blank">WordPress</a>
<a href="https://www.huitheme.com" rel="noopener" title="wordpress" target="_blank">wordpress</a>
<a href="http://www.2zzt.com" rel="noopener" target="_blank">WordPress Theme</a>
<a href="https://www.huitheme.com" rel="noopener" title="WordPress企业主题" target="_blank">WordPress企业主题</a>
<a href="https://www.huitheme.com" rel="noopener" title="WordPress插件" target="_blank">WordPress插件</a>
<a href="https://www.huitheme.com" rel="noopener" title="WordPress教程" target="_blank">WordPress教程</a>
<a href="https://www.huitheme.com" rel="noopener" target="_blank">WordPress模版</a>
<a href="https://www.huitheme.com" rel="noopener" title="绘主题" target="_blank">绘主题</a>
    </div>
</section>

<footer class="footbox">
    <div class="container">
    	<div class="copyright">
    		<p>©️ 2022 Mango All Rights Reserved. Powered by <a href="https://www.huitheme.com/" target="_blank">WordPress</a>
	    						<a class="beian" href="https://beian.miit.gov.cn/" rel="external nofollow" target="_blank" title="备案号"><i class="bi bi-shield-check me-1"></i>苏ICP备123456号</a>
					    	</p>
    	</div>
	</div>
</footer>

<button class="scrollToTopBtn" title="返回顶部"><i class="bi bi-chevron-up"></i></button>


<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/bootstrap.min.js'); ?>" id="bootstrap-js"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/fancybox.js'); ?>" id="fancybox-js"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/js.js'); ?>" id="dsjs-js"></script>
</body>