<?php
function themeConfig($form) {
  //博客信息
  $subTitle  = new Typecho_Widget_Helper_Form_Element_Text('subTitle', NULL,'个人博客', _t('网站副标题'), _t('默认内容"个人博客"'));
  $form->addInput($subTitle);

  // 头像
  $avatar = new Typecho_Widget_Helper_Form_Element_Text('avatar', NULL,'/usr/themes/Mango/assets/img/avatar.webp', _t('博主头像地址'), _t('默认值 "/usr/themes/Mango/assets/img/avatar.webp"'));
  $form->addInput($avatar);

  // 个人介绍
  $introduce = new Typecho_Widget_Helper_Form_Element_Text('introduce', NULL,'站在巨人的肩膀上而已', _t('个人介绍'), _t('文章页面头像下个人介绍'));
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

  // ICP备案号
  $ICP = new Typecho_Widget_Helper_Form_Element_Text('ICP', NULL,NULL, _t('ICP备案号'), _t('备案号（不填写时隐藏）'));
  $form->addInput($ICP);

  // 公安备案号
  $WangAn = new Typecho_Widget_Helper_Form_Element_Text('WangAn', NULL,NULL, _t('公安备案号'), _t('备案号（不填写时隐藏）'));
  $form->addInput($WangAn);

  /* 缩略图配置选项 */
  if(function_exists('gd_info')){
    $thumbOption = new Typecho_Widget_Helper_Form_Element_Radio('thumbOption',
    array(true => '开启',false => '关闭',),
    false, _t('生成缩略图'), _t('为文章列表与文章里图片生成小尺寸的缩略图，可显著提高加载速度，节省服务器带宽。<br /><b>注意： 首次访问时会生成缩略图，加载时间可能较长。请提前创建 usr/thumb 文件夹。</b>'));
    $form->addInput($thumbOption);
  }else {
    $thumbOption = new Typecho_Widget_Helper_Form_Element_Radio('thumbOption',
    array(false => '关闭',),
    false, _t('生成缩略图'), _t('PHP 环境缺少 GD 库，无法开启缩略图功能。'));
    $form->addInput($thumbOption);
  }
  
  $other = new Typecho_Widget_Helper_Form_Element_Checkbox('other', 
    array(
    'showNav' => _t('顶部导航固定悬浮'),
    'openAjax' => _t('使用ajax加载文章'),
    ),
    array('showNav','openAjax'), _t('其他设置'));
  $form->addInput($other->multiMode());
}

// 修改后台设置以适应模板
function themeInit($archive){
  // 修改默认头像源
  define('__TYPECHO_GRAVATAR_PREFIX__', 'https://weavatar.com/avatar/');
  // 将较新的的评论显示在前面
  Helper::options()->commentsOrder = 'DESC';
  // 启用评论分页
  Helper::options()->commentsPageBreak = true;
  // 评论第一页作为默认显示
  Helper::options()->commentsPageDisplay = 'first';
  // 点赞接口 创建一个路由
  if ($archive->request->getPathInfo() == "/likes") {
    // 执行函数
    $reValues = likeup($archive->request->cid,$archive->request->action);
    Typecho_Response::getInstance()->setStatus(200)->respond(
      //返回数据
      $archive->response->throwJson(array(
        "status" => $reValues["status"],
        "message" => $reValues["message"]
      ))
    );
    exit;
  }
}

// 图片压缩
require_once('inc/core/thumb.php');
// img 标签处理
require_once('inc/core/fancyimg.php');
// a 标签处理
require_once('inc/core/setLinks.php');
// 阅读次数统计
require_once('inc/core/views.php');
// 文章点赞
require_once('inc/core/like.php');
// 头像处理
require_once('inc/core/avatar.php');
// 评论过滤
require_once('inc/core/filter.php');
?>
