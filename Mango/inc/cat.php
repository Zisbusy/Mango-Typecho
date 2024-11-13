<?php
function findImageByMid($mid) {
  // 定义 category 文件夹的路径
  $categoryPath = '/usr/themes/Mango/assets/img/category/';
  $localcategoryPath = __TYPECHO_ROOT_DIR__ . $categoryPath;
    
  // 获取 Typecho 配置项目
  $options = Typecho_Widget::widget('Widget_Options');
  // 获取后台博客域名
  if (substr($options->siteUrl, -1) == '/') {
    // 移除最后一个字符（斜杠）
    $siteUrl = substr($options->siteUrl, 0, -1);
  }
  
  // 如果传入为空，返回默认图片
  if (empty($mid)) {
    return $siteUrl . '/usr/themes/Mango/assets/img/category/default.webp';
  }

  // 获取 category 文件夹中的所有文件
  $files = scandir($localcategoryPath);

  // 遍历文件列表，寻找与 mid 匹配的图片文件
  foreach ($files as $file) {
    // 去掉文件扩展名
    $baseName = pathinfo($file, PATHINFO_FILENAME);
    // 检查文件名是否匹配 mid
    if ($baseName == $mid) {
      // 如果找到了匹配的文件，返回文件的完整路径
      return $siteUrl . $categoryPath . $file;
    }
  }

  // 如果没有找到匹配的文件，返回默认图片
  return $siteUrl . '/usr/themes/Mango/assets/img/category/default.webp';
}
?>

<div class="cat_head">
  <!-- 判断是否是分类 - 展示分类图片 -->
  <?php if($this->is('category')):?>
    <img width="180" height="180" src="<?php echo findImageByMid($this->pageRow['mid']); ?>" class="attachment-180x180x1 size-180x180x1 " alt="" decoding="async">
  <?php endif; ?>

  <div class="cat_head_r">
    <!-- 判断是否是分类 - 展示特别样式 -->
    <?php if($this->is('search')):?>
      <h2 class="mb-0"><?php $this->archiveTitle(array('search'=>_t('搜索 "%s" 的结果')), '', ''); ?></h2>
    <?php else: ?>
      <h2>
        <i class="bi bi-hash me-1"></i>
        <?php $this->archiveTitle(array(
          'category'  =>  _t('%s'),
          'tag'       =>  _t('%s'),
          'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?>
      </h2>
    <?php endif; ?>
    <!-- 判断是否是分类 - 展示分类介绍 -->
    <?php if($this->is('category') && $this->getDescription()): ?>
      <p><?php echo $this->getDescription(); ?></p>
    <?php endif; ?>
  </div>
</div>