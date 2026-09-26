@extends('adminlte::page')

@section('title', 'Contact Settings')

@section('content_header')
    <h1><i class="fas fa-envelope-open-text mr-2 text-success"></i>Contact Settings</h1>
@stop

@section('content')
    @if(session('success'))<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>{{ session('error') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

    <form method="POST" action="{{ route('contact-settings.update') }}">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-lg-7">
                <div class="card card-outline card-info">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-address-card mr-1"></i> Contact information (shown on the Contact page)</h3></div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6"><label><i class="fas fa-phone mr-1"></i> Phone</label><input name="site_phone" class="form-control" value="{{ old('site_phone', config('settings.site_phone')) }}" placeholder="+880 1234 567890"></div>
                            <div class="form-group col-md-6"><label><i class="far fa-clock mr-1"></i> Office hours (shown under the phone)</label><input name="contact_hours" class="form-control" value="{{ old('contact_hours', config('settings.contact_hours')) }}" placeholder="(সকাল ৯টা - সন্ধ্যা ৬টা)"></div>
                        </div>
                        <div class="form-group"><label><i class="far fa-envelope mr-1"></i> Public email</label><input type="email" name="site_email" class="form-control" value="{{ old('site_email', config('settings.site_email')) }}" placeholder="info@yourdomain.com"></div>
                        <div class="form-group"><label><i class="fas fa-map-marker-alt mr-1"></i> Address (street / house / road)</label><input name="street" class="form-control" value="{{ old('street', config('settings.street')) }}" placeholder="২৭১১ বিটিস রোড, ..."></div>
                        <div class="form-row">
                            <div class="form-group col-md-4"><label>City</label><input name="city" class="form-control" value="{{ old('city', config('settings.city')) }}"></div>
                            <div class="form-group col-md-4"><label>State / Division</label><input name="state" class="form-control" value="{{ old('state', config('settings.state')) }}"></div>
                            <div class="form-group col-md-4"><label>Postal code</label><input name="postal_code" class="form-control" value="{{ old('postal_code', config('settings.postal_code')) }}"></div>
                        </div>
                        <div class="form-group mb-1"><label>Country</label><input name="country" class="form-control" value="{{ old('country', config('settings.country')) }}"></div>
                        <small class="text-muted">The short "about us" text and social media icons are in <a href="{{ route('settings.webcontact') }}">Settings → Web Contact</a>.</small>
                    </div>
                </div>

                <div class="card card-outline card-success">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-inbox mr-1"></i> Where do contact messages go?</h3></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Receiver email</label>
                            <input type="email" name="contact_mail_to" class="form-control" value="{{ old('contact_mail_to', config('settings.contact_mail_to')) }}" placeholder="{{ config('settings.site_email') ?: 'info@yourdomain.com' }}">
                            <small class="text-muted">Every message sent from the Contact page is emailed here. Empty = the website email ({{ config('settings.site_email') ?: 'not set' }}). Messages are also always saved in Admin → Contacts.</small>
                        </div>
                    </div>
                </div>

                <div class="card card-outline card-primary">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-server mr-1"></i> SMTP (sending) settings</h3></div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-8"><label>SMTP host</label><input name="mail_host" class="form-control" value="{{ old('mail_host', config('settings.mail_host')) }}" placeholder="smtp.gmail.com"></div>
                            <div class="form-group col-md-4"><label>Port</label><input type="number" name="mail_port" class="form-control" value="{{ old('mail_port', config('settings.mail_port')) }}" placeholder="587"></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Encryption</label>
                                @php $enc = old('mail_encryption', config('settings.mail_encryption') ?: 'tls'); @endphp
                                <select name="mail_encryption" class="form-control">
                                    <option value="tls" @selected($enc === 'tls')>TLS (port 587)</option>
                                    <option value="ssl" @selected($enc === 'ssl')>SSL (port 465)</option>
                                    <option value="none" @selected($enc === 'none')>None (port 25)</option>
                                </select>
                            </div>
                            <div class="form-group col-md-8"><label>Username</label><input name="mail_username" class="form-control" autocomplete="off" value="{{ old('mail_username', config('settings.mail_username')) }}" placeholder="you@gmail.com"></div>
                        </div>
                        <div class="form-group">
                            <label>Password / app password</label>
                            <input type="password" name="mail_password" class="form-control" autocomplete="new-password" placeholder="{{ $hasPassword ? '•••••••• (saved — leave blank to keep)' : 'Enter SMTP password' }}">
                            @if($hasPassword)<div class="custom-control custom-checkbox mt-1"><input type="checkbox" class="custom-control-input" id="clear-pw" name="clear_password" value="1"><label class="custom-control-label" for="clear-pw">Remove the saved password</label></div>@endif
                            <small class="text-muted">Stored encrypted. For Gmail use an <b>App password</b>, not your normal password.</small>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6"><label>From address</label><input type="email" name="mail_from_address" class="form-control" value="{{ old('mail_from_address', config('settings.mail_from_address')) }}" placeholder="same as username if empty"></div>
                            <div class="form-group col-md-6"><label>From name</label><input name="mail_from_name" class="form-control" value="{{ old('mail_from_name', config('settings.mail_from_name')) }}" placeholder="{{ config('settings.site_name') }}"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card card-outline card-warning">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-map-marked-alt mr-1"></i> Google Map (Contact page)</h3></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Map embed link or iframe code</label>
                            <textarea name="contact_map_embed" rows="5" class="form-control" placeholder='https://www.google.com/maps/embed?pb=…  or  <iframe src="…"></iframe>'>{{ old('contact_map_embed', config('settings.contact_map_embed')) }}</textarea>
                            <small class="text-muted d-block mt-1"><b>How:</b> Google Maps → search your office → Share → <b>Embed a map</b> → copy HTML. Paste it here. Empty = the theme's default map.</small>
                        </div>
                        @if(config('settings.contact_map_embed'))
                            <iframe src="{{ config('settings.contact_map_embed') }}" style="width:100%;height:220px;border:0;border-radius:6px" loading="lazy" title="Map preview"></iframe>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-success btn-block"><i class="fas fa-save mr-1"></i> Save contact settings</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ route('contact-settings.test') }}" class="card card-outline card-secondary">
        @csrf
        <div class="card-header"><h3 class="card-title"><i class="fas fa-paper-plane mr-1"></i> Send a test email</h3></div>
        <div class="card-body">
            <p class="text-muted mb-2">Save the settings first, then send a test to check that SMTP works.</p>
            <div class="input-group" style="max-width:520px">
                <input type="email" name="test_to" class="form-control" placeholder="your@email.com" value="{{ old('test_to', config('settings.contact_mail_to') ?: config('settings.site_email')) }}" required>
                <div class="input-group-append"><button class="btn btn-secondary">Send test</button></div>
            </div>
        </div>
    </form>
@stop

@section('footer') @include('layouts.partials._footer') @stop
