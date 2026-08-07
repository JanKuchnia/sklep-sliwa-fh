<?php
require_once __DIR__ . '/includes/auth.php';

// Quick actions: delete, and one-click toggles for stock flags.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? '';

    if ($action === 'delete' && $id !== '') {
        db()->prepare('DELETE FROM products WHERE id = ?')->execute([$id]);
    } elseif ($action === 'toggle' && $id !== '' && in_array($_POST['field'] ?? '', ['is_bestseller', 'is_new', 'is_promo'], true)) {
        $field = $_POST['field'];
        db()->prepare("UPDATE products SET $field = NOT $field WHERE id = ?")->execute([$id]);
    }
    header('Location: products.php');
    exit;
}

$products = db()->query('SELECT * FROM products ORDER BY category, name')->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="UTF-8"><title>Produkty — Panel Śliwa FH</title></head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
  <header class="admin-header">
    <div class="header-title">Produkty (<?= count($products) ?>)</div>
    <a href="product-edit.php" class="btn btn-sm">+ Dodaj produkt</a>
  </header>
  <div class="admin-content">
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Nazwa</th><th>Kategoria</th><th>Cena brutto</th><th>Stan</th>
            <th>Bestseller</th><th>Nowość</th><th>Promocja</th><th style="text-align:right;">Akcje</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $p): ?>
          <tr>
            <td>
              <div style="font-weight:600;"><?= htmlspecialchars($p['name']) ?></div>
              <div style="color:var(--text-muted); font-size:0.8rem; font-family:var(--font-mono);"><?= htmlspecialchars($p['sku']) ?></div>
            </td>
            <td><?= htmlspecialchars($p['category_label']) ?></td>
            <td style="font-weight:600;"><?= number_format($p['price_brutto'], 2) ?> zł</td>
            <td><?= (int)$p['stock_qty'] ?> <?= htmlspecialchars($p['unit']) ?></td>
            <?php foreach (['is_bestseller', 'is_new', 'is_promo'] as $flag): ?>
            <td>
              <form method="POST" style="display:inline;">
                <input type="hidden" name="action" value="toggle">
                <input type="hidden" name="field" value="<?= $flag ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($p['id']) ?>">
                <button type="submit" class="btn <?= $p[$flag] ? '' : 'btn-secondary' ?> btn-sm" style="padding:4px 10px; min-width:44px;">
                  <?= $p[$flag] ? 'TAK' : 'nie' ?>
                </button>
              </form>
            </td>
            <?php endforeach; ?>
            <td style="text-align:right;">
              <div style="display:flex; gap:6px; justify-content:flex-end;">
                <a href="product-edit.php?id=<?= urlencode($p['id']) ?>" class="btn btn-secondary btn-sm" style="padding:6px 10px;">Edytuj</a>
                <form method="POST" style="display:inline;" onsubmit="return confirm('Usunąć ten produkt?');">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($p['id']) ?>">
                  <button type="submit" class="btn btn-danger btn-sm" style="padding:6px 10px;">Usuń</button>
                </form>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  </main>
</div>
</body>
</html>
