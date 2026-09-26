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
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav .jtv-nav-container { height: 56px !important; min-height: 56px !important; }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list:not(.active) { visibility: hidden !important; box-shadow: none !important; }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list > ul.nav-list.active { visibility: visible !important; }

        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav ul.float-end { display: flex !important; align-items: center !important; gap: 8px !important; flex: 0 0 auto !important; width: auto !important; height: auto !important; margin: 0 0 0 auto !important; padding: 0 !important; }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav li.jtv-nav-live,
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav li.jtv-nav-live > a { width: auto !important; min-width: 0 !important; max-width: none !important; }
        body.skin-magz.jtv-homepage.jtv-homepage nav.jtv-main-nav #menu-list.jtv-nav-list-wrap { flex: 1 1 0 !important; width: auto !important; min-width: 0 !important; }
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
            flex: 1 1 auto !important; min-width: 0 !important; width: auto !important; font-size: 11px !important;
            white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-topbar-inner > .jtv-topbar-actions {
            flex: 0 1 150px !important; min-width: 0 !important; width: auto !important;
        }
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-topbar-actions form,
        body.skin-magz.jtv-homepage.jtv-homepage .jtv-topbar-actions input[type="search"] { min-width: 0 !important; max-width: 100% !important; }
    }
</style>
@endonce
