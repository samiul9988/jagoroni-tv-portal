@extends('adminlte::page')

@section('title', __('Web Contact'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
<x-breadcrumbs title="{{ __('title.web_contact') }}" currentActive="{{ __('title.web_contact') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.IconPicker', true)
@section('plugins.ColorPicker', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-2">
                <ul id="navTab" class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#address" data-toggle="tab">{{ __('Contact Address') }}</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#links" data-toggle="tab">{{ __('Contact Links') }}</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="address">
                        <form action="{{ route('settings.webcontact.update') }}" method="POST" role="form">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="street">{{ __('form.address_street') }}</label>
                                        <input id="street" type="text" name="street" class="form-control" placeholder="{{ __('form.placeholder_address_street') }}" value="{{ config('settings.street') }}">
                                        <div class="msg-street"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="city">{{ __('form.city') }}</label>
                                        <input id="city" type="text" name="city" class="form-control" placeholder="{{ __('form.placeholder_city') }}" value="{{ config('settings.city') }}">
                                        <div class="msg-city"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="postal_code">{{ __('form.postal_code') }}</label>
                                        <input id="postal_code" type="text" name="postal_code" class="form-control" placeholder="{{ __('form.placeholder_postal_code') }}" value="{{ config('settings.postal_code') }}">
                                        <div class="msg-postal_code"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="state">{{ __('form.state') }}</label>
                                        <input id="state" type="text" name="state" class="form-control" placeholder="{{ __('form.placeholder_state') }}" value="{{ config('settings.state') }}">
                                        <div class="msg-state"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="country">{{ __('form.country') }}</label>
                                        <input id="country" type="text" name="country" class="form-control" placeholder="{{ __('form.placeholder_country') }}" value="{{ config('settings.country') }}">
                                        <div class="msg-country"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="siteemail">{{ __('form.email') }}</label>
                                        <input id="siteemail" type="email" name="site_email" class="form-control" placeholder="{{ __('form.placeholder_email') }}" value="{{ config('settings.site_email') }}">
                                        <div class="msg-siteemail"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="sitephone">{{ __('form.phone') }}</label>
                                        <input id="sitephone" type="text" name="site_phone" class="form-control" placeholder="{{ __('form.placeholder_phone') }}" value="{{ config('settings.site_phone') }}">
                                        <div class="msg-sitephone"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="list-flags list-inline float-right ml-2 mb-0">
                                        @foreach (LocalizationHelper::getListFlags() as $language)
                                            @php    
                                            $active = ($language->id == Auth::user()->language) ? 'active' : '';
                                            @endphp
                                            <li class="list-inline-item mr-0 {{ $active }}" data-lang="{{ $language->language }}"><i class="flag-icon flag-icon-{{ Str::lower($language->country_code) }}"></i></li>
                                        @endforeach
                                    </ul>
                                    <div class="form-group">
                                        <label for="contactdescription">{{ __('form.contact_description') }}</label>
                                        <div id="contact_desc_el" class="form-group">
                                            @php 
                                                $data = json_decode(config('settings.contact_description'), true)
                                            @endphp
                                            @if ($data)
                                                @foreach($data as $lang => $txt)
                                                    @php $hidden = (LocalizationHelper::getLangCodeById(Auth::user()->language) != $lang) ? 'hidden' : ''; @endphp
                                                    <textarea id="contactdescription" name="contact_description[{{ $lang }}]"
                                                class="form-control contact_description input-contact-desc-{{ $lang }}" rows="5" placeholder="{{ __('form.placeholder_contact_description') }}" {{ $hidden }}>{!! nl2br($txt)!!}</textarea>
                                                @endforeach
                                            @else  
                                                <textarea id="contactdescription" name="contact_description[{{ $currentLanguage->language }}]" class="form-control contact_description input-contact-desc-{{ $currentLanguage->language }}" rows="5" placeholder="{{ __('form.placeholder_contact_description') }}"></textarea>
                                            @endif
                                        </div>
                                        <div class="msg-contactdescription"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button id="submit-web-contact" type="submit" class="btn btn-info float-right">{{ __('button.save') }}</button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="links">
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="socialmedia">{{ __('form.links') }}</label>
                                <p>{{ __('form.links_info') }}</p>
                                <button type="button" class="btn btn-light btn-sm" id="addLink">+ ADD LINK</button>
                            </div>
                        </div>
                        </div>
                        <div class="row links">
                            @if($links)
                                @foreach($links as $link)
                                    <div class="col-lg-6 mb-3" id="link{{ $link->id }}">
                                        <div class="form-group">
                                            <label>{{ $link->name }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="{{ $link->icon }}"></i></span>
                                                </div>
                                                <input type="text" name="url" class="bg-link-input form-control" placeholder="" value="{{ $link->url }}" title="{{ $link->url }}" readonly>
                                                <div class="input-group-append" onclick="removeInput('{{ $link->id }}')" style="cursor:pointer">
                                                    <span class="input-group-text"><i class="fas fa-times"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@include('admin.settings._link-modal')
@stop

@push('css')
    @include('admin.settings._style')
@endpush

@push('js')
    @include('layouts.partials._notification')
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._csrf-token')
    @include('admin.languages._languages')
    <script>
        $(document).ready(() => {
            let url = location.href.replace(/\/$/, "");

            if (location.hash) {
                const hash = url.split("#");
                $('#navTab a[href="#' + hash[1] + '"]').tab("show");
                url = location.href.replace(/\/#/, "#");
                history.replaceState(null, null, url);
                setTimeout(() => {
                    $(window).scrollTop(0);
                }, 400);
            }

            $('a[data-toggle="tab"]').on("click", function() {
                let newUrl;
                const hash = $(this).attr("href");
                newUrl = url.split("#")[0] + hash;
                newUrl += "/";
                history.replaceState(null, null, newUrl);
            });
        });
    </script>
    <script>
        "use strict";

        // SELECT FLAG **^
        $(document).on("click", ".list-flags li", function(e) {
            if (!$(this).hasClass('active')) {
                $('.list-flags li.active').removeClass('active');
                $(this).addClass('active');
            }
        });
        // END SELECT FLAG....................................................

        // SET CONTACT DESCRIPTION ***
        $(document).on("click", ".list-flags li.list-inline-item", function(e) {
            let lang = $(this).data('lang');

            if (!$(this).hasClass('input-contact-desc-' + lang)) {
                $('#contact_desc_el textarea').attr('hidden', true);
            }

            if ($('#contact_desc_el textarea').hasClass('input-contact-desc-' + lang)) {
                $('#contact_desc_el textarea.input-contact-desc-' + lang).removeAttr('hidden');
            } else {
                $('#contact_desc_el').append('<textarea id="contactdescription" name="contact_description[' + lang + ']" class="form-control contact_description input-contact-desc-' + lang + '" rows="3"></textarea>');
            }
        });
        // SET CONTACT DESCRIPTION.......................................

        $(function () {
            $('.icp-auto').iconpicker();
            $('#cp2').colorpicker();
        });

        // SHOWING MODAL
        $('#addLink').on('click', function(){
            $('#add-link-modal').modal('show');
        });

        // RESET FORM MODAL
        $('#add-link-modal').on('hidden.bs.modal', function () {
            $('#linkForm')[0].reset();

            $('#link-label, #link-url').removeClass('is-invalid').next('.invalid-feedback').html('');
            $('#link-icon').removeClass('is-invalid').closest('.iconpicker-container').removeClass('is-invalid').next('.invalid-feedback').html('');
            $('#link-color').removeClass('is-invalid').closest('#cp2').removeClass('is-invalid').next('.invalid-feedback').html('');
        });

        // SUBMIT FORM MODAL
        $('#submitAddLink').on('click', function(){
            if ($('#link-label').val() == '') {
                $('#link-label').addClass('is-invalid').next('.invalid-feedback').html("{{ __('validation.required', ['attribute'=>'Label']) }}");
            } else {
                $('#link-label').removeClass('is-invalid').next('.invalid-feedback').html('');
            }

            if ($('#link-url').val() == '') {
                $('#link-url').addClass('is-invalid').next('.invalid-feedback').html("{{ __('validation.required', ['attribute'=>'URL']) }}");
            } else {
                $('#link-url').removeClass('is-invalid').next('.invalid-feedback').html('');
            }

            if ($('#link-icon').val() == '') {
                $('#link-icon').addClass('is-invalid').closest('.iconpicker-container').addClass('is-invalid').next('.invalid-feedback').html("{{ __('validation.required', ['attribute'=>'Icon']) }}");
            } else {
                $('#link-icon').removeClass('is-invalid').closest('.iconpicker-container').removeClass('is-invalid').next('.invalid-feedback').html('');
            }

            if ($('#link-color').val() == '') {
                $('#link-color').addClass('is-invalid').closest('#cp2').addClass('is-invalid').next('.invalid-feedback').html("{{ __('validation.required', ['attribute'=>'Color']) }}");
            } else {
                $('#link-color').removeClass('is-invalid').closest('#cp2').removeClass('is-invalid').next('.invalid-feedback').html('');
            }

            let data = {
                "name": $('#link-label').val(),
                "url": $('#link-url').val(),
                "icon": $('#link-icon').val(),
                "color": $('#link-color').val(),
            }

            $.ajax({
                type: 'POST',
                url: '/admin/createdatalink',
                data: data,
                dataType: 'json',
                success: function(data) {
                    let linkData = data.data;

                    if (data.errors) {
                        $.each(data.errors, function (i, j) {
                            if (i == 'name') {
                                $("#link-label").addClass("is-invalid").next('.invalid-feedback').html(j);
                            }

                            if (i == 'url') {
                                $("#link-url").addClass("is-invalid").next('.invalid-feedback').html(j);
                            }

                            if (i == 'icon') {
                                $("#link-icon").addClass("is-invalid").next('.invalid-feedback').html(j);
                            }

                            if (i == 'color') {
                                $("#link-color").addClass("is-invalid").next('.invalid-feedback').html(j);
                            }
                        });
                    } else {
                        $('#add-link-modal').modal('hide');

                        $('#link-label, #add-link-modal #link-url').val('');
                        $('#link-icon').val('fas fa-link');
                        $('#link-color').val('#666666');

                        if (data.success) {
                            toastr.success(data.success);
                            let itemHtml = "";
                            linkData.forEach((item) => {
                                itemHtml +=
                                    `<div class="col-lg-6 mb-3" id="link${item.id}">
                                        <div class="form-group">
                                            <label>${item.name}</label>
                                            <div class="input-group">
                                                <input type="hidden" name="id" value="${item.id}">
                                                <div class="input-group-prepend"><span class="input-group-text"> <i class="${item.icon}"></i></span></div>
                                                <input type="text" name="link" class="bg-link-input form-control" placeholder="http://www.example.com" value="${item.url}" title="${item.url}" readonly>
                                                <div class="input-group-append" onclick="removeInput(${item.id})" style="cursor:pointer">
                                                    <span class="input-group-text"><i class="fas fa-times"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                            });

                            $(".links").html(itemHtml);
                        } else {
                            toastr.error("{{ __('message.failed_to_save') }}");
                        }
                    } 
                }
            });
        });

        // REMOVE LINK
        function removeInput(id) {
            $.ajax({
                url: "/admin/links/"+id+"/site",
                type: 'DELETE',
                data: {
                    "id": id
                },
                success: function (response){
                    document.getElementById("link" + id).remove();
                    notification(response);
                }
            });
        }
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
