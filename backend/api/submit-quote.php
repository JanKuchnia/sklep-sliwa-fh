<?php
// Public endpoint: POST /api/submit-quote.php
// Body (JSON): { company, nip, contactName, phone, message }
// Stores the B2B quote request for the admin inbox and emails the store.

require_once __DIR__ . '/../config.php';
header('Content-Type: application/json; charset=utf-8');

$data = json_decode(file_get_contents('php://input'), true);

$company = trim($data['company'] ?? '');
$nip = trim($data['nip'] ?? '');
$contactName = trim($data['contactName'] ?? '');
$phone = trim($data['phone'] ?? '');
$message = trim($data['message'] ?? '');

if ($company === '' || $nip === '' || $phone === '' || $message === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Brak wymaganych danych (firma, NIP, telefon, wiadomość).']);
    exit;
}

$stmt = db()->prepare(
    'INSERT INTO quote_requests (company_name, nip, contact_phone, message) VALUES (?, ?, ?, ?)'
);
$stmt->execute([$company, $nip, $phone, $message]);
$quoteId = db()->lastInsertId();

$body = "Nowe zapytanie B2B #{$quoteId}\n\n"
      . "Firma: {$company}\n"
      . "NIP: {$nip}\n"
      . "Osoba kontaktowa: " . ($contactName ?: '—') . "\n"
      . "Telefon: {$phone}\n\n"
      . "Wiadomość:\n{$message}\n";

@mail(STORE_EMAIL, "Nowe zapytanie B2B #{$quoteId} — {$company}", $body, "From: sklep@fhsliwa.com.pl");

echo json_encode(['success' => true, 'quoteId' => $quoteId]);
