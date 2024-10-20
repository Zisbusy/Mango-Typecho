<?php
function themeConfig($form) {
  //博客信息
  $subTitle  = new Typecho_Widget_Helper_Form_Element_Text('subTitle', NULL,'个人博客', _t('网站副标题'), _t('默认内容"个人博客"'));
  $form->addInput($subTitle);

  // 头像
  $avatar = new Typecho_Widget_Helper_Form_Element_Text('avatar', NULL,'/usr/themes/Mango/assets/img/avatar.webp', _t('博主头像地址'), _t('默认值 "/usr/themes/Mango/assets/img/avatar.webp"'));
  $form->addInput($avatar);

  // 个人介绍
  $introduce = new Typecho_Widget_Helper_Form_Element_Text('introduce', NULL,'站在巨人的肩膀上而已', _t('个人介绍'), _t('首页公告内容'));
  $form->addInput($introduce);

  // Banner 设置
  $bannerData = new Typecho_Widget_Helper_Form_Element_Textarea(
    'bannerData', 
    null, 
    '沉浸式工作台#/usr/themes/Mango/assets/banner/1.webp#/;
双眼放空想象一下#/usr/themes/Mango/assets/banner/2.webp#/;', 
    _t('Banner 数据'), 
    _t('按要求填写 Banner, 数据格式:文字#图片路径#跳转链接;...; (不填写或填写错误时 Banner 会隐藏。)'));
  $form->addInput($bannerData);

  /* 缩略图配置选项 */
  if(function_exists('gd_info')){
    $thumbOption = new Typecho_Widget_Helper_Form_Element_Radio('thumbOption',
    array(true => '开启',false => '关闭',),
    false, _t('生成缩略图'), _t('为文章列表与文章里图片生成小尺寸的缩略图，可显著提高加载速度，节省服务器带宽。目录: usr/thumb ，其余路径、文件名与 uploads 保持一致。<br />请提前将 usr 目录权限设置为 777 。<br />注意：首次访问时需要生成缩略图，加载时间会比较长。'));
    $form->addInput($thumbOption);
  }else {
    $thumbOption = new Typecho_Widget_Helper_Form_Element_Radio('thumbOption',
    array(false => '关闭',),
    false, _t('生成缩略图'), _t('PHP 环境缺少 GD 库，无法开启缩略图功能。'));
    $form->addInput($thumbOption);
  }
  
  $other = new Typecho_Widget_Helper_Form_Element_Checkbox('other', 
    array(
    'shownav' => _t('顶部导航固定悬浮'),
    'flipajax' => _t('使用ajax加载文章'),
    'autodark' => _t('开启夜间模式(跟随系统)'),
    ),
    array('flipajax','autodark'), _t('其他设置'));
  $form->addInput($other->multiMode());
}

// 图片压缩
require_once('inc/core/thumb.php');
?>
