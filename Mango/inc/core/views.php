<?php
// 阅读次数统计
function Postviews($archive) {
  $db = Typecho_Db::get();
  $cid = $archive->cid;
  
  // 判断是否存在 views 字段
  static $fieldChecked = true;
  if ($fieldChecked) {
    // 操作数据库
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
      $db->query('ALTER TABLE `'.$db->getPrefix().'contents` ADD `views` INT(10) DEFAULT 0;');
    }
    // 避免重复检查
    $fieldChecked = false;
  }
  
  // 获取当前文章的浏览次数
  $exist = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid))['views'];
  if ($archive->is('single')) {
    $cookie = Typecho_Cookie::get('contents_views');
    $cookie = $cookie ? explode(',', $cookie) : array();
    if (!in_array($cid, $cookie)) {
      $db->query($db->update('table.contents')
        ->rows(array('views' => (int)$exist+1))
        ->where('cid = ?', $cid));
      $exist = (int)$exist+1;
      array_push($cookie, $cid);
      $cookie = implode(',', $cookie);
      Typecho_Cookie::set('contents_views', $cookie);
    }
  }
  return $exist;
}
?>
