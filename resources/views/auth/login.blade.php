@extends('adminlte::master')

@php
	$loginUrl = View::getSection('login_url') ?? config('adminlte.login_url', 'login');
	$registerUrl = View::getSection('register_url') ?? config('adminlte.register_url', 'register');
	$passResetUrl = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset');
	$brandLogo = \App\Helpers\ImageHelper::webLogoLight();
	$cardLogo = \App\Helpers\ImageHelper::webLogoDark();

	if (config('adminlte.use_route_url', false)) {
		$loginUrl = $loginUrl ? route($loginUrl) : '';
		$registerUrl = $registerUrl ? route($registerUrl) : '';
		$passResetUrl = $passResetUrl ? route($passResetUrl) : '';
	} else {
		$loginUrl = $loginUrl ? url($loginUrl) : '';
		$registerUrl = $registerUrl ? url($registerUrl) : '';
		$passResetUrl = $passResetUrl ? url($passResetUrl) : '';
	}
@endphp

@section('title_prefix', __('auth.login'))
@section('title', ' - ' . strip_tags(config('adminlte.logo')))
@section('classes_body', 'jtv-auth-page login-page')

@section('adminlte_css')
	<link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<style>
		:root { --jtv-green: #087849; --jtv-red: #d71e27; }
		* { box-sizing: border-box; }
		body.jtv-auth-page { min-height: 100vh; margin: 0; color: #173d2d; background: #eff8f6; font-family: "Noto Sans Bengali", "Segoe UI", Arial, sans-serif; }
		.jtv-auth-shell { display: grid; grid-template-columns: minmax(0, 1.12fr) minmax(420px, .88fr); min-height: 100vh; background: linear-gradient(120deg, #effaf7, #fff 52%, #eef8f5); }
		.jtv-auth-visual { position: relative; display: flex; min-height: 100vh; align-items: center; overflow: hidden; padding: 8vh 8vw; background: linear-gradient(155deg, #087849, #075b3a 48%, #033c29); isolation: isolate; }
		.jtv-auth-visual::before { position: absolute; inset: 0; z-index: -1; content: ""; opacity: .3; background: radial-gradient(circle at 15% 15%, #c5f5dd 0 2px, transparent 3px) 0 0 / 24px 24px, linear-gradient(135deg, transparent 45%, rgba(255,255,255,.12) 45.2%, transparent 47%); }
		.jtv-auth-visual::after { position: absolute; right: -15%; bottom: -20%; z-index: -1; width: 82%; height: 68%; content: ""; border-radius: 50% 50% 0 0; background: linear-gradient(145deg, rgba(255,255,255,.12), transparent 60%); transform: rotate(-14deg); }
		.jtv-auth-art { position: absolute; right: 3%; bottom: 0; width: 49%; height: 72%; opacity: .24; background: linear-gradient(180deg, transparent 0 27%, #e9fff4 28% 30%, transparent 31%), linear-gradient(75deg, transparent 48%, #e9fff4 48.5% 52%, transparent 52.5%), linear-gradient(105deg, transparent 48%, #e9fff4 48.5% 52%, transparent 52.5%); clip-path: polygon(50% 0, 56% 30%, 100% 100%, 0 100%, 44% 30%); }
		.jtv-auth-brand { position: relative; z-index: 1; max-width: 650px; color: #fff; }
		.jtv-auth-brand-logo { display: block; width: min(420px, 80%); max-height: 100px; margin-bottom: 34px; object-fit: contain; object-position: left center; filter: brightness(0) invert(1); }
		.jtv-auth-brand h1 { max-width: 560px; margin: 0 0 14px; color: #fff; font-size: clamp(29px, 4vw, 52px); font-weight: 900; line-height: 1.18; }
		.jtv-auth-brand h1 span { color: #baf1d3; }
		.jtv-auth-brand p { max-width: 500px; margin: 0; color: rgba(255,255,255,.8); font-size: 18px; line-height: 1.8; }
		.jtv-auth-features { display: flex; flex-wrap: wrap; gap: 24px; margin: 42px 0 0; padding: 0; list-style: none; color: #fff; }
		.jtv-auth-features li { display: inline-flex; align-items: center; gap: 9px; font-size: 14px; font-weight: 700; }
		.jtv-auth-features i { color: #baf1d3; font-size: 20px; }
		.jtv-auth-form-area { display: flex; align-items: center; justify-content: center; padding: 42px 7vw; }
		.jtv-auth-card { width: min(100%, 470px); padding: 38px 42px 30px; border: 1px solid #e0ece6; border-radius: 18px; background: rgba(255,255,255,.94); box-shadow: 0 20px 55px rgba(5, 77, 49, .13); }
		.jtv-auth-card-brand { display: flex; align-items: center; justify-content: center; margin-bottom: 22px; }
		.jtv-auth-card-brand img { width: 205px; max-height: 58px; object-fit: contain; }
		.jtv-auth-card h2 { margin: 0; color: #075c3b; text-align: center; font-size: 27px; font-weight: 900; }
		.jtv-auth-card-intro { margin: 7px 0 25px; color: #87978f; text-align: center; font-size: 13px; }
		.jtv-auth-field { position: relative; margin-bottom: 15px; }
		.jtv-auth-field i { position: absolute; top: 16px; left: 15px; z-index: 1; color: #82968c; }
		.jtv-auth-field input { width: 100%; height: 52px; padding: 0 16px 0 46px; border: 1px solid #d8e5df; border-radius: 8px; outline: 0; color: #214b39; background: #fbfdfc; font: inherit; font-size: 14px; }
		.jtv-auth-field input:focus { border-color: #0a8a55; box-shadow: 0 0 0 3px rgba(10,138,85,.12); background: #fff; }
		.jtv-auth-error { display: block; margin: -8px 0 10px; color: #d71e27; font-size: 11px; }
		.jtv-auth-options { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin: 4px 0 22px; color: #71857b; font-size: 12px; }
		.jtv-auth-options label { display: inline-flex; align-items: center; gap: 7px; cursor: pointer; }
		.jtv-auth-options input { accent-color: var(--jtv-green); }
		.jtv-auth-options a, .jtv-auth-register a { color: var(--jtv-green); font-weight: 800; text-decoration: none; }
		.jtv-auth-submit { display: flex; width: 100%; height: 52px; align-items: center; justify-content: center; gap: 8px; border: 0; border-radius: 8px; color: #fff; background: linear-gradient(90deg, #087849, #079557); font: inherit; font-size: 15px; font-weight: 800; cursor: pointer; box-shadow: 0 8px 16px rgba(8,120,73,.2); }
		.jtv-auth-submit:hover { background: linear-gradient(90deg, #06643d, #087849); }
		.jtv-auth-divider { display: flex; align-items: center; gap: 13px; margin: 25px 0 18px; color: #a0ada7; font-size: 12px; }
		.jtv-auth-divider::before, .jtv-auth-divider::after { flex: 1; height: 1px; content: ""; background: #dfe9e4; }
		.jtv-auth-register { margin: 0; color: #7e9188; text-align: center; font-size: 13px; }
		.jtv-auth-alert { margin-bottom: 14px; padding: 10px 12px; border-radius: 6px; color: #9e1820; background: #fff0f1; font-size: 12px; }
		@media (max-width: 900px) { .jtv-auth-shell { grid-template-columns: 1fr; } .jtv-auth-visual { min-height: 390px; padding: 55px 9vw; } .jtv-auth-brand-logo { width: 280px; margin-bottom: 22px; } .jtv-auth-brand h1 { font-size: 36px; } .jtv-auth-brand p { font-size: 15px; } .jtv-auth-features { margin-top: 25px; } .jtv-auth-form-area { padding: 38px 20px 55px; } }
		@media (max-width: 480px) { .jtv-auth-visual { min-height: 335px; padding: 38px 24px; } .jtv-auth-brand-logo { width: 240px; } .jtv-auth-brand h1 { font-size: 29px; } .jtv-auth-brand p { font-size: 13px; } .jtv-auth-features { gap: 12px; margin-top: 20px; } .jtv-auth-features li { font-size: 11px; } .jtv-auth-card { padding: 28px 20px 24px; border-radius: 12px; } }
	</style>
@stop

@section('body')
	<main class="jtv-auth-shell">
		<section class="jtv-auth-visual">
			<div class="jtv-auth-art"></div>
			<div class="jtv-auth-brand">
				<img class="jtv-auth-brand-logo" src="{{ $brandLogo }}" alt="Jagoroni TV">
				<h1>সত্য ও নিরপেক্ষ সংবাদে<br><span>সবসময় আপনার পাশে</span></h1>
				<p>জাগরণী টিভির সঙ্গে থাকুন। দেশ-বিদেশের সর্বশেষ খবর, বিশ্লেষণ এবং লাইভ সম্প্রচার একসঙ্গে পান।</p>
				<ul class="jtv-auth-features"><li><i class="fas fa-newspaper"></i> সর্বশেষ খবর</li><li><i class="fas fa-circle-play"></i> লাইভ সম্প্রচার</li><li><i class="fas fa-globe"></i> দেশ-বিদেশ</li></ul>
			</div>
		</section>
		<section class="jtv-auth-form-area">
			<div class="jtv-auth-card">
				<div class="jtv-auth-card-brand"><img src="{{ $cardLogo }}" alt="Jagoroni TV"></div>
				<h2>সাইন ইন করুন</h2><p class="jtv-auth-card-intro">আপনার অ্যাকাউন্টে প্রবেশ করতে তথ্য দিন</p>
				@if(session('status'))<div class="jtv-auth-alert">{{ session('status') }}</div>@endif
				@if($errors->any())<div class="jtv-auth-alert">{{ $errors->first() }}</div>@endif
				<form action="{{ $loginUrl }}" method="post">
					@csrf
					<div class="jtv-auth-field"><i class="fas fa-envelope"></i><input type="email" name="email" value="{{ old('email') }}" placeholder="ইমেইল ঠিকানা" required autofocus></div>
					@error('email')<span class="jtv-auth-error">{{ $message }}</span>@enderror
					<div class="jtv-auth-field"><i class="fas fa-lock"></i><input type="password" name="password" placeholder="পাসওয়ার্ড" required></div>
					@error('password')<span class="jtv-auth-error">{{ $message }}</span>@enderror
					<div class="jtv-auth-options"><label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> আমাকে মনে রাখুন</label>@if($passResetUrl)<a href="{{ $passResetUrl }}">পাসওয়ার্ড ভুলে গেছেন?</a>@endif</div>
					<button class="jtv-auth-submit" type="submit"><i class="fas fa-sign-in-alt"></i> সাইন ইন</button>
				</form>
				<div class="jtv-auth-divider">অথবা</div>
				@if($registerUrl)<p class="jtv-auth-register">নতুন সদস্য? <a href="{{ $registerUrl }}">রেজিস্ট্রেশন করুন</a></p>@endif
			</div>
		</section>
	</main>
@stop
