<?php

namespace App\Queries;

use App\Models\Transaction;
use Dwikipeddos\PeddosLaravelTools\Queries\PaginatedQuery;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\AllowedSort;

class TransactionQuery extends PaginatedQuery
{
    public function __construct()
    {
        parent::__construct(Transaction::query());
    }

    protected array $append = [
        // 'phone',
    ];

    protected string $adminPermission = 'transaction.view-sensitive-data';

    protected function getAllowedSorts(): array
    {
        return [
            AllowedSort::field('created_at'),
        ];
    }

    protected function getAllowedFilters(): array
    {
        return [
            AllowedFilter::partial('number'),
            AllowedFilter::partial('created_at'),
        ];
    }

    protected function getAllowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('transaction_details'),
        ];
    }
}
