<?php
// 获取传入链接的主域名，为给是否为自己的链接做判断
function getMainDomain($siteUrl) {
  // 获取主机部分
  $host = parse_url($siteUrl, PHP_URL_HOST);
  // 如果解析失败或主机部分为空，返回空字符串
  if (!$host) {
    return '';
  }
  // 处理带有子域名的情况
  $parts = explode('.', $host);
  if (count($parts) > 2) {
    // 如果有多于两个部分，取最后两部分作为主域名
    $mainDomain = $parts[count($parts) - 2] . '.' . $parts[count($parts) - 1];
  } else {
    // 否则直接使用主机部分
    $mainDomain = $host;
  }
  return $mainDomain;
}
// 修改文章中除自己外的链接加一些属性
function setLinks($string) {
  // 获取博客主域名
  $skip_domain = getMainDomain(Typecho_Widget::widget('Widget_Options')->siteUrl);
  
  // 使用正则表达式匹配所有<a>标签
  return preg_replace_callback('/<a\s([^>]*)href="([^"]*)"([^>]*)>/i', function($matches) use ($skip_domain) {
    $attributes = $matches[1] . $matches[3]; // 获取<a>标签的其他属性
    $href = $matches[2]; // 获取href属性值
    
    // 解析href中的主机部分
    $href_host = parse_url($href, PHP_URL_HOST);
    
    // 检查href是否包含跳过的域名或其子域名
    if ($href_host && strpos($href_host, $skip_domain) === false) {
      // 如果不包含，添加 target 和 rel 属性
      return "<a $attributes href=\"$href\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">";
    } else {
      // 如果包含，直接返回原标签
      return "<a $attributes href=\"$href\">";
    }
  }, $string);
}
?>