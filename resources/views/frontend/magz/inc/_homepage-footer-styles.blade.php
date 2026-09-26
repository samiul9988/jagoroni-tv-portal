@once
<style>
    body.skin-magz.jtv-homepage footer.footer {
        padding: 0 !important;
        border-top: 0 !important;
        background: #0d1f16 !important;
    }

    body.skin-magz.jtv-homepage .jtv-homepage-footer-bar {
        width: 100% !important;
        max-width: none !important;
        margin: 0 auto !important;
        padding-left: clamp(12px, 2vw, 32px) !important;
        padding-right: clamp(12px, 2vw, 32px) !important;
        box-sizing: border-box !important;
        display: grid !important;
        grid-template-columns: auto 1fr auto !important;
        gap: 18px !important;
        align-items: center !important;
        min-height: 44px !important;
        color: rgba(255, 255, 255, .9) !important;
        font-size: 12px !important;
    }

    body.skin-magz.jtv-homepage .jtv-homepage-footer-copy { text-align: left !important; }
    body.skin-magz.jtv-homepage .jtv-homepage-footer-slogan { text-align: right !important; }

    body.skin-magz.jtv-homepage .jtv-homepage-footer-links {
        display: flex !important;
        justify-content: center !important;
        flex-wrap: wrap !important;
        gap: 16px !important;
        margin: 0 !important;
        padding: 0 !important;
        list-style: none !important;
    }

    body.skin-magz.jtv-homepage .jtv-homepage-footer-links a,
    body.skin-magz.jtv-homepage .jtv-homepage-footer-slogan {
        color: rgba(255, 255, 255, .85) !important;
        text-decoration: none !important;
    }

    @media (max-width: 1199px) {
        body.skin-magz.jtv-homepage .jtv-homepage-footer-bar {
            grid-template-columns: 1fr !important;
            justify-items: center !important;
            text-align: center !important;
            padding-top: 10px !important;
            padding-bottom: 10px !important;
        }

        body.skin-magz.jtv-homepage .jtv-homepage-footer-copy,
        body.skin-magz.jtv-homepage .jtv-homepage-footer-slogan {
            text-align: center !important;
        }
    }
</style>
@endonce
