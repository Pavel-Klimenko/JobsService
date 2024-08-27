<?php

namespace App\Domains\Vacancies\QueryFilters;

use App\QueryFilters\Filter;

class SalaryFrom extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where($this->filterName(),  '>=', request($this->filterName()));
    }
}
