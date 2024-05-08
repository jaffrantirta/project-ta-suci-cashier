<?php

namespace App\Queries;

use App\Models\Stock;
use Dwikipeddos\PeddosLaravelTools\Queries\PaginatedQuery;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\AllowedSort;

class StockQuery extends PaginatedQuery
{
    public function __construct()
    {
        parent::__construct(Stock::query());
    }

    protected array $append = [
        // 'phone',
    ];

    protected string $adminPermission = 'stock.view-sensitive-data';

    protected function getAllowedSorts(): array
    {
        return [
            AllowedSort::field('created_at'),
        ];
    }

    protected function getAllowedFilters(): array
    {
        return [
            AllowedFilter::partial('item_id'),
            AllowedFilter::partial('change_amount'),
            AllowedFilter::callback('type', function ($query, $value) {
                $query->where('change_amount', $value, 0);
            }),
            AllowedFilter::partial('amount'),
            AllowedFilter::partial('item.name'),
            AllowedFilter::partial('supplier_name'),
            AllowedFilter::partial('number_of_invoice'),
        ];
    }

    protected function getAllowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('item'),
        ];
    }
}
