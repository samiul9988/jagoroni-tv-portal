<?php

namespace App\DataTables;

use App\Helpers\RoleHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
                    <input type="checkbox" class="custom-control-input user_checkbox" id="checkbox'.$query->id.'" name="user_checkbox[]" value="'.$query->id.'"><label class="custom-control-label" for="checkbox'.$query->id.'"></label>
                </div>';
            })
            ->addColumn('roles', function($query) {
                foreach ($query->getRoleNames() as $role) {
                    $roles[] =  "<small class='badge badge-success'>$role</small>";
                }
                return implode(' ', $roles);
            })
            ->addColumn('active', function ($query) {
                if ($query->getAttributeValue('banned_at')  == null) {
                    return "<small class='badge badge-success'>".__('button.active')."</small>";
                } else {
                    return "<small class='badge badge-danger'>".__('button.blocked') ."</small>";
                }
            })
            ->addColumn('action', function ($query) {
                $action = [
                    'table' => 'user-table',
                    'model' => $query,
                ];

                /** @var object User */
                $currentUser = Auth::user();

                if ($currentUser->hasRole('super-admin')) {
                    if (!$query->hasRole('super-admin')){
                        $action['del_url'] = route('users.destroy', $query->id);
                        $action['edit_url'] = route('users.edit', $query->id);
                    }
                } elseif ($currentUser->hasRole(['admin'])) {
                    if (!$query->hasRole('super-admin') OR Auth::id() == $query->id) {
                        $action['del_url'] = route('users.destroy', $query->id);
                        $action['edit_url'] = route('users.edit', $query->id);
                    }
                } else {
                    if (!$query->hasRole('super-admin') OR !$query->hasRole('admin') OR Auth::id() == $query->id) {
                        $action['del_url'] = route('users.destroy', $query->id);
                        $action['edit_url'] = route('users.edit', $query->id);
                    }
                }
                return view('layouts.partials._action', $action);
            })
            ->rawColumns(['roles','checkbox','active']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return QueryBuilder
     */
    public function query(User $model): QueryBuilder
    {
        $roles = RoleHelper::showRoles();

        /** @var object User */
        $currentUser = Auth::user();
        
        return $currentUser->hasRole('super-admin') ?
            $model->with('roles')->latest()->newQuery() :
            $model->role($roles)->with('roles')->latest()->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
                        let table = "user-table";
                        let selectClass = "user_checkbox";
                        multiDelCheckbox(table, url, selectClass);
                    })

                    $("#selectAll").on("click", function(e) {
                        if ($(this).is( ":checked" )) {
                            $(".user_checkbox").prop("checked",true);
                        } else {
                            $(".user_checkbox").prop("checked",false);
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
                ->footer('<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn btn-xs btn-danger" data-url="'.route('users.mass.destroy').'">'.__('button.delete').'</button>')
                ->titleAttr('')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false)
                ->width(3),
            Column::make('name')->title(__('table.name'))
                ->orderable(false),
            Column::make('roles')->title(__('table.roles'))
                ->orderable(false),
            Column::make('active')->title(__('table.status'))
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
        return 'Users_' . date('YmdHis');
    }
}
