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