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
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Produkty — Panel Śliwa FH</title></head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
    <div class="section-header">
      <div class="section-title-group">
        <h2>Produkty (<?= count($products) ?>)</h2>
        <p>Zarządzaj katalogiem i stanami magazynowymi</p>
      </div>
      <a href="product-edit.php" class="btn-primary">
        <i data-lucide="plus" class="lucide-icon"></i> Dodaj produkt
      </a>
    </div>
    <div class="table-container desktop-products-table">
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
              <div style="font-weight:700; color:var(--text-main); font-size:0.95rem;"><?= htmlspecialchars($p['name']) ?></div>
              <div class="mono-text" style="color:var(--text-muted); font-size:0.8rem; margin-top:2px;"><?= htmlspecialchars($p['sku']) ?></div>
            </td>
            <td><span class="status-pill" style="background:var(--bg-surface-elevated); color:var(--text-muted); border-color:var(--border-color);"><?= htmlspecialchars($p['category_label']) ?></span></td>
            <td style="font-weight:700; color:var(--text-main);"><?= number_format($p['price_brutto'], 2) ?> zł</td>
            <td>
              <div style="font-weight:600; color:<?= $p['stock_qty'] > 0 ? 'var(--emerald-green)' : 'var(--danger-red)' ?>;">
                <?= (int)$p['stock_qty'] ?> <?= htmlspecialchars($p['unit']) ?>
              </div>
            </td>
            <?php foreach (['is_bestseller' => 'Bestseller', 'is_new' => 'Nowość', 'is_promo' => 'Promocja'] as $flag => $label): ?>
            <td>
              <form method="POST" style="display:inline;">
                <input type="hidden" name="action" value="toggle">
                <input type="hidden" name="field" value="<?= $flag ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($p['id']) ?>">
                <?php if ($p[$flag]): ?>
                  <button type="submit" class="status-pill badge-<?= str_replace('is_', '', $flag) ?>" style="cursor:pointer;" title="Kliknij, aby wyłączyć">
                    <?= $label ?>
                  </button>
                <?php else: ?>
                  <button type="submit" class="status-pill" style="cursor:pointer; background:transparent; border-color:var(--border-color); color:var(--text-light);" title="Kliknij, aby włączyć">
                    brak
                  </button>
                <?php endif; ?>
              </form>
            </td>
            <?php endforeach; ?>
            <td style="text-align:right;">
              <div style="display:flex; gap:8px; justify-content:flex-end;">
                <a href="product-edit.php?id=<?= urlencode($p['id']) ?>" class="btn-outline btn-sm" title="Edytuj">
                  <i data-lucide="edit" class="lucide-icon"></i> Edytuj
                </a>
                <form method="POST" style="display:inline;" onsubmit="return confirm('Usunąć ten produkt?');">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($p['id']) ?>">
                  <button type="submit" class="btn-outline btn-sm" style="color:var(--danger-red); border-color:var(--danger-red);" title="Usuń">
                    <i data-lucide="trash-2" class="lucide-icon"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Mobile Cards Layout -->
    <div class="mobile-products-list">
      <?php foreach ($products as $p): ?>
      <div class="item-card mpc-card">
        <div class="item-header" style="margin-bottom: 8px;">
          <div>
            <div class="item-title"><?= htmlspecialchars($p['name']) ?></div>
            <div class="mono-text" style="color:var(--text-muted); font-size:0.8rem; margin-top:2px;"><?= htmlspecialchars($p['sku']) ?></div>
          </div>
          <span class="status-pill" style="background:var(--bg-surface-elevated); color:var(--text-muted); border-color:var(--border-color);"><?= htmlspecialchars($p['category_label']) ?></span>
        </div>
        
        <div class="item-details" style="display:flex; justify-content:space-between; align-items:center; border:none; padding-top:8px; margin-bottom:12px;">
          <div style="font-weight:700; color:var(--text-main); font-size:1.1rem;"><?= number_format($p['price_brutto'], 2) ?> zł</div>
          <div style="font-weight:600; color:<?= $p['stock_qty'] > 0 ? 'var(--emerald-green)' : 'var(--danger-red)' ?>;">
            <?= (int)$p['stock_qty'] ?> <?= htmlspecialchars($p['unit']) ?>
          </div>
        </div>

        <div style="display:flex; gap:6px; flex-wrap:wrap; margin-bottom:16px;">
          <?php foreach (['is_bestseller' => 'Bestseller', 'is_new' => 'Nowość', 'is_promo' => 'Promocja'] as $flag => $label): ?>
            <?php if ($p[$flag]): ?>
              <form method="POST" style="display:inline;">
                <input type="hidden" name="action" value="toggle">
                <input type="hidden" name="field" value="<?= $flag ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($p['id']) ?>">
                <button type="submit" class="status-pill badge-<?= str_replace('is_', '', $flag) ?>" style="cursor:pointer;" title="Kliknij, aby wyłączyć">
                  <?= $label ?>
                </button>
              </form>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>

        <div class="item-actions" style="border-top: 1px solid var(--border-color); padding-top: 12px; width: 100%; display: flex; gap: 8px;">
          <a href="product-edit.php?id=<?= urlencode($p['id']) ?>" class="btn-outline btn-sm" style="flex:1; justify-content:center;">
            <i data-lucide="edit" class="lucide-icon"></i> Edytuj
          </a>
          <form method="POST" style="display:flex; flex:1;" onsubmit="return confirm('Usunąć ten produkt?');">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= htmlspecialchars($p['id']) ?>">
            <button type="submit" class="btn-outline btn-sm" style="width:100%; justify-content:center; color:var(--danger-red); border-color:var(--danger-red);">
              <i data-lucide="trash-2" class="lucide-icon"></i> Usuń
            </button>
          </form>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</main>
<script>lucide.createIcons();</script>
</body>
</html>
