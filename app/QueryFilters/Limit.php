<?php

namespace App\QueryFilters;

class Limit extends Filter
{
    public function applyFilter($builder)
    {
        $limit = (int) request($this->filterName());
        if ($limit <= 0) {
            return $builder;
        }

        return $builder->limit($limit);
    }
}
