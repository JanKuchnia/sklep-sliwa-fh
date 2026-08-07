# Graph Report - .  (2026-08-07)

## Corpus Check
- Corpus is ~19,083 words - fits in a single context window. You may not need a graph.

## Summary
- 146 nodes · 223 edges · 35 communities (15 shown, 20 thin omitted)
- Extraction: 89% EXTRACTED · 11% INFERRED · 0% AMBIGUOUS · INFERRED: 24 edges (avg confidence: 0.84)
- Token cost: 383,773 input · 0 output

## Community Hubs (Navigation)
- [[_COMMUNITY_Product Page Rendering|Product Page Rendering]]
- [[_COMMUNITY_Cart & Catalog State|Cart & Catalog State]]
- [[_COMMUNITY_Catalog Filter Controls|Catalog Filter Controls]]
- [[_COMMUNITY_Design Critique Findings|Design Critique Findings]]
- [[_COMMUNITY_Cart Actions|Cart Actions]]
- [[_COMMUNITY_Nav & UI Event Wiring|Nav & UI Event Wiring]]
- [[_COMMUNITY_FilterSort Logic|Filter/Sort Logic]]
- [[_COMMUNITY_Business Facts & Competitors|Business Facts & Competitors]]
- [[_COMMUNITY_Product Card & Router|Product Card & Router]]
- [[_COMMUNITY_Headroom Session Marker|Headroom Session Marker]]
- [[_COMMUNITY_Claude Settings Config|Claude Settings Config]]
- [[_COMMUNITY_Store Identity & Location|Store Identity & Location]]
- [[_COMMUNITY_Warehouse Ledger Palette|Warehouse Ledger Palette]]
- [[_COMMUNITY_Serena Project Config|Serena Project Config]]
- [[_COMMUNITY_Claude Local Permissions|Claude Local Permissions]]
- [[_COMMUNITY_Brand Personality|Brand Personality]]
- [[_COMMUNITY_Accessibility Standards|Accessibility Standards]]
- [[_COMMUNITY_Response-Only Shadow Rule|Response-Only Shadow Rule]]
- [[_COMMUNITY_Shovel Icon|Shovel Icon]]
- [[_COMMUNITY_Rake Icon|Rake Icon]]
- [[_COMMUNITY_Hose Icon|Hose Icon]]
- [[_COMMUNITY_Pruning Shears Icon|Pruning Shears Icon]]
- [[_COMMUNITY_Chain Icon|Chain Icon]]
- [[_COMMUNITY_Pipe Elbow Icon|Pipe Elbow Icon]]
- [[_COMMUNITY_Screws Icon|Screws Icon]]
- [[_COMMUNITY_Painter Tape Icon|Painter Tape Icon]]
- [[_COMMUNITY_Paintbrush Icon|Paintbrush Icon]]
- [[_COMMUNITY_Spirit Level Icon|Spirit Level Icon]]
- [[_COMMUNITY_Hammer Icon|Hammer Icon]]
- [[_COMMUNITY_Wrenches Icon|Wrenches Icon]]
- [[_COMMUNITY_Work Gloves Icon|Work Gloves Icon]]

## God Nodes (most connected - your core abstractions)
1. `renderCatalog()` - 15 edges
2. `renderCatalog()` - 13 edges
3. `index.html (Śliwa FH storefront SPA shell)` - 10 edges
4. `state (global app state object)` - 9 edges
5. `renderProductSubpage()` - 9 edges
6. `updateCartUI()` - 9 edges
7. `initLucideIcons()` - 8 edges
8. `handleRoute()` - 7 edges
9. `showToast()` - 7 edges
10. `updateCartUI()` - 7 edges

## Surprising Connections (you probably didn't know these)
- `index.html (Śliwa FH storefront SPA shell)` --shares_data_with--> `state (global app state object)`  [INFERRED]
  index.html → app.js
- `The Two-Lane Rule: orange = retail lane, blue = wholesale lane, never mixed on one control` --implements--> `setPriceMode() B2C/B2B toggle`  [INFERRED]
  DESIGN.md → app.js
- `P0: product images unreliable, one factually wrong (steel chain shows dumplings)` --references--> `handleProductImgError()`  [INFERRED]
  TODO-critique.md → app.js
- `The Ledger-Numeral Rule: any number a customer might act on renders in mono font` --implements--> `formatPrice()`  [INFERRED]
  DESIGN.md → app.js
- `P0: product images unreliable, one factually wrong (steel chain shows dumplings)` --references--> `createProductCardHTML()`  [INFERRED]
  TODO-critique.md → app.js

## Hyperedges (group relationships)
- **Add-to-Cart Persistence Flow** — app_addtocart, app_updatecartui, app_savecart, app_state, app_showtoast [EXTRACTED 1.00]
- **Catalog Filter, Sort & Render Pipeline** — app_state, app_getfilteredproducts, app_rendercatalog, app_renderactivefilterchips, app_updatesidebardynamiccounts [EXTRACTED 1.00]
- **Design System Governance & Critique Loop** — product_md, design_md, todo_critique_md, critique_index_html_report [INFERRED 0.85]

## Communities (35 total, 20 thin omitted)

### Community 0 - "Product Page Rendering"
Cohesion: 0.15
Nodes (13): addCurrentSubpageToCart(), createProductCardHTML(), formatPrice(), handleProductImgError(), handleRoute() SPA hash router, DOMContentLoaded bootstrap handler, initLucideIcons(), initRouter() (+5 more)

