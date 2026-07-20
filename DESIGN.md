---
name: Śliwa FH
description: Industrial-premium storefront for a Rzeszotary garden & construction hardware wholesaler.
colors:
  bg-primary: "#f8fafc"
  bg-surface: "#ffffff"
  bg-surface-elevated: "#f1f5f9"
  bg-dark-slate: "#0f172a"
  bg-slate-card: "#1e293b"
  text-main: "#0f172a"
  text-muted: "#64748b"
  text-light: "#94a3b8"
  text-white: "#ffffff"
  accent-orange: "#f97316"
  accent-orange-hover: "#ea580c"
  amber-gold: "#f59e0b"
  b2b-blue: "#2563eb"
  b2b-blue-hover: "#1d4ed8"
  emerald-green: "#10b981"
  border-color: "#e2e8f0"
  border-dark: "#334155"
typography:
  display:
    fontFamily: "Plus Jakarta Sans, sans-serif"
    fontSize: "2.8rem"
    fontWeight: 800
    lineHeight: 1.15
    letterSpacing: "-0.02em"
  headline:
    fontFamily: "Plus Jakarta Sans, sans-serif"
    fontSize: "1.75rem"
    fontWeight: 800
    lineHeight: 1.25
  title:
    fontFamily: "Plus Jakarta Sans, sans-serif"
    fontSize: "1.05rem"
    fontWeight: 700
    lineHeight: 1.35
  body:
    fontFamily: "Inter, sans-serif"
    fontSize: "1rem"
    fontWeight: 400
    lineHeight: 1.5
  label:
    fontFamily: "Inter, sans-serif"
    fontSize: "0.8rem"
    fontWeight: 700
    letterSpacing: "0.04em"
  mono:
    fontFamily: "JetBrains Mono, monospace"
    fontWeight: 500
rounded:
  sm: "6px"
  md: "10px"
  lg: "16px"
  full: "9999px"
spacing:
  sm: "8px"
  md: "16px"
  lg: "24px"
  xl: "40px"
components:
  button-primary:
    backgroundColor: "{colors.accent-orange}"
    textColor: "{colors.text-white}"
    rounded: "{rounded.md}"
    padding: "14px 28px"
  button-primary-hover:
    backgroundColor: "{colors.accent-orange-hover}"
  button-outline:
    backgroundColor: "transparent"
    textColor: "{colors.text-main}"
    rounded: "{rounded.md}"
    padding: "10px 20px"
  button-b2b:
    backgroundColor: "{colors.b2b-blue}"
    textColor: "{colors.text-white}"
    rounded: "{rounded.md}"
  product-card:
    backgroundColor: "{colors.bg-surface}"
    rounded: "{rounded.lg}"
  price-mode-switch:
    backgroundColor: "{colors.bg-surface-elevated}"
    rounded: "{rounded.full}"
---

# Design System: Śliwa FH

## 1. Overview

**Creative North Star: "The Warehouse Ledger"**

The site reads like a well-run stock ledger you can trust, not a pitch deck. A near-black slate anchors the header, footer, and any surface carrying authority (hours, pricing totals, cart totals); an off-white paper background carries the browsing surfaces; one loud, singular orange marks the one action that matters on any given screen (add to cart, primary CTA), while a separate blue is reserved exclusively for the B2B/wholesale track so the two audiences never visually collide. Nothing is soft-launched with a gradient or a glow; borders are real 1px lines, cards sit flush until you touch them, and elevation exists only as a response, never as ambient decoration.

This system explicitly rejects the generic SaaS/AI-slop landing page: no gradient text, no tiny uppercase tracked eyebrows stacked above every section, no 01/02/03 numbered scaffolding, no identical icon+heading+text card grids repeated as filler, no cream/sand/parchment default palette standing in for "warmth." Warmth here comes from plain trade language and real numbers (stock counts, SKUs, netto/brutto prices), not from typographic ornament.

**Key Characteristics:**
- Dark slate + paper-white duality: authority surfaces are dark, browsing surfaces are light.
- One orange accent for retail action, one blue accent for wholesale action — never mixed on the same control.
- Flat by default; shadow and lift only ever signal "this is interactive."
- Real borders, real numbers, no invented specs or reviews.

## 2. Colors

A two-neutral, two-accent palette: slate for authority, paper for browsing, orange for the retail CTA, blue for the wholesale track.

