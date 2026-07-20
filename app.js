/* ==========================================================================
   ŚLIWA FH - HURTOWNIA & SKLEP NARZĘDZIOWY
   Application Logic & State Management
   ========================================================================== */

// --- PRODUCT CATALOG DATABASE ---
const PRODUCTS_DB = [
  {
    id: "p-101",
    sku: "SLW-OGR-01",
    name: "Łopata Piaskowa ERGO Hartowana 120cm",
    category: "ogrodnicze",
    categoryLabel: "Narzędzia Ogrodnicze",
    brand: "FISKARS",
    material: "Stal hartowana",
    isBestseller: true,
    isWholesaleDiscount: true,
    priceNetto: 45.00,
    priceBrutto: 55.35,
    wholesaleMinQty: 10,
    wholesalePriceNetto: 38.00,
    stockQty: 48,
    unit: "szt.",
    image: "./assets/products/p-101-lopata.svg",
    description: "Profesjonalna łopata piaskowa z wzmacnianej stali hartowanej. Ergonomiczny trzonek wyprofilowany z uchwytem typu D dla maksymalnej wygody pracy w ogrodzie i na budowie.",
    specs: {
      "Producent": "FISKARS / Śliwa FH Supply",
      "Długość całkowita": "120 cm",
      "Szerokość głowicy": "235 mm",
      "Materiał głowicy": "Stal borowa hartowana",
      "Rękojeść": "Tworzywo antypoślizgowe z uchwytem D",
      "Waga": "1.85 kg"
    }
  },
  {
    id: "p-102",
    sku: "SLW-OGR-02",
    name: "Grabie Ogrodowe 16-Zębowe Wzmacniane z Trzonkiem",
    category: "ogrodnicze",
    categoryLabel: "Narzędzia Ogrodnicze",
    brand: "Śliwa FH Supply",
    material: "Drewno",
    isBestseller: true,
    isWholesaleDiscount: true,
    priceNetto: 32.00,
    priceBrutto: 39.36,
    wholesaleMinQty: 10,
    wholesalePriceNetto: 26.50,
    stockQty: 35,
    unit: "szt.",
    image: "./assets/products/p-102-grabie.svg",
    description: "Solidne grabie ogólnego przeznaczenia do wyrównywania gleby, grabienia liści oraz skoszonej trawy. Stalowe hartowane zęby odporne na wygięcia.",
    specs: {
      "Ilość zębów": "16 zębów",
      "Szerokość robocza": "42 cm",
      "Trzonek": "Drewno bukowe lakierowane 150cm",
      "Powłoka": "Farba proszkowa zabezpieczająca przed korozją",
      "Waga": "1.30 kg"
    }
  },
  {
    id: "p-103",
    sku: "SLW-OGR-03",
    name: "Wąż Ogrodowy 5-Warstwowy z Oplotem 1/2\" 50m",
    category: "ogrodnicze",
    categoryLabel: "Narzędzia Ogrodnicze",
    brand: "ATS Ogrodnictwo",
    material: "Tworzywo / Guma",
    isBestseller: false,
    isWholesaleDiscount: true,
    priceNetto: 89.00,
    priceBrutto: 109.47,
    wholesaleMinQty: 5,
    wholesalePriceNetto: 75.00,
    stockQty: 22,
    unit: "rolka",
    image: "./assets/products/p-103-waz.svg",
    description: "Wytrzymały 5-warstwowy wąż ogrodowy z oplotem krzyżowym zapobiegającym skręcaniu (ATS). Odporny na promieniowanie UV oraz osadzanie się glonów.",
    specs: {
      "Średnica": "1/2 cala (12.5 mm)",
      "Długość": "50 metrów",
      "Ciśnienie rozrywające": "24 bar",
      "Zakres temperatur": "-20°C do +60°C",
      "Gwarancja": "5 lat"
    }
  },
  {
    id: "p-104",
    sku: "SLW-OGR-04",
    name: "Sekator Ogrodniczy Nożycowy Profi 215mm",
    category: "ogrodnicze",
    categoryLabel: "Narzędzia Ogrodnicze",
    brand: "FISKARS",
    material: "Stal hartowana",
    isBestseller: true,
    isWholesaleDiscount: true,
    priceNetto: 28.00,
    priceBrutto: 34.44,
    wholesaleMinQty: 10,
    wholesalePriceNetto: 22.00,
    stockQty: 60,
    unit: "szt.",
    image: "./assets/products/p-104-sekator.svg",
    description: "Precyzyjny sekator do cięcia żywych gałęzi o średnicy do 22mm. Ostrze pokryte powłoką PTFE zmniejszającą tarcie.",
    specs: {
      "Długość": "215 mm",
      "Max średnica cięcia": "22 mm",
      "Ostrze": "Stal nierdzewna SK5 z PTFE",
      "Blokada bezpieczeństwa": "Tak, jednoręczna"
    }
  },
  {
    id: "p-105",
    sku: "SLW-OGR-05",
    name: "Sekator Dźwigniowy Profesjonalny 230mm",
    category: "ogrodnicze",
    categoryLabel: "Narzędzia Ogrodnicze",
    brand: "FISKARS",
    material: "Stal hartowana",
    isBestseller: true,
    isWholesaleDiscount: true,
    priceNetto: 60.00,
    priceBrutto: 73.80,
    wholesaleMinQty: 5,
    wholesalePriceNetto: 52.00,
    stockQty: 18,
    unit: "szt.",
    image: "./assets/products/p-104-sekator.svg",
    description: "Sekator z mechanizmem wspomagania dźwigniowego zredukowany o 40% siłę cięcia grubych gałęzi. Ostrza szlifowane diamentowo.",
    specs: {
      "Długość": "230 mm",
      "Max średnica cięcia": "26 mm",
      "Technologia": "LeverGear System",
      "Rękojeść": "Kompaktowa powłoka SoftGrip"
    }
  },
  {
    id: "p-201",
    sku: "SLW-MET-01",
    name: "Łańcuch Odbierakowy Ogniwowy Ocynkowany DIN 766 6mm (30m)",
    category: "metalowe",
    categoryLabel: "Artykuły Metalowe",
    brand: "Śliwa FH Supply",
    material: "Stal hartowana",
    isBestseller: true,
    isWholesaleDiscount: true,
    priceNetto: 140.00,
    priceBrutto: 172.20,
    wholesaleMinQty: 3,
    wholesalePriceNetto: 118.00,
    stockQty: 18,
    unit: "rolka (30m)",
    image: "./assets/products/p-201-lancuch.svg",
    description: "Łańcuch stalowy techniczny z ogniwami krótkimi, ocynkowany galwanicznie. Znajduje szerokie zastosowanie w budownictwie, rolnictwie i gospodarstwie.",
    specs: {
      "Norma": "DIN 766",
      "Grubość drutu d": "6 mm",
      "Podziałka p": "18.5 mm",
      "Obciążenie niszczące": "16.0 kN",
      "Powłoka": "Ocynk galwaniczny silver"
    }
  },
  {
    id: "p-202",
    sku: "SLW-MET-02",
    name: "Kolano Nastawne Dymowe 4-segmentowe Fi 150mm / 2mm Black",
    category: "metalowe",
    categoryLabel: "Artykuły Metalowe",
    brand: "Senotherm",
    material: "Stal hartowana",
    isBestseller: false,
    isWholesaleDiscount: true,
    priceNetto: 65.00,
    priceBrutto: 79.95,
    wholesaleMinQty: 5,
    wholesalePriceNetto: 54.00,
    stockQty: 14,
    unit: "szt.",
    image: "./assets/products/p-202-kolano.svg",
    description: "Kolano dymowe stalowe grubo ścienne 2mm przeznaczone do podłączania wkładów kominkowych i pieców. Zakres regulacji kąta od 0° do 90°.",
    specs: {
      "Średnica": "150 mm",
      "Grubość blachy": "2.0 mm",
      "Odporność termiczna": "1000°C",
      "Malowanie": "Farba żaroodporna Senotherm",
      "Segmenty": "4 segmenty z rewizją"
    }
  },
  {
    id: "p-203",
    sku: "SLW-MET-03",
    name: "Śruby Budowlane Ocynkowane M10x120mm z Nakrętką (100 szt.)",
    category: "metalowe",
    categoryLabel: "Artykuły Metalowe",
    brand: "Śliwa FH Supply",
    material: "Stal hartowana",
    isBestseller: false,
    isWholesaleDiscount: true,
    priceNetto: 42.00,
    priceBrutto: 51.66,
    wholesaleMinQty: 10,
    wholesalePriceNetto: 35.00,
    stockQty: 85,
    unit: "paczka",
    image: "./assets/products/p-203-sruby.svg",
    description: "Śruby z łbem sześciokątnym gwintowane z nakrętką podkładką stalową. Klasa twardości 8.8 do konstrukcji drewnianych i stalowych.",
    specs: {
      "Wymiar": "M10 x 120 mm",
      "Klasa twardości": "8.8",
      "Norma": "DIN 931 / ISO 4014",
      "Ilość w opakowaniu": "100 sztuk"
    }
  },
  {
    id: "p-301",
    sku: "SLW-BUD-01",
    name: "Zestaw Malarski Velour 25cm z Rączką i Kuwetą",
    category: "budowlane",
    categoryLabel: "Budowlane & Malarskie",
    brand: "Velour Profi",
    material: "Tworzywo / Guma",
    isBestseller: false,
    isWholesaleDiscount: true,
    priceNetto: 24.00,
    priceBrutto: 29.52,
    wholesaleMinQty: 10,
    wholesalePriceNetto: 19.50,
    stockQty: 50,
    unit: "zestaw",
    image: "./assets/products/p-301-malarski.svg",
    description: "Kompletny zestaw malarski do lakierów, emulsji i gładzi. Wałek welurowy z krótkim włosiem zapewnia wyjątkowo gładkie wykończenie powierzchni.",
    specs: {
      "Szerokość wałka": "25 cm",
      "Wysokość runa": "4 mm",
      "Przeznaczenie": "Farby olejne, emalie, lakiery",
      "Skład zestawu": "Wałek + Rączka 25cm + Kuweta malarska 31x35cm"
    }
  },
  {
    id: "p-302",
    sku: "SLW-BUD-02",
    name: "Pędzel Płaski Angielski Najwyższa Jakość 50mm",
    category: "budowlane",
    categoryLabel: "Budowlane & Malarskie",
    brand: "Velour Profi",
    material: "Drewno",
    isBestseller: true,
    isWholesaleDiscount: true,
    priceNetto: 6.50,
    priceBrutto: 7.995,
    wholesaleMinQty: 20,
    wholesalePriceNetto: 4.80,
    stockQty: 120,
    unit: "szt.",
    image: "./assets/products/p-302-pedzel.svg",
    description: "Pędzel płaski z gęstym włosiem naturalnym z dodatkiem włókien syntetycznych. Drewniana rączka lakierowana z miedzianą skuwką.",
    specs: {
      "Szerokość": "50 mm (2 cale)",
      "Włosie": "60% naturalne, 40% poliuretan",
      "Skuwka": "Miedziana ocynkowana"
    }
  },
  {
    id: "p-303",
    sku: "SLW-BUD-03",
    name: "Poziomica Aluminium Magnet 100cm 3-libellowa",
    category: "budowlane",
    categoryLabel: "Budowlane & Malarskie",
    brand: "YATO",
    material: "Aluminium",
    isBestseller: false,
    isWholesaleDiscount: true,
    priceNetto: 58.00,
    priceBrutto: 71.34,
    wholesaleMinQty: 5,
    wholesalePriceNetto: 48.00,
    stockQty: 28,
    unit: "szt.",
    image: "./assets/products/p-303-poziomica.svg",
    description: "Wzmocniona poziomica alu z magnesem neodymowym w podstawie. Trzy wstrząsoodporne libelle umożliwiający szybki odczyt pionu, poziomu i kąta 45°.",
    specs: {
      "Długość": "100 cm",
      "Dokładność": "0.5 mm / m",
      "Profil": "Aluminium anodowane 1.5mm",
      "Magnesy": "Neodymowe w podstawie"
    }
  },
  {
    id: "p-304",
    sku: "SLW-BUD-04",
    name: "Taśma Malarska Papierowa Maskująca 48mm/50m",
    category: "budowlane",
    categoryLabel: "Budowlane & Malarskie",
    brand: "Velour Profi",
    material: "Tworzywo / Guma",
    isBestseller: false,
    isWholesaleDiscount: true,
    priceNetto: 11.50,
    priceBrutto: 14.15,
    wholesaleMinQty: 24,
    wholesalePriceNetto: 8.90,
    stockQty: 140,
    unit: "szt.",
    image: "./assets/products/p-301-malarski.svg",
    description: "Odporna taśma papierowa malarska ze specjalnym klejem kauczukowym. Bezpieczna dla ścian, nie pozostawia śladów kleju po odklejeniu.",
    specs: {
      "Szerokość": "48 mm",
      "Długość": "50 metrów",
      "Klej": "Kauczuk naturalny solvent"
    }
  },
  {
    id: "p-401",
    sku: "SLW-REC-01",
    name: "Młotek Ślusarski Hartowany 1000g z Trzonkiem FiberGlass",
    category: "reczne",
    categoryLabel: "Narzędzia Ręczne",
    brand: "YATO",
    material: "Stal hartowana",
    isBestseller: false,
    isWholesaleDiscount: true,
    priceNetto: 26.00,
    priceBrutto: 31.98,
    wholesaleMinQty: 10,
    wholesalePriceNetto: 21.00,
    stockQty: 40,
    unit: "szt.",
    image: "./assets/products/p-401-mlotek.svg",
    description: "Solidny młotek ślusarski 1kg z głowicą ze stali kutej indukcyjnie hartowanej. Trzonek z włókna szklanego absorbujący drgania z gumowym chwytem.",
    specs: {
      "Masa głowicy": "1000 gramów",
      "Materiały": "Stal narzędziowa Kuta / Fiberglass",
      "Gwarancja": "24 miesiące"
    }
  },
  {
    id: "p-402",
    sku: "SLW-REC-02",
    name: "Zestaw Kluczy Płasko-Oczkowych 6-32mm CrV (25 szt.)",
    category: "reczne",
    categoryLabel: "Narzędzia Ręczne",
    brand: "YATO",
    material: "Stal hartowana",
    isBestseller: true,
    isWholesaleDiscount: true,
    priceNetto: 185.00,
    priceBrutto: 227.55,
    wholesaleMinQty: 3,
    wholesalePriceNetto: 155.00,
    stockQty: 15,
    unit: "zestaw",
    image: "./assets/products/p-402-klucze.svg",
    description: "Kompletny zestaw kluczy ze stali chromowo-wanadowej (CrV) w wytrzymałym płachcie warsztatowej z możliwością powieszenia na ścianie.",
    specs: {
      "Zakres rozmiarów": "6-32 mm (25 elementów)",
      "Stal": "Chrome-Vanadium Premium",
      "Wykończenie": "Satyna matowa"
    }
  },
  {
    id: "p-403",
    sku: "SLW-REC-03",
    name: "Szczypce Uniwersalne Kombinerki 180mm CrV",
    category: "reczne",
    categoryLabel: "Narzędzia Ręczne",
    brand: "YATO",
    material: "Stal hartowana",
    isBestseller: true,
    isWholesaleDiscount: true,
    priceNetto: 27.50,
    priceBrutto: 33.83,
    wholesaleMinQty: 10,
    wholesalePriceNetto: 22.00,
    stockQty: 55,
    unit: "szt.",
    image: "./assets/products/p-401-mlotek.svg",
    description: "Kombinerki kute ze stali chromowo-wanadowej, utwardzane krawędzie tnące z wielokomponentowymi rękojeściami z izolacją ERGO.",
    specs: {
      "Długość": "180 mm",
      "Stal": "CrV 60 HRC",
      "Rękojeść": "Ergonomiczna dwukomponentowa"
    }
  },
  {
    id: "p-501",
    sku: "SLW-BHP-01",
    name: "Rękawice Robocze Powlekane Nitrylem Dragon (12 par)",
    category: "bhp",
    categoryLabel: "BHP & Odzież Robocza",
    brand: "Dragon Safety",
    material: "Nitryl",
    isBestseller: true,
    isWholesaleDiscount: true,
    priceNetto: 36.00,
    priceBrutto: 44.28,
    wholesaleMinQty: 10,
    wholesalePriceNetto: 28.50,
    stockQty: 90,
    unit: "paczka (12 par)",
    image: "./assets/products/p-501-rekawice.svg",
    description: "Elastyczne rękawice ochronne z dzianiny poliestrowej powlekane czarnym nitrylem. Doskonała chwytność i odporność na oleje oraz smary.",
    specs: {
      "Norma": "EN 388 (4121X)",
      "Rozmiar": "10 / XL",
      "Ilość": "12 par w paczce"
    }
  }
];

