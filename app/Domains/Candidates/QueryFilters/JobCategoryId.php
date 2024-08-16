<?php

namespace App\Domains\Candidates\QueryFilters;

use App\QueryFilters\Filter;

class JobCategoryId extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where($this->filterName(), request($this->filterName()));
    }
}
