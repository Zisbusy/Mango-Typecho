<?php
  function processImage($originalImageUrl,$targetWidth,$targetHeight) {
    // 获取 Typecho 配置项目
    $options = Typecho_Widget::widget('Widget_Options');

    // 判断功能是否开启
    if (!$options->thumbOption) {
      return $originalImageUrl;
    }
    
    // 判断文件夹是否存在
    if (!file_exists(__TYPECHO_ROOT_DIR__ . '/usr/thumb')) {
      return $originalImageUrl;
    } 
    
    // 使用 parse_url 函数来解析 URL 获取图片路径，获取不到直接原样返回。
    $parsedUrl = parse_url($originalImageUrl);
    if (isset($parsedUrl['path'])) {
      $originalImagePath = $parsedUrl['path'];
    } else {
      return $originalImageUrl;
    }
    
    // 定义源文件绝对路径
    $localoriginalImagePath = __TYPECHO_ROOT_DIR__ . $originalImagePath;
    
    // 判断本地是否有这个文件，不存在直接返回，防止程序错误。
    if (!file_exists($localoriginalImagePath)) {
      return $originalImageUrl;
    }
    
    // 判断文件格式是否是图片，并排除 GIF 图片，不做压缩。
    $imageInfo = getimagesize($localoriginalImagePath);
    if ($imageInfo === false || $imageInfo[2] === IMAGETYPE_GIF) {
      return $originalImageUrl;
    }

    // 当目标宽高有一个为 0 时，保持原图比例
    if ($targetWidth == 0) {
        $targetWidth = round($imageInfo[0] * $targetHeight / $imageInfo[1]);
    } elseif ($targetHeight == 0) {
        $targetHeight = round($imageInfo[1] * $targetWidth / $imageInfo[0]);
    }
    
    // 修改图片路径、后缀名用于生成新图片、匹配缓存。
    $temPath = substr($originalImagePath, 0, strrpos($originalImagePath, '.')) .'-'.$targetWidth.'x'.$targetHeight.'.webp';
    // 判断路径是否为 typecho /usr/uploads/ 的图片，决定文件保存目录。
    if (strpos($originalImagePath, '/usr/uploads/') === 0) {
      $thumbImagePath = str_replace('uploads', 'thumb', $temPath);
    } else {
      $thumbImagePath = '/usr/thumb/other' . $temPath;
    }

    // 获取后台博客域名
    if (substr($options->siteUrl, -1) == '/') {
      // 移除最后一个字符（斜杠）
      $siteUrl = substr($options->siteUrl, 0, -1);
    }
    
    $thumbImageURL = $siteUrl . $thumbImagePath;
    $localThumbImagePath = __TYPECHO_ROOT_DIR__ . $thumbImagePath;

    // 判断缓存有没有生成，有缓存直接返回。
    if (file_exists($localThumbImagePath)) {
      return $thumbImageURL;
    }
    
    // 判断图片类型，加载原始图像。
    $originalImage = null;
    switch ($imageInfo[2]) {
      case IMAGETYPE_PNG:
        $originalImage = imagecreatefrompng($localoriginalImagePath);
        // 设置透明颜色
        imagecolortransparent($originalImage, imagecolorallocatealpha($originalImage, 0, 0, 0, 127));
        break;
      case IMAGETYPE_JPEG:
        $originalImage = imagecreatefromjpeg($localoriginalImagePath);
        break;
      case IMAGETYPE_WEBP:
        $originalImage = imagecreatefromwebp($localoriginalImagePath);
        break;
      default:
        // 如果是不支持的图片格式，直接返回原始图片URL
        return $originalImageUrl; 
    }
    
    // 获取原始图像的宽度和高度
    $originalWidth = imagesx($originalImage);
    $originalHeight = imagesy($originalImage);
    
    // 计算宽高比
    $originalAspectRatio = $originalWidth / $originalHeight;
    $targetAspectRatio = $targetWidth / $targetHeight;
    
    // 根据目标宽高比决定裁剪区域
    if ($originalAspectRatio > $targetAspectRatio) {
      // 如果原始图像较宽，则裁剪宽度
      $cropWidth = floor($originalHeight * $targetAspectRatio);
      $cropHeight = $originalHeight;
      $cropX = floor(($originalWidth - $cropWidth) / 2);
      $cropY = 0;
    } else {
      // 如果原始图像较高，则裁剪高度
      $cropWidth = $originalWidth;
      $cropHeight = floor($originalWidth / $targetAspectRatio);
      $cropX = 0;
      $cropY = floor(($originalHeight - $cropHeight) / 2);
    }
    
    // 创建新的图像资源
    $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);
    // 设置透明度
    imagealphablending($thumbnail, false);
    $color = imagecolorallocatealpha($thumbnail, 0, 0, 0, 127);
    imagefill($thumbnail, 0, 0, $color);
    imagesavealpha($thumbnail, true);
    
    // 使用 imagecopyresampled 进行等比例缩放
    imagecopyresampled($thumbnail, $originalImage, 0, 0, $cropX, $cropY, $targetWidth, $targetHeight, $cropWidth, $cropHeight);
    
    // 创建必要的目录
    $directory = dirname($localThumbImagePath);
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }
    
    //调整图片格式、压缩质量。
    imagewebp($thumbnail, $localThumbImagePath, 80); // 第三个参数是质量，范围从 0 到 100
    
    // 清理
    imagedestroy($originalImage);
    imagedestroy($thumbnail);

    // 返回处理后的图片
    return $thumbImageURL;
  }
?>
