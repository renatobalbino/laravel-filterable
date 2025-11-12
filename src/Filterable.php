<?php

namespace RbdevSys\Filterable;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param $query
     * @param QueryFilter $filter
     * @return Builder
     */
    public function scopeFilter($query, QueryFilter $filter): Builder
    {
        return $filter->apply($query);
    }
}
