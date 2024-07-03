<?php

namespace App\Queries;

use App\Models\ItemUnit;
use Dwikipeddos\PeddosLaravelTools\Queries\PaginatedQuery;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\AllowedSort;

class ItemUnitQuery extends PaginatedQuery
{
    public function __construct()
    {
        parent::__construct(ItemUnit::query());
    }

    protected array $append = [
        // 'phone',
    ];

    protected string $adminPermission = 'itemunit.view-sensitive-data';

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
        ];
    }

    protected function getAllowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('items'),
        ];
    }
}
