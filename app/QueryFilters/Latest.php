<?php

namespace App\QueryFilters;

class Latest extends Filter
{
    public function applyFilter($builder)
    {
        if (request($this->filterName()) == "false") return $builder;
        return $builder->orderBy('id', 'desc')->limit(1);
    }
}