### Community 1 - "Cart & Catalog State"
Cohesion: 0.38
Nodes (11): addToCart(), getFilteredProducts() multi-criteria filter/sort, PRODUCTS_DB (product catalog array), removeFromCart(), saveCart(), showToast(), state (global app state object), submitCartOrder() (+3 more)

### Community 2 - "Catalog Filter Controls"
Cohesion: 0.30
Nodes (12): filterCategory(), removeSingleFilter(), renderActiveFilterChips(), renderCatalog(), resetAllFilters(), setPricePreset(), submitB2BQuote(), toggleBrandFilter() (+4 more)

### Community 3 - "Design Critique Findings"
Cohesion: 0.24
Nodes (11): .impeccable critique report on index.html (Design Health Score 23/40), P1: flat type hierarchy (13.1-16px cluster, 1.7:1 range) detector-confirmed, P1: hero eyebrow badge + duplicate icon-card rows read as templated/AI-slop, P2: no mobile affordance for overflowing horizontally-scrolling sub-nav, DESIGN.md — Śliwa FH visual design system, The Two-Lane Rule: orange = retail lane, blue = wholesale lane, never mixed on one control, Typography hierarchy: Plus Jakarta Sans display, Inter body, JetBrains Mono for numbers, ≥1.25 step-ratio scale, Anti-references: reject generic SaaS/AI-slop landing-page look (gradient text, eyebrows, numbered scaffolding, identical card grids) (+3 more)

### Community 4 - "Cart Actions"
Cohesion: 0.29
Nodes (11): addCurrentSubpageToCart(), addToCart(), closeCartDrawer(), openCartDrawer(), removeFromCart(), saveCart(), showToast(), submitB2BQuote() (+3 more)

### Community 6 - "Filter/Sort Logic"
Cohesion: 0.27
Nodes (11): filterCategory(), getFilteredProducts(), removeSingleFilter(), renderActiveFilterChips(), renderCatalog(), resetAllFilters(), setPricePreset(), toggleBrandFilter() (+3 more)

### Community 7 - "Business Facts & Competitors"
Cohesion: 0.22
Nodes (9): INFO/brief.md — client-supplied business facts (Google listing snapshot), INFO/research.md — business research on Śliwa FH, Unresolved conflict: "Rzeszotary 451" vs. "ul. Myślenicka 3, Rzeszotary" address forms, Metal-Zbyt Hurtownia Narzędzi (competitor, Skawina), Nawmet (competitor, Świątniki Górne, B2B manufacturer), Piomar (competitor, Rzeszotary, est. 1984), Unresolved conflict: brief's Mon-Fri 07:00-17:00 vs. fhsliwa.com.pl's daily 9-16/Sat 10-14 hours, Dual-audience positioning: local tradesmen/contractors (B2B) + retail customers (B2C), both walk-in/pickup shoppers (+1 more)

### Community 8 - "Product Card & Router"
Cohesion: 0.31
Nodes (9): createProductCardHTML(), formatPrice(), handleProductImgError(), handleRoute(), initLucideIcons(), initRouter(), renderHomeBestsellers(), renderProductSubpage() (+1 more)

### Community 9 - "Headroom Session Marker"
Cohesion: 0.29
Nodes (6): key, pid, port, previous, start_src, start_time

### Community 10 - "Claude Settings Config"
Cohesion: 0.29
Nodes (6): env, ANTHROPIC_BASE_URL, hooks, SessionStart, permissions, allow

### Community 11 - "Store Identity & Location"
Cohesion: 1.00
Nodes (3): FH Sliwa (Hardware/Garden/Building Supplies Store), Hero Banner Photo (FH Sliwa Storefront), Rzeszotary 494 Store Location

## Knowledge Gaps
- **36 isolated node(s):** `PRODUCTS_DB`, `state`, `pid`, `start_src`, `start_time` (+31 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **20 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `index.html (Śliwa FH storefront SPA shell)` connect `Catalog Filter Controls` to `Cart & Catalog State`, `Design Critique Findings`, `Business Facts & Competitors`?**
  _High betweenness centrality (0.068) - this node is a cross-community bridge._
- **Why does `renderCatalog()` connect `Catalog Filter Controls` to `Product Page Rendering`, `Cart & Catalog State`?**
  _High betweenness centrality (0.057) - this node is a cross-community bridge._
- **Are the 3 inferred relationships involving `index.html (Śliwa FH storefront SPA shell)` (e.g. with `state (global app state object)` and `Unresolved conflict: brief's Mon-Fri 07:00-17:00 vs. fhsliwa.com.pl's daily 9-16/Sat 10-14 hours`) actually correct?**
  _`index.html (Śliwa FH storefront SPA shell)` has 3 INFERRED edges - model-reasoned connections that need verification._
- **Are the 4 inferred relationships involving `renderProductSubpage()` (e.g. with `adjustSubpageQty()` and `addCurrentSubpageToCart()`) actually correct?**
  _`renderProductSubpage()` has 4 INFERRED edges - model-reasoned connections that need verification._
- **What connects `PRODUCTS_DB`, `state`, `pid` to the rest of the system?**
  _39 weakly-connected nodes found - possible documentation gaps or missing edges._