// --- STATE MANAGEMENT ---
const state = {
  priceMode: 'b2c', // 'b2c' (Brutto) or 'b2b' (Netto)
  activeCategory: 'all',
  searchQuery: '',
  filters: {
    minPrice: null,
    maxPrice: null,
    brands: [],
    materials: [],
    inStockOnly: false,
    b2bDiscountOnly: false,
    bestsellerOnly: false
  },
  sortBy: 'default', // 'default', 'price_asc', 'price_desc', 'name_asc', 'stock_desc'
  cart: JSON.parse(localStorage.getItem('sliwa_cart') || '[]'),
  pickupOption: 'pickup_rzeszotary'
};

// --- INITIALIZATION ---
document.addEventListener('DOMContentLoaded', () => {
  initLucideIcons();
  initOpeningStatusTicker();
  initRouter();
  initEventListeners();
  renderCatalog();
  updateCartUI();
});

function initLucideIcons() {
  if (window.lucide) {
    window.lucide.createIcons();
  }
}

function handleProductImgError(imgElement, categoryKey) {
  if (!imgElement || imgElement.getAttribute('data-fallback-applied')) return;
  imgElement.setAttribute('data-fallback-applied', 'true');
  
  const iconMap = {
    ogrodnicze: 'flower-2',
    metalowe: 'link',
    budowlane: 'paint-bucket',
    reczne: 'hammer',
    bhp: 'shield'
  };
  const iconName = iconMap[categoryKey] || 'wrench';
  
  const wrapper = imgElement.parentElement;
  if (wrapper) {
    const fallbackBox = document.createElement('div');
    fallbackBox.className = 'img-fallback-box';
    fallbackBox.style.cssText = 'display:flex; flex-direction:column; align-items:center; justify-content:center; width:100%; height:100%; background:var(--bg-surface-elevated); color:var(--text-muted); padding:20px; text-align:center; border-radius:var(--radius-md);';
    fallbackBox.innerHTML = `<i data-lucide="${iconName}" class="lucide-icon" style="width:36px; height:36px; color:var(--accent-orange); margin-bottom:6px;"></i><span style="font-size:0.75rem; color:var(--text-muted); font-weight:700;">Śliwa FH Supply</span>`;
    imgElement.style.display = 'none';
    wrapper.appendChild(fallbackBox);
    initLucideIcons();
  }
}

