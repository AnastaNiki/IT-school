<?php
setcookie('key', null, time() - 604800, '/');
header("Location: ../index.php"); exit;