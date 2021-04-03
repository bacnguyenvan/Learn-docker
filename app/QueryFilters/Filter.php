<?php

namespace App\QueryFilters;

use Closure;

abstract class Filter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has($this->filterName())) {
            return $next($request);
        }
        $builder = $next($request);

        return $this->applyFilter($builder);
    }

    protected function filterName()
    {
        return \Illuminate\Support\Str::snake(class_basename($this));
    }

    protected abstract function applyFilter($builder);
}
