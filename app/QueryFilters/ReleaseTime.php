<?php

namespace App\QueryFilters;

use DateTime;

class ReleaseTime extends Filter
{
    public function applyFilter($builder)
    {
        if (request($this->filterName()))
            return $builder->where('release_time', '<=', new DateTime());
    }
}
