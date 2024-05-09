<?php

namespace App\Queries;

use App\Models\Opname;
use Dwikipeddos\PeddosLaravelTools\Queries\PaginatedQuery;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\AllowedSort;

class OpnameQuery extends PaginatedQuery
{
    public function __construct()
    {
        parent::__construct(Opname::query());
    }

    protected array $append = [
        // 'phone',
    ];

    protected string $adminPermission = 'opname.view-sensitive-data';

    protected function getAllowedSorts(): array
    {
        return [
            AllowedSort::field('created_at'),
        ];
    }

    protected function getAllowedFilters(): array
    {
        return [
            AllowedFilter::partial('item.name'),
        ];
    }

    protected function getAllowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('item'),
        ];
    }
}
