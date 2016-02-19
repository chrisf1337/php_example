<?php foreach ($this->context['posts'] as $post) { ?>
<div class="post">
  <div class="post-header">
    <span class="post-op"><?php echo $post->op->username; ?></span>:
    <span class="post-subject"><?php echo $post->subject; ?></span>
  </div>
  <div class="post-body">
  <?php echo $post->body; ?>
  </div>
</div>
<?php } ?>

<div><a href="javascript:void(0);" class="reply-link">[Reply]</a></div>

<script src="http://code.jquery.com/jquery-2.2.0.js"></script>
<script type="text/javascript" src="js/thread.js"></script>
