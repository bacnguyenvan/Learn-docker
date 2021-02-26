<?php

namespace App\QueryFilters;

class Activities extends Filter
{
    public function applyFilter($builder)
    {
        $data = explode(',', request($this->filterName()));

        return $builder->whereHas('activities', function ($query) use ($data) {
            $query->whereIn('id', $data);
        });
    }
}
