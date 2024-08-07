<?php

namespace App\Queries;

use App\Models\Item;
use Dwikipeddos\PeddosLaravelTools\Queries\PaginatedQuery;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\AllowedSort;

class ItemQuery extends PaginatedQuery
{
    public function __construct()
    {
        parent::__construct(Item::query());
    }

    protected array $append = [
        'stock',
    ];

    protected string $adminPermission = 'item.view-sensitive-data';

    protected function getAllowedSorts(): array
    {
        return [
            AllowedSort::field('created_at'),
        ];
    }

    protected function getAllowedFilters(): array
    {
        return [
            AllowedFilter::partial('name'),
            AllowedFilter::partial('sku'),
            AllowedFilter::partial('price'),
        ];
    }

    protected function getAllowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('item_unit'),
        ];
    }
}
