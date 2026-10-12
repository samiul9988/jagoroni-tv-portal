<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="60">
    <meta name="theme-color" content="#0B6B3A">
    <title>আমরা শীঘ্রই ফিরে আসছি — Jagoroni TV</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            font-family: "Noto Sans Bengali", "Segoe UI", Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at 15% 20%, rgba(11, 107, 58, .35), transparent 40%),
                radial-gradient(circle at 85% 75%, rgba(214, 31, 38, .22), transparent 45%),
                linear-gradient(135deg, #04150d 0%, #0b2b1b 55%, #0d3a24 100%);
            background-color: #04150d;
            position: relative;
            overflow: hidden;
        }

        .glow-dot { position: fixed; border-radius: 50%; background: #7cffb0; filter: blur(1px); opacity: .55; animation: pulse 3.4s ease-in-out infinite; pointer-events: none; }
        .glow-dot.d1 { width: 10px; height: 10px; top: 14%; left: 10%; animation-delay: 0s; }
        .glow-dot.d2 { width: 7px; height: 7px; top: 70%; left: 20%; animation-delay: .6s; }
        .glow-dot.d3 { width: 9px; height: 9px; top: 30%; right: 12%; animation-delay: 1.1s; }
        .glow-dot.d4 { width: 6px; height: 6px; top: 80%; right: 22%; animation-delay: 1.7s; }
        @keyframes pulse { 0%, 100% { transform: scale(1); opacity: .35; } 50% { transform: scale(1.8); opacity: .85; } }

        .maint-card {
            position: relative;
            z-index: 1;
            width: min(560px, 100%);
            padding: 3rem 2.6rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .14);
            backdrop-filter: blur(6px);
            text-align: center;
            box-shadow: 0 30px 70px rgba(2, 15, 8, .55);
        }

        .maint-gear-stack { position: relative; width: 120px; height: 120px; margin: 0 auto 1.6rem; }
        .maint-gear-stack i { position: absolute; color: #7cffb0; text-shadow: 0 0 24px rgba(124, 255, 176, .6); }
        .maint-gear-stack .gear-big { font-size: 5.5rem; top: 0; left: 0; animation: spin 7s linear infinite; }
        .maint-gear-stack .gear-small { font-size: 3rem; bottom: -4px; right: -8px; color: #d61f26; text-shadow: 0 0 20px rgba(214, 31, 38, .6); animation: spin-reverse 5s linear infinite; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes spin-reverse { from { transform: rotate(360deg); } to { transform: rotate(0deg); } }

        .maint-card h1 { margin: 0 0 .6rem; color: #fff; font-size: 1.85rem; font-weight: 800; letter-spacing: -.01em; }
        .maint-card p { margin: 0 0 1.6rem; color: #d7f5e4; font-size: .95rem; line-height: 1.7; }

        .maint-progress { height: 6px; border-radius: 999px; background: rgba(255,255,255,.14); overflow: hidden; margin-bottom: 1.6rem; }
        .maint-progress span { display: block; height: 100%; width: 40%; border-radius: 999px; background: linear-gradient(90deg, #0b6b3a, #d61f26); animation: slide 1.8s ease-in-out infinite; }
        @keyframes slide { 0% { transform: translateX(-100%); } 100% { transform: translateX(350%); } }

        .maint-brand { display: inline-flex; align-items: center; gap: .55rem; padding: .55rem 1rem; border-radius: 999px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.14); }
        .maint-brand span { color: #e7fcef; font-size: .82rem; font-weight: 700; }
        .maint-brand span b { color: #d61f26; }

        @media (max-width: 480px) {
            .maint-card { padding: 2.2rem 1.6rem; }
        }
    </style>
</head>
<body>
    <span class="glow-dot d1"></span>
    <span class="glow-dot d2"></span>
    <span class="glow-dot d3"></span>
    <span class="glow-dot d4"></span>

    <div class="maint-card">
        <div class="maint-gear-stack" aria-hidden="true">
            <i class="bi bi-gear-fill gear-big"></i>
            <i class="bi bi-gear-fill gear-small"></i>
        </div>

        <h1>আমরা শীঘ্রই ফিরে আসছি</h1>
        <p>সাইটটি এই মুহূর্তে কিছু জরুরি আপডেটের কাজ চলছে। অসুবিধার জন্য আন্তরিকভাবে দুঃখিত — কিছুক্ষণের মধ্যেই আমরা আবার ফিরে আসব।</p>

        <div class="maint-progress"><span></span></div>

        <div class="maint-brand">
            <span>জাগরণী <b>টিভি</b></span>
        </div>
    </div>
</body>
</html>
