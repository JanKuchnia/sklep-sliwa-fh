<?php
// Session guard — include at the top of every admin page except login.php.
require_once __DIR__ . '/../../config.php';

session_start();

if (empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Auto-logout after 30 minutes of inactivity.
$timeoutSeconds = 30 * 60;
if (!empty($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeoutSeconds) {
    session_unset();
    session_destroy();
    header('Location: login.php?timeout=1');
    exit;
}
$_SESSION['last_activity'] = time();
