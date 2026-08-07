<?php
// Public endpoint: GET /api/products.php
// Returns the product catalog as JSON, same shape as the old hardcoded PRODUCTS_DB in app.js.

require_once __DIR__ . '/../config.php';
header('Content-Type: application/json; charset=utf-8');

$rows = db()->query('SELECT * FROM products ORDER BY category, name')->fetchAll();

$products = array_map(function ($p) {
    return [
        'id' => $p['id'],
        'sku' => $p['sku'],
        'name' => $p['name'],
        'category' => $p['category'],
        'categoryLabel' => $p['category_label'],
        'brand' => $p['brand'],
        'material' => $p['material'],
        'isBestseller' => (bool)$p['is_bestseller'],
        'isNew' => (bool)$p['is_new'],
        'isPromo' => (bool)$p['is_promo'],
        'isWholesaleDiscount' => (bool)$p['is_wholesale_discount'],
        'priceNetto' => (float)$p['price_netto'],
        'priceBrutto' => (float)$p['price_brutto'],
        'wholesaleMinQty' => $p['wholesale_min_qty'] !== null ? (int)$p['wholesale_min_qty'] : null,
        'wholesalePriceNetto' => $p['wholesale_price_netto'] !== null ? (float)$p['wholesale_price_netto'] : null,
        'stockQty' => (int)$p['stock_qty'],
        'unit' => $p['unit'],
        'image' => $p['image'],
        'description' => $p['description'],
        'specs' => json_decode($p['specs'] ?? '{}', true) ?: new stdClass(),
    ];
}, $rows);

echo json_encode($products, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
