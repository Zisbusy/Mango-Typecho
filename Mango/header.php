<!DOCTYPE html>
<script>
  // 创建一个 MediaQueryList 对象，获取系统偏好设置。
  const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
  // 获取本地有没有存储值。
  const isDark = localStorage.getItem("isDarkMode");

  // 判断有无手动选择状态。
  if (isDark === null) {
    // 无手动选择状态，应用系统偏好设置。
    handleDarkModeChange(darkModeMediaQuery);
  } else {
    // 根据用户偏好切换，当前状态与用户偏好一致时清除本地存储值。
    if (isDark==="1") {
      document.documentElement.classList.add('dark');
      if (darkModeMediaQuery.matches) {
        localStorage.removeItem("isDarkMode")
      }
    } else {
      document.documentElement.classList.remove('dark');
      if (!darkModeMediaQuery.matches) {
        localStorage.removeItem("isDarkMode")
      }
    }
  }
  
  // 添加监听器以响应系统实时变化。
  darkModeMediaQuery.addEventListener('change', handleDarkModeChange);
  // 处理系统实时变化，根据系统设置切换。
  function handleDarkModeChange(e) {
    if (e.matches) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
    // 清理手动选择状态
    if (localStorage.getItem("isDarkMode") !== null) {
      localStorage.removeItem("isDarkMode")
    }
  }
</script>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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

<body>
  <style>:root{--ds_background:url(/usr/themes/Mango/assets/img/background.svg)}</style>
  <header class="header<?php if(!empty($this->options->other) && in_array('showNav', $this->options->other)) {echo ' sticky-top';}?>">
    <div class="container">
      <div class="top">
        <!-- 手机端菜单按钮 -->
        <button class="mobile_an" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobile_right_nav"><i class="bi bi-list"></i></button>
        <!-- PC端左侧 logo-->
        <div class="top_l">
          <h1 class="logo">
            <a href="/" title="<?php $this->options->title() ?>">
              <img src="/usr/themes/Mango/assets/img/logo.png" alt="">
              <b><?php $this->options->title() ?></b>
            </a>
          </h1>
          <!-- 导航栏 -->
          <nav class="header-menu">
            <ul class="header-menu-ul">
              <li><a href="/">首页</a></li>
              <?php $this->need('inc/nav.php'); ?>
            </ul>
          </nav>
        </div>
        <!-- PC端右侧 一些按钮-->
        <div class="top_r">
            <div class="top_r_an theme-switch me-4" onclick="switchDarkMode()"><i class="bi bi-lightbulb-fill"></i></div>
            <button class="top_r_an" type="button" data-bs-toggle="offcanvas" data-bs-target="#c_sousuo"><i class="bi bi-search"></i></button>
        </div>
      </div>
    </div>
  </header>
  <!-- 搜索 -->
  <div class="offcanvas offcanvas-top" id="c_sousuo">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-lg-6 search_box">
                <form action="/" class="ss_a clearfix" method="get">
                    <input name="s" aria-label="Search" type="text" onblur="if(this.value=='')this.value='搜索'" onfocus="if(this.value=='搜索')this.value=''" value="搜索">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
    </div>
  </div>
  <!-- 侧边导航 -->
  <div class="offcanvas offcanvas-start" id="mobile_right_nav">
      <div class="mobile_head">
        <div class="mobile_head_logo">
          <img src="/usr/themes/Mango/assets/img/logo.png" alt="">
        </div>
        <div class="theme-switch" onclick="switchDarkMode()">
          <i class="bi bi-lightbulb-fill"></i>
        </div>
      </div>
      <!-- 手机导航栏 -->
      <div id="sjcldnav">
        <ul class="menu-zk">
          <?php $this->need('inc/nav.php'); ?>
        </ul>
      </div>
  </div>
