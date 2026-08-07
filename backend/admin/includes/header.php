<link rel="stylesheet" href="admin.css">
<div class="admin-layout">
  <aside class="admin-sidebar">
    <div class="sidebar-header">
      <div class="sidebar-brand">Śliwa<span>FH</span></div>
    </div>
    <nav class="sidebar-nav">
      <a href="index.php" class="nav-item">Dashboard</a>
      <a href="products.php" class="nav-item">Produkty</a>
      <a href="orders.php" class="nav-item">Zamówienia</a>
      <a href="quotes.php" class="nav-item">Zapytania B2B</a>
    </nav>
    <div class="sidebar-footer">
      <div>Zalogowano jako:<br><strong style="color:var(--text-white);"><?= htmlspecialchars($_SESSION['admin_username'] ?? '') ?></strong></div>
      <a href="logout.php" class="logout-link">Wyloguj</a>
    </div>
  </aside>
  <main class="admin-main">
