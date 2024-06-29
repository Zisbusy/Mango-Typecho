<?php
function themeConfig($form) {

  $subTitle  = new Typecho_Widget_Helper_Form_Element_Text('subTitle', NULL,'个人博客', _t('网站副标题'), _t('默认内容"个人博客"'));
  $form->addInput($subTitle);

}