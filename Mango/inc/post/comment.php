<link rel='stylesheet' id='ajax-comment-css' href='https://mango.huitheme.cn/wp-content/themes/mango/inc/comment/app.css' type='text/css' media='all' />

<?php function threadedComments($comments, $options) { 
  // 评论层数大于0为子级，否则是父级
  $commentOlClass = $comments->levels > 0 ? 'children' : 'comment-list';
?>
<ol class="<?php echo $commentOlClass; ?>">
  <li id="<?php $comments->theId(); ?>" class="comment even thread-even depth-<?php echo ($comments->levels) + 1; ?>">
    <article id="div-comment-9" class="comment-body">
      <footer class="comment-meta">
        <div class="comment-author vcard">
          <img alt="<?php $comments->author(false); ?>" src="<?php echo getavatar($comments->mail); ?>" class="avatar avatar-40 photo" height="40" width="40" loading="lazy" decoding="async">
          <b class="fn"><a target="_blank" href="<?php $comments->url(); ?>" rel="external nofollow" class="url"><?php $comments->author(false); ?></a></b>
          <span class="says">说道：</span>
        </div>
        <div class="comment-metadata">
          <a href="<?php $comments->permalink(); ?>"><time datetime="<?php $comments->date('Y-m-d\TH:iP'); ?>"><?php $comments->date("Y年m月d日 H:i"); ?></time></a>
        </div>
      </footer>
      <div class="comment-content">
        <p><?php $comments->content(); ?></p>
      </div>
      <div class="reply">
        <a rel="nofollow" class="comment-reply-link" href="" onclick="return TypechoComment.reply('<?php $comments->theId(); ?>', <?php $comments->coid();?>);" data-commentid="9" data-postid="1082" data-belowelement="div-comment-9" data-respondelement="respond" data-replyto="回复给 王宜楷" aria-label="回复给 王宜楷">回复</a>
      </div>
    </article>
    <?php if ($comments->children) { 
      /* 子评论 */
      $comments->threadedComments($options);
    }?>
  </li>
</ol>
<?php } ?>










<div class="post_comment" id="post_comment_anchor">
	<div id="comments" class="comments-area">
    <div class="layoutSingleColumn">
        


  <!-- 回复列表 -->
  <?php $this->comments()->to($comments); ?>
  <?php if ($comments->have()) : ?>
        <!-- 评论的内容 -->
        <h3 class="comments-title"><i class="bi bi-filter me-2"></i>评论<small>(<?php $this->commentsNum(); ?>)</small></h3>
        <?php $comments->listComments(); ?>
  <?php endif; ?>


<div id="respond" class="comment-respond">
    <h3 id="reply-title" class="comment-reply-title">
        <i class="bi bi-keyboard me-1"></i>发布评论 
        <small>
            <a rel="nofollow" id="cancel-comment-reply-link" href="/1082.html#respond" style="display:none;">取消回复</a>
        </small>
	</h3>
    <form action="https://mango.huitheme.cn/wp-comments-post.php" method="post" id="commentform" class="comment-form">
        <p class="comment-form-comment">
            <textarea id="comment" name="comment" aria-required="true"></textarea>
        </p>
        <p class="comment-form-author">
            <input id="author" class="blog-form-input" placeholder="昵称" name="author" type="text" value="" size="30">
        </p>
        <p class="comment-form-email">
            <input id="email" class="blog-form-input" placeholder="Email " name="email" type="text" value="" size="30">
        </p>
        <p class="comment-form-url">
            <input id="url" class="blog-form-input" placeholder="网站地址" name="url" type="text" value="" size="30">
        </p>
        <p class="comment-form-cookies-consent">
            <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes">
            <label for="wp-comment-cookies-consent">在此浏览器中保存我的显示名称、邮箱地址和网站地址，以便下次评论时使用。</label>
        </p>
        <p class="form-submit">
            <input name="submit" type="submit" id="submit" class="submit" value="发布评论">
            <input type="hidden" name="comment_post_ID" value="1082" id="comment_post_ID">
            <input type="hidden" name="comment_parent" id="comment_parent" value="0">
        </p>
    </form>
  </div>
</div>
</div>

</div>



<script type="text/javascript" src="https://mango.huitheme.cn/wp-content/themes/mango/inc/comment/app.js" id="ajax-comment-js"></script>