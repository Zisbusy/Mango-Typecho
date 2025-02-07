<?php
// 查询点赞情况
function likeDone($cid) {
  // 获取 Cookie 中的文章浏览记录
  $cookie = isset($_COOKIE['Likes']) ? $_COOKIE['Likes'] : '';
  $cookie = $cookie ? explode(',', $cookie) : array();
  // Cookie 中有点赞记录的,返回类名,用于标注已经点赞的。
  if (in_array($cid, $cookie)) {
      return "done";
  }
}
// 点赞逻辑
function likeup($cid, $action){
  // 获取Typecho数据库实例
  $db = Typecho_Db::get();
  // 判断是否存在 likes 字段
  static $fieldChecked = true;
  if ($fieldChecked) {
    // 操作数据库
    if (!array_key_exists('likes', $db->fetchRow($db->select()->from('table.contents')))) {
      $db->query('ALTER TABLE `'.$db->getPrefix().'contents` ADD `likes` INT(10) DEFAULT 0;');
    }
    // 避免重复检查
    $fieldChecked = false;
  }
  
  // 获取当前文章的浏览次数
  $num = $db->fetchRow($db->select('likes')->from('table.contents')->where('cid = ?', $cid))['likes'];
  // 展示参数，直接展示。
  if($action == "show") {
    return $num;
  }
  
  // 获取 Cookie 中的文章浏览记录
  $cookie = isset($_COOKIE['Likes']) ? $_COOKIE['Likes'] : '';
  $cookie = $cookie ? explode(',', $cookie) : array();
  
  // 默认提示内容
  $status = "error";
  $message = "错误参数";
  
  // 如果没有点赞过,且执行的点赞操作。
  if (!in_array($cid, $cookie) && $action == "do") {
    // 给数据值加1
    $db->query($db->update('table.contents')->rows(array('likes' => (int)$num + 1))->where('cid = ?', $cid));
    // 设置已经点赞的cookie，将当前文章 ID 添加到 Cookie 中
    array_push($cookie, $cid);
    $status = "success";
    $message = "do";
  }
  if (in_array($cid, $cookie) && $action == "undo") {
    // 给数据值减1
    $db->query($db->update('table.contents')->rows(array('likes' => (int)$num - 1))->where('cid = ?', $cid));
    // 删除取消点赞的cookie，从数组中移除当前文章 ID
    $cookie = array_diff($cookie, array($cid));
    $status = "success";
    $message = "undo";
  }
  
  // 设置Cookie，有效期为一年
  $cookie = implode(',', $cookie);
  setcookie('Likes', $cookie, time() + 31536000, '/');
  // 返回值
  return [
    "status" => $status,
    "message" => $message,
  ];
}
?>
