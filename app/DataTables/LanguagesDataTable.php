<?php

namespace App\DataTables;

use App\Models\Language;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LanguagesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', function($query){
                return '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input language_checkbox" id="checkbox'.$query->id.'" name="language_checkbox[]" value="'.$query->id.'"><label class="custom-control-label" for="checkbox'.$query->id.'"></label>
                </div>';
            })
            ->addColumn('country', function($query){
                return '<img src="'.asset('vendor/flag-icons/flags/4x3/'.strtolower($query->country_code).'.svg').'" style="width:2rem">';
            })
            ->addColumn('active', function ($query) {
                $checked = $query->active == 'y' ? 'checked' : '';
                $code = $query->language;
                return view('admin.languages._active', compact('checked', 'code'));
            })
            ->addColumn('action', function($query){
                return view('admin.languages._action',[
                    'table'     => 'languages-table',
                    'model'     => $query,
                    'isDefault' => config('settings.default_language') == $query->language ? true: false,
                    'del_url'   => route('languages.destroy', $query),
                    'edit_url'  => route('languages.edit', $query)
                ]);
            })
            ->rawColumns(['active','checkbox','country']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Language $model
     * @return QueryBuilder
     */
    public function query(Language $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('languages-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>")
            ->orderBy(1)
            ->orders([])
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
                'drawCallback' => 'function() {
                    $(".toggle-class, .toggle-class-default").bootstrapToggle();
                    $(".toggle-class").change(function() {
                        var status = $(this).prop("checked") == true ? "y" : "n";
                        var code = $(this).data("code");
                        $.ajax({
                            type: "PATCH",
                            dataType: "json",
                            url: "/admin/manage/languages/"+code+"/active",
                            data: {"active": status},
                            success: function(response) {
                                notification(response);
                            },
                            error: function(data) {
                                 notification(response);
                            }
                        })
                    });

                    $(".delete").on("click", function() {
                        let table = $(this).data("table");
                        let url = $(this).data("url");
                        sweetalert2(table, url);
                    })

                    $("#bulk_delete").on("click", function() {
                        let url = $(this).data("url");
                        let table = "languages-table";
                        let selectClass = "language_checkbox";
                        multiDelCheckbox(table, url, selectClass);
                    });

                    $("#selectAll").on( "click", function(e) {
                        if ($(this).is( ":checked" )) {
                            $(".language_checkbox").prop("checked",true);
                        } else {
                            $(".language_checkbox").prop("checked",false);
                        }
                    });
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
                ->footer('<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn btn-xs btn-danger" data-url="'.route('languages.mass.destroy').'">'. __('button.delete') .'</button>')
                ->titleAttr('')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false)
                ->width(3),
            Column::make('id')->title(__('table.id'))
                ->orderable(false),
            Column::make('name')->title(__('table.language'))
                ->orderable(false),
            Column::make('country')->title(__('table.country'))
                ->orderable(false),
            Column::make('active')
                ->orderable(false)
                ->searchable(false)
                ->title(__('table.active')),
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
        return 'Languages_' . date('YmdHis');
    }
}