// Store hours status checker (Mon-Fri 07:00-17:00)
function initOpeningStatusTicker() {
  const now = new Date();
  const day = now.getDay(); // 0: Sun, 1: Mon, ..., 5: Fri, 6: Sat
  const hours = now.getHours();
  const minutes = now.getMinutes();

  const isWeekday = day >= 1 && day <= 5;
  const isOpenHours = hours >= 7 && (hours < 17 || (hours === 17 && minutes === 0));

  const pill = document.getElementById('store-status-pill');
  if (pill) {
    if (isWeekday && isOpenHours) {
      pill.className = 'status-pill';
      pill.innerHTML = `<span class="status-dot"></span> Otwarte teraz (do 17:00)`;
    } else {
      pill.className = 'status-pill closed';
      pill.innerHTML = `<span class="status-dot"></span> Zamknięte (Otwarcia: Pn-Pt 07:00)`;
    }
  }
}

// --- SPA HASH ROUTER ---
function initRouter() {
  window.addEventListener('hashchange', handleRoute);
  handleRoute(); // initial trigger
}

function updateNavActiveLinks() {
  const hash = window.location.hash || '#home';

  // Sub-nav desktop links
  document.querySelectorAll('.sub-nav .nav-link').forEach(link => {
    link.classList.remove('active');
    const href = link.getAttribute('href');
    const cat = link.dataset.cat;

    if (hash === '#catalog') {
      if (cat && cat === state.activeCategory) {
        link.classList.add('active');
      }
    } else {
      if (href === hash && !cat) {
        link.classList.add('active');
      }
    }
  });

  // Mobile nav drawer links
  document.querySelectorAll('.mobile-nav-link').forEach(link => {
    link.classList.remove('active');
    const href = link.getAttribute('href');
    const cat = link.dataset.cat;

    if (hash === '#catalog') {
      if (cat && cat === state.activeCategory) {
        link.classList.add('active');
      }
    } else {
      if (href === hash && !cat) {
        link.classList.add('active');
      }
    }
  });

  // Sidebar filter list
  document.querySelectorAll('.category-filter-item').forEach(el => {
    el.classList.toggle('active', el.dataset.cat === state.activeCategory);
  });
}

function handleRoute() {
  const hash = window.location.hash || '#home';
  const views = document.querySelectorAll('.view-section');
  views.forEach(v => v.classList.remove('active-view'));

  // Update Nav Active links
  updateNavActiveLinks();

  if (hash.startsWith('#product/')) {
    const productId = hash.replace('#product/', '');
    renderProductSubpage(productId);
    document.getElementById('view-product-single').classList.add('active-view');
  } else if (hash === '#catalog') {
    document.getElementById('view-catalog').classList.add('active-view');
    renderCatalog();
  } else if (hash === '#b2b') {
    document.getElementById('view-b2b').classList.add('active-view');
  } else if (hash === '#contact') {
    document.getElementById('view-contact').classList.add('active-view');
  } else {
    // Default #home
    document.getElementById('view-home').classList.add('active-view');
    renderHomeBestsellers();
  }

  window.scrollTo({ top: 0, behavior: 'smooth' });
  initLucideIcons();
}

