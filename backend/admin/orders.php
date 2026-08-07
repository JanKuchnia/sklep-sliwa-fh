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
<head><meta charset="UTF-8"><title>Zamówienia — Panel Śliwa FH</title></head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
  <header class="admin-header">
    <div class="header-title">Zamówienia (<?= count($orders) ?>)</div>
  </header>
  <div class="admin-content">
    <?php if (!$orders): ?>
      <p style="color:var(--text-muted);">Brak zamówień.</p>
    <?php endif; ?>
    <?php foreach ($orders as $o): $itemsStmt->execute([$o['id']]); $items = $itemsStmt->fetchAll(); ?>
      <div class="item-card">
        <div class="item-header">
          <div>
            <div class="item-title">#<?= $o['id'] ?> — <?= htmlspecialchars($o['customer_name']) ?></div>
            <div class="item-meta" style="margin-top:4px;">
              <span><?= htmlspecialchars($o['customer_phone']) ?></span>
              <span>·</span>
              <span><?= $o['created_at'] ?></span>
              <span class="badge badge-<?= $o['status'] ?>" style="margin-left:8px;"><?= $o['status'] ?></span>
            </div>
          </div>
          <form method="POST" class="item-actions">
            <input type="hidden" name="order_id" value="<?= $o['id'] ?>">
            <select name="status" style="width:auto; padding:8px 12px;">
              <?php foreach (['pending', 'confirmed', 'picked_up', 'cancelled'] as $s): ?>
                <option value="<?= $s ?>" <?= $o['status'] === $s ? 'selected' : '' ?>><?= $s ?></option>
              <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-secondary btn-sm">Zapisz</button>
          </form>
        </div>
        <div class="item-details">
          <ul style="margin:0; padding-left:20px; font-size:0.9rem;">
            <?php foreach ($items as $it): ?>
              <li><strong><?= htmlspecialchars($it['product_name']) ?></strong> — <?= (int)$it['qty'] ?> szt. (<?= number_format($it['price_brutto'], 2) ?> zł/szt.)</li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  </main>
</div>
</body>
</html>
