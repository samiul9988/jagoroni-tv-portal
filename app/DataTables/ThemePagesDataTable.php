<?php

namespace App\DataTables;

use App\Models\Theme;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ThemePagesDataTable extends DataTable
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
            ->editColumn('url', function ($query) {
                return $query->url;
            })
            ->addColumn('action', function ($query) {
                return view('layouts.partials._action', [
                    'table'    => 'themepages',
                    'model'    => $query,
                    'edit_url' => route('theme.layout', ['theme' => $query->theme, 'slug' => $query->slug])
                ]);
            })
            ->rawColumns(['checkbox', 'url']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Theme $model
     * @return QueryBuilder
     */
    public function query(Theme $model): QueryBuilder
    {
        return $model->newQuery()->where('id', '>', 1);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('themepages-table')
            ->pageLength(25)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->orders([])
            ->parameters([
                'responsive' => true,
                'autoWidth' => false
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
            Column::make('title')->title(__('table.pages'))
                ->orderable(false),
            Column::make('url')->title(__('table.url'))
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
        return 'ThemePages_' . date('YmdHis');
    }
}
