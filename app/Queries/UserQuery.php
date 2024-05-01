<?php

namespace App\Queries;

use App\Models\User;
use Dwikipeddos\PeddosLaravelTools\Queries\PaginatedQuery;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\AllowedSort;

class UserQuery extends PaginatedQuery
{
    public function __construct()
    {
        parent::__construct(User::query());
    }

    protected array $append = [
        // 'phone',
    ];

    protected string $adminPermission = 'user.view-sensitive-data';

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
            // AllowedInclude::relationship('user'),
        ];
    }
}
