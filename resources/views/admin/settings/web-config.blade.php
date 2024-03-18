@extends('adminlte::page')

@section('title', __('Web Information'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.web_config') }}" currentActive="{{ __('title.web_config') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Select2', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <form id="form-web-config" action="{{ route('settings.webconfig.update') }}" method="POST" role="form">
                    @method('PATCH')
                    @csrf
                    <input type="hidden" name="web_config">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{ __('form.measurement_id') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-google"></i></span>
                                    </div>
                                    <input type="text" name="measurement_id" class="form-control" placeholder="{{ __('form.placeholder_measurement_id') }}" value="{{ config('settings.measurement_id') }}">
                                    <div class="msg-googleanalyticsid"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('form.publisher_id') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bullhorn"></i></span>
                                    </div>
                                    <input type="text" name="publisher_id" class="form-control" placeholder="{{ __('form.placeholder_publisher_id') }}" value="{{ config('settings.publisher_id') }}">
                                    <div class="msg-publisherid"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('form.disqus_shortname') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-comments"></i></span>
                                    </div>
                                    <input type="text" name="disqus_shortname" class="form-control" placeholder="{{ __('form.placeholder_disqus_shortname') }}" value="{{ config('settings.disqus_shortname') }}">
                                    <div class="msg-disqusshortname"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{ __('form.property_id') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-chart-line"></i></span>
                                    </div>
                                    <input type="text" name="property_id" class="form-control" placeholder="{{ __('form.placeholder_property_id') }}" value="{{ $propertyId }}">
                                    <div class="msg-propertyid"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('form.credentials_file') }}</label><br>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="credentials_file" class="custom-file-input" id="credentialFile" value="{{ config('settings.credentials_file') }}">
                                        <label class="custom-file-label" for="credentialFile">{{ __('form.placeholder_credentials_file') }}</label>
                                    </div>
                                </div>
                                <p>
                                    <small>
                                        {{ __('form.help_credentials_file') }}<br>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <button id="submit-web-config" type="submit" class="btn btn-info float-right">{{ __('button.save') }}</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row mt-3">
                    <div class="form-group col-lg-12">
                        <label>{{ __('form.display_language_options') }}</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="maintenance"
                                class="custom-control-input" data-id="" id="switchDisplayLanguage" {{ $showLanguage }}>
                            <label class="custom-control-label" for="switchDisplayLanguage">
                                {{ __('form.label_display_language_options') }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="default_language">{{ __('form.default_language') }}</label>
                        <select id="default_language" name="default_language" class="form-control">
                            @foreach( $languages as $languageCode => $languageName )
                                @if($languageCode == config('settings.default_language'))
                                    <option value="{{ $languageCode }}" selected="selected">{{ $languageName }}</option>
                                @else
                                    <option value="{{ $languageCode }}">{{ $languageName }}</option>
                                @endif
                            @endforeach
                        </select>
                        <small id="defaultlanguageHelp" class="form-text text-muted">
                            {{ __('form.help_default_language') }}
                        </small>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="form-group col-lg-12">
                        <label>{{ __('form.comments_require_approval') }}</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="comment_approval"
                                class="custom-control-input" id="commentReqApproval" {{ $commentApproval }}>
                            <label class="custom-control-label" for="commentReqApproval">
                                {{ __('form.label_comments_require_approval') }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="number_nested_comments">{{ __('form.number_of_nested_comments') }}</label>
                        <select id="number_nested_comments" name="number_nested_comments" class="form-control" style="width:auto;">
                            @foreach( $numberNestedComments as $no)
                                @if($no == config('settings.number_nested_comments'))
                                    <option value="{{$no}}" selected="selected">{{ $no }}</option>
                                @else
                                    <option value="{{ $no }}">{{ $no }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-12">
                        <label>{{ __('form.send_comment_reply_email') }}</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="send_comment_reply_email"
                                class="custom-control-input" id="sendCommentReplyEmail" {{ $sendCommentReplyEmail }}>
                            <label class="custom-control-label" for="sendCommentReplyEmail">
                                {{ __('form.label_send_comment_reply_email') }}
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="form-group col-lg-12">
                        <label>{{ __('form.maintenance_mode') }}</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="maintenance"
                                class="custom-control-input" data-id="" id="customSwitch1" {{ $maintenance }}>
                            <label class="custom-control-label" for="customSwitch1">
                                {{ __('form.label_maintenance_mode') }}
                            </label>
                        </div>
                    </div>
                    @can('register-users')
                        <div class="form-group col-lg-12">
                            <label>{{ __('form.register_user') }}</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="maintenance" class="custom-control-input" data-id="" id="customSwitch2" {{ $register }}>
                                <label class="custom-control-label" for="customSwitch2">
                                    {{ __('form.label_register_user') }}
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label>{{ __('form.email_verification') }}</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="email_verification" class="custom-control-input" data-id="" id="customSwitch3" {{ $emailVerification }}>
                                <label class="custom-control-label" for="customSwitch3">
                                    {{ __('form.label_email_verification') }}
                                </label>
                            </div>
                        </div>
                    @endcan
                </div>
                </div>
            </div>
        </div>
    </div>
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
        // SET DISPLAY LANGUAGE OPTIONS
        $(document).on("change", "#switchDisplayLanguage", function(e) {
            let active = $(this).prop("checked") == true ? "y" : "n";
            $.ajax({
                type: "PATCH",
                dataType: "json",
                url: "/admin/settings/switch-display-language",
                data: {
                    "active": active
                },
                success: function(data) {
                    if(data.info) {
                        toastr.info(data.info);
                    } else if(data.success){
                        toastr.success(data.success);
                    }else{
                        toastr.error(data.abort);
                    }
                }
            })
        });

        // SET DEFAULT LANGUAGE
        $(document).on("change", "#default_language", function(e) {
            e.preventDefault();
            let dataLangCode = $('select#default_language').find(':selected').val() //get code;
            $.ajax({
                type: "PATCH",
                dataType: "json",
                url: "/admin/settings/change-default-language",
                data: {
                    'code': dataLangCode
                },
                success: function(response) {
                    toastr.success(response.success);
                    $("#default_language").select2("val", "");
                }
            })
        });

        // SET COMMENTS REQUIRE APPROVAL
        $(document).on("change", "#commentReqApproval", function(e) {
            let active = $(this).prop("checked") == true ? "y" : "n";
            $.ajax({
                type: "PATCH",
                dataType: "json",
                url: "/admin/settings/change-comment-req-approval",
                data: {
                    "active": active
                },
                success: function(data) {
                    if(data.info) {
                        toastr.info(data.info);
                    } else {
                        toastr.success(data.success);
                    }
                }
            })
        });

        // SET NUMBER OF NESTED COMMENTS
        $(document).on("change", "#number_nested_comments", function(e) {
            e.preventDefault();
            let dataNumberNestedComments = $('select#number_nested_comments').find(':selected').val() //get code;
            $.ajax({
                type: "PATCH",
                dataType: "json",
                url: "/admin/settings/change-number-nested-comment",
                data: {
                    'number_nested_comments': dataNumberNestedComments
                },
                success: function(response) {
                    toastr.success(response.success);
                    $("#number_nested_comments").select2("val", "");
                }
            })
        });

        // SEND COMMENT REPLY TO EMAIL
        $(document).on("change", "#sendCommentReplyEmail", function(e) {
            let active = $(this).prop("checked") == true ? "y" : "n";
            $.ajax({
                type: "PATCH",
                dataType: "json",
                url: "/admin/settings/change-send-comment-reply-email",
                data: {
                    "active": active
                },
                success: function(data) {
                    if(data.info) {
                        toastr.info(data.info);
                    } else {
                        toastr.success(data.success);
                    }
                }
            })
        });

        // SET MAINTENANCE MODE
        $(document).on("change", "#customSwitch1", function(e) {
            let active = $(this).prop("checked") == true ? "y" : "n";
            $.ajax({
                type: "PATCH",
                dataType: "json",
                url: "/admin/settings/changeStatusMaintenance",
                data: {
                    "active": active
                },
                success: function(data) {
                    if(data.info) {
                        toastr.info(data.info);
                    } else {
                        toastr.success(data.success);
                    }
                }
            })
        });

        // SET REGISTER USER
        $(document).on("change", "#customSwitch2", function(e) {
            let active = $(this).prop("checked") == true ? "y" : "n";
            $.ajax({
                type: "PATCH",
                dataType: "json",
                url: "/admin/settings/changeRegisterMember",
                data: {
                    "active": active
                },
                success: function(data) {
                    if(data.info) {
                        toastr.info(data.info);
                    } else if(data.success){
                        toastr.success(data.success);
                    }else{
                        toastr.error(data.abort);
                    }
                }
            })
        });


        // SET EMAIL VERIFICATION
        $(document).on("change", "#customSwitch3", function(e) {
            let active = $(this).prop("checked") == true ? "y" : "n";
            $.ajax({
                type: "PATCH",
                dataType: "json",
                url: "/admin/settings/change-active-email-verification",
                data: {
                    "active": active
                },
                success: function(data) {
                    if(data.info) {
                        toastr.info(data.info);
                    } else if(data.success){
                        toastr.success(data.success);
                    }else{
                        toastr.error(data.abort);
                    }
                }
            })
        });

        
    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
