# Plan: Śliwa FH Website Content & Navigation Updates

Based on client note review and codebase audit of `index.html` and `app.js`.

Status: **DONE** — all 11 tasks completed 2026-08-07.

## Client Answers (2026-08-07)
- "Materiały wykonania" filter → **remove**
- "Artykuły" → **skip**, not implementing
- "Lack met" → **skip**, client doesn't remember what it meant
- Chains (task 5) → **actually remove** the chain product + de-emphasize copy, not just reword
- Filter removal (tasks 9–10, and now 11) → **sitewide**, all categories

## Contact Info

1. **Update store address sitewide to "Myślenicka 3, Rzeszotary"**
   Current address ("Rzeszotary 451, 32-040 Świątniki Górne") appears in 6 places that all need updating together: ticker bar (`index.html` lines 23–26), Google Maps link `href` (lines 23, 610), hero copy (line 149), contact section (line 552), map CTA text (line 747), footer (line 996). Also update the `google.com/maps?q=` query params to the new address, and re-check embedded map iframe/pin coordinates if one exists.

2. **Add two new phone numbers as clickable `tel:` links**
   `697 618807` and `+48 693 896 914` (formatted consistently with existing `12 270 43 53` / `601 913 899`). Add to the ticker phone group (`index.html` ~lines 32–36, inside `.ticker-phone-group`), the mobile call button block, and the contact section phone list (~line 550s) alongside the existing two numbers — do not replace the existing numbers, this is additive.

3. **Surface the contact email in the ticker/header, not just the contact page**
   `biuro@fhsliwa.com.pl` already exists in the Contact section (line 566–569) and footer (line 1002) — no new work needed there. Add a mailto link (`mailto:biuro@fhsliwa.com.pl`) to the top ticker bar or header area for parity with the phone numbers, since client explicitly asked to "add" it and it's currently buried below the fold.

## Categories & Navigation

4. **Remove "Odzież" wording from the BHP category label**
   Rename `"BHP & Odzież Robocza"` → `"BHP"` (or "BHP i Ochrona Osobista" if a fuller label is wanted) in all 6 places it's hardcoded: sub-nav link (`index.html` line 110), homepage category card (line 227), desktop sidebar filter (line 326), mobile filter drawer (line 803), mobile nav (line 724), footer link (line 979). Also update `categoryLabel: "BHP & Odzież Robocza"` on product `p-501` in `app.js` (~line 389) since it's rendered directly in some UI states.

5. **Reword "łańcuchy" (chains) marketing copy in favor of "ogrodnicze" (garden) emphasis**
   The site copy currently foregrounds chains in the meta description (line 7), hero subtitle (line 131), and footer tagline (line 968). Reword these three strings to lead with garden/tools framing per client wording ("ogrodnicze" first). Note: the `metalowe` (Artykuły Metalowe) category and its chain product (`p-201`) are real catalog data and are NOT being deleted by this task — see Needs Clarification below for whether the client actually wants the chain product removed from the catalog.

6. **Apply one consistent icon/visual style across all category cards**
   Category cards (`index.html` lines 190–229) and nav links already use distinct Lucide icons per category (`flower-2`, `link`, `paint-bucket`, `hammer`, `shield`) — audit `.category-icon-box` styling to confirm all 5 use identical box size/color treatment (client said "style do narzędzi" = consistent style). This is a CSS-only pass, no icon swap needed unless client flags a specific card as inconsistent.

7. **Add expandable/dropdown categories to navigation**
   No dropdown/expand mechanism currently exists for categories (`nav-links` in `.sub-nav`, line 103–112, is a flat list; same for mobile nav lines 691–734 and sidebar filter list lines 304–330). Add expand/collapse per category showing its subcategories (see per-category lists below) — implement as a `<details>`/`<summary>` or a toggle-class pattern consistent with the existing `.category-filter-item` / `filterCategory()` click pattern in `app.js`. New `filterCategory(cat, subcat)` param or a `data-subcat` attribute would be the natural extension point (`app.js` line 1159 `filterCategory()`).

