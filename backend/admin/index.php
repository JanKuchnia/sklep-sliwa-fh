<?php require_once __DIR__ . '/includes/auth.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Panel — Śliwa FH</title></head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
    <div class="section-header">
      <div class="section-title-group">
        <h2>Dashboard</h2>
        <p>Przegląd statystyk panelu administracyjnego</p>
      </div>
    </div>
    <?php
      $productCount = db()->query('SELECT COUNT(*) c FROM products')->fetch()['c'];
      $pendingOrders = db()->query("SELECT COUNT(*) c FROM orders WHERE status = 'pending'")->fetch()['c'];
      $newQuotes = db()->query("SELECT COUNT(*) c FROM quote_requests WHERE status = 'new'")->fetch()['c'];
      
      $recentOrders = db()->query('SELECT * FROM orders ORDER BY created_at DESC LIMIT 5')->fetchAll();
      $recentQuotes = db()->query('SELECT * FROM quote_requests ORDER BY created_at DESC LIMIT 5')->fetchAll();
    ?>
    <div style="display:flex; justify-content:flex-end; gap:12px; margin-bottom:24px;">
      <a href="product-edit.php" class="btn-primary btn-sm"><i data-lucide="plus" class="lucide-icon"></i> Dodaj produkt</a>
    </div>

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
    
    <div class="dashboard-lists" style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:32px;">
      <!-- Ostatnie zamówienia -->
      <div>
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
          <h3 style="font-size:1.15rem; font-weight:800; color:var(--text-main);">Ostatnie zamówienia</h3>
          <a href="orders.php" class="btn-outline btn-sm">Zobacz wszystkie</a>
        </div>
        <?php if (!$recentOrders): ?>
          <div class="form-card" style="text-align:center; padding:30px 20px;">
            <p style="color:var(--text-muted); font-weight:600;">Brak zamówień.</p>
          </div>
        <?php else: ?>
          <?php foreach ($recentOrders as $o): ?>
            <a href="orders.php" class="item-card" style="display:block; padding:16px; margin-bottom:12px; text-decoration:none;">
              <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div>
                  <div style="font-weight:700; font-size:0.95rem;">#<?= $o['id'] ?> — <?= htmlspecialchars($o['customer_name']) ?></div>
                  <div class="item-meta" style="margin-top:4px; font-size:0.8rem;">
                    <span style="display:flex; align-items:center; gap:4px;"><i data-lucide="calendar" class="lucide-icon" style="width:12px;height:12px;"></i> <?= $o['created_at'] ?></span>
                  </div>
                </div>
                <span class="status-pill badge-<?= $o['status'] ?>" style="font-size:0.7rem;"><?= $o['status'] ?></span>
              </div>
            </a>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <!-- Ostatnie zapytania B2B -->
      <div>
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
          <h3 style="font-size:1.15rem; font-weight:800; color:var(--text-main);">Ostatnie zapytania B2B</h3>
          <a href="quotes.php" class="btn-outline btn-sm">Zobacz wszystkie</a>
        </div>
        <?php if (!$recentQuotes): ?>
          <div class="form-card" style="text-align:center; padding:30px 20px;">
            <p style="color:var(--text-muted); font-weight:600;">Brak zapytań.</p>
          </div>
        <?php else: ?>
          <?php foreach ($recentQuotes as $q): ?>
            <a href="quotes.php" class="item-card" style="display:block; padding:16px; margin-bottom:12px; text-decoration:none;">
              <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div>
                  <div style="font-weight:700; font-size:0.95rem;">
                    <i data-lucide="building-2" class="lucide-icon" style="color:var(--b2b-blue); width:14px; height:14px; margin-right:4px;"></i>
                    <?= htmlspecialchars($q['company_name']) ?>
                  </div>
                  <div class="item-meta" style="margin-top:4px; font-size:0.8rem;">
                    <span style="display:flex; align-items:center; gap:4px;"><i data-lucide="calendar" class="lucide-icon" style="width:12px;height:12px;"></i> <?= $q['created_at'] ?></span>
                  </div>
                </div>
                <span class="status-pill badge-<?= $q['status'] ?>" style="font-size:0.7rem;"><?= $q['status'] ?></span>
              </div>
            </a>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>
<script>lucide.createIcons();</script>
</body>
</html>
