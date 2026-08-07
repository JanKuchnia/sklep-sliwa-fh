<?php
// One-off CLI script to create/reset an admin login.
// Usage: php create-admin.php <username> <password>
// Delete this file (or move it outside the webroot) once your admins are set up.

require_once __DIR__ . '/config.php';

if ($argc !== 3) {
    fwrite(STDERR, "Usage: php create-admin.php <username> <password>\n");
    exit(1);
}

[$_, $username, $password] = $argv;
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = db()->prepare(
    'INSERT INTO admin_users (username, password_hash) VALUES (?, ?)
     ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash)'
);
$stmt->execute([$username, $hash]);

echo "Admin '$username' created/updated.\n";
