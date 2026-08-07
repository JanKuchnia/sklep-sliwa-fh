<?php
// Public endpoint: POST /api/submit-order.php
// Body (JSON): { customerName, customerPhone, items: [{ id, name, qty, priceBrutto }] }
// Stores the pickup reservation for the admin inbox and emails the store.

require_once __DIR__ . '/../config.php';
header('Content-Type: application/json; charset=utf-8');

$data = json_decode(file_get_contents('php://input'), true);

$name = trim($data['customerName'] ?? '');
$phone = trim($data['customerPhone'] ?? '');
$items = $data['items'] ?? [];

if ($name === '' || $phone === '' || !is_array($items) || count($items) === 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Brak wymaganych danych (imię, telefon, produkty).']);
    exit;
}

$pdo = db();
$pdo->beginTransaction();

$stmt = $pdo->prepare('INSERT INTO orders (customer_name, customer_phone) VALUES (?, ?)');
$stmt->execute([$name, $phone]);
$orderId = $pdo->lastInsertId();

$itemStmt = $pdo->prepare(
    'INSERT INTO order_items (order_id, product_id, product_name, qty, price_brutto) VALUES (?, ?, ?, ?, ?)'
);
$summaryLines = [];
foreach ($items as $item) {
    $qty = max(1, (int)($item['qty'] ?? 1));
    $price = (float)($item['priceBrutto'] ?? 0);
    $itemStmt->execute([$orderId, $item['id'] ?? '', $item['name'] ?? '', $qty, $price]);
    $summaryLines[] = "- {$item['name']} x{$qty} (" . number_format($price, 2) . " zł/szt.)";
}

$pdo->commit();

$body = "Nowa rezerwacja odbioru #{$orderId}\n\n"
      . "Klient: {$name}\n"
      . "Telefon: {$phone}\n\n"
      . "Produkty:\n" . implode("\n", $summaryLines) . "\n";

@mail(STORE_EMAIL, "Nowa rezerwacja odbioru #{$orderId}", $body, "From: sklep@fhsliwa.com.pl");

echo json_encode(['success' => true, 'orderId' => $orderId]);