// --- EVENT LISTENERS ---
function initEventListeners() {
  // Price mode switch (B2C / B2B) - Bind all mode buttons in header & mobile drawer
  document.querySelectorAll('.mode-b2c-btn').forEach(btn => {
    btn.addEventListener('click', () => setPriceMode('b2c'));
  });
  document.querySelectorAll('.mode-b2b-btn').forEach(btn => {
    btn.addEventListener('click', () => setPriceMode('b2b'));
  });

  // Mobile Navigation Drawer Triggers
  const mobileMenuBtn = document.getElementById('mobile-menu-trigger');
  const closeMobileMenuBtn = document.getElementById('close-mobile-menu-btn');
  const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

  if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMobileMenu);
  if (closeMobileMenuBtn) closeMobileMenuBtn.addEventListener('click', closeMobileMenu);
  if (mobileMenuOverlay) {
    mobileMenuOverlay.addEventListener('click', (e) => {
      if (e.target === mobileMenuOverlay) closeMobileMenu();
    });
  }

  // Cart Drawer Triggers
  const cartBtn = document.getElementById('cart-trigger');
  const closeCartBtn = document.getElementById('close-cart-btn');
  const cartOverlay = document.getElementById('cart-overlay');

  if (cartBtn) cartBtn.addEventListener('click', openCartDrawer);
  if (closeCartBtn) closeCartBtn.addEventListener('click', closeCartDrawer);
  if (cartOverlay) {
    cartOverlay.addEventListener('click', (e) => {
      if (e.target === cartOverlay) closeCartDrawer();
    });
  }

  // Search input live autocomplete
  const searchInput = document.getElementById('main-search-input');
  const searchDropdown = document.getElementById('search-results-dropdown');

  if (searchInput && searchDropdown) {
    searchInput.addEventListener('input', (e) => {
      const query = e.target.value.toLowerCase().trim();
      state.searchQuery = query;

      if (query.length > 1) {
        const matches = PRODUCTS_DB.filter(p => 
          p.name.toLowerCase().includes(query) || 
          p.sku.toLowerCase().includes(query) ||
          p.categoryLabel.toLowerCase().includes(query) ||
          (p.brand || '').toLowerCase().includes(query)
        ).slice(0, 5);

        if (matches.length > 0) {
          searchDropdown.innerHTML = matches.map(p => `
            <div class="suggestion-item" onclick="navigateToProduct('${p.id}')">
              <div>
                <strong style="font-size:0.9rem; color:var(--bg-dark-slate);">${p.name}</strong>
                <div style="font-size:0.75rem; color:var(--text-muted);">${p.sku} | ${p.categoryLabel}</div>
              </div>
              <span class="mono-text" style="font-weight:700; color:var(--accent-orange);">
                ${formatPrice(p)}
              </span>
            </div>
          `).join('');
          searchDropdown.classList.add('active');
        } else {
          searchDropdown.innerHTML = `<div style="padding:12px; font-size:0.85rem; color:var(--text-muted);">Brak wyników wyszukiwania</div>`;
          searchDropdown.classList.add('active');
        }
      } else {
        searchDropdown.classList.remove('active');
      }

      if (window.location.hash === '#catalog') {
        renderCatalog();
      }
    });

    document.addEventListener('click', (e) => {
      if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
        searchDropdown.classList.remove('active');
      }
    });
  }

  // Price Filter Inputs
  const minPriceInput = document.getElementById('filter-price-min');
  const maxPriceInput = document.getElementById('filter-price-max');

  if (minPriceInput) {
    minPriceInput.addEventListener('input', (e) => {
      state.filters.minPrice = e.target.value !== '' ? parseFloat(e.target.value) : null;
      renderCatalog();
    });
  }
  if (maxPriceInput) {
    maxPriceInput.addEventListener('input', (e) => {
      state.filters.maxPrice = e.target.value !== '' ? parseFloat(e.target.value) : null;
      renderCatalog();
    });
  }

  // Checkbox toggles in sidebar
  const stockToggle = document.getElementById('stock-only-toggle');
  if (stockToggle) {
    stockToggle.addEventListener('change', (e) => {
      state.filters.inStockOnly = e.target.checked;
      renderCatalog();
    });
  }

  const b2bToggle = document.getElementById('b2b-discount-toggle');
  if (b2bToggle) {
    b2bToggle.addEventListener('change', (e) => {
      state.filters.b2bDiscountOnly = e.target.checked;
      renderCatalog();
    });
  }

  const bestsellerToggle = document.getElementById('bestseller-only-toggle');
  if (bestsellerToggle) {
    bestsellerToggle.addEventListener('change', (e) => {
      state.filters.bestsellerOnly = e.target.checked;
      renderCatalog();
    });
  }

  // Sort Select Dropdown
  const sortSelect = document.getElementById('catalog-sort-select');
  if (sortSelect) {
    sortSelect.addEventListener('change', (e) => {
      state.sortBy = e.target.value;
      renderCatalog();
    });
  }

  // Mobile Filter Drawer Controls
  const openMobileFilterBtn = document.getElementById('mobile-filter-trigger');
  const closeMobileFilterBtn = document.getElementById('close-mobile-filter-btn');
  const mobileFilterOverlay = document.getElementById('mobile-filter-overlay');

  if (openMobileFilterBtn) openMobileFilterBtn.addEventListener('click', openFilterDrawer);
  if (closeMobileFilterBtn) closeMobileFilterBtn.addEventListener('click', closeFilterDrawer);
  if (mobileFilterOverlay) {
    mobileFilterOverlay.addEventListener('click', (e) => {
      if (e.target === mobileFilterOverlay) closeFilterDrawer();
    });
  }
}

function openMobileMenu() {
  const overlay = document.getElementById('mobile-menu-overlay');
  if (overlay) overlay.classList.add('active');
}

function closeMobileMenu() {
  const overlay = document.getElementById('mobile-menu-overlay');
  if (overlay) overlay.classList.remove('active');
}

function openFilterDrawer() {
  const overlay = document.getElementById('mobile-filter-overlay');
  if (overlay) overlay.classList.add('active');
}

function closeFilterDrawer() {
  const overlay = document.getElementById('mobile-filter-overlay');
  if (overlay) overlay.classList.remove('active');
}

function setPriceMode(mode) {
  state.priceMode = mode;
  document.querySelectorAll('.mode-b2c-btn').forEach(btn => btn.classList.toggle('active', mode === 'b2c'));
  document.querySelectorAll('.mode-b2b-btn').forEach(btn => btn.classList.toggle('active', mode === 'b2b'));

  // Re-render UI views
  renderCatalog();
  renderHomeBestsellers();
  updateCartUI();

  if (window.location.hash.startsWith('#product/')) {
    const pid = window.location.hash.replace('#product/', '');
    renderProductSubpage(pid);
  }
}

function formatPrice(product) {
  if (state.priceMode === 'b2b') {
    return `${product.priceNetto.toFixed(2)} PLN <small style="font-weight:normal; font-size:0.7em;">netto</small>`;
  } else {
    return `${product.priceBrutto.toFixed(2)} PLN <small style="font-weight:normal; font-size:0.7em;">brutto</small>`;
  }
}

