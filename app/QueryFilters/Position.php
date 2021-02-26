<?php

namespace App\QueryFilters;

class Position extends Filter
{
    public function applyFilter($builder)
    {
        $data = explode(',', request($this->filterName()));
        // TODO: validate the values and define meaning variable
        return $builder->getByDistance($data[0], $data[1]);
    }
}
