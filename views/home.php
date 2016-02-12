<p>Hello there<?php
if (!empty($this->templateVars['username'])) {
  echo ', ' . $this->templateVars['username'];
}?>!
<p>

<a href="/php_example_mvc/new_thread">Create a new thread!</a>
