<?php
//获取评论的锚点链接
function get_comment_at($coid) {
  try {
    $db = Typecho_Db::get();

    // 获取当前评论的父评论ID
    $current = $db->fetchRow(
      $db->select('parent')
        ->from('table.comments')
        ->where('coid = ?', $coid)
        ->limit(1)
    );
    // 无父评论（母评论）直接返回空
    if (!$current || empty($current['parent']) || $current['parent'] == '0') {
      return '';
    }

    // 查询父评论作者
    $parent = $db->fetchRow(
      $db->select('author')
        ->from('table.comments')
        ->where('coid = ?', $current['parent'])
        ->limit(1)
    );
    // 父评论不存在或作者为空，返回空
    if (!$parent || empty(trim($parent['author']))) {
      return '';
    }

    // 输出
    return sprintf('<a href="#comment-%d">@%s</a>', $current['parent'], $parent['author']);
      
  } catch (Exception $e) {
    return '';
  }
}
?>