// --- MULTI-CRITERIA FILTERING & SORTING LOGIC ---
function getFilteredProducts() {
  return PRODUCTS_DB.filter(p => {
    // 1. Category Filter
    if (state.activeCategory !== 'all' && p.category !== state.activeCategory) {
      return false;
    }

    // 2. Search Query Filter
    if (state.searchQuery) {
      const q = state.searchQuery.toLowerCase();
      const matchName = p.name.toLowerCase().includes(q);
      const matchSku = p.sku.toLowerCase().includes(q);
      const matchCat = p.categoryLabel.toLowerCase().includes(q);
      const matchBrand = (p.brand || '').toLowerCase().includes(q);
      if (!matchName && !matchSku && !matchCat && !matchBrand) return false;
    }

    // 3. Price Range Filter (evaluated dynamically against Netto vs Brutto according to active priceMode)
    const activePrice = state.priceMode === 'b2b' ? p.priceNetto : p.priceBrutto;
    if (state.filters.minPrice !== null && activePrice < state.filters.minPrice) {
      return false;
    }
    if (state.filters.maxPrice !== null && activePrice > state.filters.maxPrice) {
      return false;
    }

    // 4. Brands Filter
    if (state.filters.brands.length > 0 && !state.filters.brands.includes(p.brand)) {
      return false;
    }

    // 5. Materials Filter
    if (state.filters.materials.length > 0 && !state.filters.materials.includes(p.material)) {
      return false;
    }

    // 6. Availability & Special Deals Toggles
    if (state.filters.inStockOnly && p.stockQty <= 0) return false;
    if (state.filters.b2bDiscountOnly && !p.wholesaleMinQty) return false;
    if (state.filters.bestsellerOnly && !p.isBestseller) return false;

    return true;
  }).sort((a, b) => {
    const priceA = state.priceMode === 'b2b' ? a.priceNetto : a.priceBrutto;
    const priceB = state.priceMode === 'b2b' ? b.priceNetto : b.priceBrutto;

    switch (state.sortBy) {
      case 'price_asc':
        return priceA - priceB;
      case 'price_desc':
        return priceB - priceA;
      case 'name_asc':
        return a.name.localeCompare(b.name, 'pl');
      case 'stock_desc':
        return b.stockQty - a.stockQty;
      default:
        return 0; // Natural order in catalog DB
    }
  });
}

// Brand Filter Toggle
function toggleBrandFilter(brandName) {
  const idx = state.filters.brands.indexOf(brandName);
  if (idx > -1) {
    state.filters.brands.splice(idx, 1);
  } else {
    state.filters.brands.push(brandName);
  }
  renderCatalog();
}

// Material Filter Toggle
function toggleMaterialFilter(materialName) {
  const idx = state.filters.materials.indexOf(materialName);
  if (idx > -1) {
    state.filters.materials.splice(idx, 1);
  } else {
    state.filters.materials.push(materialName);
  }
  renderCatalog();
}

// Price Presets
function setPricePreset(min, max) {
  state.filters.minPrice = min;
  state.filters.maxPrice = max;

  const minInput = document.getElementById('filter-price-min');
  const maxInput = document.getElementById('filter-price-max');
  if (minInput) minInput.value = min !== null ? min : '';
  if (maxInput) maxInput.value = max !== null ? max : '';

  renderCatalog();
}

// Reset All Filters
function resetAllFilters() {
  state.activeCategory = 'all';
  state.searchQuery = '';
  state.filters = {
    minPrice: null,
    maxPrice: null,
    brands: [],
    materials: [],
    inStockOnly: false,
    b2bDiscountOnly: false,
    bestsellerOnly: false
  };
  state.sortBy = 'default';

  // Reset UI inputs & checkboxes
  const searchInput = document.getElementById('main-search-input');
  if (searchInput) searchInput.value = '';

  const minInput = document.getElementById('filter-price-min');
  const maxInput = document.getElementById('filter-price-max');
  if (minInput) minInput.value = '';
  if (maxInput) maxInput.value = '';

  document.querySelectorAll('#stock-only-toggle, .stock-only-toggle').forEach(el => el.checked = false);
  document.querySelectorAll('#b2b-discount-toggle, .b2b-discount-toggle').forEach(el => el.checked = false);
  document.querySelectorAll('#bestseller-only-toggle, .bestseller-only-toggle').forEach(el => el.checked = false);
  document.querySelectorAll('#catalog-sort-select, .mobile-sort-select').forEach(el => el.value = 'default');

  // Uncheck brand & material checkboxes
  document.querySelectorAll('.brand-checkbox, .material-checkbox').forEach(cb => cb.checked = false);

  updateNavActiveLinks();
  renderCatalog();
}

// Remove individual active filter tag chip
function removeSingleFilter(type, value) {
  if (type === 'category') {
    filterCategory('all');
  } else if (type === 'search') {
    state.searchQuery = '';
    const searchInput = document.getElementById('main-search-input');
    if (searchInput) searchInput.value = '';
    renderCatalog();
  } else if (type === 'price') {
    setPricePreset(null, null);
  } else if (type === 'brand') {
    toggleBrandFilter(value);
  } else if (type === 'material') {
    toggleMaterialFilter(value);
  } else if (type === 'inStockOnly') {
    state.filters.inStockOnly = false;
    document.querySelectorAll('#stock-only-toggle, .stock-only-toggle').forEach(el => el.checked = false);
    renderCatalog();
  } else if (type === 'b2bDiscountOnly') {
    state.filters.b2bDiscountOnly = false;
    document.querySelectorAll('#b2b-discount-toggle, .b2b-discount-toggle').forEach(el => el.checked = false);
    renderCatalog();
  } else if (type === 'bestsellerOnly') {
    state.filters.bestsellerOnly = false;
    document.querySelectorAll('#bestseller-only-toggle, .bestseller-only-toggle').forEach(el => el.checked = false);
    renderCatalog();
  }
}

// --- RENDER CATALOG & ACTIVE CHIPS ---
function renderCatalog() {
  const container = document.getElementById('catalog-products-grid');
  if (!container) return;

  const items = getFilteredProducts();

  // 1. Update Results Counter
  const countBadge = document.getElementById('catalog-results-count');
  if (countBadge) {
    countBadge.innerHTML = `Pokazuję <strong>${items.length}</strong> z <strong>${PRODUCTS_DB.length}</strong> produktów`;
  }

  // 2. Render Active Chips
  renderActiveFilterChips();

  // 3. Update Checkboxes & Sidebar Dynamic Counts
  updateSidebarDynamicCounts();

  // 4. Render Product Cards Grid
  if (items.length === 0) {
    container.innerHTML = `
      <div style="grid-column: 1/-1; padding: 48px; text-align: center; background: var(--bg-surface); border-radius: var(--radius-lg); border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
        <i data-lucide="package-x" style="width:52px; height:52px; color:var(--text-muted); margin-bottom:14px;"></i>
        <h3 style="font-size:1.2rem; font-weight:700; color:var(--bg-dark-slate);">Brak produktów spełniających kryteria</h3>
        <p style="color:var(--text-muted); margin-top:6px; font-size:0.9rem; max-width:420px; margin: 6px auto 20px auto;">Nie znaleźliśmy artykułów dopasowanych do Twojego filtra. Spróbuj poluzować kryteria lub zresetować filtry.</p>
        <button class="btn-outline" onclick="resetAllFilters()" style="margin: 0 auto;">
          <i data-lucide="rotate-ccw" class="lucide-icon"></i> Wyczyść wszystkie filtry
        </button>
      </div>
    `;
  } else {
    container.innerHTML = items.map(p => createProductCardHTML(p)).join('');
  }

  initLucideIcons();
}

