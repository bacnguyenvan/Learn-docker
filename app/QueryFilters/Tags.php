<?php

namespace App\QueryFilters;

class Tags extends Filter
{
    public function applyFilter($builder)
    {
        $data = explode(',', request($this->filterName()));
        return $builder->whereHas('tags', function ($query) use ($data) {
            $query->whereIn('id', $data);
        });
    }
}
