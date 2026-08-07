<?php
require_once __DIR__ . '/includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quoteId = (int)($_POST['quote_id'] ?? 0);
    $status = $_POST['status'] ?? '';
    if ($quoteId && in_array($status, ['new', 'responded', 'closed'], true)) {
        db()->prepare('UPDATE quote_requests SET status = ? WHERE id = ?')->execute([$status, $quoteId]);
    }
    header('Location: quotes.php');
    exit;
}

$quotes = db()->query('SELECT * FROM quote_requests ORDER BY created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="UTF-8"><title>Zapytania B2B — Panel Śliwa FH</title></head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
  <header class="admin-header">
    <div class="header-title">Zapytania Hurtowe B2B (<?= count($quotes) ?>)</div>
  </header>
  <div class="admin-content">
    <?php if (!$quotes): ?>
      <p style="color:var(--text-muted);">Brak zapytań.</p>
    <?php endif; ?>
    <?php foreach ($quotes as $q): ?>
      <div class="item-card">
        <div class="item-header">
          <div>
            <div class="item-title"><?= htmlspecialchars($q['company_name']) ?></div>
            <div class="item-meta" style="margin-top:4px;">
              <span>NIP: <?= htmlspecialchars($q['nip']) ?></span>
              <span>·</span>
              <span><?= htmlspecialchars($q['contact_phone']) ?></span>
              <span>·</span>
              <span><?= $q['created_at'] ?></span>
              <span class="badge badge-<?= $q['status'] ?>" style="margin-left:8px;"><?= $q['status'] ?></span>
            </div>
          </div>
          <form method="POST" class="item-actions">
            <input type="hidden" name="quote_id" value="<?= $q['id'] ?>">
            <select name="status" style="width:auto; padding:8px 12px;">
              <?php foreach (['new', 'responded', 'closed'] as $s): ?>
                <option value="<?= $s ?>" <?= $q['status'] === $s ? 'selected' : '' ?>><?= $s ?></option>
              <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-secondary btn-sm">Zapisz</button>
          </form>
        </div>
        <div class="item-details">
          <p style="margin:0; font-size:0.9rem; white-space:pre-wrap; line-height:1.6;"><?= htmlspecialchars($q['message']) ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  </main>
</div>
</body>
</html>
