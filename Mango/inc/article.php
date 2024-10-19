<?php
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

<!-- 文章头部 -->
<div class="post_container_title">
  <h1><?php $this->title() ?></h1>
  <p>
    <span><i class="bi bi-clock"></i><?php $this->dateWord(); ?></span>
    <span><i class="bi bi-eye"></i>2,908</span>
    <span><i class="bi bi-chat-square-text"></i>18</span>
  </p>
</div>
<!-- 文章详情 -->
<div class="post_container">
  <article class="wznrys">
    <?php echo wrapImagesInLinks($this->content,$this->title); ?>
  </article>
  <!-- 标签 -->
  <?php $this->need('/inc/tag.php'); ?>
</div>
<!-- 文章底部作者信息 -->
<div class="post_author">
  <div class="post_author_l">
    <img alt="" src="<?php $this->options->avatar(); ?>" class="avatar avatar-30 photo" height="30" width="30" loading="lazy" decoding="async">
    <span><?php $this->author(); ?></span>
  </div>
  <div class="post_author_r">
    <div class="post_author_icon">
      <a href="#post_comment_anchor"><i class="bi bi-chat-square-dots-fill"></i><?php $this->commentsNum(); ?></a>
      <a href="javascript:;" data-action="ding" data-id="1300" class="specsZan "><i class="bi bi-hand-thumbs-up-fill"></i><small class="count">104</small></a>
    </div>
  </div>
</div>