<?php
  // 如果字符串为空，则提前结束脚本
  if (empty($this->options->bannerData)) {return false;}
  // 获取并整理 Banner 数据
  // 数据格式 文字#图片路径#跳转链接;...;
  // 使用分号作为条目分隔符，将数据分割成条目，去除字符串末尾的分号
  $entries = explode(';', rtrim($this->options->bannerData, ';'));
  // 用来存储解析后的数据
  $parsedData = array();
  // 验证并解析数据
  foreach ($entries as $entry) {
    // 使用逗号作为分隔符分割条目
    $parts = explode('#', $entry);
    // 检查是否有三个部分
    if (count($parts) === 3) {
      // 去除可能存在的空格
      $description = trim($parts[0]);
      $identifier = trim($parts[1]);
      $url = trim($parts[2]);
      // 存储解析的数据
      $parsedData[] = array(
        'description' => $description,
        'identifier' => $identifier,
        'url' => $url
      );
    }
  }
  //数据错误的时候退出
  if (empty($parsedData)) {return false;}
?>
<section class="index_banner">
  <div class="container">
    <div id="banner" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
        <?php foreach ($parsedData as $index => $item): ?>
          <button type="button" data-bs-target="#banner" data-bs-slide-to="<?php echo $index; ?>" 
          <?php if ($index == 0):?>
            class="active" aria-current="true"
          <?php else: ?>
            class=""
          <?php endif; ?>
          ></button>
        <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
        <?php foreach ($parsedData as $index => $item): ?>
          <div class="carousel-item <?php if ($index == 0) {echo 'active';}?>">
            <a class="banlist" href="<?php echo $item['url']; ?>">
              <img src="<?php echo $item['identifier']; ?>" class="attachment-900x350x1 size-900x350x1 wp-post-image" alt="" decoding="async" loading="lazy">                            
              <h2><?php echo $item['description']; ?></h2>
              <i>置顶推荐</i>
            </a>
          </div>
        <?php endforeach; ?>
        </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#banner" data-bs-slide="prev"><i class="bi bi-chevron-left"></i></button>
      <button class="carousel-control-next" type="button" data-bs-target="#banner" data-bs-slide="next"><i class="bi bi-chevron-right"></i></button>
    </div>
  </div>
</section>
