<?php
// DEMO ONLY - an ordinary page. The exposure comes from the PHP runtime it runs on,
// not from this code. Any PHP script on an unpatched runtime is in scope.
echo 'Hello from PHP ' . htmlspecialchars(PHP_VERSION, ENT_QUOTES, 'UTF-8');
