<?php
// 给图片外层添加 a 标签，用于支持点击放大，顺带调用函数压缩图片。
function wrapImagesInLinks($html,$title) {
  // 使用正则表达式匹配所有的 <img> 标签
  $pattern = '/<img\s+[^>]*src=["\']([^"\']+)["\'][^>]*>/i';

  // 使用 preg_replace_callback 执行自定义的回调函数
  $modifiedHtml = preg_replace_callback($pattern, function ($matches) use ($title) {

    // 获取匹配的 <img> 标签，src 属性
    $imgTag = $matches[0];
    $src = $matches[1];

    // 调用 processImage 函数处理图像路径
    $processedSrc = processImage($src, 900, 0);

    // 使用处理后的 src 替换原来的 src
    $processedImgTag = str_replace($src, $processedSrc, $imgTag);

    // 构建新的 <a> 标签
    $aTag = '<figure class="wp-block-image size-full"><a href="' . $src . '" alt="' . $title . '" title="' . $title . '" data-fancybox="gallery">' . $processedImgTag . '</a></figure>';

    return $aTag;
  }, $html);

  return $modifiedHtml;
}
?>