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
    // 获取 Cookie 中的文章浏览记录
    $cookie = isset($_COOKIE['Views']) ? $_COOKIE['Views'] : '';
    $cookie = $cookie ? explode(',', $cookie) : array();

    // 如果当前文章没有被浏览过
    if (!in_array($cid, $cookie)) {
      // 更新数据库中的浏览次数
      $db->query($db->update('table.contents')
         ->rows(array('views' => (int)$exist + 1))
         ->where('cid = ?', $cid));
      // 更新浏览次数变量
      $exist = (int)$exist + 1;
      // 将当前文章 ID 添加到 Cookie 中
      array_push($cookie, $cid);
      $cookie = implode(',', $cookie);
      // 设置 Cookie，有效期为 30 天
      setcookie('Views', $cookie, time() + 2592000, '/');
    }
  }
  return $exist;
}
?>
