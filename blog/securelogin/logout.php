<?php
include '../common.php';
$_SESSION['auth'] = '';
$_SESSION['ADMIN_NAME'] = '';
session_destroy();
$f->redirect(APP_URL);
?>