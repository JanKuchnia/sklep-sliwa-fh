<?php
require_once __DIR__ . '/includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = (int)($_POST['order_id'] ?? 0);
    $status = $_POST['status'] ?? '';
    if ($orderId && in_array($status, ['pending', 'confirmed', 'picked_up', 'cancelled'], true)) {
        db()->prepare('UPDATE orders SET status = ? WHERE id = ?')->execute([$status, $orderId]);
    }
    header('Location: orders.php');
    exit;
}

$orders = db()->query('SELECT * FROM orders ORDER BY created_at DESC')->fetchAll();
$itemsStmt = db()->prepare('SELECT * FROM order_items WHERE order_id = ?');
?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Zamówienia — Panel Śliwa FH</title></head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
    <div class="section-header">
      <div class="section-title-group">
        <h2>Zamówienia (<?= count($orders) ?>)</h2>
        <p>Zarządzaj rezerwacjami z koszyka</p>
      </div>
    </div>
    
    <?php if (!$orders): ?>
      <div class="form-card" style="text-align:center; padding:60px 20px;">
        <i data-lucide="inbox" class="lucide-icon" style="font-size:3rem; color:var(--text-light); margin-bottom:16px; display:block; margin:0 auto 16px;"></i>
        <p style="color:var(--text-muted); font-weight:600;">Brak zamówień do wyświetlenia.</p>
      </div>
    <?php endif; ?>
    
    <?php foreach ($orders as $o): $itemsStmt->execute([$o['id']]); $items = $itemsStmt->fetchAll(); ?>
      <div class="item-card">
        <div class="item-header">
          <div>
            <div class="item-title">#<?= $o['id'] ?> — <?= htmlspecialchars($o['customer_name']) ?></div>
            <div class="item-meta" style="margin-top:4px;">
              <span style="display:flex; align-items:center; gap:4px;"><i data-lucide="phone" class="lucide-icon" style="width:14px;height:14px;"></i> <?= htmlspecialchars($o['customer_phone']) ?></span>
              <span>·</span>
              <span style="display:flex; align-items:center; gap:4px;"><i data-lucide="calendar" class="lucide-icon" style="width:14px;height:14px;"></i> <?= $o['created_at'] ?></span>
              <span class="status-pill badge-<?= $o['status'] ?>" style="margin-left:8px;"><?= $o['status'] ?></span>
            </div>
          </div>
          <form method="POST" class="item-actions">
            <input type="hidden" name="order_id" value="<?= $o['id'] ?>">
            <select name="status" style="width:auto; padding:8px 36px 8px 12px; font-weight:600; font-size:0.85rem; border-color:var(--border-color);">
              <?php foreach (['pending' => 'Oczekujące', 'confirmed' => 'Potwierdzone', 'picked_up' => 'Odebrane', 'cancelled' => 'Anulowane'] as $val => $label): ?>
                <option value="<?= $val ?>" <?= $o['status'] === $val ? 'selected' : '' ?>><?= $label ?></option>
              <?php endforeach; ?>
            </select>
            <button type="submit" class="btn-primary btn-sm">Zapisz</button>
          </form>
        </div>
        <div class="item-details">
          <ul style="margin:0; padding-left:20px; font-size:0.95rem; display:flex; flex-direction:column; gap:8px;">
            <?php foreach ($items as $it): ?>
              <li><strong style="color:var(--text-main);"><?= htmlspecialchars($it['product_name']) ?></strong> — <?= (int)$it['qty'] ?> szt. (<?= number_format($it['price_brutto'], 2) ?> zł/szt.)</li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>
<script>lucide.createIcons();</script>
</body>
</html>
