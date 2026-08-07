<?php require_once __DIR__ . '/includes/auth.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="UTF-8"><title>Panel — Śliwa FH</title></head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
  <header class="admin-header">
    <div class="header-title">Dashboard</div>
  </header>
  <div class="admin-content">
    <?php
      $productCount = db()->query('SELECT COUNT(*) c FROM products')->fetch()['c'];
      $pendingOrders = db()->query("SELECT COUNT(*) c FROM orders WHERE status = 'pending'")->fetch()['c'];
      $newQuotes = db()->query("SELECT COUNT(*) c FROM quote_requests WHERE status = 'new'")->fetch()['c'];
    ?>
    <div class="dashboard-stats">
      <a href="products.php" class="stat-card">
        <span class="stat-title">Wszystkie Produkty</span>
        <span class="stat-value"><?= $productCount ?></span>
      </a>
      <a href="orders.php" class="stat-card">
        <span class="stat-title">Oczekujące Zamówienia</span>
        <span class="stat-value"><?= $pendingOrders ?></span>
      </a>
      <a href="quotes.php" class="stat-card">
        <span class="stat-title">Nowe Zapytania B2B</span>
        <span class="stat-value"><?= $newQuotes ?></span>
      </a>
    </div>
  </div>
  </main>
</div>
</body>
</html>
