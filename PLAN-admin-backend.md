# Plan: Backend + Admin Dashboard for Śliwa FH

Status: **DRAFT — awaiting client approval before any code is written.**

## Current state (why this is a from-scratch build, not an add-on)
The storefront is a static frontend only — no server exists today.
- `PRODUCTS_DB` (16 products, prices, stock, bestseller flags) is a hardcoded array in `app.js`. Every product change today means editing JS by hand and redeploying.
- `submitCartOrder()` and `submitB2BQuote()` (`app.js`) don't send anything anywhere — they just show a success toast and clear the form. **Pickup reservations and B2B quote requests are currently not received or stored at all.**
- There is no login, no database, no API.

So "admin dashboard for each meaningful function" = build a real backend (API + DB + auth) and a dashboard on top of it, then wire the existing storefront forms to actually call it.

## Proposed stack (lazy/minimal, matched to a single small store)
- **Node.js + Express** — one small service, no framework overkill for this traffic level.
- **SQLite** (via `better-sqlite3`) — a wholesale/retail store with ~20 products and a handful of daily orders doesn't need Postgres/hosted DB ops. One file, trivial backups, zero infra to manage. Upgrade path noted below if that ever changes.
- **Session-based admin login** (single/few admin accounts, `express-session` + hashed password) — no need for OAuth/roles/permissions system for a 1-3 person office.
- **Admin dashboard**: server-rendered pages (EJS or plain HTML+fetch) rather than a separate React app — one deployable, no build step, matches the plain-HTML style of the existing storefront.
- Storefront (`index.html`/`app.js`) stays static; it just calls the new API instead of faking success.

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

## Next step once approved
Scaffold: Express API + SQLite schema (products, orders, order_items, quotes) + admin login + the 3 dashboard screens above, then wire `app.js` to call the real API.
