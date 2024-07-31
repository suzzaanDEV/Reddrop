<?php
session_start();

$_SESSION = array();
session_destroy();

unset($_COOKIE['user_id']);
setcookie('user_id', '', -1, '/');
unset($_COOKIE['admin_id']);
setcookie('admin_id', '', -1, '/');
unset($_COOKIE['partner_id']);
setcookie('partner_id', '', -1, '/');

header("Location: ../view/Home.php");
exit();
