<?php
require_once __DIR__ . '/includes/auth.php';

$id = $_GET['id'] ?? $_POST['id'] ?? '';
$product = null;
if ($id !== '') {
    $stmt = db()->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$id]);
    $product = $stmt->fetch();
}
$isNewProduct = $product === null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $specsRaw = trim($_POST['specs'] ?? '{}');
    $specsDecoded = json_decode($specsRaw ?: '{}', true);

    if ($specsRaw !== '' && $specsDecoded === null && $specsRaw !== '{}') {
        $error = 'Pole "Specyfikacja" musi być poprawnym JSON-em, np. {"Waga": "1kg"}.';
    } else {
        $fields = [
            'sku' => trim($_POST['sku']),
            'name' => trim($_POST['name']),
            'category' => $_POST['category'],
            'category_label' => trim($_POST['category_label']),
            'brand' => trim($_POST['brand']),
            'material' => trim($_POST['material']),
            'is_wholesale_discount' => isset($_POST['is_wholesale_discount']) ? 1 : 0,
            'price_netto' => (float)$_POST['price_netto'],
            'price_brutto' => (float)$_POST['price_brutto'],
            'wholesale_min_qty' => $_POST['wholesale_min_qty'] !== '' ? (int)$_POST['wholesale_min_qty'] : null,
            'wholesale_price_netto' => $_POST['wholesale_price_netto'] !== '' ? (float)$_POST['wholesale_price_netto'] : null,
            'stock_qty' => (int)$_POST['stock_qty'],
            'unit' => trim($_POST['unit']),
            'image' => trim($_POST['image']),
            'description' => trim($_POST['description']),
            'specs' => json_encode($specsDecoded ?: new stdClass(), JSON_UNESCAPED_UNICODE),
        ];

        if ($isNewProduct) {
            $newId = 'p-' . substr((string)time(), -6);
            $fields['id'] = $newId;
            $cols = implode(', ', array_keys($fields));
            $placeholders = implode(', ', array_fill(0, count($fields), '?'));
            db()->prepare("INSERT INTO products ($cols) VALUES ($placeholders)")->execute(array_values($fields));
        } else {
            $set = implode(', ', array_map(fn($c) => "$c = ?", array_keys($fields)));
            $values = array_values($fields);
            $values[] = $id;
            db()->prepare("UPDATE products SET $set WHERE id = ?")->execute($values);
        }

        if (!$error) {
            header('Location: products.php');
            exit;
        }
    }
}

// Values to pre-fill the form with (POST takes priority on validation error, else DB row, else blank).
$v = fn($key, $default = '') => $_POST[$key] ?? $product[$key] ?? $default;
$specsDisplay = $_POST['specs'] ?? ($product ? json_encode(json_decode($product['specs'] ?? '{}'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '{}');
?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="UTF-8"><title><?= $isNewProduct ? 'Nowy produkt' : 'Edytuj produkt' ?> — Panel Śliwa FH</title></head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<div class="wrap" style="max-width:700px;">
  <h1><?= $isNewProduct ? 'Nowy produkt' : 'Edytuj: ' . htmlspecialchars($product['name']) ?></h1>
  <?php if ($error): ?><p style="color:#dc2626;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
  <form method="POST" style="display:flex; flex-direction:column; gap:14px;">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

    <label>SKU <input type="text" name="sku" value="<?= htmlspecialchars($v('sku')) ?>" required style="width:100%;"></label>
    <label>Nazwa <input type="text" name="name" value="<?= htmlspecialchars($v('name')) ?>" required style="width:100%;"></label>

    <div style="display:flex; gap:14px;">
      <label style="flex:1;">Kategoria
        <select name="category" required style="width:100%;">
          <?php foreach (['ogrodnicze' => 'Ogrodnicze', 'metalowe' => 'Artykuły Metalowe', 'budowlane' => 'Budowlane & Malarskie', 'reczne' => 'Narzędzia Ręczne', 'bhp' => 'BHP'] as $key => $label): ?>
            <option value="<?= $key ?>" <?= $v('category') === $key ? 'selected' : '' ?>><?= $label ?></option>
          <?php endforeach; ?>
        </select>
      </label>
      <label style="flex:1;">Etykieta kategorii <input type="text" name="category_label" value="<?= htmlspecialchars($v('category_label')) ?>" required style="width:100%;"></label>
    </div>

    <div style="display:flex; gap:14px;">
      <label style="flex:1;">Marka <input type="text" name="brand" value="<?= htmlspecialchars($v('brand')) ?>" style="width:100%;"></label>
      <label style="flex:1;">Materiał <input type="text" name="material" value="<?= htmlspecialchars($v('material')) ?>" style="width:100%;"></label>
    </div>

    <div style="display:flex; gap:14px;">
      <label style="flex:1;">Cena netto <input type="number" step="0.01" name="price_netto" value="<?= htmlspecialchars($v('price_netto', '0')) ?>" required style="width:100%;"></label>
      <label style="flex:1;">Cena brutto <input type="number" step="0.01" name="price_brutto" value="<?= htmlspecialchars($v('price_brutto', '0')) ?>" required style="width:100%;"></label>
    </div>

    <div style="display:flex; gap:14px;">
      <label style="flex:1;">Min. ilość hurtowa <input type="number" name="wholesale_min_qty" value="<?= htmlspecialchars($v('wholesale_min_qty')) ?>" style="width:100%;"></label>
      <label style="flex:1;">Cena hurtowa netto <input type="number" step="0.01" name="wholesale_price_netto" value="<?= htmlspecialchars($v('wholesale_price_netto')) ?>" style="width:100%;"></label>
    </div>
    <label><input type="checkbox" name="is_wholesale_discount" <?= $v('is_wholesale_discount') ? 'checked' : '' ?>> Rabat hurtowy dostępny</label>

    <div style="display:flex; gap:14px;">
      <label style="flex:1;">Stan magazynowy <input type="number" name="stock_qty" value="<?= htmlspecialchars($v('stock_qty', '0')) ?>" required style="width:100%;"></label>
      <label style="flex:1;">Jednostka <input type="text" name="unit" value="<?= htmlspecialchars($v('unit', 'szt.')) ?>" required style="width:100%;"></label>
    </div>

    <label>Zdjęcie (ścieżka) <input type="text" name="image" value="<?= htmlspecialchars($v('image')) ?>" style="width:100%;"></label>
    <label>Opis <textarea name="description" rows="3" style="width:100%;"><?= htmlspecialchars($v('description')) ?></textarea></label>
    <label>Specyfikacja (JSON) <textarea name="specs" rows="6" style="width:100%; font-family:monospace;"><?= htmlspecialchars($specsDisplay) ?></textarea></label>

    <div>
      <button type="submit" class="btn"><?= $isNewProduct ? 'Dodaj produkt' : 'Zapisz zmiany' ?></button>
      <a href="products.php" class="btn btn-secondary">Anuluj</a>
    </div>
  </form>
</div>
</body>
</html>
