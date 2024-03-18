<?php

namespace App\DataTables;

use App\Models\Comment;
use App\Traits\LanguageTrait;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class CommentDataTable extends DataTable
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
                    <input type="checkbox" class="custom-control-input comment_checkbox" id="checkbox'.$query->id.'" name="comment_checkbox[]" value="'.$query->id.'"><label class="custom-control-label" for="checkbox'.$query->id.'"></label>
                </div>';
                
            })
            ->editColumn('status', function ($query) {
                if ($query->status  == "approved") {
                    return "<small class='badge badge-success p-1' data-status='pending' data-id='".$query->id."' onclick='changeStatus(event)' data-toggle='tooltip' data-placement='top' title='".__('button.unapprove')."'>".__('button.approved')."</small>";
                } else {
                    return "<small class='badge badge-danger p-1' data-status='approved' data-id='".$query->id."' onclick='changeStatus(event)' data-toggle='tooltip' data-placement='top' title='".__('button.approve')."'>".__('button.pending') ."</small>";
                }
            })
            ->addColumn('action', function($query){
            
                if ($query->post_id == Auth::id() OR Auth::user()->hasPermissionTo('reply-comments')) {
                    $replyBtn = '<button type="button" class="reply btn btn-primary" data-url="" data-reply="'. $query->id .'" data-main="'.$query->main_reply.'" data-post="'.$query->post_id.'" data-toggle="tooltip" data-placement="left" title="'.__('button.reply').'"><i class="fas fa-reply"></i></button>';
                } else {
                    $replyBtn = '';
                }

                $action = [
                    'table' => 'comment-table',
                    'reply_btn' => $replyBtn,
                    'user_id' => $query->user_id,
                    'del_url'  => route('comments.destroy', $query->id),
                    'edit_url' => route('comments.update', $query->id)
                ];

                return view('admin.comments._action', $action);
            })
            ->rawColumns(['status','checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Comment $model
     * @return QueryBuilder
     */
    public function query(Comment $model): QueryBuilder
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
        $script = 'data.filter = $("#custom-filter").val();';
        return $this->builder()
            ->setTableId('comment-table')
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

                    $("[data-toggle=\"tooltip\"]").tooltip()

                    $(".delete").on("click", function() {
                        let table = $(this).data("table");
                        let url = $(this).data("url");
                        sweetalert2(table, url);
                    })

                    $("#bulk_delete").on("click", function() {
                        let url = $(this).data("url");
                        let table = "comment-table";
                        let selectClass = "comment_checkbox";
                        multiDelCheckbox(table, url, selectClass);
                    })

                    $("#selectAll").on( "click", function(e) {
                        if ($(this).is( ":checked" )) {
                            $(".comment_checkbox").prop("checked",true);
                        } else {
                            $(".comment_checkbox").prop("checked",false);
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
                ->titleAttr('')
                ->footer('<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn btn-xs btn-danger" data-url="'.route('comments.mass.destroy').'">'.__('button.delete').'</button>')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false)
                ->width(3),
            Column::make('id')->title(__('table.id'))
                ->orderable(false),
            Column::make('name')->title(__('table.name'))
                ->orderable(false),
            Column::make('email')->title(__('table.email'))
                ->orderable(false),
            Column::make('comment')->title(__('table.comment'))
                ->orderable(false),
            Column::make('status')->title(__('table.status'))
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
