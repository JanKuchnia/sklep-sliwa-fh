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
        $imagePath = trim($_POST['image_existing'] ?? '');
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['image_file']['tmp_name'];
            $fileSize = $_FILES['image_file']['size'];
            $fileName = $_FILES['image_file']['name'];
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];
            
            if (!in_array($ext, $allowedExts)) {
                $error = 'Niedozwolony format pliku.';
            } elseif ($fileSize > 5 * 1024 * 1024) {
                $error = 'Plik jest za duży (maksymalnie 5MB).';
            } else {
                if ($ext === 'svg') {
                    $content = file_get_contents($tmpName);
                    if ($content === false || (!str_starts_with(trim($content), '<?xml') && !str_starts_with(trim($content), '<svg')) || stripos($content, '<script') !== false) {
                        $error = 'Nieprawidłowy plik SVG.';
                    }
                } else {
                    $imgSize = getimagesize($tmpName);
                    if ($imgSize === false) {
                        $error = 'Plik nie jest poprawnym zdjęciem.';
                    }
                }
            }
            
            if (!$error) {
                $uploadDir = __DIR__ . '/../../assets/products/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $sku = trim($_POST['sku']);
                $safeSku = preg_replace('/[^a-z0-9-]/', '', strtolower($sku));
                if ($safeSku === '') $safeSku = 'prod';
                
                $newFileName = 'p-' . $safeSku . '-' . uniqid() . '.' . $ext;
                if (move_uploaded_file($tmpName, $uploadDir . $newFileName)) {
                    $imagePath = './assets/products/' . $newFileName;
                } else {
                    $error = 'Błąd podczas zapisywania pliku na serwerze.';
                }
            }
        }

        if (!$error) {
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
                'image' => $imagePath,
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

            header('Location: products.php');
            exit;
        }
    }
}