### Primary
- **Warehouse Orange** (#f97316, hover #ea580c): the single retail call-to-action color — "Przeglądaj Katalog," "Dodaj do koszyka," cart total, hero tag. Used sparingly and only where a click or a total actually matters.

### Secondary
- **Ledger Blue** (#2563eb, hover #1d4ed8): reserved exclusively for the B2B/wholesale track — the B2B mode toggle, "Zamówienia Hurtowe" nav link, the wholesale-tier pricing table. Never appears on a retail-facing control; its presence alone tells the user "you are now in the wholesale lane."

### Tertiary
- **Stock Emerald** (#10b981): status-only — "open now" pill, in-stock badges, availability confirmations. Never decorative, always a state signal.
- **Ledger Gold** (#f59e0b): the trust badge (star rating) only.

### Neutral
- **Slate Authority** (#0f172a): header ticker, footer, cart drawer header, primary heading text. The color of things that are certain and non-negotiable (hours, address, totals).
- **Paper Surface** (#ffffff / #f8fafc body / #f1f5f9 elevated): the browsing canvas — catalog grid, cards, filter sidebar.
- **Muted Ledger Text** (#64748b): secondary copy, spec snippets, helper text.
- **Hairline Border** (#e2e8f0 light / #334155 on dark): every card, input, and table row boundary. Always a real 1px line, never a soft shadow standing in for a border.

### Named Rules
**The Two-Lane Rule.** Orange is the retail lane, blue is the wholesale lane. A single control is never styled with both; a user should be able to tell which price mode they're in from color alone, without reading the label.

## 3. Typography

**Display Font:** Plus Jakarta Sans (with system sans-serif fallback)
**Body Font:** Inter (with system sans-serif fallback)
**Label/Mono Font:** JetBrains Mono (for SKUs, prices, and anything that should read as a ledger entry)

**Character:** A geometric-leaning display sans for confident headings, paired with a plain, highly legible body sans; mono is reserved for anything numeric or code-like (SKU codes, prices), reinforcing the "ledger" metaphor at the type level.

### Hierarchy
- **Display** (800 weight, 2.8rem, 1.15 line-height, -0.02em tracking): hero heading only ("Hurtownia Narzędzi Ogrodniczo-Budowlanych").
- **Headline** (800 weight, 1.75rem): section headers ("Kategorie Produktów", "Polecane & Bestsellery").
- **Title** (700 weight, 1.05rem): product card titles, feature card titles.
- **Body** (400 weight, 1rem, 1.5 line-height): descriptions, paragraph copy; capped conceptually at ~70ch measure inside cards and info panels.
- **Label** (700 weight, 0.8rem, 0.04em tracking, uppercase only for short badges/tags like category pills): never full sentences.
- **Mono** (500–700 weight): SKUs, prices, cart totals — anything that should feel like a read-out, not prose.

### Named Rules
**The Ledger-Numeral Rule.** Any number a customer might act on — a price, a SKU, a stock count, a cart total — renders in mono. If it's not in mono, it's not a number the customer should trust as final.

## 4. Elevation

Flat at rest, lift on interaction. Every surface (product card, feature card, category card, button) sits flush with no shadow in its default state; a shadow plus a small `translateY(-2px to -4px)` appears only on hover/focus, functioning purely as an affordance signal ("this responds to you"), never as ambient depth. The one exception is the sticky header, which carries a permanent soft shadow (`--shadow-sm`) purely to separate it from scrolling content, and the cart drawer, which carries a directional shadow as it slides in from the edge of the viewport.

### Shadow Vocabulary
- **shadow-sm** (`0 1px 3px rgba(15, 23, 42, 0.06)`): sticky header separation, feature cards at rest.
- **shadow-md** (`0 4px 12px rgba(15, 23, 42, 0.08)`): hover state for cards and the cart trigger button.
- **shadow-lg** (`0 12px 32px rgba(15, 23, 42, 0.12)`): hero banner, filter sidebar, search dropdown, single-product container — the "important surface" shadow.
- **shadow-orange** (`0 8px 24px rgba(249, 115, 22, 0.25)`): exclusively on the primary orange CTA, at rest and stronger on hover — the one shadow allowed to carry brand color.

### Named Rules
**The Response-Only Rule.** If a shadow is visible before the user touches the element, it had better be justified by z-index (sticky header, drawer, dropdown), not by decoration. Cards, buttons, and badges earn their shadow only on hover/focus.

## 5. Components

### Buttons
- **Shape:** rounded-md (10px radius), pill-shaped for the price-mode switch and cart trigger (full radius, 9999px).
- **Primary:** orange background (#f97316), white text, 14px/28px padding, `shadow-orange` at rest, deepens to #ea580c with `translateY(-2px)` on hover.
- **Secondary:** translucent white-on-slate for hero context, or bordered outline (1px `--border-color`) on light surfaces for lower-emphasis actions.
- **B2B variant:** same shape family, blue background (#2563eb) instead of orange — the wholesale lane's dedicated CTA color, used only on `.btn-b2b` and the B2B mode toggle.

### Chips / Badges
- **Style:** small, uppercase, 0.72rem, tinted background matching the semantic role (emerald tint for in-stock, blue tint for wholesale-tier), never gray-on-gray.
- **State:** static status indicators, not interactive — badges describe, they don't trigger.

### Cards / Containers
- **Corner Style:** rounded-lg (16px) for product/category/feature cards and containers; rounded-md (10px) for smaller inline elements.
- **Background:** white on the light canvas; `--bg-surface-elevated` (#f1f5f9) for image wells and elevated info blocks.
- **Shadow Strategy:** see Elevation — flat at rest, `shadow-md` on hover with a 4px lift.
- **Border:** always a real 1px `--border-color` hairline; never a colored side-stripe accent.
- **Internal Padding:** 20-24px standard card padding, 36-40px for the single-product and hero containers.

### Inputs / Fields
- **Style:** 1px hairline border, `--bg-surface-elevated` background, full-radius for the search bar, `--radius-md` for form fields.
- **Focus:** border shifts to accent-orange, background lifts to pure white, plus a 3px orange glow ring (`box-shadow: 0 0 0 3px var(--accent-orange-light)`).
- **Error / Disabled:** not yet defined in the current build — see Do's and Don'ts.

### Navigation
- **Style:** two-tier — a dark slate ticker bar (hours/phone) above a sticky, backdrop-blurred white header (logo, search, price toggle, cart), then a light sub-nav row of category links. Active/hover states underline in orange (or blue for the B2B link specifically). Mobile stacks the ticker and header vertically and lets the sub-nav scroll horizontally.

### Price Mode Switch (signature component)
A pill-shaped segmented control that is the site's clearest piece of brand logic made visual: the B2C side stays neutral (white-on-surface) while the B2B side, once active, turns solid blue. It is the one place color alone communicates state, deliberately, per the Two-Lane Rule.

## 6. Do's and Don'ts

### Do:
- **Do** keep every number a customer might act on (price, SKU, stock count, cart total) in JetBrains Mono, per the Ledger-Numeral Rule.
- **Do** use real 1px hairline borders (#e2e8f0) on every card and input; never simulate a border with only a shadow.
- **Do** keep orange exclusively on retail actions and blue exclusively on wholesale actions, per the Two-Lane Rule.
- **Do** hold cards and buttons flat at rest; only add shadow and lift as a hover/focus response, per the Response-Only Rule.
- **Do** write plain Polish trade terminology in copy — SKU codes, exact dimensions, norms (DIN, EN) — never vague marketing adjectives.

### Don't:
- **Don't** use gradient text or `background-clip: text` treatments anywhere — PRODUCT.md explicitly rejects the SaaS/AI-slop landing-page look.
- **Don't** add tiny uppercase tracked eyebrows above every section (no "ASORTYMENT" / "KATALOG" kickers stacked over headings).
- **Don't** introduce 01/02/03 numbered section scaffolding; nothing on this site is an ordered sequence.
- **Don't** repeat identical icon+heading+text card grids as filler beyond the existing four-item feature row; if a new section needs cards, vary the layout.
- **Don't** shift the body background toward a cream/sand/parchment near-white "for warmth" — the palette is cool slate/paper by design; warmth comes from copy and orange, not from a tinted neutral.
- **Don't** invent stock counts, review quotes, prices, or hours not present in `INFO/brief.md` or explicitly confirmed — several facts (exact hours, exact address) are flagged unresolved in `INFO/research.md` and must not be dressed up as certain in the UI.
- **Don't** style a control with both orange and blue at once; it breaks the Two-Lane Rule and confuses which price mode is active.
