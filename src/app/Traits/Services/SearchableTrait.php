<?php

namespace App\Traits\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait SearchableTrait
{
    /**
     * Perform search
     *
     * @param Builder $query
     * @param array $params
     * @return LengthAwarePaginator
     */
    protected function performSearch($query, array $params)
    {
        $page = Arr::get($params, 'page', 1);
        $limit = Arr::get($params, 'limit', 50);

        $query->select($query->qualifyColumn('*'));

        if (property_exists($this, 'filters')) {
            $filters = Arr::get($params, 'filter', []);
            $this->applySearchFilters($query, $filters);
        }

        if (property_exists($this, 'sort')) {
            $defaultSort = property_exists($this, 'defaultSort')
                ? $this->defaultSort
                : [];
            $sorts = Arr::get($params, 'sort', $defaultSort);
            $this->applySortingOrdering($query, $sorts);
        }

        return $query->paginate($limit, ['*'], 'page', $page);
    }

    /**
     * Apply search filter to the query
     *
     * @param Builder $query
     * @param array $filters
     * @param array $map
     */
    protected function applySearchFilters($query, $filters, $map = null)
    {
        $map = $this->getFiltersMapping($map);

        foreach ($filters as $prop => $value) {
            $prop = Str::camel($prop);

            if (array_key_exists($prop, $map)) {
                $scope = $map[$prop];
                $query->{$scope}($value);
            }
        }
    }

    /**
     * Get filters map
     *
     * @param array $custom
     * @return array
     */
    protected function getFiltersMapping($custom)
    {
        return $custom !== null ? $custom : $this->filters;
    }

    /**
     * Apply sorting order to the query
     *
     * @param Builder $query
     * @param array $sorts
     * @param array $map
     */
    protected function applySortingOrdering($query, $sorts, $map = null)
    {
        $map = $this->getSortMapping($map);

        foreach ($sorts as $sort) {
            if (preg_match('/^([a-z0-9_]+)-(asc|desc)$/i', $sort, $match)) {
                $prop = $match[1];
                $dir = $match[2];
            } else {
                $prop = $sort;
                $dir = 'asc';
            }

            $prop = Str::camel($prop);

            if (array_key_exists($prop, $map)) {
                $scope = $map[$prop];
                $query->{$scope}($dir);
            }
        }
    }

    /**
     * Get sorting map
     *
     * @param array $custom
     * @return array
     */
    protected function getSortMapping($custom)
    {
        return $custom !== null ? $custom : $this->sort;
    }
}