function renderActiveFilterChips() {
  const container = document.getElementById('active-filter-chips');
  if (!container) return;

  const chips = [];

  // Category
  if (state.activeCategory !== 'all') {
    const catNames = {
      ogrodnicze: 'Ogrodnicze',
      metalowe: 'Artykuły Metalowe',
      budowlane: 'Budowlane & Malarskie',
      reczne: 'Narzędzia Ręczne',
      bhp: 'BHP & Odzież Robocza'
    };
    const catLabel = catNames[state.activeCategory] || state.activeCategory;
    chips.push(`
      <span class="filter-chip">
        <span>Kategoria: <strong>${catLabel}</strong></span>
        <button onclick="removeSingleFilter('category')">&times;</button>
      </span>
    `);
  }

  // Search
  if (state.searchQuery) {
    const escapedQuery = state.searchQuery.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    chips.push(`
      <span class="filter-chip">
        <span>Szukaj: <strong>"${escapedQuery}"</strong></span>
        <button onclick="removeSingleFilter('search')">&times;</button>
      </span>
    `);
  }

  // Price range
  if (state.filters.minPrice !== null || state.filters.maxPrice !== null) {
    const minStr = state.filters.minPrice !== null ? `${state.filters.minPrice} PLN` : '0 PLN';
    const maxStr = state.filters.maxPrice !== null ? `${state.filters.maxPrice} PLN` : 'bez limitu';
    chips.push(`
      <span class="filter-chip">
        <span>Cena: <strong>${minStr} – ${maxStr}</strong></span>
        <button onclick="removeSingleFilter('price')">&times;</button>
      </span>
    `);
  }

  // Brands
  state.filters.brands.forEach(b => {
    chips.push(`
      <span class="filter-chip">
        <span>Marka: <strong>${b}</strong></span>
        <button onclick="removeSingleFilter('brand', '${b}')">&times;</button>
      </span>
    `);
  });

  // Materials
  state.filters.materials.forEach(m => {
    chips.push(`
      <span class="filter-chip">
        <span>Materiał: <strong>${m}</strong></span>
        <button onclick="removeSingleFilter('material', '${m}')">&times;</button>
      </span>
    `);
  });

  // Stock toggle
  if (state.filters.inStockOnly) {
    chips.push(`
      <span class="filter-chip">
        <span>W magazynie (Rzeszotary)</span>
        <button onclick="removeSingleFilter('inStockOnly')">&times;</button>
      </span>
    `);
  }

  // B2B discount toggle
  if (state.filters.b2bDiscountOnly) {
    chips.push(`
      <span class="filter-chip">
        <span>Rabat hurtowy B2B</span>
        <button onclick="removeSingleFilter('b2bDiscountOnly')">&times;</button>
      </span>
    `);
  }

  // Bestseller toggle
  if (state.filters.bestsellerOnly) {
    chips.push(`
      <span class="filter-chip">
        <span>Tylko Bestsellery</span>
        <button onclick="removeSingleFilter('bestsellerOnly')">&times;</button>
      </span>
    `);
  }

  if (chips.length > 0) {
    container.style.display = 'flex';
    container.innerHTML = `
      <div style="font-size:0.78rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.04em; align-self:center;">Filtry:</div>
      ${chips.join('')}
      <button class="btn-clear-chips" onclick="resetAllFilters()">Wyczyść filtry</button>
    `;
  } else {
    container.style.display = 'none';
    container.innerHTML = '';
  }
}

function updateSidebarDynamicCounts() {
  // Checkbox inputs check state syncing
  document.querySelectorAll('.brand-checkbox').forEach(cb => {
    cb.checked = state.filters.brands.includes(cb.value);
  });
  document.querySelectorAll('.material-checkbox').forEach(cb => {
    cb.checked = state.filters.materials.includes(cb.value);
  });
  document.querySelectorAll('#stock-only-toggle, .stock-only-toggle').forEach(el => el.checked = state.filters.inStockOnly);
  document.querySelectorAll('#b2b-discount-toggle, .b2b-discount-toggle').forEach(el => el.checked = state.filters.b2bDiscountOnly);
  document.querySelectorAll('#bestseller-only-toggle, .bestseller-only-toggle').forEach(el => el.checked = state.filters.bestsellerOnly);
  document.querySelectorAll('#catalog-sort-select, .mobile-sort-select').forEach(el => el.value = state.sortBy);

  // Update category filter count badges
  const catCounts = {
    all: PRODUCTS_DB.length,
    ogrodnicze: PRODUCTS_DB.filter(p => p.category === 'ogrodnicze').length,
    metalowe: PRODUCTS_DB.filter(p => p.category === 'metalowe').length,
    budowlane: PRODUCTS_DB.filter(p => p.category === 'budowlane').length,
    reczne: PRODUCTS_DB.filter(p => p.category === 'reczne').length,
    bhp: PRODUCTS_DB.filter(p => p.category === 'bhp').length
  };

  document.querySelectorAll('.category-filter-item').forEach(item => {
    const cat = item.dataset.cat;
    const badge = item.querySelector('.cat-count-badge');
    if (badge && catCounts[cat] !== undefined) {
      badge.textContent = catCounts[cat];
    }
  });
}

function createProductCardHTML(product) {
  const priceFormatted = formatPrice(product);
  return `
    <div class="product-card">
      <div class="product-image-wrap" onclick="navigateToProduct('${product.id}')">
        <img src="${product.image}" alt="${product.name}" loading="lazy" onerror="handleProductImgError(this, '${product.category}')">
        <div class="badge-container">
          <span class="badge badge-stock">
            <i data-lucide="check" class="lucide-icon" style="width:12px; height:12px;"></i> W magazynie (${product.stockQty})
          </span>
          ${product.wholesaleMinQty ? `
            <span class="badge badge-b2b-tier">
              <i data-lucide="percent" class="lucide-icon" style="width:12px; height:12px;"></i> Hurt od ${product.wholesaleMinQty} ${product.unit}
            </span>
          ` : ''}
          ${product.isBestseller ? `
            <span class="badge badge-bestseller">
              <i data-lucide="flame" class="lucide-icon" style="width:12px; height:12px;"></i> Bestseller
            </span>
          ` : ''}
        </div>
        <span class="product-sku mono-text">${product.sku}</span>
      </div>
      <div class="product-details-content">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:6px;">
          <span class="product-category-tag">${product.categoryLabel}</span>
          ${product.brand ? `<span class="product-brand-tag">${product.brand}</span>` : ''}
        </div>
        <h3 class="product-title" onclick="navigateToProduct('${product.id}')">${product.name}</h3>
        <p class="product-spec-snippet">${product.description}</p>
        
        <div class="product-price-row">
          <div class="price-display">
            <span class="main-price mono-text">${priceFormatted}</span>
            <span class="price-type-label">Cena za ${product.unit}</span>
          </div>
          <button class="add-to-cart-btn" onclick="addToCart('${product.id}', 1)">
            <i data-lucide="shopping-cart" class="lucide-icon"></i>
            <span>Dodaj</span>
          </button>
        </div>
      </div>
    </div>
  `;
}

function renderHomeBestsellers() {
  const container = document.getElementById('home-bestsellers-grid');
  if (!container) return;

  const featured = PRODUCTS_DB.filter(p => p.isBestseller).slice(0, 4);
  container.innerHTML = featured.map(p => createProductCardHTML(p)).join('');
  initLucideIcons();
}

