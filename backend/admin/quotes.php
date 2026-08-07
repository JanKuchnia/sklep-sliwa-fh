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
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Zapytania B2B — Panel Śliwa FH</title></head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
    <div class="section-header">
      <div class="section-title-group">
        <h2>Zapytania Hurtowe B2B (<?= count($quotes) ?>)</h2>
        <p>Odpowiadaj na wiadomości od firm budowlanych</p>
      </div>
    </div>
    
    <?php if (!$quotes): ?>
      <div class="form-card" style="text-align:center; padding:60px 20px;">
        <i data-lucide="inbox" class="lucide-icon" style="font-size:3rem; color:var(--text-light); margin-bottom:16px; display:block; margin:0 auto 16px;"></i>
        <p style="color:var(--text-muted); font-weight:600;">Brak zapytań do wyświetlenia.</p>
      </div>
    <?php endif; ?>
    
    <?php foreach ($quotes as $q): ?>
      <div class="item-card">
        <div class="item-header">
          <div>
            <div class="item-title">
              <i data-lucide="building-2" class="lucide-icon" style="color:var(--b2b-blue); margin-right:6px;"></i>
              <?= htmlspecialchars($q['company_name']) ?>
            </div>
            <div class="item-meta" style="margin-top:4px;">
              <span class="mono-text">NIP: <?= htmlspecialchars($q['nip']) ?></span>
              <span>·</span>
              <span style="display:flex; align-items:center; gap:4px;"><i data-lucide="phone" class="lucide-icon" style="width:14px;height:14px;"></i> <?= htmlspecialchars($q['contact_phone']) ?></span>
              <span>·</span>
              <span style="display:flex; align-items:center; gap:4px;"><i data-lucide="calendar" class="lucide-icon" style="width:14px;height:14px;"></i> <?= $q['created_at'] ?></span>
              <span class="status-pill badge-<?= $q['status'] ?>" style="margin-left:8px;"><?= $q['status'] ?></span>
            </div>
          </div>
          <form method="POST" class="item-actions">
            <input type="hidden" name="quote_id" value="<?= $q['id'] ?>">
            <select name="status" style="width:auto; padding:8px 36px 8px 12px; font-weight:600; font-size:0.85rem; border-color:var(--border-color);">
              <?php foreach (['new' => 'Nowe', 'responded' => 'Odpowiedziano', 'closed' => 'Zakończone'] as $val => $label): ?>
                <option value="<?= $val ?>" <?= $q['status'] === $val ? 'selected' : '' ?>><?= $label ?></option>
              <?php endforeach; ?>
            </select>
            <button type="submit" class="btn-primary btn-sm">Zapisz</button>
          </form>
        </div>
        <div class="item-details">
          <p style="margin:0; font-size:0.95rem; white-space:pre-wrap; line-height:1.6; color:var(--text-main);"><?= htmlspecialchars($q['message']) ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>
<script>lucide.createIcons();</script>
</body>
</html>
