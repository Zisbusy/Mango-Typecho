<?php
function getavatar($email) {
  return __TYPECHO_GRAVATAR_PREFIX__ . md5(strtolower($email)) . '?s=160&r=X&d=mm';
}
?>
