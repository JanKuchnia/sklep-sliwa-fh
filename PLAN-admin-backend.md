# Plan: Backend + Admin Dashboard for Śliwa FH

Status: **APPROVED (client answers 2026-08-07) — stack revised, building now.**

## Client Answers (2026-08-07)
- Hosting: **Hostinger shared hosting → PHP + MariaDB (phpMyAdmin available).** Stack below revised from Node/SQLite to PHP/MariaDB accordingly.
- Multiple staff (e.g. 3 people) need the admin panel open concurrently, all adding products — MariaDB handles concurrent writes natively, no special locking needed, just make sure each admin has their own login/session.
- No payment processing — confirmed out of scope. Flow: customer builds cart → submits → order is (a) stored in the admin panel inbox and (b) emailed to the store. Customer pays in person at pickup.

## Current state (why this is a from-scratch build, not an add-on)
The storefront is a static frontend only — no server exists today.
- `PRODUCTS_DB` (16 products, prices, stock, bestseller flags) is a hardcoded array in `app.js`. Every product change today means editing JS by hand and redeploying.
- `submitCartOrder()` and `submitB2BQuote()` (`app.js`) don't send anything anywhere — they just show a success toast and clear the form. **Pickup reservations and B2B quote requests are currently not received or stored at all.**
- There is no login, no database, no API.

So "admin dashboard for each meaningful function" = build a real backend (API + DB + auth) and a dashboard on top of it, then wire the existing storefront forms to actually call it.

## Stack (revised for Hostinger: PHP + MariaDB)
- **Plain PHP (PDO + prepared statements)** — no framework (Laravel etc. is overkill for this scope and adds a Composer/deploy step Hostinger shared hosting doesn't need).
- **MariaDB** via phpMyAdmin-manageable schema — tables: `products`, `orders`, `order_items`, `quote_requests`, `admin_users`.
- **PHP sessions + password_hash()** for admin login — each staff member gets their own account, so 3 people can be logged in and editing concurrently; MariaDB row-level writes handle the concurrency, no extra locking needed.
- **Admin dashboard**: plain PHP pages (no build step), same plain-HTML style as the storefront.
- **Storefront (`index.html`/`app.js`)**: `app.js` currently hardcodes `PRODUCTS_DB` as a literal array — this becomes a `fetch('/api/products.php')` call instead, so admin-added products show up live. `submitCartOrder()`/`submitB2BQuote()` POST to `/api/submit-order.php` / `/api/submit-quote.php` instead of just showing a toast.
- **Order notification**: PHP `mail()` to `biuro@fhsliwa.com.pl` on new order/quote (ponytail: built-in, no library; upgrade to SMTP/PHPMailer later if Hostinger's `mail()` deliverability turns out unreliable — common shared-hosting gotcha, flagging as the ceiling on this shortcut).

## Meaningful functions → admin screens

1. **Product catalog management** (replaces hand-editing `PRODUCTS_DB` in app.js)
   - List/search products, add/edit/delete, edit price (netto+brutto), stock qty, category/subcategory, specs, image.
   - Public catalog API endpoint the storefront fetches instead of the hardcoded array.
   - *Highest value — this is the thing that currently requires a code deploy for a price change.*

2. **Pickup order inbox** (makes `submitCartOrder()` real)
   - Storefront POSTs cart + customer name/phone to the API, stored as an order.
   - Admin view: list of pending/confirmed/picked-up orders, mark status, see items/qty/customer contact.

3. **B2B wholesale quote inbox** (makes `submitB2BQuote()` real)
   - Storefront POSTs company/NIP/message to the API.
   - Admin view: list of quote requests, mark responded/closed.

4. **Stock & flags toggle** (folds into #1, called out separately since it's the fastest-changing data)
   - Stock qty, `isBestseller`, and the new `isNew`/`isPromo` flags (added today for the Promocje/Nowości/Polecane tab) — one-click toggles in the product list rather than full edit form.

## Explicitly out of scope for v1 (skip — say if you want them)
- Category/subcategory structure editing — only 5 categories, changes rarely; keep in code. Add later if it becomes a real pain point.
- Contact info (address/phone/hours) editing — same reasoning, ~4 lines of static HTML, not worth a DB table.
- Multi-admin roles/permissions — start with one shared admin login, split later if staff count grows.
- Payment processing — current flow is pickup-reservation only (pay in person), no online payment needed.

## Upgrade path notes (ponytail: naming the ceiling)
- SQLite → Postgres if the store ever needs multi-location/concurrent-write scale it doesn't have today.
- Session auth → proper auth provider if staff count grows past a few trusted people.

## Open questions for you
1. Where will this be hosted? (VPS, existing hosting panel, etc. — determines deploy approach)
2. Should pickup-order/quote notifications also email or Telegram-ping the office when a new one comes in, or is checking the dashboard enough?
3. OK with SQLite, or do you already have a database/hosting preference?

## Build status: DONE
- `backend/schema.sql` + `backend/seed.sql` — 5 tables, seeded with all 15 existing products.
- `backend/config.php` — DB connection (needs real Hostinger credentials filled in).
- `backend/create-admin.php` — CLI script to create staff logins.
- `backend/api/products.php`, `submit-order.php`, `submit-quote.php` — public endpoints the storefront calls.
- `backend/admin/` — login, dashboard home, product CRUD (+ one-click bestseller/new/promo toggles), order inbox, B2B quote inbox.
- `app.js` — now fetches the live catalog from `/backend/api/products.php` on load (falls back to the old hardcoded array if the API is unreachable), and the checkout/B2B forms POST to the real endpoints instead of faking success.
- All PHP files pass `php -l`, `app.js` passes `node -c`.
- See `backend/README.md` for deploy steps (import schema+seed via phpMyAdmin, fill in `config.php`, create admin logins, upload).
