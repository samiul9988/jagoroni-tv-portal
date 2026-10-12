@extends('adminlte::page')

@section('title', 'সাইট মেইনটেন্যান্স')

@section('content_header')
    <h1 class="sr-only">সাইট মেইনটেন্যান্স</h1>
@stop

@section('content')
    <style>
        .jtv-maint-card { max-width: 640px; margin: 0 auto; background: #fff; border: 1px solid #dfe8e3; border-radius: 10px; padding: 24px 28px; }
        .jtv-maint-card h2 { margin: 0 0 18px; color: #163a2b; font-size: 1.15rem; font-weight: 800; }
        .jtv-maint-status-row { display: flex; align-items: center; justify-content: space-between; gap: 1.5rem; }
        .jtv-maint-status-badge { display: inline-flex; align-items: center; gap: .4rem; padding: .35rem .75rem; border-radius: 999px; font-size: .8rem; font-weight: 700; }
        .jtv-maint-status-badge.is-off { background: #e4f7e8; color: #0b6b3a; }
        .jtv-maint-status-badge.is-on { background: #fdecec; color: #c43b3b; }
        .jtv-maint-status-desc { margin: .6rem 0 0; max-width: 380px; color: #5d7092; font-size: .85rem; line-height: 1.6; }
        .jtv-maint-toggle-switch { position: relative; flex: 0 0 auto; width: 62px; height: 34px; border: 0; border-radius: 999px; background: #d7dee8; cursor: pointer; transition: background .2s ease; }
        .jtv-maint-toggle-switch.is-on { background: #0b6b3a; }
        .jtv-maint-toggle-knob { position: absolute; top: 3px; left: 3px; width: 28px; height: 28px; border-radius: 50%; background: #fff; box-shadow: 0 2px 6px rgba(0,0,0,.25); transition: transform .2s ease; }
        .jtv-maint-toggle-switch.is-on .jtv-maint-toggle-knob { transform: translateX(28px); }
        .jtv-maint-preview-link { margin-top: 1.2rem; }
        .jtv-maint-bookmark-note { margin-top: 1.2rem; padding: .8rem 1rem; border-radius: 6px; background: #fff8e8; border: 1px solid #f3e0ad; color: #7a5b12; font-size: .82rem; line-height: 1.6; }
        .jtv-maint-bookmark-note code { background: rgba(0,0,0,.06); padding: .05rem .3rem; border-radius: 3px; word-break: break-all; }
    </style>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="jtv-maint-card">
        <h2><i class="fas fa-toggle-on"></i> সাইট মেইনটেন্যান্স মোড</h2>

        <div class="jtv-maint-status-row">
            <div>
                <span class="jtv-maint-status-badge {{ $active ? 'is-on' : 'is-off' }}">
                    <i class="fas {{ $active ? 'fa-exclamation-triangle' : 'fa-check-circle' }}"></i>
                    {{ $active ? 'মেইনটেন্যান্স মোড চালু আছে' : 'সাইট লাইভ আছে' }}
                </span>
                <p class="jtv-maint-status-desc">
                    @if ($active)
                        ভিজিটররা এখন সাইটের বদলে মেইনটেন্যান্স পেজ দেখছেন। এই পেজটি login ছাড়াই খোলা থাকে, তাই আপনি যেকোনো সময় এটি আবার বন্ধ করতে পারবেন।
                    @else
                        সাইট এখন সবার জন্য স্বাভাবিকভাবে চলছে।
                    @endif
                </p>
            </div>

            <form method="POST" action="{{ route('maintenance.toggle', $key ? ['key' => $key] : []) }}">
                @csrf
                @if ($key)
                    <input type="hidden" name="key" value="{{ $key }}">
                @endif
                <button type="submit" class="jtv-maint-toggle-switch {{ $active ? 'is-on' : '' }}" aria-pressed="{{ $active ? 'true' : 'false' }}">
                    <span class="jtv-maint-toggle-knob"></span>
                </button>
            </form>
        </div>

        <div class="jtv-maint-preview-link">
            <a href="{{ route('maintenance.preview') }}" target="_blank" class="btn btn-light btn-sm">
                <i class="fas fa-eye"></i> মেইনটেন্যান্স পেজ প্রিভিউ করুন
            </a>
        </div>

        @unless (auth()->check())
            <div class="jtv-maint-bookmark-note">
                <i class="fas fa-bookmark"></i>
                এই পেজের সম্পূর্ণ URL-টি (<code>?key=...</code> সহ) বুকমার্ক করে রাখুন — login ছাড়া আবার এখানে ফিরে আসার এটিই একমাত্র উপায়।
            </div>
        @endunless
    </div>
@stop
