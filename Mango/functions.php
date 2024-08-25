<?php
function themeConfig($form) {
  //博客信息
  $subTitle  = new Typecho_Widget_Helper_Form_Element_Text('subTitle', NULL,'个人博客', _t('网站副标题'), _t('默认内容"个人博客"'));
  $form->addInput($subTitle);

  // Banner 设置
  $bannerData = new Typecho_Widget_Helper_Form_Element_Textarea(
    'bannerData', 
    null, 
    '沉浸式工作台#/usr/themes/Mango/assets/banner/1.jpg#/;
双眼放空想象一下#/usr/themes/Mango/assets/banner/2.jpg#/;', 
    _t('Banner 数据'), 
    _t('按要求填写 Banner, 数据格式:文字#图片路径#跳转链接;...; (不填写或填写错误时 Banner 会隐藏。)'));
  $form->addInput($bannerData);
}
