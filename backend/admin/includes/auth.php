<?php
// Session guard — include at the top of every admin page except login.php.
require_once __DIR__ . '/../../config.php';

session_start();

if (empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