// Values to pre-fill the form with (POST takes priority on validation error, else DB row, else blank).
$v = fn($key, $default = '') => $_POST[$key] ?? $product[$key] ?? $default;
// Product image paths are stored root-relative (e.g. "./assets/products/x.svg") for the storefront at "/";
// admin pages live under /backend/admin/, so rewrite to an absolute path for display here.
$imgSrc = fn($path) => $path === '' ? '' : (preg_match('#^https?://#', $path) ? $path : '/' . ltrim($path, './'));
$specsDisplay = $_POST['specs'] ?? ($product ? json_encode(json_decode($product['specs'] ?? '{}'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '{}');
?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title><?= $isNewProduct ? 'Nowy produkt' : 'Edytuj produkt' ?> — Panel Śliwa FH</title></head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
    <div class="section-header">
      <div class="section-title-group">
        <h2><?= $isNewProduct ? 'Nowy produkt' : 'Edytuj: ' . htmlspecialchars($product['name']) ?></h2>
        <p>Uzupełnij dane produktu w formularzu</p>
      </div>
    </div>
    
    <div class="form-card" style="max-width:1200px; margin: 0 auto;">
      <?php if ($error): ?><div style="color:var(--danger-red); font-weight:600; margin-bottom:20px;"><i data-lucide="alert-circle" class="lucide-icon"></i> <?= htmlspecialchars($error) ?></div><?php endif; ?>
      <form method="POST" id="product-form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

        <div class="product-edit-layout">
          <div class="pel-main">
            <div class="edit-section">
              <h3>Podstawowe informacje</h3>
          <div class="edit-grid grid-1-2">
            <div>
              <label>SKU</label>
              <input type="text" name="sku" value="<?= htmlspecialchars($v('sku')) ?>" required class="mono-text" autofocus>
            </div>
            <div>
              <label>Nazwa</label>
              <input type="text" name="name" value="<?= htmlspecialchars($v('name')) ?>" required>
            </div>
          </div>
          <div class="edit-grid grid-1-1">
            <div>
              <label>Kategoria</label>
              <select name="category" id="category-select" required>
                <?php foreach (['ogrodnicze' => 'Ogrodnicze', 'metalowe' => 'Artykuły Metalowe', 'budowlane' => 'Budowlane & Malarskie', 'reczne' => 'Narzędzia Ręczne', 'bhp' => 'BHP'] as $key => $label): ?>
                  <option value="<?= $key ?>" <?= $v('category') === $key ? 'selected' : '' ?>><?= $label ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div>
              <label>Etykieta kategorii</label>
              <input type="text" name="category_label" id="category_label_input" value="<?= htmlspecialchars($v('category_label')) ?>" required>
            </div>
          </div>
          <div class="edit-grid grid-1-1">
            <div>
              <label>Marka <span style="font-size: 0.8em; color: var(--text-muted, #777); font-weight: normal; margin-left: 8px;">(opcjonalne)</span></label>
              <input type="text" name="brand" value="<?= htmlspecialchars($v('brand')) ?>">
            </div>
            <div>
              <label>Materiał <span style="font-size: 0.8em; color: var(--text-muted, #777); font-weight: normal; margin-left: 8px;">(opcjonalne)</span></label>
              <input type="text" name="material" value="<?= htmlspecialchars($v('material')) ?>">
            </div>
          </div>
        </div>

        <div class="edit-section">
          <h3>Ceny</h3>
          <div class="edit-grid grid-1-1">
            <div>
              <label>Cena netto (PLN)</label>
              <input type="number" step="0.01" name="price_netto" id="price_netto" value="<?= htmlspecialchars($v('price_netto', '0')) ?>" required>
            </div>
            <div>
              <label>Cena brutto (PLN)</label>
              <input type="number" step="0.01" name="price_brutto" id="price_brutto" value="<?= htmlspecialchars($v('price_brutto', '0')) ?>" required>
            </div>
          </div>
        </div>

        <div class="edit-section">
          <h3>Hurtowa sprzedaż <span style="font-size: 0.8em; color: var(--text-muted, #777); font-weight: normal; margin-left: 8px;">(opcjonalne)</span></h3>
          <div class="edit-grid grid-1-1">
            <div>
              <label>Min. ilość hurtowa</label>
              <input type="number" name="wholesale_min_qty" value="<?= htmlspecialchars($v('wholesale_min_qty')) ?>">
            </div>
            <div>
              <label>Cena hurtowa netto (PLN)</label>
              <input type="number" step="0.01" name="wholesale_price_netto" value="<?= htmlspecialchars($v('wholesale_price_netto')) ?>">
            </div>
          </div>
          <div class="form-group">
            <label style="display:flex; align-items:center; gap:8px; font-weight:600; cursor:pointer;">
              <input type="checkbox" name="is_wholesale_discount" class="custom-checkbox" <?= $v('is_wholesale_discount') ? 'checked' : '' ?>>
              Rabat hurtowy dostępny
            </label>
          </div>
        </div>

        <div class="edit-section">
          <h3>Magazyn</h3>
          <div class="edit-grid grid-1-1">
            <div>
              <label>Stan magazynowy</label>
              <input type="number" name="stock_qty" value="<?= htmlspecialchars($v('stock_qty', '0')) ?>" required>
            </div>
            <div>
              <label>Jednostka</label>
              <input type="text" name="unit" list="units-list" value="<?= htmlspecialchars($v('unit', 'szt.')) ?>" required>
              <datalist id="units-list">
                <option value="szt."></option>
                <option value="kg"></option>
                <option value="m"></option>
                <option value="opak."></option>
                <option value="zestaw"></option>
                <option value="paczka"></option>
                <option value="rolka"></option>
                <option value="komplet"></option>
              </datalist>
            </div>
          </div>
        </div>
      </div> <!-- end pel-main -->

      <div class="pel-sidebar">
        <div class="edit-section">
          <h3>Opis i zdjęcie</h3>
          <div class="form-group" style="margin-bottom:20px;">
            <label>Zdjęcie <span style="font-size: 0.8em; color: var(--text-muted, #777); font-weight: normal; margin-left: 8px;">(opcjonalne)</span></label>
            <input type="hidden" name="image_existing" value="<?= htmlspecialchars($v('image')) ?>">
            <div class="photo-picker">
              <div class="photo-preview" id="photo-preview-box">
                <img id="image_preview" src="<?= htmlspecialchars($imgSrc($v('image'))) ?>" style="<?= $v('image') ? '' : 'display: none;' ?>">
                <span class="photo-preview-placeholder" id="photo-preview-placeholder" style="<?= $v('image') ? 'display: none;' : '' ?>">Brak zdjęcia</span>
              </div>
              <div class="photo-picker-controls">
                <input type="file" name="image_file" id="image_file" accept="image/*" class="photo-file-input">
                <label for="image_file" class="btn btn-outline btn-sm">Wybierz zdjęcie</label>
                <span class="photo-filename" id="photo-filename"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Opis <span style="font-size: 0.8em; color: var(--text-muted, #777); font-weight: normal; margin-left: 8px;">(opcjonalne)</span></label>
            <textarea name="description" rows="4"><?= htmlspecialchars($v('description')) ?></textarea>
          </div>
        </div>

        <div class="edit-section">
          <h3>Specyfikacja <span style="font-size: 0.8em; color: var(--text-muted, #777); font-weight: normal; margin-left: 8px;">(opcjonalne)</span></h3>
          <div class="form-group">
            <input type="hidden" name="specs" id="specs-hidden" value="<?= htmlspecialchars($specsDisplay) ?>">
            <div id="specs-container"></div>
            <button type="button" id="add-spec-btn" class="btn-outline" style="margin-top: 10px; font-size: 0.9em; padding: 6px 12px; cursor: pointer;">
              + Dodaj parametr
            </button>
          </div>
        </div>
      </div> <!-- end pel-sidebar -->
      </div> <!-- end product-edit-layout -->

        <div style="display:flex; gap:16px; border-top:1px solid var(--border-color); padding-top:24px;">
          <button type="submit" class="btn-primary">
            <i data-lucide="save" class="lucide-icon"></i> <?= $isNewProduct ? 'Dodaj produkt' : 'Zapisz zmiany' ?>
          </button>
          <a href="products.php" class="btn-outline">Anuluj</a>
        </div>
      </form>
    </div>
  </div>
</main>
<script>
lucide.createIcons();

// 1. Kategoria auto-fill
document.getElementById('category-select').addEventListener('change', function() {
    var labelInput = document.getElementById('category_label_input');
    var selectedOption = this.options[this.selectedIndex];
    labelInput.value = selectedOption.text;
});

// 2. Cena brutto auto-calculate (23% VAT)
const priceNetto = document.getElementById('price_netto');
const priceBrutto = document.getElementById('price_brutto');
let lastCalculatedBrutto = null;

priceNetto.addEventListener('input', function() {
    const netto = parseFloat(this.value);
    if (!isNaN(netto)) {
        const calculated = (netto * 1.23).toFixed(2);
        if (priceBrutto.value === '' || priceBrutto.value === lastCalculatedBrutto || parseFloat(priceBrutto.value) === 0) {
            priceBrutto.value = calculated;
            lastCalculatedBrutto = calculated;
        }
    }
});
priceBrutto.addEventListener('input', function() {
    lastCalculatedBrutto = null;
});

// 3. Dynamic Key/Value Spec Builder
const specsHidden = document.getElementById('specs-hidden');
const specsContainer = document.getElementById('specs-container');
const addSpecBtn = document.getElementById('add-spec-btn');
const mainForm = document.getElementById('product-form');

let currentSpecs = {};
try {
    currentSpecs = JSON.parse(specsHidden.value || '{}');
} catch(e) {
    currentSpecs = {};
}

function createSpecRow(key = '', val = '') {
    const row = document.createElement('div');
    row.style.display = 'flex';
    row.style.gap = '10px';
    row.style.marginBottom = '10px';
    row.className = 'spec-row';
    
    const inputKey = document.createElement('input');
    inputKey.type = 'text';
    inputKey.placeholder = 'Klucz (np. Waga)';
    inputKey.value = key;
    inputKey.className = 'spec-key';
    inputKey.style.flex = '1';
    
    const inputVal = document.createElement('input');
    inputVal.type = 'text';
    inputVal.placeholder = 'Wartość (np. 1kg)';
    inputVal.value = val;
    inputVal.className = 'spec-val';
    inputVal.style.flex = '1';
    
    const removeBtn = document.createElement('button');
    removeBtn.type = 'button';
    removeBtn.textContent = '✕';
    removeBtn.className = 'btn-outline';
    removeBtn.style.padding = '0 12px';
    removeBtn.style.color = 'var(--danger-red, #dc3545)';
    removeBtn.style.borderColor = 'var(--danger-red, #dc3545)';
    removeBtn.style.cursor = 'pointer';
    removeBtn.onclick = function() {
        specsContainer.removeChild(row);
    };
    
    row.appendChild(inputKey);
    row.appendChild(inputVal);
    row.appendChild(removeBtn);
    specsContainer.appendChild(row);
}

for (const [k, v] of Object.entries(currentSpecs)) {
    createSpecRow(k, v);
}

addSpecBtn.addEventListener('click', () => createSpecRow());

mainForm.addEventListener('submit', function() {
    const newSpecs = {};
    const rows = specsContainer.querySelectorAll('.spec-row');
    rows.forEach(row => {
        const k = row.querySelector('.spec-key').value.trim();
        const v = row.querySelector('.spec-val').value.trim();
        if (k !== '') {
            newSpecs[k] = v;
        }
    });
    specsHidden.value = JSON.stringify(newSpecs);
});

document.getElementById('image_file')?.addEventListener('change', function() {
    const preview = document.getElementById('image_preview');
    const placeholder = document.getElementById('photo-preview-placeholder');
    const filenameEl = document.getElementById('photo-filename');
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
        filenameEl.textContent = file.name;
    } else {
        const existing = document.querySelector('input[name="image_existing"]').value;
        filenameEl.textContent = '';
        if (existing) {
            preview.src = /^https?:\/\//.test(existing) ? existing : '/' + existing.replace(/^\.?\/*/, '');
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        } else {
            preview.src = '';
            preview.style.display = 'none';
            placeholder.style.display = 'block';
        }
    }
});
</script>
</body>
</html>