8. **Add "Promocje / Nowości / Polecane" nav tab**
   No such section exists — there's only a "Polecane & Bestsellery" catalog subsection (index.html line 235) driven by `isBestseller` in `PRODUCTS_DB`. Add a new top-level nav link (sub-nav + mobile nav) routing to a filtered view. Since there's no `isNew` or `isPromo` field in `PRODUCTS_DB` yet, this task requires adding those boolean fields to each product object (`app.js` lines 7–408) before the filter can work — flag to client that "Nowości" and "Promocje" have no backing data today, only "Polecane" (bestseller) does.

### Subcategories per category (mapped to real `PRODUCTS_DB` entries — no invented categories)

- **Ogrodnicze (Narzędzia Ogrodnicze)**: Łopaty (p-101), Grabie (p-102), Węże ogrodowe (p-103), Sekatory (p-104, p-105)
- **Metalowe (Artykuły Metalowe)**: Łańcuchy (p-201 — pending clarification, see below), Kolana/rury dymowe (p-202), Śruby i złącza (p-203)
- **Budowlane (Budowlane & Malarskie)**: Zestawy malarskie/wałki (p-301), Pędzle (p-302), Poziomice (p-303), Taśmy malarskie (p-304)
- **Ręczne (Narzędzia Ręczne)**: Młotki (p-401), Klucze (p-402), Szczypce/kombinerki (p-403)
- **BHP**: Rękawice ochronne (p-501) — only one product exists, so this category has no real subcategory split yet; flag to client that more BHP SKUs are needed before dropdown subcategories are meaningful here.

## Garden Category Filters (sidebar, `index.html` lines 299–440)

9. **Remove "Producent / Marka" filter group**
   Delete the entire filter block at `index.html` lines 358–398 (`.filter-group` containing `.brand-checkbox` inputs). Also remove the corresponding `toggleBrandFilter()` calls and `state.filters.brands` logic in `app.js` if brand filtering is being dropped sitewide, or scope the removal to the Ogrodnicze category view only if the client wants it category-specific (clarify scope — see below).

10. **Remove "Dostępność i Oferty" filter group**
    Delete the filter block at `index.html` lines 403–423 (`#stock-only-toggle`, `#b2b-discount-toggle`, `#bestseller-only-toggle`). Also remove corresponding `state.filters.inStockOnly / b2bDiscountOnly / bestsellerOnly` references in `app.js` (state object ~lines 415–423, plus wherever `renderCatalog()` reads them) since `bestsellerOnly` overlaps with the new "Polecane" tab from task 8 — confirm that overlap doesn't break the new tab.

11. **Remove "Materiały wykonania" filter group** (client-confirmed)
    Delete the material filter block in the sidebar (`index.html` ~lines 428–440+, `.material-checkbox`). Remove corresponding `state.filters.materials` / material-filter logic in `app.js`.

## Skipped (client doesn't want these implemented)
- "Artykuły" — no action.
- "Lack met" — no action, client doesn't remember the intent.

## Execution Notes
- Task 5 upgraded: actually **remove product `p-201` (chain)** from `PRODUCTS_DB`, not just reword copy. Still reword meta description / hero / footer copy to lead with garden framing.
- Tasks 9, 10, 11 (filter removal) are **sitewide** — remove from the shared filter sidebar, not scoped to one category.
- Task 7: implemented as expandable chevron dropdowns in the sidebar category filter (desktop + mobile drawer). Subcategory clicks reuse the existing search-filter mechanism (`filterCategory(cat, subcatKeyword)`) rather than adding new product fields — no PRODUCTS_DB changes needed. BHP has no subcategory dropdown (only 1 SKU exists — flagged to client).
- Task 8: implemented as a new nav tab (`data-cat="promo"`) filtering on `isBestseller || isNew || isPromo`. Only `isBestseller` currently has real data; `isNew`/`isPromo` are wired into the filter logic but no products are flagged with them yet — flagged to client, needs their input on which products are "new" or "on promotion".

## Final Status: all 11 tasks complete
- Verified: `node -c app.js` passes, no dangling references to removed filter classes/functions in either file.

### Critical Files for Implementation
- /home/jankuchnia/Desktop/sliwa-fh-sklep-v2/index.html
- /home/jankuchnia/Desktop/sliwa-fh-sklep-v2/app.js
