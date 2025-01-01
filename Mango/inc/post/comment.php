<!-- 评论资源 -->
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/comment.css'); ?>" id="ajax-comment-css" type="text/css" media="all">
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/comment.js'); ?>" id="ajax-comment-js"></script>

<?php function threadedComments($comments, $options) { ?>
  <li id="<?php $comments->theId(); ?>" class="comment even thread-even depth-<?php echo ($comments->levels) + 1; ?>">
    <article id="div-<?php $comments->theId(); ?>" class="comment-body">
      <footer class="comment-meta">
        <div class="comment-author vcard">
          <img alt="<?php $comments->author(false); ?>" src="<?php echo getavatar($comments->mail); ?>" class="avatar avatar-40 photo" height="40" width="40" loading="lazy" decoding="async">
          <b class="fn"><a target="_blank" href="<?php $comments->url(); ?>" rel="external nofollow" class="url"><?php $comments->author(false); ?></a></b>
        </div>
        <div class="comment-metadata">
          <a href="<?php $comments->permalink(); ?>"><time datetime="<?php $comments->date('Y-m-d\TH:iP'); ?>"><?php $comments->date("Y年m月d日 H:i"); ?></time></a>
        </div>
        <?php if ($comments->status == 'waiting') : ?>
          <em class="comment-awaiting-moderation">您的评论正在审核！</em>
        <?php endif; ?>
      </footer>
      <div class="comment-content">
        <?php $comments->content(); ?>
      </div>
      <div class="reply">
        <a rel="nofollow" class="comment-reply-link" href="<?php echo substr($comments->permalink, 0, - strlen($comments->theId) - 1) . '?replyTo=' . $comments->coid .'#'. $comments->parameter->respondId; ?>" onclick="return TypechoComment.reply('<?php $comments->theId(); ?>', <?php $comments->coid();?>, this);"  aria-label="回复给 <?php $comments->author(false); ?>">回复</a>
      </div>
    </article>
    <?php if ($comments->children) { ?>
      <!-- 子评论 -->
      <ol class="children">
        <?php $comments->threadedComments($options); ?>
      </ol>
    <?php } ?>
  </li>
<?php } ?>

<div class="post_comment" id="post_comment_anchor">
  <div id="comments" class="comments-area">
    <div class="layoutSingleColumn">


  <!-- 评论列表 -->
  <?php $this->comments()->to($comments); ?>
  <?php if ($comments->have()) : ?>
        <!-- 评论的内容 -->
        <h3 class="comments-title"><i class="bi bi-filter me-2"></i>评论<small>(<?php $this->commentsNum(); ?>)</small></h3>
        <ol class="comment-list">
            <?php $comments->listComments(array('before'=>'','after'=>'')); ?>
        </ol>
  <?php endif; ?>

<!-- 评论表单 -->
<?php if ($this->allow('comment')) : ?>
<div id="<?php $this->respondId(); ?>" class="comment-respond">
    <h3 id="reply-title" class="comment-reply-title">
        <i class="bi bi-keyboard me-1"></i>发布评论 
        <small>
            <?php $comments->cancelReply(); ?>
        </small>
	</h3>
    <form action="<?php $this->commentUrl() ?>" method="post" id="commentform" class="comment-form">
        <p class="comment-form-comment">
            <textarea id="comment" name="text" aria-required="true"></textarea>
        </p>
        <p class="comment-form-author">
            <input id="author" class="blog-form-input" placeholder="昵称" name="author" type="text" value="<?php $this->remember('author'); ?>" size="30">
        </p>
        <p class="comment-form-email">
            <input id="email" class="blog-form-input" placeholder="Email " name="mail" type="text" value="<?php $this->remember('mail'); ?>" size="30">
        </p>
        <p class="comment-form-url">
            <input id="url" class="blog-form-input" placeholder="网站地址" name="url" type="text" value="<?php $this->remember('url'); ?>" size="30">
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
<?php endif; ?>
	    

	    

    </div>
  </div>
</div>
