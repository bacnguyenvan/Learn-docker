<?php

namespace App\QueryFilters;

class Limit extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->limit(request($this->filterName()));
    }
}
