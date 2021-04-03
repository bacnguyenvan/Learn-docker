<?php

namespace App\QueryFilters;

class OrderBy extends Filter
{
    public function applyFilter($builder)
    {
        $data = explode(',', request($this->filterName()));
        if (count($data) == 2)
            return $builder->orderBy($data[0], $data[1]);
        return $builder;
    }
}
