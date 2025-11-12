<?php

namespace RbdevSys\Filterable\Filters;

use Illuminate\Database\Eloquent\Builder;
use RbdevSys\Filterable\QueryFilter;

class DummyFilter extends QueryFilter {
    public function id(): Builder
    {
        return $this->builder->where('dummyQueryParameter', 1);
    }
}