function filterCategory(categoryKey) {
  state.activeCategory = categoryKey;
  
  // Update nav and sidebar active states
  updateNavActiveLinks();

  if (window.location.hash !== '#catalog') {
    window.location.hash = '#catalog';
  } else {
    renderCatalog();
  }
}

function navigateToProduct(id) {
  window.location.hash = `#product/${id}`;
}

// --- SINGLE PRODUCT SUBPAGE RENDERER ---
function renderProductSubpage(id) {
  const product = PRODUCTS_DB.find(p => p.id === id);
  const container = document.getElementById('view-product-single');
  if (!container) return;

  if (!product) {
    container.innerHTML = `
      <div class="section-container">
        <div style="padding: 60px; text-align: center; background: var(--bg-surface); border-radius: var(--radius-lg);">
          <h2>Produkt nie został znaleziony</h2>
          <a href="#catalog" class="btn-primary" style="margin-top: 16px;">
            <i data-lucide="arrow-left" class="lucide-icon"></i> Powrót do katalogu
          </a>
        </div>
      </div>
    `;
    initLucideIcons();
    return;
  }

  const priceFormatted = formatPrice(product);
  const specRows = Object.entries(product.specs || {}).map(([key, val]) => `
    <tr>
      <th>${key}</th>
      <td>${val}</td>
    </tr>
  `).join('');

  container.innerHTML = `
    <div class="section-container">
      <!-- Breadcrumbs -->
      <nav class="breadcrumbs">
        <a href="#home"><i data-lucide="home" class="lucide-icon"></i> Główna</a>
        <i data-lucide="chevron-right" class="lucide-icon" style="width:14px;"></i>
        <a href="#catalog">Katalog</a>
        <i data-lucide="chevron-right" class="lucide-icon" style="width:14px;"></i>
        <a href="#catalog" onclick="filterCategory('${product.category}')">${product.categoryLabel}</a>
        <i data-lucide="chevron-right" class="lucide-icon" style="width:14px;"></i>
        <span style="color:var(--text-main); font-weight:600;">${product.name}</span>
      </nav>

      <!-- Single Product Box -->
      <div class="single-product-container">
        <div class="single-product-grid">
          <div class="product-gallery-large">
            <img src="${product.image}" alt="${product.name}" onerror="handleProductImgError(this, '${product.category}')">
          </div>
          
          <div class="single-product-info">
            <span class="product-category-tag">${product.categoryLabel}</span>
            <h1>${product.name}</h1>
            
            <div class="single-product-meta">
              <span class="mono-text" style="color:var(--text-muted);">Kod SKU: <strong>${product.sku}</strong></span>
              <span class="badge badge-stock">
                <i data-lucide="check-circle-2" class="lucide-icon"></i> Dostępne w Rzeszotarach (${product.stockQty} ${product.unit})
              </span>
            </div>

            <p style="color:var(--text-muted); font-size:1rem; line-height:1.6; margin-bottom:24px;">
              ${product.description}
            </p>

            <!-- Price & Wholesale Tier -->
            <div style="background:var(--bg-surface-elevated); border-radius:var(--radius-md); padding:20px; margin-bottom:24px;">
              <div style="font-size:0.85rem; color:var(--text-muted); font-weight:600;">Cena jednostkowa:</div>
              <div class="mono-text" style="font-size:2.2rem; font-weight:800; color:var(--bg-dark-slate);">
                ${priceFormatted}
              </div>
              <div style="font-size:0.8rem; color:var(--text-muted); margin-top:2px;">
                Cena netto: ${product.priceNetto.toFixed(2)} PLN | Cena brutto (VAT 23%): ${product.priceBrutto.toFixed(2)} PLN
              </div>
            </div>

            <!-- Wholesale Tier Matrix -->
            <div class="tier-table-box">
              <div class="tier-table-title">
                <i data-lucide="trending-down" class="lucide-icon"></i> Cennik Hurtowy (Rabat Ilościowy)
              </div>
              <div class="tier-grid">
                <div class="tier-item">
                  <div class="tier-qty">1 - 4 ${product.unit}</div>
                  <div class="tier-price">${state.priceMode === 'b2b' ? product.priceNetto.toFixed(2) : product.priceBrutto.toFixed(2)} PLN</div>
                </div>
                <div class="tier-item">
                  <div class="tier-qty">5 - 9 ${product.unit}</div>
                  <div class="tier-price">${(state.priceMode === 'b2b' ? product.priceNetto * 0.92 : product.priceBrutto * 0.92).toFixed(2)} PLN</div>
                </div>
                <div class="tier-item" style="border-color:var(--b2b-blue);">
                  <div class="tier-qty">10+ ${product.unit} (Hurt)</div>
                  <div class="tier-price">${(state.priceMode === 'b2b' ? product.wholesalePriceNetto : product.wholesalePriceNetto * 1.23).toFixed(2)} PLN</div>
                </div>
              </div>
            </div>

            <!-- Add to Cart Action Box -->
            <div class="purchase-row">
              <div class="qty-picker">
                <button class="qty-btn" onclick="adjustSubpageQty(-1)">-</button>
                <input type="number" id="subpage-qty-input" value="1" min="1" max="${product.stockQty}">
                <button class="qty-btn" onclick="adjustSubpageQty(1)">+</button>
              </div>

              <button class="btn-primary" style="flex:1;" onclick="addCurrentSubpageToCart('${product.id}')">
                <i data-lucide="shopping-cart" class="lucide-icon"></i>
                <span>Dodaj do koszyka</span>
              </button>
              
              <a href="#b2b" class="btn-outline">
                <i data-lucide="file-text" class="lucide-icon"></i>
                <span>Zapytaj o hurt</span>
              </a>
            </div>

            <!-- Local Store Pickup Guarantee -->
            <div style="margin-top:24px; padding-top:20px; border-top:1px solid var(--border-color); display:flex; gap:16px; font-size:0.88rem; color:var(--text-muted);">
              <div><i data-lucide="shield-check" class="lucide-icon" style="color:var(--emerald-green);"></i> Gwarancja jakości FH Śliwa</div>
              <div><i data-lucide="truck" class="lucide-icon" style="color:var(--accent-orange);"></i> Odbiór w Rzeszotarach 451</div>
            </div>
          </div>
        </div>

        <!-- Specifications Table -->
        <div style="margin-top:40px; padding-top:32px; border-top:1px solid var(--border-color);">
          <h3 style="font-size:1.3rem; margin-bottom:16px;">Specyfikacja Techniczna</h3>
          <table class="spec-table">
            <tbody>
              ${specRows}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  `;

  initLucideIcons();
}

function adjustSubpageQty(delta) {
  const input = document.getElementById('subpage-qty-input');
  if (input) {
    let current = parseInt(input.value) || 1;
    current = Math.max(1, current + delta);
    input.value = current;
  }
}

function addCurrentSubpageToCart(productId) {
  const input = document.getElementById('subpage-qty-input');
  const qty = input ? parseInt(input.value) || 1 : 1;
  addToCart(productId, qty);
  openCartDrawer();
}

