<?php
class Widget_Contents_Post_Comments extends Widget_Abstract_Contents{
  public function execute(){
    $this->parameter->setDefault(array('pageSize' => $this->options->postsListSize));
    $this->db->fetchAll($this->select()
    ->where('table.contents.status = ?', 'publish')
    ->where('table.contents.created <= ?', $this->options->time)
    ->where('table.contents.type = ?', 'post')
    ->order('commentsNum', Typecho_Db::SORT_DESC)
    ->limit($this->parameter->pageSize), array($this, 'push'));
  }
}

function getFirstImageContent($html) {
  $pattern = '/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i';
  if (preg_match($pattern, $html, $matches)) {
    return $matches[1];
  }
  return "/usr/themes/Mango/assets/img/hostpostimg.webp";
}
?>