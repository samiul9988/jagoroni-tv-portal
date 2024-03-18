<?php

namespace App\DataTables;

use App\Helpers\ImageHelper;
use App\Models\Term;
use App\Traits\LanguageTrait;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
{
    use LanguageTrait;

    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return EloquentDataTable
     * @throws Exception
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', function($query){
                return '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input category_checkbox" id="checkbox'.$query->id.'" name="category_checkbox[]" value="'.$query->id.'"><label class="custom-control-label" for="checkbox'.$query->id.'"></label>
                </div>';
            })
            ->editColumn('image', function ($query) {
                return '<img src="'.ImageHelper::show('images',  $query->image, 'img/noimage200.webp').'" width="100px">';
            })
            ->addColumn('action', function($query){
                $name = $query->parent == 0 ? '' : Term::find($query->parent)->name;

                $lang = (is_null(request('filter')) || request('filter') == '0') ?
                    $this->getLanguageCodeByAuth() : request('filter');

                $showTranslations = $query->translation;

                if($showTranslations){
                    $translations = json_decode($query->translation, true);
                    foreach($translations as $key => $value) {
                        $translations[$key] = Term::category()->firstWhere('slug', $value) ? Term::category()->firstWhere('slug', $value)->name : '';
                    }
                    $showTranslations = json_encode($translations);
                }

                $dataMerge = [
                    'parent_name' => $name,
                    'show_translations' => $showTranslations
                ];

                return view('admin.categories._action',[
                    'table'    => 'category-table',
                    'lang'     => $lang,
                    'model'    => collect($query)->merge($dataMerge),
                    'del_url'  => route('categories.destroy', $query->id),
                    'edit_url' => route('categories.update', $query->id)]);
            })
            ->rawColumns(['action','checkbox','image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Term $model
     * @return QueryBuilder
     */
    public function query(Term $model): QueryBuilder
    {
        if(is_null(request('filter')) || request('filter') == '0') {
            $reqLanguage = $this->getLanguageIdByAuth();
        } else {
            $reqLanguage = request('filter');
        }

        return $model->select('id', 'name', 'slug', 'parent', 'description', 'translation', 'image')
            ->category()
            ->where('language_id', $reqLanguage)
            ->latest()
            ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        $script = 'data.filter = $("#custom-filter").val();';
        return $this->builder()
            ->setTableId('category-table')
            ->columns($this->getColumns())
            ->minifiedAjax($url = '', $script, [])
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>")
            ->orderBy(1)
            ->orders([])
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,

                'drawCallback' => 'function() {
                    "use strict";

                    $(".link-edit").on("click", function(e) {
                        e.preventDefault()
                        let editurl = $(this).attr("href");
                        let query = $(this).data("model");
                        let lang = $(this).data("lang");

                        $("#name").val(query.name);

                        if(query.parent != 0){
                            $("#parent").html("<option value="+query.parent+">"+query.parent_name+"</option>");
                        }else{
                            $("#parent").html("");
                        }

                        $("#description").val(query.description);
                        if (query.translation) {
                            showTranslation(query.name);
                        } else {
                            hideTranslation(query.name);
                        }

                        $.each( JSON.parse(query.show_translations) , function( key, value ) {
                          $("#translation-"+key).val(value);
                        });

                        $("#insert").attr("href", editurl);

                        $("#btn-reset").removeAttr("hidden");
                        $("#btn-submit").attr("id","btn-submit-update");
                        $("button[type=submit]").html("'.__('button.update').'");

                        $("#name").removeClass("is-invalid");
                        $(".msg-error-name").html("");
                        $("#description").removeClass("is-invalid");
                        $(".msg-error-description").html("");

                        if (query.image) {
                            $(".upload-image").addClass("ready");
                            $("#image_preview_container").attr("src", "'. asset('/storage/images/') .'/" + query.image);
                            $("input[name=isupload]").val("true");
                        } else {
                            $("#display").removeAttr("hidden");
                            $("#reset").attr("hidden");
                            $(".upload-image").removeClass("ready result");
                            $("#image_preview_container").attr("src", "#");
                            $("#upload")[0].value = "";
                        }
                    });

                    $(".delete").on("click", function() {
                        let table = $(this).data("table");
                        let url = $(this).data("url");
                        sweetalert2(table, url);
                    })

                    $("#bulk_delete").on("click", function() {
                        let url = $(this).data("url");
                        let table = "category-table";
                        let selectClass = "category_checkbox";
                        multiDelCheckbox(table, url, selectClass);
                    })

                    $("#selectAll").on( "click", function(e) {
                        if ($(this).is( ":checked" )) {
                            $(".category_checkbox").prop("checked",true);
                        } else {
                            $(".category_checkbox").prop("checked",false);
                        }
                    })

                    if(document.getElementById("translation")){
                        document.getElementById("translation").removeAttribute("disabled");
                    }
                }'
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('checkbox')
                ->title('<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="selectAll"><label class="custom-control-label" for="selectAll"></label></div>')
                ->titleAttr('')
                ->footer('<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn btn-xs btn-danger" data-url="'.route('categories.mass.destroy').'">'.__('button.delete').'</button>')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false)
                ->width(3),
            Column::make('id')->title(__('table.id'))
                ->orderable(false),
            Column::make('image')->title(__('table.image'))
                ->orderable(false),
            Column::make('name')->title(__('table.name'))
                ->orderable(false),
            Column::make('slug')->title(__('table.slug'))
                ->orderable(false),
            Column::computed('action')->title(__('table.action'))
                ->addClass('text-center')
                ->width(60),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Categories_' . date('YmdHis');
    }
}
