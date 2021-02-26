<?php

namespace App\QueryFilters;

class Area extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->where('area_id', request($this->filterName()));
    }
}
