<p>Hello there<?php
if (!empty($this->context['username'])) {
  echo ', ' . $this->context['username'];
}?>!
<p>

<div><a href="javascript:void(0);" class="new-thread-link">[Start a new thread]</a></div>

<div>
<?php
if (!empty($this->context['frontPageThreads'])) {
  foreach ($this->context['frontPageThreads'] as $thread) {
?>
  <div>
    <?php echo $thread->subject; ?>
  </div>
<?php
  }
}
?>
</div>

<script src="http://code.jquery.com/jquery-2.2.0.js"></script>
<script type="text/javascript" src="js/index.js"></script>
