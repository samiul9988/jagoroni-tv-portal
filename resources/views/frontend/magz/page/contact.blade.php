@extends('frontend.magz.index')

@push('scripts_head')
{!! NoCaptcha::renderJs() !!}
@endpush

@section('content')
<section class="page top">
    <div class="container-md">
        <div class="row">
            <div class="col-xl-12">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="/">{{ __('dhakawatch::magz.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('dhakawatch::magz.contact_us') }}</li>
                </ol>
                <h1 class="page-title">{{ __('dhakawatch::magz.contact_us') }}</h1>
                <p class="page-subtitle">{{ __('dhakawatch::magz.contact_us_subtitle') }}</p>
                <div class="line thin"></div>
                <div class="page-description">
                    <div class="row">
                        @if($contactInformation)
                        <div class="col-xl-6 col-lg-6">
                            <h2>{{ __('dhakawatch::magz.contact') }}</h2>
                            @if(config('settings.contact_description') && Arr::exists(json_decode(config('settings.contact_description'), true), LaravelLocalization::getCurrentLocale()))
                            <p> 
                            {{ json_decode(config('settings.contact_description'), true)[LaravelLocalization::getCurrentLocale()] }}
                            </p>
                            @endif
                            <p>
                                {{ __('dhakawatch::magz.contact_phone') }}: <span class="bold">{{ config('settings.site_phone') }}</span> <br>
                                {{ __('dhakawatch::magz.contact_email') }}: <span class="bold">{{ config('settings.site_email') }}</span>
                            </p>
                            <p>
                                {{  config('settings.street') }} <br>
                                {{  config('settings.city') }} {{ config('settings.postal_code') }} <br>
                                {{  config('settings.state') }} @if(config('settings.country')) - {{ config('settings.country') }} @endif
                            </p>
                        </div>
                        @endif
                        <div class="col-xl-6 col-lg-6 @if(!$contactInformation) offset-lg-3 @endif">
                            <form class="row contact" id="contact-form" method="POST" data-recaptcha="true">
                                <input type="hidden" id="captchaCheck" value="{{ $captchaActive }}">
                                <div class="col-xl-6">
                                    <div class="form-group form-group-name">
                                        <label for="name">{{ __('dhakawatch::magz.contact_name') }} <span class="required"></span></label>
                                        <input id="name" type="text" class="form-control" name="name" required>
                                        <div id="msg-error-name" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group form-group-email">
                                        <label for="email">{{ __('dhakawatch::magz.contact_email') }} <span class="required"></span></label>
                                        <input id="email" type="text" class="form-control" name="email" required>
                                        <div id="msg-error-email" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-xl-12 my-3">
                                    <div class="form-group form-group-subject">
                                        <label for="subject">{{ __('dhakawatch::magz.contact_subject') }}</label>
                                        <input id="subject" type="text" class="form-control" name="subject">
                                        <div id="msg-error-subject" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group form-group-message">
                                        <label for="message">{{ __('dhakawatch::magz.contact_message') }} <span class="required"></span></label>
                                        <textarea id="message" class="form-control" name="message" required></textarea>
                                        <div id="msg-error-message" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <x-captcha/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<x-map/>
@stop
