@once
<style>
    /* Responsive safety net shared by all frontend pages */
    body.skin-magz img,
    body.skin-magz video,
    body.skin-magz iframe,
    body.skin-magz embed,
    body.skin-magz object { max-width: 100%; }
    body.skin-magz iframe { border: 0; }
    body.skin-magz h1, body.skin-magz h2, body.skin-magz h3,
    body.skin-magz h4, body.skin-magz p, body.skin-magz a { overflow-wrap: anywhere; }
    body.skin-magz table { max-width: 100%; }
    body.skin-magz .post-content, body.skin-magz .article-body,
    body.skin-magz .col-lg-8 { min-width: 0; }
    body.skin-magz .post-content table, body.skin-magz .article-body table,
    body.skin-magz .col-lg-8 table { display: block; overflow-x: auto; -webkit-overflow-scrolling: touch; }
    body.skin-magz .post-content iframe, body.skin-magz .article-body iframe,
    body.skin-magz .col-lg-8 iframe[src*="youtube"], body.skin-magz .col-lg-8 iframe[src*="facebook"],
    body.skin-magz .col-lg-8 iframe[src*="vimeo"] { width: 100%; aspect-ratio: 16 / 9; height: auto; }

    /* Hide the masthead "লাইভ দেখুন" button and the nav's "লাইভ স্ট্রিমিং" pill site-wide. */
    body.skin-magz .jtv-masthead-live-btn,
    body.skin-magz.jtv-homepage.jtv-homepage .jtv-masthead-live-btn,
    body.skin-magz nav.jtv-main-nav ul.nav-list > li.jtv-nav-live-item.jtv-nav-live-item {
        display: none !important;
    }

    /* Category banner: drop the "Home > Category" breadcrumb, keep just the heading + subtitle. */
    body.skin-magz .jtv-cat-crumb {
        display: none !important;
    }

    @media (max-width: 767px) {
        body.skin-magz input, body.skin-magz select, body.skin-magz textarea { max-width: 100%; font-size: 16px; }
        body.skin-magz .btn, body.skin-magz button { min-height: 40px; }
        body.skin-magz.jtv-homepage section.page.top .col-lg-8 { padding: 16px !important; }
        body.skin-magz .pagination { flex-wrap: wrap; }
        body.skin-magz .container, body.skin-magz .container-fluid { padding-left: 12px; padding-right: 12px; }
    }

    /* Desktop/tablet nav: wrap instead of overflowing the viewport; keep dropdowns on-screen */
    @media (min-width: 768px) {
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav,
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav .jtv-nav-container {
            height: auto !important; min-height: 68px !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap {
            height: auto !important; min-height: 0 !important; overflow: visible !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap > ul.nav-list {
            width: 100% !important; max-width: 100% !important; height: auto !important;
            min-height: 68px !important; flex-wrap: wrap !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.dropdown > .dropdown-menu {
            left: 0 !important; right: auto !important; transform: none !important;
            width: max-content !important; max-width: min(520px, calc(100vw - 24px)) !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.dropdown:nth-last-child(-n+5) > .dropdown-menu {
            left: auto !important; right: 0 !important;
        }
    }
    @media (min-width: 768px) and (max-width: 991px) {
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li.dropdown > .dropdown-menu {
            max-width: 240px !important; min-width: 0 !important; left: auto !important; right: 0 !important;
        }
    }

    /* Mobile: keep nav scrollable from its first item, and stop the top bar text overlapping */
    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap,
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap > ul.nav-list {
            justify-content: flex-start !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-topbar-title { display: none !important; }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav .mobile-toggle a,
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav .mobile-toggle a i { color: #fff !important; }
    }
    @media (max-width: 991px) {
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-topbar-title { display: none !important; }
    }
    /* Laptop: tighter items so the menu stays on one row where possible */
    @media (min-width: 992px) and (max-width: 1599px) {
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.nav-list > li > a {
            padding: 0 clamp(5px, .5vw, 14px) !important; font-size: clamp(12px, 1vw, 15px) !important;
        }
    }

    /* Mobile drawer: theme slides ul.nav-list in via .active; page overrides had sized it to max-content */
    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap {
            overflow: visible !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list {
            position: fixed !important; top: 0 !important; bottom: 0 !important; left: auto !important;
            right: calc(-1 * min(320px, 86vw) - 20px) !important;
            width: min(320px, 86vw) !important; min-width: 0 !important; max-width: none !important;
            height: 100vh !important; height: 100dvh !important;
            flex: none !important; flex-direction: column !important; align-items: stretch !important; flex-wrap: nowrap !important;
            overflow-x: hidden !important; overflow-y: auto !important; -webkit-overflow-scrolling: touch;
            padding: 52px 0 24px !important; background: #006b3f !important; z-index: 3000 !important;
            transition: right .35s ease !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list.active { right: 0 !important; }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li {
            display: block !important; width: 100% !important; height: auto !important; float: none !important; position: static !important;
            border-bottom: 1px solid rgba(255, 255, 255, .12) !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li > a {
            width: 100% !important; height: auto !important; min-height: 48px !important;
            justify-content: flex-start !important; padding: 12px 18px !important; font-size: 16px !important; white-space: normal !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.jtv-nav-home-link > a { width: 100% !important; }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.dropdown > .dropdown-menu {
            position: static !important; display: none !important; width: 100% !important; max-width: none !important;
            opacity: 1 !important; visibility: visible !important; pointer-events: auto !important;
            box-shadow: none !important; background: rgba(0, 0, 0, .18) !important; padding: 4px 0 !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list .dropdown-menu a { justify-content: flex-start !important; text-align: left !important; }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.dropdown > .dropdown-menu.active,
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.dropdown.open > .dropdown-menu { display: block !important; }
    }

    /* Mobile: nav bar height, hidden drawer, category headings/cards, footer spacing */
    @media (max-width: 767px) {
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav,
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav .jtv-nav-container { height: 44px !important; min-height: 44px !important; }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list:not(.active) {
            visibility: visible !important;
            box-shadow: none !important;
            position: static !important;
            top: auto !important; right: auto !important; left: auto !important;
            width: max-content !important; min-width: 100% !important; height: 44px !important;
            background-color: transparent !important; z-index: auto !important; overflow: visible !important;
            padding: 0 !important; margin: 0 !important; border: 0 !important;
            transition: none !important; display: flex !important; flex-direction: row !important; flex-wrap: nowrap !important; justify-content: flex-start !important; align-items: center !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list:not(.active) > li {
            display: flex !important; flex: none !important; float: none !important; position: relative !important; width: auto !important; height: 44px !important; padding: 0 !important; border-bottom: 0 !important;
        }

        /* Hamburger-triggered full drawer: JS adds .active to .nav-list on click */
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list.active {
            visibility: visible !important;
            box-shadow: -4px 0 24px rgba(0, 0, 0, .25) !important;
            position: fixed !important;
            top: 0 !important; bottom: 0 !important; left: auto !important;
            right: 0 !important;
            width: min(300px, 82vw) !important; min-width: 0 !important; max-width: none !important;
            height: 100vh !important; height: 100dvh !important;
            background-color: #07532d !important; z-index: 4000 !important; overflow-x: hidden !important; overflow-y: auto !important;
            padding: 56px 0 24px !important; margin: 0 !important; border: 0 !important;
            transition: none !important; display: flex !important; flex-direction: column !important; flex-wrap: nowrap !important; justify-content: flex-start !important; align-items: stretch !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list.active > li {
            display: flex !important; flex: none !important; float: none !important; position: relative !important; width: 100% !important; height: auto !important; padding: 0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, .12) !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list.active > li:nth-child(n+7) {
            display: flex !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list.active::after {
            display: none !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list.active > li > a {
            width: 100% !important; height: auto !important; min-height: 48px !important; max-height: none !important;
            justify-content: flex-start !important; padding: 12px 20px !important; font-size: 15px !important; white-space: normal !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list.active > li.jtv-nav-home-link {
            min-width: 0 !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list.active > li.jtv-nav-home-link > a {
            width: 100% !important; min-width: 0 !important; justify-content: flex-start !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list.active > li.jtv-nav-home-link > a i {
            display: inline-block !important; margin-right: 10px !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list.active > li.active > a,
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list.active > li.current-menu-item > a {
            background: rgba(195, 29, 36, .9) !important;
        }

        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav .mobile-toggle {
            margin-right: 8px !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li > a,
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.jtv-nav-home-link > a {
            display: flex !important; align-items: center !important; justify-content: center !important;
            width: auto !important; height: 44px !important; min-height: 0 !important; max-height: 44px !important;
            padding: 0 11px !important; font-size: 13px !important; white-space: nowrap !important; border-bottom: 0 !important;
        }

        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li > a {
            background: transparent !important;
            border-radius: 6px !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.jtv-nav-home-link > a {
            color: #fff !important;
            font-weight: 700 !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.jtv-nav-home-link > a i {
            display: inline-block !important;
            font-size: 16px !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.jtv-nav-home-link > a .jtv-nav-home-label {
            display: none !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.jtv-nav-home-link {
            width: auto !important;
            min-width: 44px !important;
            flex: none !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.jtv-nav-home-link > a {
            width: 44px !important;
            min-width: 44px !important;
            box-sizing: border-box !important;
            padding: 0 !important;
            justify-content: center !important;
        }

        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.active > a,
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.current-menu-item > a,
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li.current_page_item > a {
            background: #c31d24 !important;
            color: #fff !important;
        }

        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list > li:nth-child(n+7) {
            display: none !important;
        }

        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list::after {
            content: '\2022\2022\2022' !important;
            display: flex !important;
            align-items: center !important;
            padding: 0 11px !important;
            color: #fff !important;
            font-size: 13px !important;
            letter-spacing: 1px !important;
        }

        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.float-end { display: none !important; }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav li.jtv-nav-live,
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav li.jtv-nav-live > a { width: auto !important; min-width: 0 !important; max-width: none !important; }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap {
            flex: 1 1 auto !important; width: auto !important; min-width: 0 !important;
            overflow: visible !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav li.jtv-nav-search { display: none !important; }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-category-heading { padding: 8px 12px !important; }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-category-heading a { color: #fff !important; margin-left: auto !important; padding: 0 !important; }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-category-card { overflow: hidden; }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-category-card figure { width: 100% !important; margin: 0 !important; }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-category-card figure img { width: 100% !important; }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-category-card h3,
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-category-card p { padding-left: 12px !important; padding-right: 12px !important; }

        body.skin-magz.jtv-homepage.jtv-homepage .jtv-homepage-footer-bar { padding-top: 18px !important; padding-bottom: 18px !important; gap: 12px !important; }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-homepage-footer-links { gap: 8px 16px !important; }
    }

    /* Small phones: date and search share the top bar without overlapping */
    @media (max-width: 480px) {
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-topbar-inner {
            display: flex !important; flex-wrap: nowrap !important; align-items: center !important;
            justify-content: space-between !important; gap: 8px !important; text-align: left !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-topbar-inner > .jtv-topbar-meta {
            flex: 0 0 auto !important; min-width: max-content !important; width: auto !important; font-size: 11px !important;
            white-space: nowrap !important; overflow: visible !important; text-overflow: clip !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-topbar-inner > .jtv-lang-toggle {
            flex: none !important; margin-left: auto !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-topbar-inner > .jtv-topbar-actions {
            flex: 0 1 150px !important; min-width: 0 !important; width: auto !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-topbar-actions form,
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-topbar-actions input[type="search"] { min-width: 0 !important; max-width: 100% !important; }
    }

    /* Site-wide: bold, consistent near-black body copy (titles, excerpts, meta,
       lists, footer text). Deliberately leaves nav links, buttons and badge/tag
       pills alone — those rely on their own (often white-on-color) text to stay
       readable, and turning them black would make them disappear into their
       backgrounds. */
    body.skin-magz :where(
        p, h1, h2, h3, h4, h5, h6, li, dt, dd, time, small, label, blockquote, caption, figcaption
    ):not(nav *):not(.btn):not(button):not([class*="overlay"] *):not([class*="overlay"]):not(.category):not(.category *):not([class*="badge"]):not([class*="badge"] *):not(.jtv-cat-banner):not(.jtv-cat-banner *) {
        font-weight: 700 !important;
        color: #000 !important;
    }

    body.skin-magz :where(span, a):not(nav *):not(.btn):not(button):not([class*="badge"]):not([class*="badge"] *):not([class*="tag"]):not([class*="pill"]):not([class*="btn"]):not([class*="overlay"] *):not(.category):not(.category *):not(.jtv-cat-banner):not(.jtv-cat-banner *) {
        font-weight: 700 !important;
        color: #000 !important;
    }

    body.skin-magz input,
    body.skin-magz textarea,
    body.skin-magz select {
        font-weight: 700 !important;
        color: #000 !important;
    }
</style>
@endonce
