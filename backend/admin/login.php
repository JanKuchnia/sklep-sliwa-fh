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
        $_SESSION['last_activity'] = time();
        header('Location: index.php');
        exit;
    }
    $error = 'Nieprawidłowa nazwa użytkownika lub hasło.';
}
if (!empty($_GET['timeout'])) {
    $error = 'Sesja wygasła z powodu braku aktywności. Zaloguj się ponownie.';
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logowanie — Panel Śliwa FH</title>
<link rel="stylesheet" href="admin.css">
<script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-brand">
        <div class="brand-logo">
          <div class="logo-icon"><i data-lucide="wrench" class="lucide-icon"></i></div>
          <div class="logo-text">
            <div class="brand-name">ŚLIWA <span>FH</span></div>
            <div class="brand-sub">Panel Administracyjny</div>
          </div>
        </div>
      </div>
      <div class="auth-title">Logowanie do panelu administracyjnego</div>
      <form method="POST">
        <?php if ($error): ?><div style="color:var(--danger-red); font-size:0.85rem; margin-bottom:16px; font-weight:600; text-align:center;"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <div class="form-group">
          <label for="username">Użytkownik</label>
          <input type="text" id="username" name="username" required autofocus>
        </div>
        <div class="form-group">
          <label for="password">Hasło</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn-primary" style="width:100%; padding:14px; font-size:1rem; margin-top:8px;">Zaloguj się</button>
      </form>
    </div>
  </div>
  <script>lucide.createIcons();</script>
</body>
</html>
