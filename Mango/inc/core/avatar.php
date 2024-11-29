<?php
function getavatar($email) {
  // 空邮箱返回默认头像
  if($email == '') {
    return 'https://gravatar.loli.net/avatar/c7cfa13aedff7a445ffd7bc98eb33272?s=80&d=mm&r=g';
  }
  //判断邮箱类型选取头像地址
  if(preg_match('|^[1-9]\d{4,10}@qq\.com$|i',$email)){
    return '//q.qlogo.cn/g?b=qq&nk=' . explode("@",$email)[0]. '&s=160';
  }else{
    return 'https://gravatar.loli.net/avatar/' . md5(strtolower($email)) . '?s=160&r=X&d=mm';
  }
}
?>
