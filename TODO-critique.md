# Śliwa FH — Critique Punch List

Source: `/impeccable critique index.html` run on 2026-07-20. Full report: `.impeccable/critique/2026-07-20T12-14-51Z__index-html.md`. Score: 23/40 (Acceptable).

## P0 — Product images unreliable, one factually wrong
- 9 of 18 sampled `<img>` elements failed to load (hotlinked to Unsplash, no local fallback) — blank/broken boxes where product photos should be.
- The image that *did* load for `p-201` ("Łańcuch Odbierakowy... DIN 766 6mm", a steel chain) shows steamed dumplings, not a chain.
- Fix: host real product photography locally (or reliable, topically-correct placeholders) instead of hotlinking. Add a CSS/`onerror` fallback (tinted background + category icon) for any image that fails to load.

## P1 — Hero eyebrow + duplicate icon-card rows read as templated
- The boxed uppercase "TRADYCJA I JAKOŚĆ W RZESZOTARACH" tag above the H1, followed immediately by a 4-up feature-card row and a 5-up category-card row (both icon-circle + heading + text), is the generic AI-landing-page reflex DESIGN.md explicitly bans.
- Fix: drop the eyebrow badge or fold its message into the H1/subhead copy. Give the feature-card and category-card rows visibly different structures instead of repeating the same card shape twice in a row.

## P1 — Flat type hierarchy (detector-confirmed)
- `detect.mjs` found font sizes clustering 13.1–16px with only one 22.4px outlier (1.7:1 total range) — sidebar labels, footer links, and body copy all sit at nearly the same visual weight.
- Fix: widen the scale per DESIGN.md's own ≥1.25 step-ratio rule (push labels smaller, push section subheads larger/heavier).

## P2 — `javascript:` URI category links
- Category shortcuts in the nav/footer use `href="javascript:filterCategory(...)"` while primary nav uses real `#hash` anchors — inconsistent, breaks "open in new tab," fails with JS disabled.
- Fix: convert to `<button>` elements or real hash links the router already handles.

## P2 — No mobile affordance for overflowing sub-nav
- On mobile (390px), the category sub-nav scrolls horizontally with "BHP & Odzież Robocza" clipped off-screen and no visual hint (fade/arrow) that more categories exist.
- Fix: add an edge fade-mask or chevron hint when `scrollWidth > clientWidth`.

## Also noted (minor)
- Cart-drawer submit button is clickable on an empty cart; only a post-click `alert()` catches it.
- Cart-drawer qty stepper has no ceiling tied to `stockQty` (the single-product page does cap it) — inconsistent between the two add-quantity paths.
- Order/quote confirmations use native `alert()` dialogs, which feel out of place against the rest of the designed UI.
