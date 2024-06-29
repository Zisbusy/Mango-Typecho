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

<link rel="stylesheet" href="<?php $this->options->themeUrl('normalize.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('grid.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">