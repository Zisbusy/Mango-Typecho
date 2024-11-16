<?php
function getavatar($email) {
  //判断邮箱类型选取头像地址
  if(preg_match('|^[1-9]\d{4,10}@qq\.com$|i',$email)){
    $avatar = '//q.qlogo.cn/g?b=qq&nk=' . explode("@",$email)[0]. '&s=160';
  }else{
    $avatar = 'https://gravatar.loli.net/avatar/' . md5(strtolower($email)) . '?s=160&r=X&d=mm';
  }
  return $avatar;
}
?>

<aside class="widget widget_comments">
  <h3 class="widget-title">最近评论</h3>
  <ul class="widget_comment_ul">
    <?php $this->widget('Widget_Comments_Recent','pageSize=10&ignoreAuthor=true')->to($recent);?>
    <?php while($recent->next()):?>
    <li>
      <img alt="" src="<?php echo getavatar($recent->mail); ?>" class="avatar avatar-40 photo" height="40" width="40" loading="lazy" decoding="async">
      <div class="widget_comment_info">
        <a rel="nofollow" href="<?php echo $recent->permalink; ?>"><?php echo $recent->text; ?></a>
        <span>
          <em><?php echo $recent->author; ?></em>
          <em><?php echo $recent->dateWord; ?></em>
        </span>
      </div>
    </li>
    <?php endwhile;?>
  </ul>
</aside>
