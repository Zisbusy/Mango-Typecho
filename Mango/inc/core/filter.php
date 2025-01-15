<?php
// 过滤评论内容后友好提示。
function contentFilter($content) {
  $content= strip_tags($content);
  if (empty($content)) {
    return "违规评论（已过滤）";
  }
  return $content; 
}
?>