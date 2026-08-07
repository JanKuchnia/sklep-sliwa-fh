<?php
require_once __DIR__ . '/../config.php';
session_start();

if (!empty($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = db()->prepare('SELECT id, password_hash FROM admin_users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $username;
        header('Location: index.php');
        exit;
    }
    $error = 'Nieprawidłowa nazwa użytkownika lub hasło.';
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Logowanie — Panel Śliwa FH</title>
<link rel="stylesheet" href="admin.css">
</head>
<body>
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-brand">Śliwa<span>FH</span></div>
      <div class="auth-title">Logowanie do panelu administracyjnego</div>
      <form method="POST">
        <?php if ($error): ?><div style="color:#ef4444; font-size:0.85rem; margin-bottom:16px; font-weight:500; text-align:center;"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <div class="form-group">
          <label for="username">Użytkownik</label>
          <input type="text" id="username" name="username" required autofocus>
        </div>
        <div class="form-group">
          <label for="password">Hasło</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn" style="width:100%; padding:14px; font-size:1rem; margin-top:8px;">Zaloguj się</button>
      </form>
    </div>
  </div>
</body>
</html>
