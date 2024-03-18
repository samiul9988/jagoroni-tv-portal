@extends('adminlte::page')

@section('title', __('title.translations'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.translations') }}" currentActive="{{ __('title.translations') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.translations._table')
        </div>
    </div>
@stop

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/pace-progress/themes/blue/pace-theme-minimal.css') }}">
    <style>
        #myInput {
            background: url('data:image/svg+xml;charset=utf8,<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:bx="https://boxy-svg.com"><path d="M 11.732 12.439 C 9.047 14.525 5.109 12.921 4.645 9.553 C 4.181 6.183 7.538 3.575 10.689 4.858 C 13.399 5.962 14.306 9.349 12.512 11.66 L 15.466 14.603 L 14.682 15.388 L 11.738 12.439 Z M 9.027 12.263 C 11.577 12.263 13.172 9.5 11.897 7.291 C 11.304 6.267 10.21 5.634 9.027 5.634 C 6.476 5.634 4.88 8.397 6.157 10.606 C 6.749 11.63 7.842 12.263 9.027 12.263 Z" style="fill: rgb(96, 111, 123);"/></svg>');
            background-repeat: no-repeat;
            width: 100%; /* Full-width */
            font-size: 15px; /* Increase font-size */
            padding: 7px 20px 7px 45px; /* Add some padding */
            border: 1px solid #ddd; /* Add a grey border */
            margin-bottom: 12px; /* Add some space below the input */
        }

        .dark-mode #myInput, .dark-mode #myInput:focus-visible{
            color: white;
            border: 1px solid #6c757d;
            outline: unset;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('/vendor/translation/js/app.js') }}"></script>
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._notification')
    @include('admin.translations._script')
    <script>
        "use strict";
        let items = "";
        $.getJSON("{{ route('getdatalanguage') }}", function (result) {
            $.each(result, function (i, item) {
                if (item.id == "{{ Auth::user()->language }}") {
                    items += "<option value='" + item.language + "' selected>" + item.name + "</option>";
                } else {
                    items += "<option value='" + item.language + "'>" + item.name + "</option>";
                }
            });
            $("#language-filter").html(items);
        });

        let groups = "";
        $.getJSON("{{ route('get.group') }}", function (result) {
            $.each(result, function (i, group) {
                if (group == "dashboard") {
                    groups += "<option value='" + group + "' selected>" + group + "</option>";
                } else {
                    groups += "<option value='" + group + "'>" + group + "</option>";
                }
            });
            $("#group-filter").html(groups);
            $("#group-filter").prepend("<option value='0' selected='selected'>View All Groups</option>");
        });

        function resultHtml(result)
        {
            $.each(result.data, function (type, items) {
                $.each(items, function (group, translations) {
                    $.each(translations, function (key, value) {
                        if (!Array.isArray(value['{{ App::currentLocale() }}'])) {
                            result.data += "<tr>";
                            result.data += "<td>"+group+"</td>";
                            result.data += "<td>"+key+"</td>";
                            result.data += "<td>"+htmlEntities(value['{{ App::currentLocale()}}'])+"</td>";
                            result.data += "<td><div onclick='clickToEdit(this)' data-lang='"+result.language+"' data-group='"+group+"' data-key='"+key+"'>" +
                                "<i class='fa fa-pencil'></i> "+htmlEntities(value[result.language] ? value[result.language] : "...")+"</div>" +
                                "</td>";
                            result.data += "</tr>";
                        }
                    });
                });
            });

            $("#translation-table > tbody").html(result.data);
        }

        showDataTable();

        function showDataTable() {
            let data = "";
            $.getJSON("{{ route('getdatatranslations') }}", function (result) {
                resultHtml(result)
            });
        }

        $("#language-filter").on('change', function() {
            let group = $('#group-filter').find(':selected').val();
            let lang = $('#language-filter').find(':selected').val();
            $.ajax({
                url: '{{ route('getdatatranslations') }}',
                data: {
                    'language': lang,
                    'group': group
                },
                type: 'get',
                dataType: 'json',
                success: function(result) {
                    resultHtml(result)
                }
            });
        })

        $("#group-filter").on('change', function() {
            let group = $('#group-filter').find(':selected').val();
            let lang = $('#language-filter').find(':selected').val();
            $.ajax({
                url: '{{ route('getdatatranslations') }}',
                data: {
                    'language': lang,
                    'group': group
                },
                type: 'get',
                dataType: 'json',
                success: function(result) {
                    resultHtml(result)
                }
            });
        })

        function filterTable(event) {
            var filter = event.target.value.toUpperCase();
            var rows = document.querySelector("#translation-table tbody").rows;

            for (var i = 0; i < rows.length; i++) {
                var firstCol = rows[i].cells[0].textContent.toUpperCase();
                var secondCol = rows[i].cells[1].textContent.toUpperCase();
                var thirdCol = rows[i].cells[2].textContent.toUpperCase();
                var fourthCol = rows[i].cells[3].textContent.toUpperCase();
                if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || fourthCol.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        function clickToEdit(e) {
            e.removeAttribute("onclick")
            let text = e.innerText.trimStart();
            let lang = e.dataset.lang;
            let group = e.dataset.group;
            let key = e.dataset.key;
            e.innerHTML = "<textarea class='txtedit form-control'>"+text+"</textarea>";

            const textarea = document.querySelector("textarea.txtedit");
            const end = textarea.value.length;

            textarea.setSelectionRange(end, end);
            textarea.focus();

            textarea.addEventListener("focusout", textEdit);

            function textEdit() {
                e.setAttribute('onclick','clickToEdit(this)');
                let newValue = textarea.value;
                e.innerHTML = "<i class='fa fa-pencil'></i> " + newValue;

                let data = { group: group, key: key, value: newValue };
                $.ajax({
                    url: 'translations/' + lang,
                    type: 'post',
                    data: data,
                    success:function(response){
                         notification(response);
                    }
                });
            }
        }

        document.querySelector('#myInput').addEventListener('keyup', filterTable, false);

    </script>
@endpush

@section('footer')
    @include('layouts.partials._footer')
@stop
