<link rel="stylesheet" href="admin.css">
<script src="https://unpkg.com/lucide@latest"></script>
<header class="main-header">
  <div class="header-container">
    <a href="index.php" class="brand-logo">
      <div class="logo-icon">
        <i data-lucide="wrench" class="lucide-icon"></i>
      </div>
      <div class="logo-text">
        <div class="brand-name">ŚLIWA <span>FH</span></div>
        <div class="brand-sub">Panel Administracyjny</div>
      </div>
    </a>
    <div class="header-actions">
      <div style="font-weight:600; font-size:0.9rem; color:var(--text-main); display:flex; align-items:center; gap:6px;">
        <i data-lucide="user" class="lucide-icon" style="color:var(--text-muted);"></i>
        <?= htmlspecialchars($_SESSION['admin_username'] ?? '') ?>
      </div>
      <a href="logout.php" class="btn-outline btn-sm">
        <i data-lucide="log-out" class="lucide-icon"></i> Wyloguj
      </a>
    </div>
  </div>
</header>
<nav class="sub-nav">
  <div class="sub-nav-container">
    <ul class="nav-links">
      <?php $page = basename($_SERVER['PHP_SELF']); ?>
      <li><a href="index.php" class="nav-link <?= $page === 'index.php' ? 'active' : '' ?>"><i data-lucide="layout-dashboard" class="lucide-icon"></i> Dashboard</a></li>
      <li><a href="products.php" class="nav-link <?= $page === 'products.php' || $page === 'product-edit.php' ? 'active' : '' ?>"><i data-lucide="package" class="lucide-icon"></i> Produkty</a></li>
      <li><a href="orders.php" class="nav-link <?= $page === 'orders.php' ? 'active' : '' ?>"><i data-lucide="shopping-cart" class="lucide-icon"></i> Zamówienia</a></li>
      <li><a href="quotes.php" class="nav-link <?= $page === 'quotes.php' ? 'active' : '' ?>"><i data-lucide="file-text" class="lucide-icon"></i> Zapytania B2B</a></li>
    </ul>
  </div>
</nav>
<main class="app-content">
  <div class="section-container">
