# Śliwa FH — Backend Setup (Hostinger)

## 1. Database
1. In hPanel → Hosting → Databases, create a MariaDB database + user, note the credentials.
2. Open phpMyAdmin, select the new database, go to **Import**, and import `schema.sql`, then `seed.sql` (seeds the 15 existing products so the catalog isn't empty on launch).

## 2. Config
Edit `config.php` and fill in the real values:
```php
define('DB_HOST', 'localhost');   // usually 'localhost' on Hostinger
define('DB_NAME', '...');
define('DB_USER', '...');
define('DB_PASS', '...');
```

## 3. Create your first admin login
Over SSH (or Hostinger's terminal if available):
```
php create-admin.php twoj_login twoje_haslo
```
Repeat once per staff member who needs access. Delete or move `create-admin.php` out of the public webroot afterward — it's meant to be run once, not left reachable over HTTP.

## 4. Upload
Upload the whole `backend/` folder to the same place as `index.html`/`app.js` on Hostinger, so the paths `/backend/api/products.php` etc. that `app.js` calls resolve correctly.

## 5. Log in
Visit `yoursite.com/backend/admin/login.php`.

## Notes
- Order/quote emails use PHP's built-in `mail()` — if they don't arrive, check Hostinger's mail logs; shared hosting `mail()` deliverability can be inconsistent. Swap in SMTP (PHPMailer) if that becomes a problem.
- Multiple staff can be logged into the admin panel at once and edit products concurrently — MariaDB handles that natively, no extra setup needed.
