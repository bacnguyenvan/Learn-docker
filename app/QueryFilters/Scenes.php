<?php

namespace App\QueryFilters;

class Scenes extends Filter
{
    public function applyFilter($builder)
    {
        $data = explode(',', request($this->filterName()));
        return $builder->whereHas('scenes', function ($query) use ($data) {
            $query->whereIn('id', $data);
        });
    }
}
