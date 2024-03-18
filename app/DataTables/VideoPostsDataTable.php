<?php

namespace App\DataTables;

use App\Helpers\PostHelper;
use App\Models\{Post, User};
use App\Services\ArticleService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VideoPostsDataTable extends DataTable
{
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
                    <input type="checkbox" class="custom-control-input post_checkbox" id="checkbox'.$query->id.'" name="post_checkbox[]" value="'.$query->id.'"><label class="custom-control-label" for="checkbox'.$query->id.'"></label>
                </div>';
            })
            ->editColumn('post_title', function ($query) {
                if ($query->post_visibility === 'private') {
                    $visibility = "<i class='fas fa-lock text-info'></i>";
                } else {
                    $visibility = "";
                }

                if ($query->post_status === 'draft') {
                    $status = "<i class='fas fa-sticky-note text-info'></i>";
                } else  {
                    $status = "";
                }

                if ($query->created_at->format('Y-m-d H:i:s') >= Carbon::now()->format('Y-m-d H:i:s')) {
                    $schedule = '<i class="fas fa-clock text-info"></i>';
                } else {
                    $schedule = '';
                }

                if ($visibility || $status || $schedule) {
                    $sign = "&mdash;";
                } else {
                    $sign = "";
                }

                return "<a href='" . PostHelper::getUriPost($query) . "' target='_blank'>" . $query->post_title . "</a> $sign $visibility $status $schedule";
            })
            ->addColumn('category', function ($query) {
                return $query->terms()->category()->get()->map(function ($term) {
                    return $term->name;
                })->implode(', ');
            })
            ->addColumn('tag', function ($query) {
                return $query->terms()->tag()->get()->map(function ($term) {
                    return $term->name;
                })->implode(', ');
            })
            ->addColumn('date', function ($query) {
                return $query->created_at->format('Y/m/d h:m a');
            })
            ->addColumn('action', function ($query) {
                $action = [
                    'table' => 'post-table',
                    'model' => $query,
                ];

                /** @var object User */
                $currentUser = Auth::user();

                if ( $currentUser->hasRole(['super-admin']) ) {
                    $action['del_url'] = route('videos.destroy', $query->id);
                    $action['edit_url'] = route('videos.edit', $query->id);
                }

                if( Auth::id() == $query->post_author ){
                    $action['del_url'] = route('videos.destroy', $query->id);
                    $action['edit_url'] = route('videos.edit', $query->id);
                }

                if ( User::findOrFail($query->post_author)->getRoleNames()->first() == 'author' ) {
                    if ( $currentUser->can('delete-post-author') ) {
                        $action['del_url'] = route('videos.destroy', $query->id);
                    }

                    if ( $currentUser->can('edit-post-author') ) {
                        $action['edit_url'] = route('videos.edit', $query->id);
                    }
                }

                return view('layouts.partials._action', $action);
            })
            ->rawColumns(['post_title','checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param ArticleService $article
     * @param Post $model
     * @return QueryBuilder
     */
    public function query(ArticleService $article, Post $model)
    {
        $posts = $model::video();

        $q = (is_null(request('filter')) || request('filter') == '0')
            ? $posts->languageCurrentAuthSession()
            : $posts->wherePostLanguage(request('filter'));

        /** @var object User */
        $currentUser = Auth::user();
        
        return $currentUser->hasRole('super-admin')
            ? $q->latest()->newQuery()
            : $article->qryDataTable($q);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        $script = 'data.filter = $("#custom-filter").val()';
        return $this->builder()
            ->setTableId('post-table')
            ->columns($this->getColumns())
            ->minifiedAjax($url='', $script, [])
            ->dom("<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'i><'col-sm-12 col-md-4'p>>")
            ->orderBy(1)
            ->orders([])
            ->buttons(
                Button::make('create')->className('btn btn-sm btn-info')->text(__('button.create'))
            )
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
                'drawCallback' => 'function() {
                    "use strict";

                    $(".delete").on("click", function() {
                        let table = $(this).data("table");
                        let url = $(this).data("url");
                        sweetalert2(table, url);
                    })

                    $("#bulk_delete").on("click", function() {
                        let url = $(this).data("url");
                        let table = "post-table";
                        let selectClass = "post_checkbox";
                        multiDelCheckbox(table, url, selectClass);
                    })

                    $("#selectAll").on( "click", function(e) {
                        if ($(this).is( ":checked" )) {
                            $(".post_checkbox").prop("checked",true);
                        } else {
                            $(".post_checkbox").prop("checked",false);
                        }
                    })
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
                ->footer('<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn btn-xs btn-danger" data-url="'.route('videos.mass.destroy').'">'.__('button.delete').'</button>')
                ->titleAttr('')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false)
                ->width(3),
            Column::make('id')->title(__('table.id'))
                ->orderable(false),
            Column::make('post_title')->title(__('table.title'))
                ->orderable(false),
            Column::make('user.name')->title(__('table.author'))
                ->orderable(false),
            Column::make('category')->title(__('table.category'))
                ->orderable(false),
            Column::make('tag')->title(__('table.tag'))
                ->orderable(false),
            Column::make('date')->title(__('table.date'))
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
        return 'Posts_' . date('YmdHis');
    }
}