// --- TOAST NOTIFICATIONS SYSTEM ---
function showToast(message, type = 'info') {
  let container = document.getElementById('toast-container');
  if (!container) {
    container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'toast-container';
    document.body.appendChild(container);
  }

  const toast = document.createElement('div');
  toast.className = `toast-card toast-${type}`;
  
  const iconName = type === 'success' ? 'check-circle-2' : type === 'warning' ? 'alert-triangle' : 'info';
  
  toast.innerHTML = `
    <i data-lucide="${iconName}" class="lucide-icon toast-icon"></i>
    <div class="toast-message">${message}</div>
    <button class="toast-close" onclick="this.parentElement.remove()"><i data-lucide="x" class="lucide-icon"></i></button>
  `;

  container.appendChild(toast);
  initLucideIcons();

  requestAnimationFrame(() => {
    toast.classList.add('toast-show');
  });

  setTimeout(() => {
    toast.classList.remove('toast-show');
    setTimeout(() => toast.remove(), 300);
  }, 4500);
}

// --- CART DRAWER LOGIC ---
function addToCart(productId, qty = 1) {
  const product = PRODUCTS_DB.find(p => p.id === productId);
  if (!product) return;

  const existing = state.cart.find(item => item.id === productId);
  const maxStock = product.stockQty || 999;

  if (existing) {
    if (existing.qty + qty > maxStock) {
      existing.qty = maxStock;
      showToast(`Osiągnięto limit magazynowy dla: ${product.name} (${maxStock} ${product.unit})`, 'warning');
    } else {
      existing.qty += qty;
      showToast(`Zaktualizowano ilość: ${product.name} (${existing.qty} ${product.unit})`, 'info');
    }
  } else {
    const initialQty = Math.min(qty, maxStock);
    state.cart.push({
      id: product.id,
      name: product.name,
      sku: product.sku,
      priceNetto: product.priceNetto,
      priceBrutto: product.priceBrutto,
      image: product.image,
      unit: product.unit,
      qty: initialQty
    });
    showToast(`Dodano do koszyka: ${product.name}`, 'success');
  }

  saveCart();
  updateCartUI();
}

function removeFromCart(productId) {
  const item = state.cart.find(i => i.id === productId);
  if (item) {
    showToast(`Usunięto z koszyka: ${item.name}`, 'info');
  }
  state.cart = state.cart.filter(item => item.id !== productId);
  saveCart();
  updateCartUI();
}

function updateCartQty(productId, qty) {
  const item = state.cart.find(i => i.id === productId);
  const product = PRODUCTS_DB.find(p => p.id === productId);
  if (item && product) {
    const maxStock = product.stockQty || 999;
    if (qty > maxStock) {
      item.qty = maxStock;
      showToast(`Maksymalna dostępna ilość w magazynie to ${maxStock} ${product.unit}`, 'warning');
    } else {
      item.qty = Math.max(1, qty);
    }
    saveCart();
    updateCartUI();
  }
}

function saveCart() {
  localStorage.setItem('sliwa_cart', JSON.stringify(state.cart));
}

function updateCartUI() {
  const countBadge = document.getElementById('cart-count-badge');
  const itemsContainer = document.getElementById('cart-drawer-items');
  const totalNettoEl = document.getElementById('cart-total-netto');
  const totalBruttoEl = document.getElementById('cart-total-brutto');
  const submitBtn = document.getElementById('cart-submit-btn');

  const totalCount = state.cart.reduce((sum, item) => sum + item.qty, 0);
  if (countBadge) countBadge.textContent = totalCount;

  if (submitBtn) {
    if (state.cart.length === 0) {
      submitBtn.disabled = true;
      submitBtn.classList.add('disabled-btn');
    } else {
      submitBtn.disabled = false;
      submitBtn.classList.remove('disabled-btn');
    }
  }

  if (!itemsContainer) return;

  if (state.cart.length === 0) {
    itemsContainer.innerHTML = `
      <div style="text-align:center; padding:48px 16px; color:var(--text-muted);">
        <i data-lucide="shopping-bag" style="width:48px; height:48px; margin-bottom:12px; color:var(--text-light);"></i>
        <h4 style="font-size:1.05rem; font-weight:700; color:var(--text-main);">Twój koszyk jest pusty</h4>
        <p style="font-size:0.85rem; margin-top:4px; color:var(--text-muted);">Dodaj produkty z katalogu, aby złożyć rezerwację lub pobrać wycenę.</p>
      </div>
    `;
    if (totalNettoEl) totalNettoEl.textContent = '0.00 PLN';
    if (totalBruttoEl) totalBruttoEl.textContent = '0.00 PLN';
  } else {
    let sumNetto = 0;
    let sumBrutto = 0;

    itemsContainer.innerHTML = state.cart.map(item => {
      const itemNetto = item.priceNetto * item.qty;
      const itemBrutto = item.priceBrutto * item.qty;
      sumNetto += itemNetto;
      sumBrutto += itemBrutto;

      const displayPrice = state.priceMode === 'b2b' ? itemNetto.toFixed(2) : itemBrutto.toFixed(2);

      return `
        <div class="cart-item">
          <img src="${item.image}" alt="${item.name}" class="cart-item-img" onerror="handleProductImgError(this, 'general')">
          <div class="cart-item-info">
            <div class="cart-item-title">${item.name}</div>
            <div style="font-size:0.75rem; color:var(--text-muted);">${item.sku}</div>
            <div class="cart-item-price mono-text">${displayPrice} PLN</div>
          </div>
          <div style="display:flex; align-items:center; gap:8px;">
            <div class="qty-picker" style="scale:0.85;">
              <button class="qty-btn" onclick="updateCartQty('${item.id}', ${item.qty - 1})">-</button>
              <input type="number" value="${item.qty}" readonly style="width:36px;">
              <button class="qty-btn" onclick="updateCartQty('${item.id}', ${item.qty + 1})">+</button>
            </div>
            <button class="remove-item-btn" onclick="removeFromCart('${item.id}')" title="Usuń z koszyka">
              <i data-lucide="trash-2" class="lucide-icon"></i>
            </button>
          </div>
        </div>
      `;
    }).join('');

    if (totalNettoEl) totalNettoEl.textContent = `${sumNetto.toFixed(2)} PLN`;
    if (totalBruttoEl) totalBruttoEl.textContent = `${sumBrutto.toFixed(2)} PLN`;
  }

  initLucideIcons();
}

function openCartDrawer() {
  const overlay = document.getElementById('cart-overlay');
  if (overlay) overlay.classList.add('active');
}

function closeCartDrawer() {
  const overlay = document.getElementById('cart-overlay');
  if (overlay) overlay.classList.remove('active');
}

function submitCartOrder(e) {
  if (e) e.preventDefault();
  if (state.cart.length === 0) {
    showToast('Twój koszyk jest pusty!', 'warning');
    return;
  }

  const name = document.getElementById('order-client-name')?.value || 'Klient';
  const phone = document.getElementById('order-client-phone')?.value || '';

  showToast(`Dziękujemy ${name}! Rezerwacja odbioru zarejestrowana. Skontaktujemy się telefonicznie (${phone}) w celu potwierdzenia.`, 'success');
  
  state.cart = [];
  saveCart();
  updateCartUI();
  closeCartDrawer();
}

function submitB2BQuote(e) {
  if (e) e.preventDefault();
  const company = document.getElementById('b2b-company')?.value || 'Firma';
  const nip = document.getElementById('b2b-nip')?.value || '';

  showToast(`Zapytanie hurtowe dla firmy ${company} (NIP: ${nip}) zostało wysłane. Odpowiedź prześlemy niezwłocznie.`, 'success');
  
  const form = e.target;
  if (form && form.reset) form.reset();
}
